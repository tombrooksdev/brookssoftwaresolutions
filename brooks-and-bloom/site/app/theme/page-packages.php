<?php
get_header();
$d = bb_content('deposit');
?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, [
    'crumb' => 'Packages', 'eyebrow' => 'Packages & prices', 'title' => 'Clear prices,', 'accent' => 'no surprises',
    'intro' => 'Every session includes hand-edited images in a private online gallery, with a print release for personal use. Pick the one that suits you, or get in touch and we will find the right fit.']); ?>

  <section class="pb-16 md:pb-20" aria-label="Packages">
    <div class="wrap">
      <div class="reveal mb-12 flex flex-col gap-4 rounded-[1.5rem] border border-line bg-surface p-6 sm:flex-row sm:items-center sm:gap-6 md:p-7">
        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-ivory text-taupe-deep"><?= bb_icon('shield') ?></span>
        <p class="text-sm leading-relaxed text-ink"><strong class="font-semibold"><?= bb_price($d['amount']) ?> booking fee.</strong> <?= esc_html(preg_replace('/^A £\d+ booking fee /', 'It ', $d['note'])) ?></p>
      </div>
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <?php foreach (bb_content('packages') as $p) get_template_part('template-parts/package-card', null, ['package' => $p]); ?>
      </div>
      <p class="reveal mt-8 flex items-center gap-2 text-sm text-ink-soft"><?= bb_icon('car', 'icon h-4 w-4 text-taupe-deep') ?> <?= esc_html(bb_config('travel_note')) ?></p>
    </div>
  </section>

  <section class="py-16 md:py-20" aria-labelledby="addons-title">
    <div class="wrap">
      <?php get_template_part('template-parts/section-heading', null, ['eyebrow' => 'Extras', 'title' => 'Add-ons &', 'accent' => 'keepsakes']); ?>
      <ul class="mt-12 grid gap-px overflow-hidden rounded-[1.5rem] border border-line bg-line sm:grid-cols-2 lg:grid-cols-4">
        <?php foreach (bb_content('addons') as $i => $x): ?>
        <li class="reveal bg-ivory p-7" style="--d:<?= $i * 0.06 ?>s">
          <?= bb_icon($x['icon'], 'icon icon-lg text-taupe-deep') ?>
          <h3 class="t-h3 mt-4"><?= esc_html($x['title']) ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-ink-soft"><?= esc_html($x['text']) ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <?php get_template_part('template-parts/booking-steps'); ?>

  <section class="py-20 md:py-28" aria-labelledby="pk-faq">
    <div class="wrap grid gap-12 lg:grid-cols-12">
      <div class="reveal lg:col-span-4">
        <p class="eyebrow lead-rule">Before you book</p>
        <h2 id="pk-faq" class="t-h2 mt-5">Common <span class="serif-accent">questions</span></h2>
        <a href="<?= esc_url(bb_url('faq')) ?>" class="link-arrow mt-8">All FAQs <?= bb_icon('arrow-right') ?></a>
      </div>
      <div class="lg:col-span-8"><?php get_template_part('template-parts/faq-list', null, ['limit' => 5]); ?></div>
    </div>
  </section>
  <?php get_template_part('template-parts/cta-band'); ?>
</main>
<?php get_footer(); ?>
