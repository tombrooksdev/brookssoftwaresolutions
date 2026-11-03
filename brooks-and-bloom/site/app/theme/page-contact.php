<?php
get_header();
$c = bb_config();
$sessionTypes = array_merge(array_column(bb_content('packages'), 'name'), ['Gift voucher', 'Something else']);
$status = $_GET['sent'] ?? null;
ob_start(); ?>
<form action="/api/contact" method="post" class="grid gap-5" novalidate>
  <?php wp_nonce_field('bb_contact'); ?>
  <div class="hidden" aria-hidden="true"><label for="website">Leave this empty</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
  <input type="hidden" name="started" value="<?= time() ?>">
  <?php if ($status === '1'): ?><p class="rounded-xl bg-sage-wash p-4 text-sm">Thank you. Your message is on its way and I will be in touch soon.</p><?php elseif ($status === '0'): ?><p class="rounded-xl bg-lavender-wash p-4 text-sm">Something went wrong sending your message. Please email me directly at <?= esc_html($c['email']) ?>.</p><?php endif; ?>
  <div class="grid gap-5 sm:grid-cols-2">
    <p><label for="cf-name" class="mb-2 block text-sm font-medium">Your name</label><input id="cf-name" name="name" required autocomplete="name" class="w-full rounded-xl border border-line bg-ivory px-4 py-3"></p>
    <p><label for="cf-email" class="mb-2 block text-sm font-medium">Email</label><input id="cf-email" name="email" type="email" required autocomplete="email" class="w-full rounded-xl border border-line bg-ivory px-4 py-3"></p>
  </div>
  <p><label for="cf-session" class="mb-2 block text-sm font-medium">Session type</label><select id="cf-session" name="session" class="w-full rounded-xl border border-line bg-ivory px-4 py-3"><?php foreach ($sessionTypes as $s): ?><option><?= esc_html($s) ?></option><?php endforeach; ?></select></p>
  <p><label for="cf-message" class="mb-2 block text-sm font-medium">Message</label><textarea id="cf-message" name="message" rows="5" required class="w-full rounded-xl border border-line bg-ivory px-4 py-3"></textarea></p>
  <p class="flex gap-3 text-sm text-ink-soft"><input id="cf-consent" name="consent" type="checkbox" required class="mt-1"><label for="cf-consent">I'm happy for Brooks &amp; Bloom to use these details to reply to me.</label></p>
  <p><button type="submit" class="btn btn-primary"><?= bb_icon('send') ?> Send message</button></p>
</form>
<?php $fallback = ob_get_clean(); ?>
<main id="main">
  <?php get_template_part('template-parts/page-hero', null, [
    'crumb' => 'Contact', 'eyebrow' => 'Contact', 'title' => 'Let\'s', 'accent' => 'say hello',
    'intro' => 'Ready to book, or want to ask a question first? Choose a date in my booking calendar, or send me a message and I will get back to you soon.']); ?>

  <section class="pb-20 md:pb-28">
    <div class="wrap grid gap-10 lg:grid-cols-12">
      <div class="reveal min-w-0 rounded-[1.75rem] border border-line bg-ivory p-6 sm:p-8 md:p-10 lg:col-span-7">
        <h2 class="t-h3">Send me a message</h2>
        <p class="mt-2 text-sm text-ink-soft">All fields are needed unless marked optional.</p>
        <div class="mt-8">
          <?= bb_island('ContactForm', [
            'action' => '/api/contact', 'token' => bb_csrf_token(), 'sessionTypes' => $sessionTypes,
            'email' => $c['email'], 'preview' => bb_is_export(),
          ], $fallback) ?>
        </div>
      </div>

      <aside class="flex min-w-0 flex-col gap-6 lg:col-span-5" aria-label="Other ways to get in touch">
        <div class="reveal relative overflow-hidden rounded-[1.75rem] bg-[rgb(59_52_49)] p-8 text-[rgb(250_249_247)] ring-1 ring-lavender/30 md:p-10" style="--d:.08s">
          <span class="wash wash-lavender -right-16 -top-16 h-56 w-56 opacity-40" aria-hidden="true"></span>
          <div class="relative">
            <?= bb_icon('calendar', 'icon icon-lg text-lavender') ?>
            <h2 class="t-h3 mt-4 !text-[rgb(250_249_247)]">Ready to book?</h2>
            <p class="mt-3 text-sm leading-relaxed text-[rgb(250_249_247/.8)]">See my available dates and secure your session with a <?= bb_price(bb_content('deposit')['amount']) ?> booking fee through my secure Pixieset booking page.</p>
            <a href="<?= esc_url(bb_booking_url()) ?>" data-book target="_blank" rel="noopener" class="btn mt-6 w-full bg-[rgb(250_249_247)] text-[rgb(59_52_49)] hover:bg-lavender">Check availability <?= bb_icon('arrow-up-right') ?></a>
          </div>
        </div>
        <div class="reveal rounded-[1.75rem] bg-surface p-8 md:p-10" style="--d:.16s">
          <ul class="space-y-5 text-sm">
            <li class="flex gap-4"><span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-ivory text-taupe-deep"><?= bb_icon('mail') ?></span><span><span class="block eyebrow !tracking-[.2em]">Email</span><a class="link-underline mt-1 inline-block break-all text-ink" href="mailto:<?= esc_attr($c['email']) ?>"><?= esc_html($c['email']) ?></a></span></li>
            <?php if ($c['phone']): ?><li class="flex gap-4"><span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-ivory text-taupe-deep"><?= bb_icon('phone') ?></span><span><span class="block eyebrow !tracking-[.2em]">Phone</span><a class="link-underline mt-1 inline-block text-ink" href="tel:<?= esc_attr(preg_replace('/\s+/', '', $c['phone'])) ?>"><?= esc_html($c['phone']) ?></a></span></li><?php endif; ?>
            <li class="flex gap-4"><span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-ivory text-taupe-deep"><?= bb_icon('instagram') ?></span><span><span class="block eyebrow !tracking-[.2em]">Instagram</span><a class="link-underline mt-1 inline-block text-ink" href="<?= esc_url($c['social']['instagram']) ?>" target="_blank" rel="noopener">@brooks_and_bloom_photography</a></span></li>
            <li class="flex gap-4"><span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-ivory text-taupe-deep"><?= bb_icon('map-pin') ?></span><span><span class="block eyebrow !tracking-[.2em]">Based in</span><span class="mt-1 block text-ink"><?= esc_html($c['address']['locality']) ?>, South Derbyshire</span></span></li>
            <li class="flex gap-4"><span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-ivory text-taupe-deep"><?= bb_icon('gallery') ?></span><span><span class="block eyebrow !tracking-[.2em]">Existing client?</span><a class="link-underline mt-1 inline-block text-ink" href="<?= esc_url($c['pixieset']['client_gallery_url']) ?>" target="_blank" rel="noopener">View your gallery</a></span></li>
          </ul>
        </div>
      </aside>
    </div>
  </section>
</main>
<?php get_footer(); ?>
