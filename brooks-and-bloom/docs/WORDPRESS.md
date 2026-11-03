# Turning this into a WordPress theme

The templates already use WordPress function names (`get_header`, `get_template_part`, `esc_html`, `esc_url`, `home_url`, `wp_nonce_field`), backed by `app/lib/wp-shims.php`. In WordPress you delete the shims and the real functions take over.

## File mapping

| Now | WordPress theme |
|---|---|
| `app/theme/header.php`, `footer.php`, `front-page.php`, `page-*.php`, `404.php` | same names in the theme root |
| `app/theme/template-parts/*` | `template-parts/*` (unchanged) |
| `app/theme/icons.svg` | `assets/icons.svg`, printed in `wp_body_open` |
| `app/lib/helpers.php`, `seo.php`, `llms.php` | `inc/` and required from `functions.php` |
| `httpdocs/assets/build/*` | `assets/build/*`, enqueued with `wp_enqueue_style/script` |
| `app/lib/pages.php` | real Pages with those slugs; titles/descriptions in Yoast or Rank Math |
| `config.php` | Customizer or an ACF options page; `bb_config()` reads `get_theme_mod`/`get_field('x','option')` |

## Content she will manage

| `content.php` key | WordPress |
|---|---|
| `packages` | custom post type `bb_package` (price, duration, images, includes repeater, Pixieset URL, featured) |
| `reviews` | CPT `bb_review` (quote, name, session) |
| `faqs` | CPT `bb_faq`, or an ACF repeater on the FAQ page |
| `portfolio` + categories | CPT `bb_photo` with a `photo_category` taxonomy, or ACF gallery field |
| `services`, `booking_steps`, `addons`, `areas` | ACF repeaters on an options page |
| `photos` (named slots) | ACF image fields on the relevant page |

`bb_content('packages')` becomes a `WP_Query` returning the same array shape, so templates don't change. `bb_photo()` swaps to `wp_get_attachment_image()` for responsive `srcset`.

## Other swaps

- Contact form: replace `/api/contact` with a REST route (`register_rest_route`) or `admin-post.php`, `wp_verify_nonce`, and `wp_mail()` with an SMTP plugin
- Instagram grid: drop a feed plugin (e.g. Smash Balloon) into `template-parts/instagram.php`
- `llms.txt` / sitemap: keep `bb_llms_txt()` on a rewrite rule; let the SEO plugin own `sitemap.xml`
- Pixieset: the `BookingDrawer` island stays as is; each package's Pixieset link becomes a field on the package
