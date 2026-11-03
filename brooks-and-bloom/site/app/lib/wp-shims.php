<?php
/**
 * Minimal stand-ins for the WordPress functions the templates use, with the same
 * names and signatures. In the WordPress theme this file is deleted and the real
 * core functions take over, so the templates port without edits.
 */

if (!function_exists('esc_html')) {
    function esc_html($text): string { return htmlspecialchars((string) $text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}
if (!function_exists('esc_attr')) {
    function esc_attr($text): string { return htmlspecialchars((string) $text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}
if (!function_exists('esc_url')) {
    function esc_url($url): string {
        $url = trim((string) $url);
        if ($url === '' ) return '';
        if (!preg_match('~^(https?:|mailto:|tel:|/|#|\./|[a-z0-9-]+\.html)~i', $url)) return '';
        return htmlspecialchars($url, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
if (!function_exists('esc_html_e')) {
    function esc_html_e($text): void { echo esc_html($text); }
}
if (!function_exists('wp_json_encode')) {
    function wp_json_encode($data, int $flags = 0): string {
        return json_encode($data, $flags | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
    }
}
if (!function_exists('get_template_part')) {
    function get_template_part(string $slug, ?string $name = null, array $args = []): void {
        $file = BB_THEME . '/' . $slug . ($name ? "-{$name}" : '') . '.php';
        if (is_file($file)) { (static function () use ($file, $args) { include $file; })(); }
    }
}
if (!function_exists('get_header')) {
    function get_header(): void { if (!bb_is_export()) include BB_THEME . '/header.php'; }
}
if (!function_exists('get_footer')) {
    function get_footer(): void { if (!bb_is_export()) include BB_THEME . '/footer.php'; }
}
if (!function_exists('home_url')) {
    function home_url(string $path = ''): string { return rtrim(bb_config('url'), '/') . '/' . ltrim($path, '/'); }
}
if (!function_exists('get_bloginfo')) {
    function get_bloginfo(string $show = 'name'): string {
        return match ($show) { 'description' => bb_config('tagline'), default => bb_config('name') };
    }
}
if (!function_exists('wp_nonce_field')) {
    function wp_nonce_field(string $action = 'bb_contact'): void {
        echo '<input type="hidden" name="_token" value="' . esc_attr(bb_csrf_token()) . '">';
    }
}
