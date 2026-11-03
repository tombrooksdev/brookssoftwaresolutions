<?php
/** @var array $args title, accent, text */
$args += ['title' => 'Let\'s make some', 'accent' => 'memories', 'text' => 'Dates fill quickly, especially for seasonal minis. Check availability or send me a message and I will get back to you soon.'];
?>
<section class="relative overflow-hidden bg-sage-wash py-20 md:py-28">
  <span class="wash wash-lavender left-1/2 top-0 h-80 w-80 -translate-x-1/2 opacity-70" aria-hidden="true"></span>
  <div class="wrap relative">
    <div class="reveal mx-auto max-w-2xl text-center">
      <?= bb_icon('heart', 'icon mx-auto h-7 w-7 text-taupe') ?>
      <h2 class="t-h2 mt-5"><?= esc_html($args['title']) ?> <span class="serif-accent"><?= esc_html($args['accent']) ?></span></h2>
      <p class="t-lead mx-auto mt-5 max-w-prose"><?= esc_html($args['text']) ?></p>
      <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
        <a href="<?= esc_url(bb_booking_url()) ?>" data-book target="_blank" rel="noopener" class="btn btn-primary"><?= bb_icon('calendar') ?> Check availability</a>
        <a href="<?= esc_url(bb_url('contact')) ?>" class="btn btn-outline"><?= bb_icon('chat') ?> Send a message</a>
      </div>
    </div>
  </div>
</section>
