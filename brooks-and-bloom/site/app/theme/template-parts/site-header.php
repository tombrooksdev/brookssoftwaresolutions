<?php
/** @var array $args nav, current */
$nav = $args['nav'];
$current = $args['current'];
$c = bb_config();
$links = [];
foreach ($nav as $slug => $p) $links[] = ['href' => bb_url($slug), 'label' => $p['nav'], 'slug' => $slug === '' ? 'home' : $slug];
?>
<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-full focus:bg-ink focus:px-5 focus:py-3 focus:text-sm focus:text-ivory">Skip to content</a>

<?php if ($c['draft_notice']): ?>
<div class="bg-lavender-wash text-ink-soft" data-draft-notice>
  <div class="wrap flex items-center justify-center gap-2 py-2 text-center text-xs">
    <?= bb_icon('info', 'icon h-4 w-4') ?>
    <p>Draft preview. Photos, prices and reviews are placeholders to be replaced before launch.</p>
  </div>
</div>
<?php endif; ?>

<header class="site-header" data-site-header>
  <div class="wrap flex h-[76px] items-center justify-between gap-3 sm:gap-6">
    <a href="<?= esc_url(bb_url('')) ?>" class="group flex min-w-0 items-center gap-2.5 sm:gap-3" aria-label="Brooks &amp; Bloom Photography, home">
      <picture>
        <source srcset="<?= esc_url(bb_asset('brand/logo-mark-dark.webp')) ?>" media="(prefers-color-scheme: dark)">
        <img src="<?= esc_url(bb_asset('brand/logo-mark-light.webp')) ?>" alt="" width="40" height="47" class="h-10 w-auto shrink-0 sm:h-12 transition-transform duration-500 ease-soft group-hover:-rotate-3">
      </picture>
      <span class="flex flex-col leading-none">
        <span class="whitespace-nowrap font-display text-[1.05rem] uppercase tracking-[.14em] text-taupe-deep min-[400px]:text-[1.2rem] sm:text-[1.35rem] sm:tracking-[.22em]">Brooks &amp; Bloom</span>
        <span class="mt-1 text-[.52rem] font-medium uppercase tracking-[.42em] text-ink-soft sm:text-[.58rem] sm:tracking-[.5em]">Photography</span>
      </span>
    </a>

    <nav aria-label="Main" class="hidden lg:block">
      <ul class="flex items-center gap-8" data-nav-list>
        <?php foreach ($links as $l): $isCurrent = ($current === '' ? 'home' : $current) === $l['slug']; ?>
        <li><a href="<?= esc_url($l['href']) ?>" data-nav="<?= esc_attr($l['slug']) ?>" class="link-underline py-1 text-[.8rem] font-medium uppercase tracking-[.16em] text-ink transition-colors hover:text-taupe-deep"<?= $isCurrent ? ' aria-current="page"' : '' ?>><?= esc_html($l['label']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="flex shrink-0 items-center gap-2">
      <a href="<?= esc_url(bb_booking_url()) ?>" data-book class="btn btn-primary btn-sm hidden sm:inline-flex" target="_blank" rel="noopener">
        <?= bb_icon('calendar') ?> Book a session
      </a>
      <?= bb_island('MobileNav', [
            'links' => $links, 'current' => $current === '' ? 'home' : $current,
            'bookingUrl' => bb_booking_url(), 'email' => $c['email'], 'instagram' => $c['social']['instagram'],
            'logo' => bb_asset('brand/logo-light.webp'), 'logoDark' => bb_asset('brand/logo-dark.webp'),
          ],
          '<a href="#site-footer" class="inline-flex h-12 w-12 items-center justify-center rounded-full text-ink lg:hidden" aria-label="Menu">' . bb_icon('menu', 'icon h-6 w-6') . '</a>',
          'div', 'lg:hidden') ?>
    </div>
  </div>
</header>
