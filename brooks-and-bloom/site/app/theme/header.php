<?php
/** Document head + site header. In WordPress, bb_meta_tags/bb_schema_graph move into wp_head hooks. */
global $bb_slug, $bb_page;
$c = bb_config();
$nav = array_filter(BB_PAGES, fn($p) => $p['nav']);
?><!doctype html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?= bb_meta_tags($bb_slug, $bb_page) ?>

<meta name="theme-color" content="#FAF9F7" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#1F1B19" media="(prefers-color-scheme: dark)">
<link rel="icon" href="/assets/brand/favicon.ico" sizes="any">
<link rel="icon" type="image/png" href="/assets/brand/favicon-32.png" sizes="32x32">
<link rel="apple-touch-icon" href="/assets/brand/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Montserrat:wght@400;500;600&display=swap">
<link rel="stylesheet" href="<?= esc_url(bb_asset('build/app.css')) ?>">
<script>document.documentElement.classList.add('js')</script>
<?= bb_schema_graph($bb_slug, $bb_page) ?>

</head>
<body>
<?php include BB_THEME . '/icons.svg'; ?>
<?php get_template_part('template-parts/site-header', null, ['nav' => $nav, 'current' => $bb_slug]); ?>
