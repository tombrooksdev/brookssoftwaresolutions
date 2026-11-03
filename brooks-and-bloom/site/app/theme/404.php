<?php get_header(); ?>
<main id="main">
  <section class="relative overflow-hidden py-24 md:py-36">
    <span class="wash wash-lavender left-1/2 top-10 h-80 w-80 -translate-x-1/2" aria-hidden="true"></span>
    <div class="wrap relative text-center hero-in">
      <p class="eyebrow ruled" style="--i:0">Page not found</p>
      <h1 class="t-display mt-6" style="--i:1">This one <span class="serif-accent">wandered off</span></h1>
      <p class="t-lead mx-auto mt-6 max-w-md" style="--i:2">The page you are looking for has moved or no longer exists. Let's get you back on the path.</p>
      <div class="mt-9 flex flex-col justify-center gap-3 sm:flex-row" style="--i:3">
        <a href="<?= esc_url(bb_url('')) ?>" class="btn btn-primary"><?= bb_icon('home') ?> Back to home</a>
        <a href="<?= esc_url(bb_url('portfolio')) ?>" class="btn btn-outline">View the portfolio</a>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
