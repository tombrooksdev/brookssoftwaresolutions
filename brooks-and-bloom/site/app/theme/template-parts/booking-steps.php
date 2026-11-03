<?php
/** The real booking sequence, so the numbering carries meaning. */
$steps = bb_content('booking_steps');
?>
<section class="relative overflow-hidden bg-lavender-wash py-20 md:py-28" aria-labelledby="how-booking-works">
  <span class="wash wash-sage -right-20 bottom-0 h-72 w-72" aria-hidden="true"></span>
  <div class="wrap relative">
    <div class="reveal mx-auto max-w-2xl text-center">
      <p class="eyebrow ruled">How booking works</p>
      <h2 id="how-booking-works" class="t-h2 mt-5">Simple from start <span class="serif-accent">to gallery</span></h2>
      <p class="t-lead mx-auto mt-5 max-w-prose"><?= esc_html(bb_content('deposit')['note']) ?></p>
    </div>
    <ol class="mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-5 lg:gap-0">
      <?php foreach ($steps as $i => $s): ?>
      <li class="reveal relative flex flex-col rounded-2xl bg-ivory/70 p-6 lg:rounded-none lg:bg-transparent lg:px-5 lg:text-center" style="--d:<?= $i * 0.08 ?>s">
        <?php if ($i < count($steps) - 1): ?><span class="absolute left-[calc(50%+2.5rem)] right-[calc(-50%+2.5rem)] top-[2.25rem] hidden h-px bg-taupe/40 lg:block" aria-hidden="true"></span><?php endif; ?>
        <span class="relative inline-flex h-[4.5rem] w-[4.5rem] items-center justify-center rounded-full border border-taupe/30 bg-ivory text-taupe-deep lg:mx-auto">
          <?= bb_icon($s['icon'], 'icon icon-lg') ?>
          <span class="absolute -right-1 -top-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-taupe-deep text-[.7rem] font-semibold text-on-accent"><?= $i + 1 ?></span>
        </span>
        <h3 class="t-h3 mt-5"><?= esc_html($s['title']) ?></h3>
        <p class="mt-2 text-sm leading-relaxed text-ink-soft"><?= esc_html($s['text']) ?></p>
      </li>
      <?php endforeach; ?>
    </ol>
    <div class="reveal mt-12 flex justify-center">
      <a href="<?= esc_url(bb_booking_url()) ?>" data-book target="_blank" rel="noopener" class="btn btn-primary"><?= bb_icon('calendar') ?> Check availability <?= bb_icon('arrow-right', 'icon icon-move') ?></a>
    </div>
  </div>
</section>
