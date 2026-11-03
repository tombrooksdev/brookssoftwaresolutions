# Before launch

Everything below is a placeholder or an assumption I made. All of it lives in `site/app/config.php` or `site/app/content/content.php`.

- [ ] **Domain**: `config.php → url` (also update the Sitemap line in `httpdocs/robots.txt`)
- [ ] **Email / phone**: `email`, `contact_to`, `phone`
- [ ] **Photographer's name**: `photographer_name` personalises About and adds a Person to the schema
- [ ] **Pixieset**: real Studio Manager booking URL, client gallery URL, and a per-package `booking_url` for each session type
- [ ] **Prices, durations, image counts, deposit, travel radius, gallery turnaround**: all drafts
- [ ] **Photos**: add files to `httpdocs/assets/photos/` and set `src` on each slot (WebP, about 2000px on the long edge, under 400 KB)
- [ ] **Reviews**: replace the 3 samples with real ones and set `'sample' => false`
- [ ] **Facebook / Google review link**: `social.facebook`, `google_review_url`
- [ ] **Geo coordinates**: `geo` is approximate for the village centre
- [ ] **Brand colours**: the guideline hexes were sampled by eye. Confirm with the designer. Text uses darker taupe (#6E5F57, #75655C) so it passes WCAG AA; the logo taupe #96877E is only used for large type and ornament
- [ ] **Fonts**: Cormorant Garamond + Montserrat (both free on Google Fonts). Cormorant matches the logo lettering more closely than Playfair
- [ ] **Privacy policy**: check retention periods match how she actually works
- [ ] Turn off `draft_notice`
