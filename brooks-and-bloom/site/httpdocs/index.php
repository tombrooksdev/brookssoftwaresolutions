<?php
/** Front controller. Plesk document root = httpdocs; app/ and storage/ sit outside it. */
require dirname(__DIR__) . '/app/bootstrap.php';

$path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');

header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-Frame-Options: SAMEORIGIN');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');

switch ($path) {
    case 'api/contact':
        require BB_APP . '/lib/contact.php';
        bb_handle_contact();
        exit;
    case 'sitemap.xml':
        header('Content-Type: application/xml; charset=utf-8');
        echo bb_sitemap();
        exit;
    case 'llms.txt':
        header('Content-Type: text/plain; charset=utf-8');
        echo bb_llms_txt(false);
        exit;
    case 'llms-full.txt':
        header('Content-Type: text/plain; charset=utf-8');
        echo bb_llms_txt(true);
        exit;
}

if (array_key_exists($path, BB_PAGES)) {
    // The contact form's CSRF token needs a session; other pages stay cookie-free.
    if ($path === 'contact' && session_status() !== PHP_SESSION_ACTIVE) {
        session_start(['cookie_httponly' => true, 'cookie_secure' => !empty($_SERVER['HTTPS']), 'cookie_samesite' => 'Lax']);
    }
    header('Content-Type: text/html; charset=utf-8');
    bb_render($path);
    exit;
}

http_response_code(404);
$GLOBALS['bb_slug'] = '404';
$GLOBALS['bb_page'] = ['nav' => 'Not found', 'title' => 'Page not found | Brooks & Bloom Photography',
    'description' => 'This page could not be found.', 'template' => '404'];
include BB_THEME . '/404.php';
