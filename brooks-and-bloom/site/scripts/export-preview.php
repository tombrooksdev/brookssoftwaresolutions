<?php
/**
 * Builds the single-file preview (every page as a #hash view, assets inlined) from the
 * same templates as the live site.  Run after `npm run build`:
 *   php scripts/export-preview.php
 * Outputs:
 *   ../preview/index.html                      body-only page for the hosted Artifact link
 *   ../preview/brooks-and-bloom-preview.html   full standalone document (open on any phone or laptop)
 */
define('BB_EXPORT', true);
require dirname(__DIR__) . '/app/bootstrap.php';

function bb_export_asset(string $path): string {
    $file = BB_PUBLIC . '/assets/' . $path;
    if (!is_file($file)) return '';
    $mime = ['webp' => 'image/webp', 'png' => 'image/png', 'jpg' => 'image/jpeg', 'svg' => 'image/svg+xml'][pathinfo($file, PATHINFO_EXTENSION)] ?? 'application/octet-stream';
    return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file));
}

$build = BB_PUBLIC . '/assets/build';
$css = file_get_contents("$build/app.css");
$js  = str_replace('</script', '<\/script', file_get_contents("$build/app.js"));

$views = '';
foreach (BB_PAGES as $slug => $page) {
    ob_start();
    bb_render($slug);
    $html = ob_get_clean();
    $view = $slug === '' ? 'home' : $slug;
    $html = preg_replace('/<main id="main">/', '<main id="main-' . $view . '" data-view="' . $view . '"' . ($view === 'home' ? '' : ' hidden') . '>', $html, 1);
    $views .= $html . "\n";
}

ob_start();
get_template_part('template-parts/site-header', null, ['nav' => array_filter(BB_PAGES, fn($p) => $p['nav']), 'current' => '']);
$header = ob_get_clean();
$header = preg_replace('~<a href="#main" class="sr-only[^>]*>Skip to content</a>~', '', $header);
ob_start();
get_template_part('template-parts/site-footer');
$footer = ob_get_clean();
$sprite = file_get_contents(BB_THEME . '/icons.svg');

$fonts = '<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'
       . '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Montserrat:wght@400;500;600&display=swap">';

$body = $sprite . $header . $views . $footer . "<script>document.documentElement.classList.add('js');\n" . $js . "</script>\n";

$out = dirname(__DIR__, 2) . '/preview';
if (!is_dir($out)) mkdir($out, 0755, true);

file_put_contents("$out/index.html",
    "<title>Brooks &amp; Bloom Website</title>\n<meta name=\"claude:viewport-fit-sides\" content=\"cover\">\n<meta name=\"description\" content=\"" . esc_attr(bb_config('description')) . "\">\n"
    . $fonts . "\n<style>\n" . $css . "\n</style>\n" . $body);

file_put_contents("$out/brooks-and-bloom-preview.html",
    "<!doctype html>\n<html lang=\"en-GB\">\n<head>\n<meta charset=\"utf-8\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, viewport-fit=cover\">\n"
    . "<title>Brooks &amp; Bloom Website</title>\n<link rel=\"icon\" href=\"" . bb_export_asset('brand/favicon-32.png') . "\">\n"
    . $fonts . "\n<style>\n" . $css . "\n</style>\n</head>\n<body>\n" . $body . "</body>\n</html>\n");

printf("Wrote %s (%s KB) and standalone (%s KB)\n", "$out/index.html", round(filesize("$out/index.html") / 1024), round(filesize("$out/brooks-and-bloom-preview.html") / 1024));
