<?php
/**
 * Editable content. Each top-level key maps to a WordPress custom post type or
 * repeater field when this becomes a theme (see docs/WORDPRESS.md).
 *
 * Photo slots: set 'src' to a file in httpdocs/assets/photos/ to replace a placeholder.
 */
return [

    'services' => [
        ['slug' => 'family',  'icon' => 'family', 'title' => 'Family sessions',
         'text' => 'Relaxed outdoor sessions where you walk, play and cuddle while I quietly capture it all.'],
        ['slug' => 'baby',    'icon' => 'baby',   'title' => 'Baby & little ones',
         'text' => 'Newborn snuggles at home, sitter sessions and first birthdays, at your baby\'s pace.'],
        ['slug' => 'pets',    'icon' => 'paw',    'title' => 'Pet portraits',
         'text' => 'Dogs, cats and the odd rabbit. Treats in pocket, plenty of patience, no pressure.'],
        ['slug' => 'minis',   'icon' => 'leaf',   'title' => 'Seasonal minis',
         'text' => 'Short, affordable sessions in bluebells, summer meadows, autumn leaves and festive set-ups.'],
    ],

    'packages' => [
        [
            'slug' => 'mini', 'icon' => 'leaf', 'name' => 'Seasonal Mini Session', 'price' => 95,
            'duration' => '20 minutes', 'images' => 10, 'featured' => false,
            'summary' => 'A quick, joyful session on a set date in a beautiful seasonal setting.',
            'includes' => ['20 minutes on location', '10 hand-edited images', 'Private online gallery', 'Print release'],
            'booking_url' => '',
        ],
        [
            'slug' => 'family', 'icon' => 'family', 'name' => 'Outdoor Family Session', 'price' => 195,
            'duration' => '60 minutes', 'images' => 30, 'featured' => true,
            'summary' => 'The session families book most. Time to relax, explore and let real moments happen.',
            'includes' => ['Up to 60 minutes on location', '30 hand-edited images', 'Pets welcome at no extra cost', 'Pre-session planning chat', 'Private online gallery and print store'],
            'booking_url' => '',
        ],
        [
            'slug' => 'baby', 'icon' => 'baby', 'name' => 'Baby & Newborn at Home', 'price' => 225,
            'duration' => 'Up to 2 hours', 'images' => 25, 'featured' => false,
            'summary' => 'Gentle lifestyle photos in your own home, with time built in for feeds and cuddles.',
            'includes' => ['Up to 2 hours, baby-led', '25 hand-edited images', 'Family and sibling shots', 'Private online gallery'],
            'booking_url' => '',
        ],
        [
            'slug' => 'pets', 'icon' => 'paw', 'name' => 'Pet Portrait Session', 'price' => 150,
            'duration' => '45 minutes', 'images' => 20, 'featured' => false,
            'summary' => 'A walk and a play somewhere your pet loves, with you in a few frames too.',
            'includes' => ['45 minutes on location', '20 hand-edited images', 'Up to 2 pets', 'Private online gallery'],
            'booking_url' => '',
        ],
    ],

    'deposit' => [
        'amount' => 50,
        'note'   => 'A £50 booking fee secures your date and comes off your session price. The balance is due 7 days before your session.',
    ],

    'addons' => [
        ['icon' => 'image',  'title' => 'Extra images',       'text' => '£10 per image, or the full gallery for £95.'],
        ['icon' => 'frame',  'title' => 'Prints & wall art',  'text' => 'Professional prints, canvases and frames ordered through your gallery.'],
        ['icon' => 'book',   'title' => 'Keepsake albums',    'text' => 'Linen-covered albums from £145.'],
        ['icon' => 'gift',   'title' => 'Gift vouchers',      'text' => 'Any amount, or a full session. Lovely for new parents.'],
    ],

    // The order matters here: this is the real booking sequence.
    'booking_steps' => [
        ['icon' => 'heart',    'title' => 'Choose your session', 'text' => 'Pick the package that suits you. Not sure? Send me a message and we will work it out together.'],
        ['icon' => 'calendar', 'title' => 'Book your date',      'text' => 'Choose a date in my booking calendar and pay the £50 booking fee securely through Pixieset.'],
        ['icon' => 'chat',     'title' => 'Plan together',       'text' => 'I will send a short guide covering what to wear, where to go and how to prepare little ones.'],
        ['icon' => 'camera',   'title' => 'Your session',        'text' => 'We keep it relaxed. No stiff posing, lots of fresh air and plenty of breaks.'],
        ['icon' => 'gallery',  'title' => 'Your gallery',        'text' => 'Your edited photos arrive in a private online gallery within 2 to 3 weeks.'],
    ],

    'reviews' => [
        // sample => true renders a visible "Sample" label and is excluded from schema markup.
        ['sample' => true, 'name' => 'Sample review', 'session' => 'Family session',
         'quote' => 'Replace this with a real client review. Two or three sentences about how the session felt works best.'],
        ['sample' => true, 'name' => 'Sample review', 'session' => 'Newborn at home',
         'quote' => 'Real words from parents carry far more weight than anything we write ourselves, so add them here as they come in.'],
        ['sample' => true, 'name' => 'Sample review', 'session' => 'Pet portrait',
         'quote' => 'Copy reviews from Google or Facebook with the client\'s permission, using their first name and session type.'],
    ],

    'faqs' => [
        ['q' => 'Where do your sessions take place?',
         'a' => 'Most sessions are outdoors around Coton in the Elms and the National Forest, including woodland, meadows and parkland near Rosliston. Baby sessions usually happen in your own home. I am happy to come to a place that means something to you.'],
        ['q' => 'What happens if it rains?',
         'a' => 'We keep an eye on the forecast together. If the weather looks poor I will move your session to the next available date at no cost.'],
        ['q' => 'What should we wear?',
         'a' => 'Soft, neutral and muted colours photograph beautifully and suit the natural setting. Avoid big logos. You will get a short style guide once you book.'],
        ['q' => 'My children (or my dog) won\'t sit still. Is that a problem?',
         'a' => 'Not at all. Sessions are relaxed and led by play, so running, wriggling and giggling are all part of it. Some of the best photos happen between the planned moments.'],
        ['q' => 'How long until we receive our photos?',
         'a' => 'Your edited images are delivered in a private online gallery within 2 to 3 weeks. Mini session galleries usually arrive within 10 days.'],
        ['q' => 'How does booking and the deposit work?',
         'a' => 'You choose a date in my Pixieset booking calendar and pay a £50 booking fee, which comes off your session price. The balance is due 7 days before your session.'],
        ['q' => 'Can I buy prints?',
         'a' => 'Yes. Your online gallery includes a print store with professional prints, canvases and albums. Every package also includes a print release for personal use.'],
        ['q' => 'Do you charge for travel?',
         'a' => 'Travel within 10 miles of Coton in the Elms is free. Further afield is welcome for a small travel fee, which I will confirm before you book.'],
    ],

    'areas' => [
        'base'   => 'Coton in the Elms',
        'nearby' => ['Rosliston', 'Walton-on-Trent', 'Lullington', 'Overseal', 'Linton', 'Netherseal', 'Castle Gresley', 'Cauldwell'],
        'towns'  => ['Burton upon Trent', 'Swadlincote', 'Barton-under-Needwood', 'Alrewas', 'Measham', 'Ashby-de-la-Zouch', 'Lichfield', 'Tamworth', 'Derby'],
        'spots'  => [
            ['icon' => 'tree',  'title' => 'National Forest woodland', 'text' => 'Dappled light, bluebells in spring and golden leaves in autumn, all on the doorstep.'],
            ['icon' => 'sun',   'title' => 'Open meadows',             'text' => 'Long grass and wildflowers for warm, golden evening sessions in summer.'],
            ['icon' => 'home',  'title' => 'Your home or garden',      'text' => 'Ideal for newborns and anyone who feels most themselves at home.'],
        ],
    ],

    // Portfolio: 'cat' must match a key in portfolio_categories.
    'portfolio_categories' => ['family' => 'Family', 'baby' => 'Baby', 'pets' => 'Pets', 'minis' => 'Seasonal minis'],
    'portfolio' => [
        ['cat' => 'family', 'src' => '', 'ratio' => '4/5', 'tone' => 'sage',     'alt' => 'Family walking hand in hand through woodland'],
        ['cat' => 'baby',   'src' => '', 'ratio' => '1/1', 'tone' => 'lavender', 'alt' => 'Newborn baby wrapped in a soft blanket at home'],
        ['cat' => 'pets',   'src' => '', 'ratio' => '4/5', 'tone' => 'taupe',    'alt' => 'Spaniel running through long grass'],
        ['cat' => 'minis',  'src' => '', 'ratio' => '3/4', 'tone' => 'lavender', 'alt' => 'Toddler in a bluebell wood mini session'],
        ['cat' => 'family', 'src' => '', 'ratio' => '1/1', 'tone' => 'taupe',    'alt' => 'Parents lifting their daughter between them'],
        ['cat' => 'baby',   'src' => '', 'ratio' => '4/5', 'tone' => 'sage',     'alt' => 'Baby\'s tiny feet held in a parent\'s hands'],
        ['cat' => 'minis',  'src' => '', 'ratio' => '4/5', 'tone' => 'taupe',    'alt' => 'Siblings in autumn leaves'],
        ['cat' => 'pets',   'src' => '', 'ratio' => '1/1', 'tone' => 'sage',     'alt' => 'Cat curled up on a windowsill'],
        ['cat' => 'family', 'src' => '', 'ratio' => '3/4', 'tone' => 'lavender', 'alt' => 'Mum and son sharing a laugh in a meadow'],
        ['cat' => 'baby',   'src' => '', 'ratio' => '1/1', 'tone' => 'taupe',    'alt' => 'First birthday portrait outdoors'],
        ['cat' => 'minis',  'src' => '', 'ratio' => '4/5', 'tone' => 'sage',     'alt' => 'Christmas mini session by twinkling lights'],
        ['cat' => 'pets',   'src' => '', 'ratio' => '3/4', 'tone' => 'lavender', 'alt' => 'Dog and owner sitting together on a bench'],
    ],

    // Named photo slots used across templates.
    'photos' => [
        'hero_main'   => ['src' => '', 'ratio' => '4/5', 'tone' => 'sage',     'alt' => 'Family cuddled together in golden woodland light', 'label' => 'Family'],
        'hero_small'  => ['src' => '', 'ratio' => '1/1', 'tone' => 'lavender', 'alt' => 'Close-up of a baby\'s hand holding a finger', 'label' => 'Baby'],
        'hero_pet'    => ['src' => '', 'ratio' => '3/4', 'tone' => 'taupe',    'alt' => 'Dog looking up at its owner', 'label' => 'Pets'],
        'about'       => ['src' => '', 'ratio' => '4/5', 'tone' => 'lavender', 'alt' => 'Portrait of the photographer behind Brooks & Bloom with her camera', 'label' => 'Your portrait'],
        'about_2'     => ['src' => '', 'ratio' => '1/1', 'tone' => 'sage',     'alt' => 'Behind the scenes on a family session', 'label' => 'Behind the scenes'],
        'family'      => ['src' => '', 'ratio' => '3/4', 'tone' => 'sage',     'alt' => 'Family session', 'label' => 'Family'],
        'baby'        => ['src' => '', 'ratio' => '3/4', 'tone' => 'lavender', 'alt' => 'Baby session', 'label' => 'Baby'],
        'pets'        => ['src' => '', 'ratio' => '3/4', 'tone' => 'taupe',    'alt' => 'Pet portrait', 'label' => 'Pets'],
        'minis'       => ['src' => '', 'ratio' => '3/4', 'tone' => 'sage',     'alt' => 'Seasonal mini session', 'label' => 'Minis'],
    ],
];
