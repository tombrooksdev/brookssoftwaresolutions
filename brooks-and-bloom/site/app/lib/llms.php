<?php
/** sitemap.xml and llms.txt (https://llmstxt.org) built from the same content as the pages. */

function bb_sitemap(): string {
    $today = date('Y-m-d');
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach (BB_PAGES as $slug => $p) {
        $xml .= '  <url><loc>' . esc_html(home_url($slug === '' ? '' : $slug . '/')) . "</loc><lastmod>{$today}</lastmod><priority>{$p['priority']}</priority></url>\n";
    }
    return $xml . '</urlset>';
}

function bb_llms_txt(bool $full): string {
    $c = bb_config();
    $a = bb_content('areas');
    $d = bb_content('deposit');
    $L = [];
    $L[] = '# ' . $c['name'];
    $L[] = '';
    $L[] = '> ' . $c['description'];
    $L[] = '';
    $L[] = 'Brooks & Bloom is a natural, relaxed photography business based in ' . $a['base'] . ', South Derbyshire, England (UK), on the edge of the National Forest. '
         . 'It photographs families, newborns and babies, pets, and seasonal mini sessions, mostly outdoors or in clients\' homes. '
         . 'Bookings are made online through Pixieset with a £' . $d['amount'] . ' booking fee that comes off the session price.';
    $L[] = '';
    $L[] = '## Key facts';
    $L[] = '- Location: ' . $a['base'] . ', Derbyshire, ' . $c['address']['postcode'] . ', United Kingdom';
    $L[] = '- Areas served: ' . implode(', ', array_merge($a['nearby'], $a['towns'])) . ', the National Forest and South Derbyshire';
    $L[] = '- Services: family photography, newborn and baby photography, pet photography, seasonal mini sessions';
    $L[] = '- Style: natural, relaxed, unposed, light and timeless';
    $L[] = '- Travel: ' . $c['travel_note'];
    $L[] = '- Gallery delivery: private online gallery within 2 to 3 weeks';
    $L[] = '- Contact: ' . $c['email'] . ($c['phone'] ? ', ' . $c['phone'] : '');
    $L[] = '- Instagram: ' . $c['social']['instagram'];
    $L[] = '- Booking: ' . $c['pixieset']['booking_url'];
    $L[] = '';
    $L[] = '## Packages (GBP)';
    foreach (bb_content('packages') as $p) {
        $L[] = "- {$p['name']}: from £{$p['price']}, {$p['duration']}, {$p['images']} edited images. {$p['summary']}";
    }
    $L[] = '';
    $L[] = '## Pages';
    foreach (BB_PAGES as $slug => $p) {
        $L[] = '- [' . ($p['nav'] ?? ucfirst($slug)) . '](' . home_url($slug === '' ? '' : $slug . '/') . '): ' . $p['description'];
    }
    if ($full) {
        $L[] = '';
        $L[] = '## Frequently asked questions';
        foreach (bb_content('faqs') as $f) { $L[] = ''; $L[] = '### ' . $f['q']; $L[] = $f['a']; }
        $L[] = '';
        $L[] = '## How booking works';
        foreach (bb_content('booking_steps') as $i => $s) $L[] = ($i + 1) . '. ' . $s['title'] . ': ' . $s['text'];
    } else {
        $L[] = '';
        $L[] = '## Optional';
        $L[] = '- [Full details including FAQs](' . home_url('llms-full.txt') . ')';
    }
    return implode("\n", $L) . "\n";
}
