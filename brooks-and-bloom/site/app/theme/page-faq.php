<?php get_header(); ?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, [
    'crumb' => 'FAQs', 'eyebrow' => 'FAQs', 'title' => 'Good', 'accent' => 'to know',
    'intro' => 'Answers to the questions families ask most. Anything else, just send me a message.']); ?>
  <section class="pb-20 md:pb-28">
    <div class="wrap max-w-4xl"><?php get_template_part('template-parts/faq-list'); ?></div>
  </section>
  <?php get_template_part('template-parts/cta-band', null, ['title' => 'Still wondering?', 'accent' => 'Just ask', 'text' => 'Send me a message and I will get back to you as soon as I can.']); ?>
</main>
<?php get_footer(); ?>
