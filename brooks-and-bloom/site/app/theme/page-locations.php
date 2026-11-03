<?php
get_header();
$a = bb_content('areas');
?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, [
    'crumb' => 'Where I photograph', 'eyebrow' => 'Areas & locations', 'title' => 'Photographing families across', 'accent' => 'South Derbyshire',
    'intro' => 'Brooks & Bloom is based in ' . $a['base'] . ', a village in South Derbyshire on the edge of the National Forest, close to the Staffordshire and Leicestershire borders.']); ?>

  <section class="pb-16 md:pb-20">
    <div class="wrap grid gap-6 md:grid-cols-2">
      <div class="reveal rounded-[1.75rem] bg-surface p-7 md:p-10">
        <span class="flex items-center gap-3 text-taupe-deep"><?= bb_icon('home') ?><span class="eyebrow">Close to home</span></span>
        <h2 class="t-h3 mt-4">Villages around <?= esc_html($a['base']) ?></h2>
        <ul class="mt-6 flex flex-wrap gap-2"><?php foreach ($a['nearby'] as $t): ?><li class="chip"><?= esc_html($t) ?></li><?php endforeach; ?></ul>
      </div>
      <div class="reveal rounded-[1.75rem] bg-surface p-7 md:p-10" style="--d:.08s">
        <span class="flex items-center gap-3 text-taupe-deep"><?= bb_icon('car') ?><span class="eyebrow">Towns I travel to</span></span>
        <h2 class="t-h3 mt-4">Derbyshire, Staffordshire &amp; Leicestershire</h2>
        <ul class="mt-6 flex flex-wrap gap-2"><?php foreach ($a['towns'] as $t): ?><li class="chip"><?= esc_html($t) ?></li><?php endforeach; ?></ul>
      </div>
    </div>
    <p class="wrap reveal mt-8 flex items-center gap-2 text-sm text-ink-soft"><?= bb_icon('info', 'icon h-4 w-4 text-taupe-deep') ?> <?= esc_html(bb_config('travel_note')) ?></p>
  </section>

  <section class="bg-sage-wash py-20 md:py-28" aria-labelledby="spots-title">
    <div class="wrap">
      <?php get_template_part('template-parts/section-heading', null, ['center' => true, 'eyebrow' => 'Favourite spots', 'title' => 'Settings that', 'accent' => 'feel like you',
        'intro' => 'I will suggest a location that suits the season, the light and your family. If there is somewhere special to you, we can go there instead.']); ?>
      <ul class="mt-14 grid gap-6 md:grid-cols-3">
        <?php foreach ($a['spots'] as $i => $s): ?>
        <li class="reveal rounded-[1.5rem] bg-ivory p-7" style="--d:<?= $i * 0.08 ?>s">
          <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-sage-wash text-taupe-deep"><?= bb_icon($s['icon']) ?></span>
          <h3 class="t-h3 mt-5"><?= esc_html($s['title']) ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-ink-soft"><?= esc_html($s['text']) ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
  <?php get_template_part('template-parts/cta-band'); ?>
</main>
<?php get_footer(); ?>
