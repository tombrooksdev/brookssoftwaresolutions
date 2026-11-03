<?php
/**
 * Site settings. In the WordPress theme these become Customizer / options-page fields
 * (see docs/WORDPRESS.md). Anything marked TODO needs a real value before launch.
 */
return [
    'name'        => 'Brooks & Bloom Photography',
    'short_name'  => 'Brooks & Bloom',
    'tagline'     => 'Beautiful moments, naturally.',
    'description' => 'Natural, relaxed family, baby, pet and seasonal mini session photography in Coton in the Elms, South Derbyshire, covering Burton upon Trent, Swadlincote, Lichfield and the National Forest.',

    // TODO: set the real domain. Used for canonical URLs, sitemap, schema and llms.txt.
    'url'         => 'https://www.brooksandbloomphotography.co.uk',
    'locale'      => 'en_GB',

    // TODO: add her name to personalise the About page and schema. Leave '' to keep copy name-free.
    'photographer_name' => '',

    'email'   => 'hello@brooksandbloomphotography.co.uk', // TODO
    'phone'   => '',                                       // TODO e.g. '07700 900000'
    'contact_to' => 'hello@brooksandbloomphotography.co.uk', // TODO inbox that receives enquiries

    'address' => [
        'locality' => 'Coton in the Elms',
        'region'   => 'Derbyshire',
        'postcode' => 'DE12',
        'country'  => 'GB',
    ],
    'geo' => ['lat' => 52.7406, 'lng' => -1.6406],
    'travel_note' => 'Free travel within 10 miles of Coton in the Elms. Further afield is welcome for a small travel fee.',

    'social' => [
        'instagram' => 'https://www.instagram.com/brooks_and_bloom_photography/',
        'facebook'  => '', // TODO
    ],

    // Pixieset connector. Each package can override with its own session-type booking link.
    'pixieset' => [
        'booking_url'        => 'https://brooksandbloom.pixieset.com/booking/', // TODO real Studio Manager booking page
        'client_gallery_url' => 'https://brooksandbloom.pixieset.com/',        // TODO client gallery home
        'utm'                => 'utm_source=website&utm_medium=booking&utm_campaign=site',
    ],

    'google_review_url' => '', // TODO Google Business Profile "write a review" link

    // Shows a small banner explaining photos, prices and reviews are placeholders.
    'draft_notice' => true,
];
