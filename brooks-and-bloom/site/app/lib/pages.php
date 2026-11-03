<?php
/**
 * Page registry: slug => template + SEO. In WordPress these are real Pages using
 * the matching page-{slug}.php template, with title/description set in Yoast or Rank Math.
 */
return [
    '' => [
        'template' => 'front-page', 'nav' => 'Home', 'priority' => '1.0',
        'title' => 'Family, Baby & Pet Photographer in Coton in the Elms | Brooks & Bloom',
        'description' => 'Natural, relaxed family, baby, pet and seasonal mini session photography in Coton in the Elms, South Derbyshire. Covering Burton upon Trent, Swadlincote, Lichfield and the National Forest.',
    ],
    'about' => [
        'template' => 'page-about', 'nav' => 'About', 'priority' => '0.8',
        'title' => 'About Brooks & Bloom Photography | Coton in the Elms',
        'description' => 'Meet the photographer behind Brooks & Bloom: relaxed, natural photography for families, little ones and pets, based in Coton in the Elms, South Derbyshire.',
    ],
    'portfolio' => [
        'template' => 'page-portfolio', 'nav' => 'Portfolio', 'priority' => '0.9',
        'title' => 'Portfolio: Family, Baby & Pet Photography | Brooks & Bloom',
        'description' => 'A collection of natural family, baby, pet and seasonal mini session photographs taken around South Derbyshire and the National Forest.',
    ],
    'packages' => [
        'template' => 'page-packages', 'nav' => 'Packages', 'priority' => '0.9',
        'title' => 'Photography Packages & Prices | Brooks & Bloom, South Derbyshire',
        'description' => 'Clear prices for family, newborn, pet and seasonal mini photography sessions near Burton upon Trent and Swadlincote. Book online with a £50 booking fee.',
    ],
    'reviews' => [
        'template' => 'page-reviews', 'nav' => 'Reviews', 'priority' => '0.7',
        'title' => 'Client Reviews | Brooks & Bloom Photography',
        'description' => 'What families say about their photography sessions with Brooks & Bloom in Coton in the Elms and South Derbyshire.',
    ],
    'contact' => [
        'template' => 'page-contact', 'nav' => 'Contact', 'priority' => '0.8',
        'title' => 'Contact & Book a Session | Brooks & Bloom Photography',
        'description' => 'Get in touch or check availability for a family, baby, pet or mini photography session in Coton in the Elms and South Derbyshire.',
    ],
    'faq' => [
        'template' => 'page-faq', 'nav' => null, 'priority' => '0.6',
        'title' => 'Photography Session FAQs | Brooks & Bloom',
        'description' => 'Answers about locations, weather, what to wear, deposits, gallery delivery and travel for Brooks & Bloom photography sessions.',
    ],
    'locations' => [
        'template' => 'page-locations', 'nav' => null, 'priority' => '0.7',
        'title' => 'Photographer near Burton upon Trent, Swadlincote & Lichfield | Brooks & Bloom',
        'description' => 'Based in Coton in the Elms, Brooks & Bloom photographs families across South Derbyshire, East Staffordshire and North West Leicestershire.',
    ],
    'privacy' => [
        'template' => 'page-privacy', 'nav' => null, 'priority' => '0.2',
        'title' => 'Privacy Policy | Brooks & Bloom Photography',
        'description' => 'How Brooks & Bloom Photography collects, uses and protects your personal information.',
    ],
];
