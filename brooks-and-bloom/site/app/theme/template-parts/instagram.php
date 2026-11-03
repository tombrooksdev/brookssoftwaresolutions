<?php
/** Static grid linking to Instagram. In WordPress, swap for a feed plugin (e.g. Smash Balloon) in this slot. */
$c = bb_config();
$tones = ['sage', 'lavender', 'taupe', 'lavender', 'sage', 'taupe'];
?>
<section class="py-20 md:py-28" aria-labelledby="instagram-heading">
  <div class="wrap">
    <div class="reveal flex flex-col items-center text-center">
      <?= bb_icon('instagram', 'icon icon-lg text-taupe-deep') ?>
      <h2 id="instagram-heading" class="t-h2 mt-4">Follow <span class="serif-accent">along</span></h2>
      <a href="<?= esc_url($c['social']['instagram']) ?>" target="_blank" rel="noopener" class="link-arrow mt-4">@brooks_and_bloom_photography <?= bb_icon('arrow-up-right') ?></a>
    </div>
    <ul class="mt-12 grid grid-cols-3 gap-2 md:grid-cols-6 md:gap-3">
      <?php foreach ($tones as $i => $t): ?>
      <li class="reveal" style="--d:<?= $i * 0.06 ?>s">
        <a href="<?= esc_url($c['social']['instagram']) ?>" target="_blank" rel="noopener" class="zoom-wrap group relative block rounded-xl" aria-label="View on Instagram">
          <?= bb_photo(['ratio' => '1/1', 'tone' => $t, 'alt' => '']) ?>
          <span class="absolute inset-0 flex items-center justify-center bg-ink/0 text-ivory opacity-0 transition duration-300 group-hover:bg-ink/30 group-hover:opacity-100"><?= bb_icon('instagram', 'icon icon-lg') ?></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
