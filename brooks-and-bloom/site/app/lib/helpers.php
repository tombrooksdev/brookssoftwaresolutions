<?php
/** Theme helpers. All prefixed bb_ so they can live unchanged in the WordPress theme's inc/ folder. */

function bb_config(?string $key = null) {
    static $config;
    $config ??= require BB_APP . '/config.php';
    return $key === null ? $config : ($config[$key] ?? null);
}

function bb_content(string $key) {
    static $content;
    $content ??= require BB_APP . '/content/content.php';
    return $content[$key] ?? [];
}

function bb_is_export(): bool { return defined('BB_EXPORT') && BB_EXPORT; }

/** Internal link. In the single-file preview every page is a hash view. */
function bb_url(string $slug = ''): string {
    if (bb_is_export()) return '#' . ($slug === '' ? 'home' : $slug);
    return '/' . ($slug === '' ? '' : $slug . '/');
}

function bb_asset(string $path): string {
    if (bb_is_export()) return bb_export_asset($path);
    $file = BB_PUBLIC . '/assets/' . $path;
    $v = is_file($file) ? '?v=' . filemtime($file) : '';
    return '/assets/' . $path . $v;
}

function bb_icon(string $name, string $class = 'icon'): string {
    return '<svg class="' . esc_attr($class) . '" aria-hidden="true" focusable="false"><use href="#i-' . esc_attr($name) . '"/></svg>';
}

function bb_price(int|float $amount): string { return '£' . number_format($amount, $amount == (int) $amount ? 0 : 2); }

/** Pixieset booking link with UTM tags so bookings from the site show up in analytics. */
function bb_booking_url(?array $package = null): string {
    $px  = bb_config('pixieset');
    $url = ($package['booking_url'] ?? '') ?: $px['booking_url'];
    if (!empty($px['utm'])) $url .= (str_contains($url, '?') ? '&' : '?') . $px['utm'] . ($package ? '&utm_content=' . rawurlencode($package['slug']) : '');
    return $url;
}

/** Real photo if one is set, otherwise a soft branded placeholder that holds the layout. */
function bb_photo(array $p, string $class = '', string $sizes = '100vw', bool $eager = false): string {
    $ratio = esc_attr($p['ratio'] ?? '4/5');
    $alt   = esc_attr($p['alt'] ?? '');
    if (!empty($p['src'])) {
        $loading = $eager ? 'loading="eager" fetchpriority="high"' : 'loading="lazy"';
        return '<img class="photo ' . esc_attr($class) . '" src="' . esc_url(bb_asset('photos/' . $p['src'])) . '" alt="' . $alt . '" style="aspect-ratio:' . $ratio . '" ' . $loading . ' decoding="async" sizes="' . esc_attr($sizes) . '">';
    }
    $tone  = esc_attr($p['tone'] ?? 'sage');
    $label = esc_html($p['label'] ?? '');
    $a11y  = $alt === '' ? 'aria-hidden="true"' : 'role="img" aria-label="' . $alt . '"';
    return '<div class="photo placeholder tone-' . $tone . ' ' . esc_attr($class) . '" style="aspect-ratio:' . $ratio . '" ' . $a11y . '>'
        . bb_icon('flower', 'placeholder-mark') . ($label ? '<span class="placeholder-label">' . $label . '</span>' : '') . '</div>';
}

function bb_csrf_token(): string {
    if (bb_is_export()) return 'preview';
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    return $_SESSION['bb_csrf'] ??= bin2hex(random_bytes(32));
}

/** Data for React islands, embedded as JSON so the island has the same content the server rendered. */
function bb_island(string $name, array $props, string $fallbackHtml, string $tag = 'div', string $class = ''): string {
    return '<' . $tag . ' data-island="' . esc_attr($name) . '" data-props="' . esc_attr(wp_json_encode($props)) . '"' . ($class ? ' class="' . esc_attr($class) . '"' : '') . '>' . $fallbackHtml . '</' . $tag . '>';
}

function bb_areas_sentence(): string {
    $a = bb_content('areas');
    $towns = $a['towns'];
    $last = array_pop($towns);
    return implode(', ', $towns) . ' and ' . $last;
}
