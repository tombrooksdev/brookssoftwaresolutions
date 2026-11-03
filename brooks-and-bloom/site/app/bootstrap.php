<?php
declare(strict_types=1);

define('BB_APP', __DIR__);
define('BB_THEME', __DIR__ . '/theme');
define('BB_STORAGE', dirname(__DIR__) . '/storage');
defined('BB_PUBLIC') || define('BB_PUBLIC', dirname(__DIR__) . '/httpdocs');

require BB_APP . '/lib/helpers.php';
require BB_APP . '/lib/wp-shims.php';
require BB_APP . '/lib/seo.php';
require BB_APP . '/lib/llms.php';

define('BB_PAGES', require BB_APP . '/lib/pages.php');

/** Render a page by slug (used by the front controller and the static exporter). */
function bb_render(string $slug): void {
    global $bb_slug, $bb_page;
    $bb_slug = $slug;
    $bb_page = BB_PAGES[$slug];
    include BB_THEME . '/' . $bb_page['template'] . '.php';
}
