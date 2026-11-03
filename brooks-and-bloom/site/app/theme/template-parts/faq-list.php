<?php
/** @var array $args limit */
$faqs = bb_content('faqs');
if (!empty($args['limit'])) $faqs = array_slice($faqs, 0, $args['limit']);
?>
<div class="divide-y divide-line border-y border-line">
  <?php foreach ($faqs as $i => $f): ?>
  <details class="faq group reveal" style="--d:<?= $i * 0.05 ?>s">
    <summary class="flex items-center justify-between gap-6 py-6 text-left">
      <h3 class="font-display text-xl font-medium leading-snug sm:text-2xl"><?= esc_html($f['q']) ?></h3>
      <span class="faq-icon inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-line text-taupe-deep group-hover:border-taupe-deep"><?= bb_icon('plus') ?></span>
    </summary>
    <div class="faq-body max-w-prose pb-7 pr-12 text-ink-soft"><p><?= esc_html($f['a']) ?></p></div>
  </details>
  <?php endforeach; ?>
</div>
