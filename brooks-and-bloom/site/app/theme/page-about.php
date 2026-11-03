<?php
get_header();
$c = bb_config();
$ph = bb_content('photos');
$a = bb_content('areas');
$name = $c['photographer_name'];
$values = [
  ['icon' => 'sprig',  'title' => 'Natural',  'text' => 'Gentle prompts and play instead of stiff poses, so you look and feel like yourselves.'],
  ['icon' => 'sun',    'title' => 'Warm',     'text' => 'Soft light, soft colours and an easy pace. Little ones are never rushed.'],
  ['icon' => 'heart',  'title' => 'Genuine',  'text' => 'The giggles, the cuddles and the in-between moments are what we are here for.'],
  ['icon' => 'leaf',   'title' => 'Timeless', 'text' => 'A light, classic edit that will look as lovely in twenty years as it does today.'],
];
?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, [
    'crumb' => 'About', 'eyebrow' => 'About',
    'title' => $name ? "Hello, I'm {$name}." : 'Hello, and', 'accent' => $name ? '' : 'welcome.',
    'intro' => 'The photographer behind Brooks & Bloom. Natural, relaxed photography for families, little ones and pets, from a small village on the edge of the National Forest.']); ?>

  <section class="pb-20 md:pb-28">
    <div class="wrap grid gap-12 md:grid-cols-12 md:items-start">
      <div class="reveal relative md:col-span-5">
        <div class="frame-arch"><?= bb_photo($ph['about'], '', '(min-width:768px) 38vw, 90vw', true) ?></div>
        <div class="frame-soft absolute -bottom-10 -right-2 w-2/5 border-[6px] border-ivory md:-right-10"><?= bb_photo($ph['about_2']) ?></div>
      </div>
      <div class="reveal md:col-span-6 md:col-start-7" style="--d:.1s">
        <h2 class="t-h2">Moments worth <span class="serif-accent">remembering</span></h2>
        <div class="mt-6 max-w-prose space-y-5 text-ink-soft">
          <p>Brooks &amp; Bloom started with a simple idea: family photos should feel like your family, not like a photo shoot. The best pictures happen when everyone relaxes, so that is what my sessions are built around.</p>
          <p>We might wander through the woods, chase the dog across a meadow or snuggle up at home with a brand new baby. I will guide you gently along the way, but there is no pressure to pose perfectly. Wriggles, giggles and muddy knees are all welcome.</p>
          <p>I'm based in <?= esc_html($a['base']) ?>, a few minutes from Rosliston and the heart of the National Forest, and I photograph families across Burton upon Trent, Swadlincote, Lichfield and the villages in between.</p>
        </div>
        <!-- Facts block: quick to scan for people, easy to quote for search engines and AI assistants -->
        <dl class="mt-10 grid gap-x-8 gap-y-5 rounded-[1.5rem] bg-surface p-7 text-sm sm:grid-cols-2">
          <div><dt class="eyebrow !tracking-[.22em]">Based in</dt><dd class="mt-1.5"><?= esc_html($a['base']) ?>, South Derbyshire</dd></div>
          <div><dt class="eyebrow !tracking-[.22em]">Photographing</dt><dd class="mt-1.5">Families, newborns, babies, pets and seasonal minis</dd></div>
          <div><dt class="eyebrow !tracking-[.22em]">Style</dt><dd class="mt-1.5">Natural, relaxed, light and timeless</dd></div>
          <div><dt class="eyebrow !tracking-[.22em]">Galleries</dt><dd class="mt-1.5">Private online gallery within 2 to 3 weeks</dd></div>
        </dl>
      </div>
    </div>
  </section>

  <section class="bg-sage-wash py-20 md:py-28" aria-labelledby="values-title">
    <div class="wrap">
      <?php get_template_part('template-parts/section-heading', null, ['center' => true, 'eyebrow' => 'What to expect', 'title' => 'How a session', 'accent' => 'feels']); ?>
      <ul class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <?php foreach ($values as $i => $v): ?>
        <li class="reveal rounded-[1.5rem] bg-ivory p-7" style="--d:<?= $i * 0.08 ?>s">
          <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-sage-wash text-taupe-deep"><?= bb_icon($v['icon']) ?></span>
          <h3 class="t-h3 mt-5"><?= esc_html($v['title']) ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-ink-soft"><?= esc_html($v['text']) ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <?php get_template_part('template-parts/instagram'); ?>
  <?php get_template_part('template-parts/cta-band', null, ['title' => 'I would love to', 'accent' => 'meet you']); ?>
</main>
<?php get_footer(); ?>
