<?php
$c = bb_config();
$a = bb_content('areas');
$year = date('Y');
?>
<footer id="site-footer" class="relative mt-0 overflow-hidden bg-surface pt-20 pb-28 lg:pb-12">
  <div class="wrap relative grid gap-14 lg:grid-cols-12">
    <div class="lg:col-span-4">
      <a href="<?= esc_url(bb_url('')) ?>" class="inline-block" aria-label="Brooks &amp; Bloom Photography, home">
        <picture>
          <source srcset="<?= esc_url(bb_asset('brand/logo-dark.webp')) ?>" media="(prefers-color-scheme: dark)">
          <img src="<?= esc_url(bb_asset('brand/logo-light.webp')) ?>" alt="Brooks &amp; Bloom Photography" width="220" height="194" loading="lazy" class="w-52 h-auto">
        </picture>
      </a>
      <p class="mt-6 max-w-xs text-sm leading-relaxed text-ink-soft">Natural, relaxed photography for families, little ones and pets. Based in <?= esc_html($a['base']) ?>, South Derbyshire.</p>
      <div class="mt-6 flex gap-3">
        <a href="<?= esc_url($c['social']['instagram']) ?>" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-line text-ink transition-colors hover:border-taupe-deep hover:text-taupe-deep" aria-label="Instagram" target="_blank" rel="noopener"><?= bb_icon('instagram') ?></a>
        <?php if ($c['social']['facebook']): ?>
        <a href="<?= esc_url($c['social']['facebook']) ?>" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-line text-ink transition-colors hover:border-taupe-deep hover:text-taupe-deep" aria-label="Facebook" target="_blank" rel="noopener"><?= bb_icon('facebook') ?></a>
        <?php endif; ?>
        <a href="mailto:<?= esc_attr($c['email']) ?>" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-line text-ink transition-colors hover:border-taupe-deep hover:text-taupe-deep" aria-label="Email"><?= bb_icon('mail') ?></a>
      </div>
    </div>

    <nav aria-label="Footer" class="grid grid-cols-2 gap-10 sm:grid-cols-3 lg:col-span-8">
      <div>
        <h2 class="eyebrow">Explore</h2>
        <ul class="mt-5 space-y-3 text-sm">
          <?php foreach (BB_PAGES as $slug => $p): if (!$p['nav'] && !in_array($slug, ['faq', 'locations'], true)) continue; ?>
          <li><a class="link-underline text-ink hover:text-taupe-deep" href="<?= esc_url(bb_url($slug)) ?>"><?= esc_html($p['nav'] ?? ($slug === 'faq' ? 'FAQs' : 'Where I photograph')) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <h2 class="eyebrow">Sessions</h2>
        <ul class="mt-5 space-y-3 text-sm">
          <?php foreach (bb_content('packages') as $p): ?>
          <li><a class="link-underline text-ink hover:text-taupe-deep" href="<?= esc_url(bb_url('packages')) ?>"><?= esc_html($p['name']) ?></a></li>
          <?php endforeach; ?>
          <li><a class="link-underline text-ink hover:text-taupe-deep" href="<?= esc_url($c['pixieset']['client_gallery_url']) ?>" target="_blank" rel="noopener">Client galleries</a></li>
        </ul>
      </div>
      <div class="col-span-2 sm:col-span-1">
        <h2 class="eyebrow">Find me</h2>
        <address class="mt-5 space-y-3 text-sm not-italic text-ink">
          <p class="flex gap-2"><?= bb_icon('map-pin', 'icon mt-1 h-4 w-4 text-taupe-deep') ?><span><?= esc_html($c['address']['locality']) ?>, South Derbyshire</span></p>
          <p class="flex gap-2"><?= bb_icon('mail', 'icon mt-1 h-4 w-4 text-taupe-deep') ?><a class="link-underline break-all" href="mailto:<?= esc_attr($c['email']) ?>"><?= esc_html($c['email']) ?></a></p>
          <?php if ($c['phone']): ?><p class="flex gap-2"><?= bb_icon('phone', 'icon mt-1 h-4 w-4 text-taupe-deep') ?><a class="link-underline" href="tel:<?= esc_attr(preg_replace('/\s+/', '', $c['phone'])) ?>"><?= esc_html($c['phone']) ?></a></p><?php endif; ?>
        </address>
        <p class="mt-5 text-xs leading-relaxed text-ink-soft">Covering <?= esc_html(bb_areas_sentence()) ?>.</p>
      </div>
    </nav>
  </div>

  <div class="wrap relative mt-16">
    <div class="flex flex-col items-start justify-between gap-4 border-t border-line pt-8 text-xs text-ink-soft sm:flex-row sm:items-center">
      <p>&copy; <?= $year ?> <?= esc_html($c['name']) ?>. All photographs are the property of their creator.</p>
      <div class="flex items-center gap-6">
        <a class="link-underline" href="<?= esc_url(bb_url('privacy')) ?>">Privacy</a>
        <a href="#top" class="inline-flex items-center gap-2 link-underline" data-to-top><?= bb_icon('arrow-up', 'icon h-4 w-4') ?> Back to top</a>
      </div>
    </div>
  </div>
</footer>

<div class="mobile-cta" data-mobile-cta>
  <div class="flex items-center gap-3">
    <a href="<?= esc_url(bb_booking_url()) ?>" data-book target="_blank" rel="noopener" class="btn btn-primary flex-1"><?= bb_icon('calendar') ?> Check availability</a>
    <a href="<?= esc_url(bb_url('contact')) ?>" class="btn btn-outline h-12 w-12 !p-0" aria-label="Send a message"><?= bb_icon('chat') ?></a>
  </div>
</div>

<?= bb_island('BookingDrawer', [
    'packages' => array_map(fn($p) => [
        'slug' => $p['slug'], 'name' => $p['name'], 'price' => bb_price($p['price']), 'duration' => $p['duration'],
        'images' => $p['images'], 'summary' => $p['summary'], 'url' => bb_booking_url($p),
    ], bb_content('packages')),
    'bookingUrl' => bb_booking_url(),
    'deposit' => bb_content('deposit'),
    'contactUrl' => bb_url('contact'),
], '') ?>

