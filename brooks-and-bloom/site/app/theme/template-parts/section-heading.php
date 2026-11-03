<?php
/** @var array $args eyebrow, title, accent, intro, center, link, link_label */
$center = !empty($args['center']);
?>
<div class="reveal <?= $center ? 'mx-auto max-w-2xl text-center' : 'flex flex-col gap-6 md:flex-row md:items-end md:justify-between' ?>">
  <div class="<?= $center ? '' : 'max-w-2xl' ?>">
    <p class="eyebrow <?= $center ? 'ruled' : 'lead-rule' ?>"><?= esc_html($args['eyebrow']) ?></p>
    <h2 class="t-h2 mt-5"><?= esc_html($args['title']) ?><?php if (!empty($args['accent'])): ?> <span class="serif-accent"><?= esc_html($args['accent']) ?></span><?php endif; ?></h2>
    <?php if (!empty($args['intro'])): ?><p class="t-lead mt-5 <?= $center ? 'mx-auto' : '' ?> max-w-prose"><?= esc_html($args['intro']) ?></p><?php endif; ?>
  </div>
  <?php if (!empty($args['link']) && !$center): ?>
  <a class="link-arrow shrink-0" href="<?= esc_url($args['link']) ?>"><?= esc_html($args['link_label']) ?> <?= bb_icon('arrow-right') ?></a>
  <?php endif; ?>
</div>
