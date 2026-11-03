<?php
/**
 * Contact form handler. Spam protection: CSRF token, honeypot field, minimum fill time,
 * and a per-IP rate limit stored outside the web root. Uses PHP mail(), which Plesk
 * routes through its own mail server. For better deliverability, switch to SMTP
 * (e.g. PHPMailer) or, in WordPress, wp_mail() with an SMTP plugin.
 */

function bb_contact_respond(bool $ok, string $message, int $code = 200): void {
    $wantsJson = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');
    if ($wantsJson) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok, 'message' => $message]);
        return;
    }
    header('Location: /contact/?sent=' . ($ok ? '1' : '0') . '#main', true, 303);
}

function bb_rate_limited(string $ip, int $max = 5, int $window = 3600): bool {
    $dir = BB_STORAGE . '/ratelimit';
    if (!is_dir($dir)) @mkdir($dir, 0750, true);
    $file = $dir . '/' . hash('sha256', $ip . __FILE__) . '.json';
    $now = time();
    $hits = is_file($file) ? array_filter((array) json_decode((string) file_get_contents($file), true), fn($t) => $t > $now - $window) : [];
    if (count($hits) >= $max) return true;
    $hits[] = $now;
    file_put_contents($file, json_encode(array_values($hits)), LOCK_EX);
    return false;
}

function bb_clean_line(string $s, int $max): string {
    return mb_substr(trim(preg_replace('/[\r\n\t]+/', ' ', $s)), 0, $max);
}

function bb_handle_contact(): void {
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { bb_contact_respond(false, 'Method not allowed.', 405); return; }
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    $token = (string) ($_POST['_token'] ?? '');
    if (empty($_SESSION['bb_csrf']) || !hash_equals($_SESSION['bb_csrf'], $token)) {
        bb_contact_respond(false, 'Your session expired. Please refresh the page and try again.', 419); return;
    }
    // Bots fill hidden fields and submit instantly. Pretend success so they don't retry.
    if (!empty($_POST['website']) || (time() - (int) ($_POST['started'] ?? 0)) < 3) { bb_contact_respond(true, 'Thank you.'); return; }
    if (bb_rate_limited($_SERVER['REMOTE_ADDR'] ?? 'unknown')) {
        bb_contact_respond(false, 'Too many messages in a short time. Please try again later or email me directly.', 429); return;
    }

    $name    = bb_clean_line((string) ($_POST['name'] ?? ''), 100);
    $email   = filter_var(trim((string) ($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL) ?: '';
    $session = bb_clean_line((string) ($_POST['session'] ?? ''), 80);
    $message = mb_substr(trim((string) ($_POST['message'] ?? '')), 0, 5000);
    $consent = !empty($_POST['consent']);

    if ($name === '' || $email === '' || $message === '' || !$consent) {
        bb_contact_respond(false, 'Please add your name, a valid email address and a message, and tick the consent box.', 422); return;
    }

    $c = bb_config();
    $subject = 'New enquiry: ' . ($session ?: 'General') . ' from ' . $name;
    $body = "Name: {$name}\nEmail: {$email}\nSession: {$session}\n\n{$message}\n\n--\nSent from " . home_url('contact/');
    $from = 'no-reply@' . (parse_url($c['url'], PHP_URL_HOST) ?: 'localhost');
    $headers = implode("\r\n", [
        'From: ' . $c['short_name'] . ' Website <' . $from . '>',
        'Reply-To: ' . $email,
        'Content-Type: text/plain; charset=UTF-8',
    ]);
    $ok = @mail($c['contact_to'], '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);

    bb_contact_respond($ok, $ok
        ? 'Thank you, ' . $name . '. Your message is on its way and I will be in touch soon.'
        : 'Sorry, your message could not be sent. Please email me at ' . $c['email'] . '.', $ok ? 200 : 500);
}
