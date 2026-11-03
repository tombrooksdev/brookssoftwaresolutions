<?php
get_header();
$cats = bb_content('portfolio_categories');
$items = array_map(fn($p) => $p + ['label' => $cats[$p['cat']], 'url' => $p['src'] ? bb_asset('photos/' . $p['src']) : ''], bb_content('portfolio'));
ob_start(); ?>
<div class="masonry">
  <?php foreach ($items as $i => $p): ?>
  <figure class="reveal zoom-wrap rounded-2xl" style="--d:<?= ($i % 3) * 0.06 ?>s"><?= bb_photo($p, '', '(min-width:768px) 30vw, 50vw') ?><figcaption class="sr-only"><?= esc_html($p['alt']) ?></figcaption></figure>
  <?php endforeach; ?>
</div>
<?php $fallback = ob_get_clean(); ?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, [
    'crumb' => 'Portfolio', 'eyebrow' => 'Portfolio', 'title' => 'Real families,', 'accent' => 'real moments',
    'intro' => 'A collection of family, baby, pet and seasonal sessions from around South Derbyshire and the National Forest. Tap any photo to see it larger.']); ?>
  <section class="pb-20 md:pb-28" aria-label="Gallery">
    <div class="wrap">
      <?= bb_island('PortfolioGallery', ['items' => $items, 'categories' => $cats], $fallback) ?>
    </div>
  </section>
  <?php get_template_part('template-parts/cta-band', null, ['title' => 'Love what you see?', 'accent' => 'Let\'s talk']); ?>
</main>
<?php get_footer(); ?>
