<?php
/** @var array $args eyebrow, title, accent, intro, crumb */
?>
<section class="relative overflow-hidden pt-10 pb-14 md:pt-16 md:pb-20">
  <span class="wash wash-lavender -right-24 -top-24 h-72 w-72" aria-hidden="true"></span>
  <span class="wash wash-sage -left-32 top-24 h-64 w-64 opacity-60" aria-hidden="true"></span>
  <div class="wrap relative">
    <nav aria-label="Breadcrumb" class="mb-10 text-xs text-ink-soft">
      <ol class="flex items-center gap-2">
        <li><a class="link-underline" href="<?= esc_url(bb_url('')) ?>">Home</a></li>
        <li aria-hidden="true"><?= bb_icon('chevron-right', 'icon h-3 w-3') ?></li>
        <li aria-current="page"><?= esc_html($args['crumb']) ?></li>
      </ol>
    </nav>
    <div class="hero-in max-w-3xl">
      <p class="eyebrow lead-rule" style="--i:0"><?= esc_html($args['eyebrow']) ?></p>
      <h1 class="t-display mt-6" style="--i:1"><?= esc_html($args['title']) ?><?php if (!empty($args['accent'])): ?> <span class="serif-accent"><?= esc_html($args['accent']) ?></span><?php endif; ?></h1>
      <?php if (!empty($args['intro'])): ?><p class="t-lead mt-6 max-w-prose" style="--i:2"><?= esc_html($args['intro']) ?></p><?php endif; ?>
    </div>
  </div>
</section>
