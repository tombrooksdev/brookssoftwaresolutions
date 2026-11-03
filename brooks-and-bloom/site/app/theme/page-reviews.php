<?php
get_header();
$c = bb_config();
?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, [
    'crumb' => 'Reviews', 'eyebrow' => 'Reviews', 'title' => 'Kind words from', 'accent' => 'lovely families',
    'intro' => 'Nothing means more than hearing how a session felt and how much the photos are loved. Here is what families have said.']); ?>
  <section class="pb-20 md:pb-28" aria-label="Client reviews">
    <div class="wrap">
      <ul class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach (bb_content('reviews') as $r): ?><li><?php get_template_part('template-parts/review-card', null, ['review' => $r]); ?></li><?php endforeach; ?>
      </ul>
      <div class="reveal mt-14 flex flex-col items-center gap-4 rounded-[1.75rem] bg-lavender-wash px-6 py-12 text-center">
        <?= bb_icon('star', 'icon icon-lg text-taupe-deep') ?>
        <h2 class="t-h3">Had a session with me?</h2>
        <p class="max-w-md text-sm text-ink-soft">I would be so grateful if you could leave a short review. It helps other local families find me.</p>
        <?php if ($c['google_review_url']): ?>
        <a href="<?= esc_url($c['google_review_url']) ?>" target="_blank" rel="noopener" class="btn btn-primary mt-2">Leave a Google review <?= bb_icon('arrow-up-right') ?></a>
        <?php else: ?>
        <a href="<?= esc_url(bb_url('contact')) ?>" class="btn btn-primary mt-2">Share your experience <?= bb_icon('arrow-right', 'icon icon-move') ?></a>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php get_template_part('template-parts/cta-band'); ?>
</main>
<?php get_footer(); ?>
