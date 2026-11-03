# Brooks & Bloom Photography website

PHP + React site for Brooks & Bloom, a family, baby and pet photographer in Coton in the Elms, South Derbyshire. Built from the brand guidelines (November 2026) and structured to become a WordPress theme.

## What's here

```
brooks-and-bloom/
├── site/                      Plesk project (upload this)
│   ├── httpdocs/              Plesk document root
│   │   ├── index.php          front controller: pages, /api/contact, /sitemap.xml, /llms.txt
│   │   ├── .htaccess          HTTPS, pretty URLs, caching, security headers
│   │   ├── robots.txt         allows search engines and AI crawlers
│   │   └── assets/            brand/ (logos, favicons), build/ (compiled), photos/ (add real photos)
│   ├── app/                   outside the web root
│   │   ├── config.php         business details, Pixieset links, contact email  <- edit me
│   │   ├── content/content.php packages, FAQs, reviews, areas, portfolio      <- edit me
│   │   ├── lib/               helpers, SEO + JSON-LD, llms.txt, contact handler, WP shims
│   │   └── theme/             templates laid out like a WordPress theme
│   ├── frontend/              React islands + Tailwind source (Vite)
│   ├── scripts/               dev router, single-file preview exporter
│   └── storage/               rate-limit data for the contact form (not public)
├── preview/                   single-file HTML version (all pages, works offline)
├── brand/                     generated logo variants, favicons, OG image
├── assets-src/                original logo files
└── docs/                      PLESK-DEPLOY.md, WORDPRESS.md, LAUNCH-CHECKLIST.md
```

## How it fits together

PHP renders every page in full, so search engines and AI assistants read real HTML. React only "islands" the interactive bits and receives the same content as JSON props:

| Island | What it does |
|---|---|
| `MobileNav` | full-screen menu with focus trap, Esc to close, staggered links |
| `BookingDrawer` | Pixieset connector. Any `[data-book]` or `[data-book="slug"]` link opens a drawer with the package, deposit and next steps, then hands off to Pixieset. Without JS the link goes straight to Pixieset. |
| `PortfolioGallery` | category filter + lightbox (keyboard, swipe, counter) |
| `ContactForm` | inline validation, posts to `/api/contact` (CSRF, honeypot, timing check, rate limit) |
| `Testimonials` | swipe carousel on phones, 3-up grid from tablet |

Icons: one hand-drawn line icon sprite (`app/theme/icons.svg`, 47 icons) used from PHP with `bb_icon('name')` and from React with `<Icon name="..."/>`.

## Local development

```bash
cd site/frontend && npm install && npm run build     # or: npm run dev (rebuild on save)
cd .. && php -S localhost:8080 -t httpdocs scripts/dev-router.php
php scripts/export-preview.php                        # rebuild preview/ after changes
```

Requires PHP 8.1+ and Node 18+.

## SEO and LLM optimisation

- Unique titles, descriptions and canonicals per page; Open Graph and Twitter cards; `en-GB` and geo meta for Coton in the Elms
- JSON-LD `@graph`: WebSite, LocalBusiness/ProfessionalService with `areaServed` (26 places), `OfferCatalog` with every package price, BreadcrumbList, FAQPage on `/faq/`
- Review schema is added automatically only once reviews are real (`'sample' => false`), to stay inside Google's rules
- `/llms.txt` and `/llms-full.txt` generated from the same content (facts, prices, areas, FAQs, booking steps)
- `robots.txt` explicitly allows GPTBot, ClaudeBot, PerplexityBot, Google-Extended and others
- A facts block on About written to be quotable; semantic HTML, one H1 per page, descriptive alt text
- `/locations/` covers the service area on one solid page instead of thin per-town pages
