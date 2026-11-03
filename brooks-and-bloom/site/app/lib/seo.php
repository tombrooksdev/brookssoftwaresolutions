<?php
/** Meta tags and JSON-LD. In WordPress, hook bb_schema_graph() into wp_head and let an SEO plugin own the title/meta. */

function bb_meta_tags(string $slug, array $page): string {
    $c     = bb_config();
    $url   = home_url($slug === '' ? '' : $slug . '/');
    $image = home_url('assets/brand/og-image.jpg');
    $t = esc_attr($page['title']);
    $d = esc_attr($page['description']);
    $out = [
        "<title>{$t}</title>",
        "<meta name=\"description\" content=\"{$d}\">",
        '<link rel="canonical" href="' . esc_url($url) . '">',
        '<meta name="robots" content="index,follow,max-image-preview:large">',
        '<meta property="og:type" content="website">',
        '<meta property="og:locale" content="' . esc_attr($c['locale']) . '">',
        '<meta property="og:site_name" content="' . esc_attr($c['name']) . '">',
        "<meta property=\"og:title\" content=\"{$t}\">",
        "<meta property=\"og:description\" content=\"{$d}\">",
        '<meta property="og:url" content="' . esc_url($url) . '">',
        '<meta property="og:image" content="' . esc_url($image) . '">',
        '<meta property="og:image:width" content="1200"><meta property="og:image:height" content="630">',
        '<meta name="twitter:card" content="summary_large_image">',
        '<meta name="geo.region" content="GB-DBY">',
        '<meta name="geo.placename" content="' . esc_attr($c['address']['locality']) . '">',
        '<meta name="geo.position" content="' . $c['geo']['lat'] . ';' . $c['geo']['lng'] . '">',
        '<meta name="ICBM" content="' . $c['geo']['lat'] . ', ' . $c['geo']['lng'] . '">',
        '<link rel="alternate" type="text/plain" title="LLM summary" href="/llms.txt">',
    ];
    return implode("\n", $out);
}

function bb_business_node(): array {
    $c = bb_config();
    $id = home_url('#business');
    $node = [
        '@type' => ['LocalBusiness', 'ProfessionalService'],
        '@id' => $id,
        'name' => $c['name'],
        'alternateName' => $c['short_name'],
        'slogan' => $c['tagline'],
        'description' => $c['description'],
        'url' => home_url(),
        'logo' => home_url('assets/brand/logo-light.png'),
        'image' => home_url('assets/brand/og-image.jpg'),
        'email' => $c['email'],
        'priceRange' => '££',
        'currenciesAccepted' => 'GBP',
        'address' => ['@type' => 'PostalAddress', 'addressLocality' => $c['address']['locality'],
            'addressRegion' => $c['address']['region'], 'postalCode' => $c['address']['postcode'], 'addressCountry' => $c['address']['country']],
        'geo' => ['@type' => 'GeoCoordinates', 'latitude' => $c['geo']['lat'], 'longitude' => $c['geo']['lng']],
        'areaServed' => array_map(fn($p) => ['@type' => 'Place', 'name' => $p],
            array_merge([bb_content('areas')['base']], bb_content('areas')['nearby'], bb_content('areas')['towns'], ['National Forest', 'South Derbyshire'])),
        'knowsAbout' => ['Family photography', 'Newborn photography', 'Baby photography', 'Pet photography', 'Seasonal mini sessions', 'Outdoor portrait photography'],
        'sameAs' => array_values(array_filter($c['social'])),
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog', 'name' => 'Photography sessions',
            'itemListElement' => array_map(fn($p) => [
                '@type' => 'Offer', 'name' => $p['name'], 'description' => $p['summary'],
                'price' => (string) $p['price'], 'priceCurrency' => 'GBP', 'url' => home_url('packages/#' . $p['slug']),
                'itemOffered' => ['@type' => 'Service', 'name' => $p['name'], 'serviceType' => 'Photography'],
            ], bb_content('packages')),
        ],
    ];
    if ($c['phone']) $node['telephone'] = $c['phone'];
    if ($c['photographer_name']) $node['founder'] = ['@type' => 'Person', 'name' => $c['photographer_name'], 'jobTitle' => 'Photographer'];
    $real = array_values(array_filter(bb_content('reviews'), fn($r) => empty($r['sample'])));
    if ($real) {
        $node['review'] = array_map(fn($r) => ['@type' => 'Review', 'reviewBody' => $r['quote'],
            'author' => ['@type' => 'Person', 'name' => $r['name']], 'reviewRating' => ['@type' => 'Rating', 'ratingValue' => $r['rating'] ?? 5, 'bestRating' => 5]], $real);
    }
    return $node;
}

function bb_schema_graph(string $slug, array $page): string {
    $c = bb_config();
    $url = home_url($slug === '' ? '' : $slug . '/');
    $graph = [
        ['@type' => 'WebSite', '@id' => home_url('#website'), 'url' => home_url(), 'name' => $c['name'], 'inLanguage' => 'en-GB', 'publisher' => ['@id' => home_url('#business')]],
        bb_business_node(),
        ['@type' => 'WebPage', '@id' => $url . '#webpage', 'url' => $url, 'name' => $page['title'], 'description' => $page['description'],
         'isPartOf' => ['@id' => home_url('#website')], 'about' => ['@id' => home_url('#business')], 'inLanguage' => 'en-GB'],
    ];
    if ($slug !== '') {
        $graph[] = ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url()],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $page['nav'] ?? ucfirst($slug), 'item' => $url],
        ]];
    }
    if ($slug === 'faq') {
        $graph[] = ['@type' => 'FAQPage', 'mainEntity' => array_map(fn($f) => [
            '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]], bb_content('faqs'))];
    }
    return '<script type="application/ld+json">' . wp_json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_PRETTY_PRINT) . '</script>';
}
