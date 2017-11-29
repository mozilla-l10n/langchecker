<?php

$no_active_tag = [
    'download_button.lang',
    'firefox/shared.lang',
    'main.lang',
    'mozorg/internet-health/shared.lang',
    'newsletter.lang',
    'privacy/index.lang',
];

$legal_locales = [
    'af', 'ar', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs', 'de', 'el', 'es-AR',
    'es-CL', 'es-ES', 'es-MX', 'et', 'fa', 'ff', 'fr', 'fy-NL', 'hi-IN', 'hr',
    'hu', 'id', 'it', 'ja', 'ko', 'mk', 'my', 'nl', 'pl', 'pt-BR', 'ro', 'ru',
    'son', 'sq', 'sr', 'sv-SE', 'ta', 'tl', 'xh', 'zh-CN', 'zh-TW', 'zu',
];

$getinvolved_locales = [
    'af', 'am', 'ar', 'az', 'azz', 'bg', 'bn-BD', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb',
    'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fa', 'fr', 'fy-NL',
    'he', 'hi-IN', 'hr', 'hsb', 'ia', 'id', 'it', 'kab', 'ko', 'lt', 'ms',
    'nl', 'nn-NO', 'nv', 'pai', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq',
    'sr', 'sv-SE', 'sw', 'ta', 'tr', 'uk', 'xh', 'zam', 'zh-CN', 'zh-TW',
];

// List of locales supported for the landing page (larger than the App Store)
$ios_landing_page = array_unique(array_merge(
    $ios_locales,
    [
        'af', 'an', 'ar', 'bn-BD', 'bn-IN', 'bs', 'ca', 'cak', 'el', 'es-AR',
        'eu', 'fa', 'fy-NL', 'gl', 'gn', 'he', 'hi-IN', 'ka', 'kab', 'kn',
        'lij', 'ml', 'ms', 'my', 'or', 'sq', 'sr', 'ta', 'ur', 'xh',
    ]
));

// List of locales supported for the landing page
$android_landing_page = array_unique(array_merge(
    $fx_android_locales,
    [
        'af', 'ast', 'bg', 'bn-BD', 'bs', 'fa', 'kab',
    ]
));

$engagement_locales = [
    'ar', 'bg', 'cs', 'da', 'de', 'el', 'en-GB', 'es', 'es-ES',
    'es-MX', 'fa', 'fr', 'fy-NL', 'he', 'hi-IN', 'hu', 'id', 'it', 'ja',
    'ko', 'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR',
    'rm', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'tr', 'ur',
    'zh-CN', 'zh-HK', 'zh-TW',
];

/*
    For each file it's possibile to specify the following fields:
    * deadline: if the deadline is the same for all locales, assign the deadline
      as a string in ISO format (YYYY-MM-DD):

      'deadline' => '2016-04-29',

      If deadline needs to change based on the locale, you can use a
      multidimensional array, where each deadline is associated to a list of
      locales. 'all' can be used to indicate that deadline applies to all
      supported locales. Example, deadline only for two locales:

      'deadline' => [
          '2016-04-25' => ['de', 'fr'],
      ],

      Different deadlines:

      'deadline' => [
          '2016-04-25' => ['de', 'fr'],
          '2016-01-05' => ['all'],
      ],

    * priority: priorities are numeric values assigned to files. 1 is the
      highest priority, 5 is the lowest.

      If the priority is the same for all locales, simply assign it like this:

      priority => 1,

      If priority needs to change based on the locale, you can use a
      multidimensional array, where each priority is associated to a
      list of locales. 'all' can be used to indicate that priority applies to
      all supported locales. Example:

      'priority' => [
          1 => ['de', 'fr'],
          2 => ['all'],
      ],

      If not specified, the default priority defined in the project will be
      used.

    * flags: a multidimensional array. For each key (tag), there's an array
      of locales for which the tag is valid. 'all' can be used to
      indicate that tag applies to all other supported locales, e.g.

      'flags' => [
          'opt-in' => ['all'],
      ],
*/

// Default priority is 3
$mozillaorg_lang = [
    'download_button.lang' => [
        'deadline'          => '2017-11-13',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/accounts.lang' => [
        'supported_locales' => $mozillaorg,
    ],
    'firefox/all.lang' => [
        'deadline'          => '2017-04-04',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/australis/firefox_tour.lang' => [
        'priority'          => 5,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/channel/index.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg, // Has Firefox for Android download buttons
    ],
    'firefox/dnt.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 5,
        'supported_locales' => [
            'bn-BD', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL',
            'fa', 'fi', 'fr', 'fy-NL', 'hi-IN', 'hsb', 'it', 'ja', 'kab', 'ko',
            'lt', 'nl', 'nn-NO', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'sl',
            'son', 'sq', 'sr', 'sv-SE', 'uk', 'ur', 'uz', 'xh', 'zh-CN',
            'zh-TW',
        ],
    ],
    'firefox/features/bookmarks.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/fast.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/independent.lang' => [
        'deadline'          => '2017-09-10',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/index.lang' => [
        'deadline'          => '2017-11-13',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/memory.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/password-manager.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/private-browsing.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/send-tabs.lang' => [
        'deadline'          => '2017-09-26',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/features/sync.lang' => [
        'deadline'          => '2017-09-26',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/geolocation.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 5,
        'supported_locales' => [
                'af', 'ar', 'as', 'ast', 'az', 'bg', 'bn-BD', 'bn-IN', 'bs',
                'ca', 'cak', 'cs', 'cy', 'da', 'de', 'dsb', 'el', 'en-GB', 'eo',
                'es-AR', 'es-CL', 'es-ES', 'es-MX', 'et', 'eu', 'fa', 'fi',
                'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gu-IN', 'he', 'hi-IN',
                'hr', 'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'ka', 'kab',
                'kk', 'kn', 'ko', 'lt', 'lv', 'mk', 'ml', 'mr', 'nb-NO', 'nl',
                'nn-NO', 'oc', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro',
                'ru', 'si', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'ta', 'te',
                'th', 'tr', 'uk', 'ur', 'vi', 'xh', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/hub/home.lang' => [
        'flags'             => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/hub/home-quantum.lang' => [
        'deadline'          => '2017-11-30',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/installer-help.lang' => [
        'priority'          => 2,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/mobile.lang' => [
        'deadline'          => '2017-11-13',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/new/batm.lang' => [
        'priority'          => 1,
        'supported_locales' => ['de'],
    ],
    'firefox/new/horizon.lang' => [
        'flags'             => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/new/onboarding.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/new/quantum.lang' => [
        'deadline'          => '2017-11-30',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/new/sem.lang' => [
        'priority'          => 1,
        'supported_locales' => ['de'],
    ],
    'firefox/new/wait-face.lang' => [
        'priority'          => 1,
        'supported_locales' => ['de'],
    ],
    'firefox/nightly_firstrun.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/nightly_whatsnew.lang' => [
        'flags' => [
            'opt-in' => $firefox_locales,
        ],
        'supported_locales' => [
            'bn-BD', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'eo', 'es-CL',
            'es-ES', 'fr', 'ga-IE', 'hi-IN', 'hsb', 'ja', 'kab', 'kk', 'ko', 'nn-NO',
            'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/products/android.lang' => [
        'flags'             => [
          'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/products/desktop.lang' => [
        'flags'             => [
          'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/products/developer.lang' => [
        'flags'             => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/products/developer-quantum.lang' => [
        'deadline'          => '2017-11-13',
        'supported_locales' => $firefox_locales,
    ],
    'firefox/products/focus.lang' => [
        'flags'             => [
          'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/products/ios.lang' => [
        'flags'             => [
          'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/retention/thank-you.lang' => [
        'priority'          => 1,
        'deadline'          => '2017-09-15',
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'firefox/sendto.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/shared.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/sync.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/tracking-protection-tour.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_38.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_42.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_50.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_56.lang' => [
        'deadline'          => '2017-09-26',
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_57.lang' => [
        'deadline'          => '2017-11-05',
        'priority'          => 1,
        'supported_locales' => array_diff(
            $firefox_locales,
            [
                'de', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fr', 'id',
                'pl', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
            ]),
    ],
    'foundation/advocacy.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-GB', 'fr', 'kab', 'ko', 'pt-BR', 'ro',
            'sk', 'sq',
        ],
    ],
    'foundation/annualreport/2011.lang' => [
        'priority'          => 5,
        'supported_locales' => [
            'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'is', 'it', 'ja', 'ko', 'lij', 'ms', 'nl', 'oc',
            'pa-IN', 'pl', 'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/annualreport/2011faq.lang' => [
        'priority'          => 5,
        'supported_locales' => [
            'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'is', 'it', 'ja', 'ko', 'lij', 'ms', 'nl', 'oc',
            'pa-IN', 'pl', 'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/annualreport/2012/faq.lang' => [
        'priority'          => 5,
        'supported_locales' => [
            'ar', 'ast', 'de', 'el', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'is', 'it', 'ja', 'ko', 'lij', 'ms', 'nl', 'oc',
            'pa-IN', 'pl', 'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/annualreport/2012/index.lang' => [
        'priority'          => 5,
        'supported_locales' => [
            'ar', 'ast', 'de', 'el', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'is', 'it', 'ja', 'ko', 'lij', 'ms', 'nl', 'oc',
            'pa-IN', 'pl', 'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-GB', 'es-ES', 'fr', 'kab', 'ko', 'pl',
            'pt-BR', 'ro', 'sk', 'sq', 'zh-TW',
        ],
    ],
    'foundation/issues.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-GB', 'fr', 'kab', 'ko', 'pt-BR', 'ro',
            'sk', 'sq',
        ],
    ],
    'foundation/leadership-network.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-GB', 'fr', 'kab', 'ko', 'pt-BR', 'ro',
            'sk', 'sq',
        ],
    ],
    'legal/index.lang' => [
        'priority'          => 1,
        'supported_locales' => $legal_locales,
    ],
    'lightbeam/lightbeam.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 5,
        'supported_locales' => [
            'am', 'azz', 'bs', 'ca', 'cak', 'cs', 'cy', 'de', 'dsb', 'el',
            'en-GB', 'en-ZA', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu', 'fa',
            'fr', 'fy-NL', 'hi-IN', 'hsb', 'ia', 'it', 'ja', 'kab', 'km', 'ko', 'lt',
            'ms', 'nl', 'nv', 'pai', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sk',
            'son', 'sq', 'sr', 'sv-SE', 'tr', 'uk', 'ur', 'zam', 'zh-CN',
            'zh-TW',
        ],
    ],
    'main.lang' => [
        'deadline'          => '2017-11-13',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/404.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about/governance/policies/participation.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'hi-IN', 'ja', 'pt-BR', 'zh-TW',
        ],
    ],
    'mozorg/about/history-details.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => [
            'af', 'am', 'azz', 'bn-BD', 'bs', 'ca', 'cak', 'cs', 'cy', 'de',
            'dsb', 'en-GB', 'es-CL', 'es-MX', 'eu', 'fa', 'fr', 'gl', 'hi-IN',
            'hsb', 'ia', 'it', 'ja', 'kab', 'km', 'ko', 'lt', 'lv', 'nl', 'nn-NO', 'nv',
            'pa-IN', 'pai', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'son', 'sq',
            'sv-SE', 'sw', 'uk', 'uz', 'zam', 'zh-CN', 'zh-TW',
        ],
    ],
    'mozorg/about/history.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => [
            'af', 'am', 'ar', 'azz', 'bg', 'bn-BD', 'bs', 'ca', 'cak', 'cs',
            'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES',
            'es-MX', 'eu', 'fa', 'fr', 'fy-NL', 'gl', 'hi-IN', 'hr', 'hsb',
            'ia', 'id', 'it', 'ja', 'kab', 'km', 'ko', 'lt', 'ms', 'nl', 'nn-NO', 'nv',
            'pa-IN', 'pai', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'sl',
            'son', 'sq', 'sr', 'sv-SE', 'sw', 'ta', 'tr', 'uk', 'uz', 'zam',
            'zh-CN', 'zh-TW',
        ],
    ],
    'mozorg/about/manifesto.lang' => [
        'priority'          => 3,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/contribute/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => $getinvolved_locales,
    ],
    'mozorg/contribute/signup.lang' => [
        'flags'    => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => $getinvolved_locales,
    ],
    'mozorg/contribute/stories.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => $getinvolved_locales,
    ],
    'mozorg/home/index-2016.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/home/index-quantum.lang' => [
        'deadline'          => '2017-11-30',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/internet-health.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'hi-IN', 'id', 'it', 'kab', 'ko', 'pl',
            'pt-BR', 'sq', 'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/decentralization.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fr', 'id', 'it', 'kab', 'ko', 'pt-BR', 'ro', 'sk', 'sl',
            'sq', 'sv-SE',
        ],
    ],
    'mozorg/internet-health/digital-inclusion.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fr', 'id', 'it', 'kab', 'ko', 'pt-BR', 'ro', 'sk', 'sl',
            'sq', 'sv-SE',
        ],
    ],
    'mozorg/internet-health/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'hi-IN', 'id', 'it', 'kab', 'ko', 'pl',
            'pt-BR', 'ro', 'sk', 'sl', 'sq', 'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/open-innovation.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fr', 'id', 'it', 'kab', 'ko', 'pt-BR', 'ro', 'sk', 'sl',
            'sq', 'sv-SE',
        ],
    ],
    'mozorg/internet-health/privacy-security.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'id', 'it', 'kab', 'ko', 'pt-BR', 'ro', 'sk',
            'sl', 'sq', 'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/shared.lang' => [
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'hi-IN', 'id', 'it', 'kab', 'ko', 'pl',
            'pt-BR', 'sk', 'sl', 'sq', 'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/web-literacy.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'cak', 'cs', 'cy', 'de', 'en-GB', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'id', 'it', 'kab', 'ko', 'pt-BR', 'ro', 'sk', 'sl', 'sq', 'sv-SE',
        ],
    ],
    'mozorg/mission.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/moss/index.lang' => [
        'deadline'          => '2017-07-30',
        'priority'          => 1,
        'supported_locales' => ['hi-IN'],
    ],
    'mozorg/moss/mission-partners-india.lang' => [
        'deadline'          => '2017-07-30',
        'priority'          => 1,
        'supported_locales' => ['hi-IN'],
    ],
    'mozorg/newsletters.lang' => [
        'deadline'          => '2017-03-27',
        'priority'          => 2,
        'supported_locales' => $newsletter_locales,
    ],
    'mozorg/plugincheck-update.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/products.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/technology.lang' => [
        'supported_locales' => $mozillaorg,
    ],
    'newsletter.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'privacy/index.lang' => [
        'priority'          => 1,
        'supported_locales' => array_diff($legal_locales, ['et']),
    ],
    'privacy/principles.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'tabzilla/tabzilla.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'teach/smarton/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'az', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR',
            'es-CL', 'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab',
            'ko', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sq', 'sr', 'uk', 'zh-CN',
            'zh-TW',
        ],
    ],
    'teach/smarton/security.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'az', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR',
            'es-CL', 'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'kab', 'ja',
            'ko', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sq', 'sr', 'uk', 'zh-CN',
            'zh-TW',
        ],
    ],
    'teach/smarton/surveillance.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'az', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR',
            'es-CL', 'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab',
            'ko', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sq', 'sr', 'uk', 'zh-CN',
            'zh-TW',
        ],
    ],
    'teach/smarton/tracking.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'az', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR',
            'es-CL', 'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab',
            'ko', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sq', 'sr', 'uk', 'zh-CN',
            'zh-TW',
        ],
    ],
    'thunderbird/channel.lang' => [
        'flags' => [
            'opt-in' => [
                'ar', 'ast', 'az', 'bg', 'bn-BD', 'br', 'ca', 'cs', 'cy', 'da',
                'de', 'dsb', 'el', 'en-GB', 'es-AR', 'es-ES', 'et', 'eu', 'fi',
                'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'he', 'hr', 'hsb', 'hu',
                'hy-AM', 'id', 'is', 'it', 'ja', 'kab', 'ko', 'lt', 'nb-NO',
                'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro',
                'ru', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'tr', 'uk', 'vi',
                'zh-CN', 'zh-TW',
            ],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-GB', 'es-ES', 'fi', 'fr', 'it',
            'ja', 'kab', 'ko', 'lt', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-BR', 'ro',
            'ru', 'sk', 'sq', 'uk', 'zh-TW',
        ],
    ],
    'thunderbird/features.lang' => [
        'deadline'          => '2017-02-20',
        'supported_locales' => array_merge(
            $thunderbird_locales,
            [
                'az', 'bs', 'cak', 'hi-IN',
            ]
        ),
    ],
    'thunderbird/index.lang' => [
        'supported_locales' => array_merge(
            $thunderbird_locales,
            [
                'az', 'bs', 'cak', 'hi-IN', 'ur',
            ]
        ),
    ],
    'thunderbird/start/release.lang' => [
        'supported_locales' => array_merge(
            $thunderbird_locales,
            [
                'az', 'bs', 'cak',
            ]
        ),
    ],
];

// Default priority is 2
$engagement_lang = [
    'ads/ios_android_apr2016.lang' => [
        'supported_locales' => ['de', 'es-ES', 'fr', 'pl'],
    ],
    'ads/ios_android_feb2017.lang' => [
        'deadline'          => '2017-02-02',
        'supported_locales' => ['zh-HK', 'zh-TW'],
    ],
    'emails/2016/fundraising_email_1.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it'],
    ],
    'emails/2016/fundraising_email_2.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it'],
    ],
    'emails/2016/fundraising_email_3.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/advo-autoresponder.lang' => [
        'deadline'          => '2017-04-03',
        'priority'          => 4,
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/copyright_call.lang' => [
        'deadline'          => '2017-03-31',
        'supported_locales' => ['de', 'fr', 'es', 'pl'],
    ],
    'emails/2017/copyright_call_IMCO.lang' => [
        'deadline'          => '2017-06-06',
        'priority'          => 5,
        'supported_locales' => ['de'],
    ],
    'emails/2017/copyright.lang' => [
        'deadline'          => '2017-03-09',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/copyright_sept.lang' => [
        'deadline'          => '2017-10-10',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl',
        ],
    ],
    'emails/2017/copyright_summer.lang' => [
        'deadline'          => '2017-07-14',
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2017/data_privacy_day.lang' => [
        'deadline'          => '2017-01-27',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/focus_android.lang' => [
        'deadline'          => '2017-06-19',
        'supported_locales' => ['pl'],
    ],
    'emails/2017/fx_mobile_update.lang' => [
        'deadline'          => '2017-09-22',
        'supported_locales' => ['pl'],
    ],
    'emails/2017/firefoxandyou_oct.lang' => [
        'deadline'          => '2017-10-23',
        'supported_locales' => ['fr', 'pl', 'pt-BR', 'ru'],
    ],
    'emails/2017/fundraising_email_1.lang' => [
        'deadline'          => '2017-11-24',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_oct.lang' => [
        'supported_locales' => ['de'],
    ],
    'emails/2017/fundraising_thank_you.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it'],
    ],
    'emails/2017/ihr_email_a.lang' => [
        'deadline'          => '2017-08-07',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/iot_results_a.lang' => [
        'deadline'          => '2017-10-30',
        'supported_locales' => ['es'],
    ],
    'emails/2017/iot_results_b.lang' => [
        'deadline'          => '2017-10-30',
        'supported_locales' => ['de', 'fr', 'pt-BR'],
    ],
    'emails/2017/iot_survey.lang' => [
        'deadline'          => '2017-08-06',
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2017/mozfest_call.lang' => [
        'deadline'          => '2017-06-15',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/paperstorm.lang' => [
        'supported_locales' => ['de', 'es-ES', 'fr', 'it'],
    ],
    'emails/2017/pocket.lang' => [
        'deadline'          => '2017-08-04',
        'supported_locales' => ['pl'],
    ],
    'emails/2017/results_graphics.lang' => [
        'deadline'          => '2017-03-07',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/survey_results.lang' => [
        'deadline'          => '2017-03-09',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/template.lang' => [
        'deadline'          => '2017-06-29',
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pl'],
    ],
    'emails/2017/welcome-message.lang' => [
        'deadline'          => '2017-05-10',
        'priority'          => 4,
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'heartbeat/2016/sep2016.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'es-MX', 'fr', 'hi-IN', 'id', 'it', 'ja', 'pl',
            'pt-BR', 'ru', 'zh-CN', 'zh-TW',
        ],
    ],
    'heartbeat/2016/nov2016.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'es-MX', 'fr', 'hi-IN', 'id', 'it', 'ja', 'pl',
            'pt-BR', 'ru', 'zh-CN',
        ],
    ],
    'other/2017/iot_results_assets.lang' => [
        'deadline'          => '2017-10-29',
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pt-BR'],
    ],
    'other/2017/mozfest_form.lang' => [
        'deadline'          => '2017-06-15',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'other/2017/mozfest_design_assets.lang' => [
        'deadline'          => '2017-10-04',
        'priority'          => 3,
        'supported_locales' => ['de', 'es', 'fr', 'hi-IN', 'it', 'pt-BR', 'zh-TW'],
    ],
    'snippets/2016/jan2016.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2016/feb2016.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'ru', 'pt-BR'],
    ],
    'snippets/2016/mar2016.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'id', 'ru', 'pt-BR'],
    ],
    'snippets/2016/apr2016.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'id', 'ru', 'pt-BR'],
    ],
    'snippets/2016/apr2016_b.lang' => [
        'supported_locales' => ['pt-BR'],
    ],
    'snippets/2016/may2016_a.lang' => [
        'supported_locales' => ['es', 'fr', 'ru', 'pt-BR'],
    ],
    'snippets/2016/may2016_b.lang' => [
        'supported_locales' => ['de'],
    ],
    'snippets/2016/jun2016_berec.lang' => [
        'supported_locales' => [
            'cs', 'de', 'en-GB', 'es-ES', 'fr', 'it', 'nl', 'ro', 'sv-SE',
            'sl',
        ],
    ],
    'snippets/2016/nov2016.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2016/dec2016.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2016/dec2016_eoy_a.lang' => [
        'supported_locales' => ['it', 'pt-BR', 'ru'],
    ],
    'snippets/2016/dec2016_eoy_b.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'snippets/2016/dec2016_eoy_mob.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2016/dec2016_eoy_ty.lang' => [
        'deadline'          => '2017-01-03',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2017/aurora.lang' => [
        'deadline'          => '2017-04-26',
        'supported_locales' => [
            'cs', 'de', 'es', 'fr', 'it', 'ja', 'nl', 'pl', 'pt-BR', 'ro', 'ru',
            'tr', 'zh-CN',
        ],
    ],
    'snippets/2017/jan2017.lang' => [
        'deadline'          => '2017-01-06',
        'supported_locales' => ['de'],
    ],
    'snippets/2017/feb2017.lang' => [
        'deadline'          => '2017-02-03',
        'supported_locales' => ['de', 'es', 'fr', 'ru'],
    ],
    'snippets/2017/feb2017_b.lang' => [
        'deadline'          => '2017-02-03',
        'supported_locales' => ['pt-BR'],
    ],
    'snippets/2017/mar2017.lang' => [
        'deadline'          => '2017-02-24',
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2017/mar2017_b.lang' => [
        'deadline'          => '2017-02-24',
        'supported_locales' => ['id', 'zh-TW'],
    ],
    'snippets/2017/apr2017.lang' => [
        'deadline'          => '2017-03-21',
        'supported_locales' => ['de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW'],
    ],
    'snippets/2017/apr2017_b.lang' => [
        'deadline'          => '2017-03-31',
        'supported_locales' => ['de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW'],
    ],
    'snippets/2017/may2017.lang' => [
        'deadline'          => '2017-04-19',
        'supported_locales' => ['de', 'es', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW'],
    ],
    'snippets/2017/may2017_b.lang' => [
        'deadline'          => '2017-04-19',
        'supported_locales' => ['ar', 'fa', 'he', 'ur'],
    ],
    'snippets/2017/may2017_c.lang' => [
        'deadline'          => '2017-04-19',
        'supported_locales' => ['cs'],
    ],
    'snippets/2017/may2017_d.lang' => [
        'deadline'          => '2017-04-19',
        'supported_locales' => ['pl'],
    ],
    'snippets/2017/jun2017.lang' => [
        'deadline'          => '2017-05-12',
        'supported_locales' => [
            'cs', 'de', 'es', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/jul2017.lang' => [
        'deadline'          => '2017-06-19',
        'supported_locales' => [
            'cs', 'es', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/jul2017_b.lang' => [
        'deadline'          => '2017-06-19',
        'supported_locales' => ['de'],
    ],
    'snippets/2017/sep2017_a.lang' => [
        'deadline'          => '2017-09-04',
        'supported_locales' => [
            'cs', 'de', 'es', 'fr', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/sep2017_b.lang' => [
        'deadline'          => '2017-09-04',
        'supported_locales' => ['id'],
    ],
    'snippets/2017/oct2017.lang' => [
        'deadline'          => '2017-10-25',
        'supported_locales' => [
            'cs', 'de', 'es', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/nov2017_mobile.lang' => [
        'deadline'          => '2017-11-10',
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/thanks_sep2017.lang' => [
        'deadline'          => '2017-09-15',
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/copyright_sept.lang' => [
        'deadline'          => '2017-09-15',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl',
        ],
    ],
    'snippets/2017/testpilot_aug2017.lang' => [
        'deadline'          => '2017-07-31',
        'supported_locales' => [
            'cs', 'es', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/fundraising.lang' => [
        'deadline'          => '2017-10-10',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2017/iot_survey.lang' => [
        'deadline'          => '2017-08-06',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pt-BR',
        ],
    ],
    'snippets/2017/iot_results.lang' => [
        'deadline'          => '2017-10-30',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pt-BR',
        ],
    ],
    'snippets/2017/paperstorm.lang' => [
        'deadline'          => '2017-05-08',
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'it',
        ],
    ],
    'snippets/2017/list_sign_up_oct.lang' => [
        'deadline'          => '2017-10-05',
        'supported_locales' => [
            'cs', 'de', 'es', 'fr', 'it', 'nl', 'pl', 'ru',
        ],
    ],
    'snippets/2017/buyers-guide.lang' => [
        'supported_locales' => ['es'],
    ],
    'social/2016/fundraising.lang' => [
        'supported_locales' => [
            'de', 'en-GB', 'es', 'fr', 'it', 'nl', 'pt-BR',
        ],
    ],
    'social/2017/copyright_sept.lang' => [
        'deadline'          => '2017-09-03',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl',
        ],
    ],
    'social/2017/iot_survey.lang' => [
        'deadline'          => '2017-08-09',
        'priority'          => 5,
        'supported_locales' => [
            'de', 'es', 'fr', 'pt-BR',
        ],
    ],
    'social/2017/mozfest.lang' => [
        'deadline'          => '2017-06-15',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'social/2017/paperstorm.lang' => [
        'deadline'          => '2017-05-08',
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'it',
        ],
    ],
    'surveys/copyright_stories.lang' => [
        'deadline'          => '2017-03-09',
        'supported_locales' => ['de', 'fr'],
    ],
    'surveys/copyright_call_survey.lang' => [
        'deadline'          => '2017-03-31',
        'supported_locales' => ['de', 'fr', 'es', 'pl'],
    ],
    'surveys/data_privacy_day.lang' => [
        'deadline'          => '2017-01-27',
        'supported_locales' => ['de', 'fr'],
    ],
    'surveys/iot_survey.lang' => [
        'deadline'          => '2017-08-06',
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pt-BR'],
    ],
    'surveys/survey_hello_fx42.lang' => [
        'supported_locales' => [
            'ar', 'cs', 'da', 'de', 'el', 'en-GB', 'es-ES', 'es-MX', 'fr',
            'fy-NL', 'hi-IN', 'hu', 'id', 'it', 'ja', 'ko', 'nb-NO', 'nl',
            'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'rm', 'ro', 'ru', 'sk', 'sl', 'sq',
            'sr', 'sv-SE', 'tr', 'zh-CN', 'zh-TW',
        ],
    ],
    'surveys/survey_maker_party_2016.lang' => [
        'supported_locales' => [
            'bg', 'cs', 'de', 'es', 'fr', 'it', 'nl', 'sl',
        ],
    ],
    'surveys/survey_eoy_heartbeat.lang' => [
        'supported_locales' => ['de'],
    ],
    'tiles/2016/tiles_jan2016.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
];

// Default priority is 1
$appstores_lang = [
    'focus_android/description_release.lang' => [
        'supported_locales' => $focus_android_store,
    ],
    /*
        Klar is a special case. Content is enabled only for en-US, de, it, fr
        to cover Switzerland. This also allows us to have a proper "Focus"
        description for German (e.g. users located outside Germany but using
        a phone in German).
    */
    'klar_android/description_release.lang' => [
        'supported_locales' => ['de', 'fr', 'it'],
    ],
    'focus_android/screenshots_v1.lang' => [
        'supported_locales' => [
            'es-ES', 'id', 'pt-BR', 'ru',
        ],
    ],
    'focus_ios/description_release.lang' => [
        'deadline'          => '2017-09-13',
        'supported_locales' => $focus_ios_store,
    ],
    'focus_ios/screenshots_v2_1.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru', 'zh-CN',
        ],
    ],
    'focus_ios/whatsnew/focus_3_1.lang' => [
        'supported_locales' => $focus_ios_store,
    ],
    'fx_android/description_beta.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/description_nightly.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/description_release.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_53.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_54_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_54.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_55_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_55.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_56_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_56.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_57_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_57.lang' => [
        'deadline'          => '2017-11-14',
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_58_beta.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_ios/description_release.lang' => [
        'deadline'          => '2017-09-13',
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/screenshots_v3.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru',
            'zh-CN', 'zh-TW',
        ],
    ],
    'fx_ios/whatsnew/ios_8_0.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => array_diff($fx_ios_store, ['de']),
    ],
    'fx_ios/whatsnew/ios_8_0_de.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => ['de'],
    ],
    'fx_ios/whatsnew/ios_9_0.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/whatsnew/ios_10.lang' => [
        'deadline'          => '2017-11-13',
        'supported_locales' => array_diff($fx_ios_store, ['de']),
    ],
    'fx_ios/whatsnew/ios_10b.lang' => [
        'deadline'          => '2017-11-13',
        'supported_locales' => ['de'],
    ],
];
