<?php
/** @var array $args review */
$r = $args['review'];
?>
<figure class="reveal flex h-full flex-col rounded-[1.5rem] border border-line bg-ivory p-7 md:p-8">
  <div class="flex items-center justify-between gap-4">
    <span class="flex gap-1 text-taupe" aria-label="5 out of 5 stars"><?php for ($i = 0; $i < 5; $i++) echo bb_icon('star', 'icon icon-fill h-4 w-4'); ?></span>
    <?php if (!empty($r['sample'])): ?><span class="rounded-full bg-lavender-wash px-2.5 py-1 text-[.62rem] font-semibold uppercase tracking-[.18em] text-ink-soft">Sample</span><?php endif; ?>
  </div>
  <blockquote class="mt-5 flex-1 font-display text-[1.45rem] leading-snug text-ink"><p>&ldquo;<?= esc_html($r['quote']) ?>&rdquo;</p></blockquote>
  <figcaption class="mt-6 border-t border-line pt-5 text-sm"><span class="font-semibold"><?= esc_html($r['name']) ?></span> <span class="text-ink-soft">&middot; <?= esc_html($r['session']) ?></span></figcaption>
</figure>
