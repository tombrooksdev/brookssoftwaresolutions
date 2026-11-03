<?php
/** @var array $args package */
$p = $args['package'];
$featured = !empty($p['featured']);
?>
<article id="<?= esc_attr($p['slug']) ?>" class="reveal relative flex flex-col rounded-[1.75rem] p-7 md:p-9 <?= $featured ? 'bg-[rgb(59_52_49)] text-[rgb(250_249_247)] shadow-xl shadow-ink/10 ring-1 ring-lavender/40' : 'border border-line bg-ivory' ?>">
  <?php if ($featured): ?><p class="absolute -top-3 left-7 rounded-full bg-lavender px-3 py-1 text-[.65rem] font-semibold uppercase tracking-[.2em] text-[rgb(59_52_49)]">Most loved</p><?php endif; ?>
  <div class="flex items-start justify-between gap-4">
    <span class="inline-flex h-12 w-12 items-center justify-center rounded-full <?= $featured ? 'bg-[rgb(250_249_247/.1)] text-lavender' : 'bg-sage-wash text-taupe-deep' ?>"><?= bb_icon($p['icon']) ?></span>
    <p class="text-right"><span class="block text-[.65rem] font-semibold uppercase tracking-[.2em] <?= $featured ? 'text-[rgb(250_249_247/.7)]' : 'text-ink-soft' ?>">From</span><span class="font-display text-5xl leading-none"><?= bb_price($p['price']) ?></span></p>
  </div>
  <h3 class="mt-7 font-display text-3xl <?= $featured ? '!text-[rgb(250_249_247)]' : '' ?>"><?= esc_html($p['name']) ?></h3>
  <p class="mt-3 text-sm leading-relaxed <?= $featured ? 'text-[rgb(250_249_247/.8)]' : 'text-ink-soft' ?>"><?= esc_html($p['summary']) ?></p>
  <dl class="mt-6 flex flex-wrap gap-x-6 gap-y-2 text-sm">
    <div class="flex items-center gap-2"><dt class="sr-only">Duration</dt><?= bb_icon('clock', 'icon h-4 w-4 ' . ($featured ? 'text-lavender' : 'text-taupe-deep')) ?><dd><?= esc_html($p['duration']) ?></dd></div>
    <div class="flex items-center gap-2"><dt class="sr-only">Images</dt><?= bb_icon('image', 'icon h-4 w-4 ' . ($featured ? 'text-lavender' : 'text-taupe-deep')) ?><dd><?= (int) $p['images'] ?> edited images</dd></div>
  </dl>
  <ul class="mt-6 space-y-3 border-t pt-6 text-sm <?= $featured ? 'border-[rgb(250_249_247/.15)]' : 'border-line' ?>">
    <?php foreach ($p['includes'] as $inc): ?>
    <li class="flex gap-3"><?= bb_icon('check', 'icon mt-0.5 h-4 w-4 ' . ($featured ? 'text-lavender' : 'text-sage')) ?><span><?= esc_html($inc) ?></span></li>
    <?php endforeach; ?>
  </ul>
  <div class="mt-auto pt-8">
    <a href="<?= esc_url(bb_booking_url($p)) ?>" data-book="<?= esc_attr($p['slug']) ?>" target="_blank" rel="noopener" class="btn w-full <?= $featured ? 'bg-[rgb(250_249_247)] text-[rgb(59_52_49)] hover:bg-lavender' : 'btn-primary' ?>"><?= bb_icon('calendar') ?> Book this session</a>
  </div>
</article>
