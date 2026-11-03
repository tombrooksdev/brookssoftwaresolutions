<?php
get_header();
$c = bb_config();
$ph = bb_content('photos');
$packages = array_column(bb_content('packages'), null, 'slug');
$a = bb_content('areas');
?>
<main id="main">

  <!-- Hero: the thesis. Real moments, local, easy to book. -->
  <section class="relative overflow-hidden pt-8 pb-20 md:pt-14 md:pb-28" aria-labelledby="hero-title">
    <div class="wrap relative grid items-center gap-14 lg:grid-cols-12 lg:gap-10">
      <div class="hero-in relative z-10 lg:col-span-5">
        <p class="eyebrow lead-rule" style="--i:0">Family &middot; Baby &middot; Pets</p>
        <h1 id="hero-title" class="t-display mt-7" style="--i:1">Beautiful moments, <span class="serif-accent">naturally.</span></h1>
        <p class="t-lead mt-7 max-w-md" style="--i:2">Relaxed, natural photography for families, little ones and pets in Coton in the Elms and across South Derbyshire. No pressure to pose perfectly. Just moments worth remembering.</p>
        <div class="mt-9 flex flex-col gap-3 sm:flex-row" style="--i:3">
          <a href="<?= esc_url(bb_booking_url()) ?>" data-book target="_blank" rel="noopener" class="btn btn-primary"><?= bb_icon('calendar') ?> Check availability</a>
          <a href="<?= esc_url(bb_url('packages')) ?>" class="btn btn-outline">View packages <?= bb_icon('arrow-right', 'icon icon-move') ?></a>
        </div>
        <ul class="mt-10 flex flex-wrap gap-x-6 gap-y-3 text-sm text-ink-soft" style="--i:4">
          <li class="flex items-center gap-2"><?= bb_icon('map-pin', 'icon h-4 w-4 text-taupe-deep') ?> Coton in the Elms, Derbyshire</li>
          <li class="flex items-center gap-2"><?= bb_icon('pound', 'icon h-4 w-4 text-taupe-deep') ?> Sessions from <?= bb_price(min(array_column($packages, 'price'))) ?></li>
        </ul>
      </div>

      <div class="relative lg:col-span-7" aria-hidden="false">
        <span class="wash wash-lavender right-[8%] top-[6%] h-[22rem] w-[22rem]" aria-hidden="true"></span>
        <span class="wash wash-sage bottom-[2%] left-[4%] h-64 w-64" aria-hidden="true"></span>
        <div class="relative mx-auto grid max-w-xl grid-cols-12 gap-4 lg:max-w-none">
          <div class="hero-photo col-span-8 col-start-3 sm:col-span-7 sm:col-start-4" style="--i:0">
            <div class="frame-arch shadow-xl shadow-taupe/10"><?= bb_photo($ph['hero_main'], '', '(min-width:1024px) 40vw, 70vw', true) ?></div>
          </div>
          <div class="hero-photo absolute bottom-[-6%] left-0 w-[40%] sm:w-[36%]" style="--i:2">
            <div class="frame-soft border-[6px] border-ivory shadow-lg shadow-taupe/10"><?= bb_photo($ph['hero_small']) ?></div>
          </div>
          <div class="hero-photo absolute right-0 top-[8%] hidden w-[26%] sm:block" style="--i:3">
            <div class="frame-soft border-[6px] border-ivory shadow-lg shadow-taupe/10"><?= bb_photo($ph['hero_pet']) ?></div>
          </div>
          <svg class="draw pointer-events-none absolute -left-4 top-[4%] hidden h-[60%] w-auto text-taupe sm:block" viewBox="0 0 180 320" fill="none" stroke="currentColor" stroke-width="1.1" stroke-linecap="round" aria-hidden="true">
            <path d="M24 314C46 250 70 190 104 128C122 94 140 62 162 30"/>
            <path d="M58 238C40 230 28 214 26 196C46 198 60 214 58 238Z"/>
            <path d="M66 220C84 206 104 204 120 212C106 228 86 232 66 220Z"/>
            <path d="M88 168C70 158 62 140 64 122C82 128 92 146 88 168Z"/>
            <path d="M98 150C114 134 134 130 150 136C138 154 118 158 98 150Z"/>
            <path d="M136 82C124 70 122 52 128 38C140 48 144 66 136 82Z"/>
            <path d="M162 30C156 22 158 10 166 4C172 12 170 24 162 30Z"/>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- Intro, straight from the brand voice -->
  <section class="relative py-20 md:py-28" aria-labelledby="intro-title">
    <div class="wrap grid items-center gap-12 md:grid-cols-12">
      <div class="reveal md:col-span-5">
        <div class="relative mx-auto max-w-sm">
          <div class="frame-arch"><?= bb_photo($ph['about'], '', '(min-width:768px) 35vw, 90vw') ?></div>
          <span class="absolute -bottom-6 -right-2 inline-flex h-20 w-20 sm:-right-6 sm:h-24 sm:w-24 items-center justify-center rounded-full bg-ivory shadow-md shadow-taupe/10"><?= bb_icon('heart', 'icon h-8 w-8 text-taupe') ?></span>
        </div>
      </div>
      <div class="reveal md:col-span-6 md:col-start-7" style="--d:.1s">
        <p class="eyebrow lead-rule">Hello, lovely to meet you</p>
        <h2 id="intro-title" class="t-h2 mt-5">A little about <span class="serif-accent">Brooks &amp; Bloom</span></h2>
        <div class="mt-6 max-w-prose space-y-4 text-ink-soft">
          <p>Natural, relaxed photography for families, little ones and pets. I'm a photographer based in the village of Coton in the Elms, right on the edge of the National Forest.</p>
          <p>Sessions are gentle and unhurried. We walk, play, cuddle and laugh, and I quietly capture the moments that make your family yours. No stiff poses, no pressure, just real photographs you will treasure.</p>
        </div>
        <a href="<?= esc_url(bb_url('about')) ?>" class="link-arrow mt-8">More about me <?= bb_icon('arrow-right') ?></a>
      </div>
    </div>
  </section>

  <!-- Sessions -->
  <section class="bg-surface py-20 md:py-28" aria-labelledby="sessions-title">
    <div class="wrap">
      <?php get_template_part('template-parts/section-heading', null, [
        'eyebrow' => 'Sessions', 'title' => 'Photography for the people', 'accent' => '(and pets) you love',
        'link' => bb_url('packages'), 'link_label' => 'Packages & prices']); ?>
      <ul class="-mx-4 mt-14 flex snap-x snap-mandatory gap-4 overflow-x-auto px-4 pb-2 no-scrollbar sm:mx-0 sm:grid sm:grid-cols-2 sm:gap-6 sm:overflow-visible sm:px-0 lg:grid-cols-4">
        <?php foreach (bb_content('services') as $i => $s): $pk = $packages[$s['slug']] ?? null; ?>
        <li class="reveal w-[72%] shrink-0 snap-start sm:w-auto" style="--d:<?= $i * 0.08 ?>s">
          <a href="<?= esc_url(bb_url('packages') . (bb_is_export() ? '' : '#' . $s['slug'])) ?>" class="group flex h-full flex-col">
            <div class="zoom-wrap frame-arch"><?= bb_photo($ph[$s['slug']], '', '(min-width:1024px) 22vw, (min-width:640px) 45vw, 90vw') ?></div>
            <div class="flex flex-1 flex-col pt-6">
              <span class="flex items-center gap-3 text-taupe-deep"><?= bb_icon($s['icon']) ?><?php if ($pk): ?><span class="text-[.68rem] font-semibold uppercase tracking-[.2em]">From <?= bb_price($pk['price']) ?></span><?php endif; ?></span>
              <h3 class="t-h3 mt-3 transition-colors group-hover:text-taupe-deep"><?= esc_html($s['title']) ?></h3>
              <p class="mt-2 text-sm leading-relaxed text-ink-soft"><?= esc_html($s['text']) ?></p>
            </div>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- Portfolio teaser -->
  <section class="py-20 md:py-28" aria-labelledby="portfolio-teaser">
    <div class="wrap">
      <?php get_template_part('template-parts/section-heading', null, [
        'eyebrow' => 'Portfolio', 'title' => 'Real moments,', 'accent' => 'gently captured',
        'link' => bb_url('portfolio'), 'link_label' => 'View the portfolio']); ?>
      <div class="mt-14 masonry">
        <?php foreach (array_slice(bb_content('portfolio'), 0, 6) as $i => $p): ?>
        <a href="<?= esc_url(bb_url('portfolio')) ?>" class="reveal zoom-wrap block rounded-2xl" style="--d:<?= ($i % 3) * 0.08 ?>s"><?= bb_photo($p + ['label' => bb_content('portfolio_categories')[$p['cat']]], '', '(min-width:768px) 30vw, 50vw') ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/booking-steps'); ?>

  <!-- Reviews -->
  <section class="py-20 md:py-28" aria-labelledby="reviews-title">
    <div class="wrap">
      <?php get_template_part('template-parts/section-heading', null, [
        'eyebrow' => 'Kind words', 'title' => 'From the families', 'accent' => 'I\'ve photographed',
        'link' => bb_url('reviews'), 'link_label' => 'All reviews']); ?>
      <?php
      $reviews = bb_content('reviews');
      ob_start();
      echo '<ul class="mt-14 grid gap-6 md:grid-cols-3">';
      foreach ($reviews as $r) { echo '<li>'; get_template_part('template-parts/review-card', null, ['review' => $r]); echo '</li>'; }
      echo '</ul>';
      echo bb_island('Testimonials', ['reviews' => $reviews], ob_get_clean());
      ?>
    </div>
  </section>

  <!-- Areas -->
  <section class="relative overflow-hidden bg-surface py-20 md:py-24" aria-labelledby="areas-title">
    <div class="wrap grid gap-10 lg:grid-cols-12 lg:items-center">
      <div class="reveal lg:col-span-5">
        <p class="eyebrow lead-rule">Where I photograph</p>
        <h2 id="areas-title" class="t-h2 mt-5">Rooted in <span class="serif-accent">the National Forest</span></h2>
        <p class="t-lead mt-5 max-w-prose">Based in <?= esc_html($a['base']) ?>, I photograph families across South Derbyshire, East Staffordshire and North West Leicestershire. <?= esc_html($c['travel_note']) ?></p>
        <a href="<?= esc_url(bb_url('locations')) ?>" class="link-arrow mt-8">Areas &amp; locations <?= bb_icon('arrow-right') ?></a>
      </div>
      <ul class="reveal flex flex-wrap gap-2 lg:col-span-6 lg:col-start-7" style="--d:.1s" aria-label="Areas covered">
        <li class="chip !border-taupe-deep !bg-taupe-deep !text-on-accent"><?= bb_icon('map-pin', 'icon h-4 w-4') ?> <?= esc_html($a['base']) ?></li>
        <?php foreach (array_merge(array_slice($a['nearby'], 0, 4), $a['towns']) as $t): ?>
        <li class="chip"><?= esc_html($t) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- FAQ teaser -->
  <section class="py-20 md:py-28" aria-labelledby="faq-teaser">
    <div class="wrap grid gap-12 lg:grid-cols-12">
      <div class="reveal lg:col-span-4">
        <p class="eyebrow lead-rule">Good to know</p>
        <h2 id="faq-teaser" class="t-h2 mt-5">Questions, <span class="serif-accent">answered</span></h2>
        <p class="t-lead mt-5">Everything from rainy days to wriggly toddlers.</p>
        <a href="<?= esc_url(bb_url('faq')) ?>" class="link-arrow mt-8">All FAQs <?= bb_icon('arrow-right') ?></a>
      </div>
      <div class="lg:col-span-8"><?php get_template_part('template-parts/faq-list', null, ['limit' => 4]); ?></div>
    </div>
  </section>

  <?php get_template_part('template-parts/instagram'); ?>
  <?php get_template_part('template-parts/cta-band'); ?>
</main>
<?php get_footer(); ?>
