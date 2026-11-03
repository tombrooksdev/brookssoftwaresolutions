<?php
get_header();
$c = bb_config();
$updated = 'November 2026';
?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, ['crumb' => 'Privacy', 'eyebrow' => 'Privacy policy', 'title' => 'Your privacy', 'accent' => 'matters',
    'intro' => 'How ' . $c['name'] . ' collects, uses and looks after your personal information. Last updated ' . $updated . '.']); ?>
  <section class="pb-20 md:pb-28">
    <div class="wrap">
      <div class="max-w-prose space-y-8 text-ink-soft [&_h2]:font-display [&_h2]:text-2xl [&_h2]:mb-3 [&_h2]:text-ink">
        <div><h2>Who I am</h2><p><?= esc_html($c['name']) ?> is a photography business based in <?= esc_html($c['address']['locality']) ?>, Derbyshire. I am the data controller for information you share through this website. You can contact me at <?= esc_html($c['email']) ?>.</p></div>
        <div><h2>What I collect</h2><p>When you use the contact form I collect your name, email address, the session you are interested in and your message. When you book, Pixieset collects your booking and payment details on my behalf under their own privacy policy.</p></div>
        <div><h2>How I use it</h2><p>Only to reply to your enquiry, arrange and deliver your session, and send your gallery. I never sell your details or add you to marketing lists without your permission.</p></div>
        <div><h2>Photographs</h2><p>I will only share images from your session on my website or social media with your permission. You can change your mind at any time.</p></div>
        <div><h2>How long I keep it</h2><p>Enquiries that do not lead to a booking are deleted within 12 months. Client records are kept for 6 years for accounting purposes.</p></div>
        <div><h2>Your rights</h2><p>Under UK GDPR you can ask to see, correct or delete the information I hold about you. Email me and I will respond within one month. You can also complain to the Information Commissioner's Office at ico.org.uk.</p></div>
        <div><h2>Cookies</h2><p>This website uses only the cookies needed for it to work, such as protecting the contact form from spam. If analytics are added later, this policy will be updated and you will be asked for consent.</p></div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
