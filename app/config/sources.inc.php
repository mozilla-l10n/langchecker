<?php

$no_active_tag = [
    'download_button.lang',
    'main.lang',
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
    'af', 'am', 'ar', 'az', 'bg', 'bn-BD', 'cs', 'cy', 'de', 'dsb', 'el',
    'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fa', 'fr', 'fy-NL', 'he',
    'hi-IN', 'hr', 'hsb', 'id', 'it', 'kab', 'ko', 'lt', 'ms', 'ncj', 'nl',
    'nv', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sl', 'son', 'sq', 'sr', 'sv-SE',
    'ta', 'tr', 'uk', 'zam', 'zh-CN', 'zh-TW',
];

// List of locales supported for the landing page (larger than the App Store)
$ios_landing_page = array_unique(array_merge(
    $ios_locales,
    [
        'af', 'an', 'ar', 'bn-BD', 'bn-IN', 'ca', 'el', 'es-AR', 'eu', 'fa',
        'fy-NL', 'gl', 'gn', 'he', 'hi-IN', 'ka', 'kab', 'kn', 'lij', 'ml',
        'ms', 'my', 'or', 'sq', 'sr',
    ]
));

// List of locales supported for the landing page
$android_landing_page = array_unique(array_merge(
    $fx_android_locales,
    [
        'af', 'ast', 'bg', 'bn-BD', 'fa', 'kab',
    ]
));

$engagement_locales = [
    'ar', 'bg', 'cs', 'da', 'de', 'el', 'en-GB', 'es', 'es-ES',
    'es-MX', 'fr', 'fy-NL', 'hi-IN', 'hu', 'id', 'it', 'ja',
    'ko', 'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR',
    'rm', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'tr',
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
        'deadline'          => '2016-04-29',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/accounts.lang' => [
        'deadline'          => '2016-03-15',
        'supported_locales' => $mozillaorg,
    ],
    'firefox/all.lang' => [
        'deadline'          => '2017-04-04',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/android/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => $android_landing_page,
    ],
    'firefox/australis/firefox_tour.lang' => [
        'priority'          => 5,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/channel/index.lang' => [
        'deadline'          => '2016-12-12',
        'priority'          => 1,
        'supported_locales' => $mozillaorg, // Has Firefox for Android download buttons
    ],
    'firefox/desktop/customize.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/desktop/fast.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/desktop/index.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/desktop/tips.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'am', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
            'es-ES', 'es-MX', 'eu', 'fa', 'ff', 'fr', 'fy-NL', 'ga-IE', 'gl',
            'he', 'hi-IN', 'hsb', 'hu', 'id', 'it', 'ja', 'kab', 'ko', 'lt',
            'ms', 'nl', 'nv', 'pl', 'pt-BR', 'pt-PT', 'ro', 'sk', 'sl', 'son',
            'sq', 'sr', 'sv-SE', 'uk', 'uz', 'xh', 'zam', 'zh-TW', 'af',
            'es-CL', 'gd', 'km', 'ncj', 'ru', 'zh-CN',
        ],
    ],
    'firefox/desktop/trust.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/developer.lang' => [
        'priority'          => 2,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/dnt.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 5,
        'supported_locales' => [
            'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL', 'fa', 'fi', 'fr',
            'fy-NL', 'hsb', 'it', 'ja', 'kab', 'ko', 'lt', 'nl', 'pt-BR',
            'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'uk',
            'uz', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/family/index.lang' => [
        'deadline'          => '2017-01-30',
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/features.lang' => [
        'deadline'          => '2016-10-04',
        'supported_locales' => $firefox_locales,
    ],
    'firefox/geolocation.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 5,
        'supported_locales' => [
            'af', 'ar', 'as', 'ast', 'az', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs',
            'cy', 'da', 'de', 'dsb', 'el', 'en-GB', 'eo', 'es-AR', 'es-CL',
            'es-ES', 'es-MX', 'et', 'eu', 'fa', 'fi', 'fr', 'fy-NL', 'ga-IE',
            'gd', 'gl', 'gu-IN', 'he', 'hi-IN', 'hr', 'hsb', 'hu', 'hy-AM',
            'id', 'is', 'it', 'ja', 'ka', 'kab', 'kk', 'kn', 'ko', 'lt', 'lv',
            'mk', 'ml', 'mr', 'nb-NO', 'nl', 'nn-NO', 'oc', 'pa-IN', 'pl',
            'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'si', 'sk', 'sl', 'son', 'sq',
            'sr', 'sv-SE', 'ta', 'te', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/installer-help.lang' => [
        'priority'          => 2,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/ios.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => $ios_landing_page,
    ],
    'firefox/new/horizon.lang' => [
        'deadline'          => '2017-02-20',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/nightly_firstrun.lang' => [
        'supported_locales' => [
            'ar', 'ast', 'cs', 'de', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fa', 'fr', 'fy-NL', 'gd', 'gl', 'he', 'hu', 'id', 'it', 'ja', 'kk',
            'ko', 'lt', 'lv', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-PT', 'ru', 'sk',
            'sv-SE', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/nightly_whatsnew.lang' => [
        'flags' => [
            'opt-in' => [
                'cs', 'de', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fr',
                'it', 'ja', 'pl', 'pt-BR', 'pt-PT', 'ru', 'sk', 'sl', 'uk',
                'zh-CN', 'zh-TW',
            ],
        ],
        'supported_locales' => [
            'cs', 'de', 'es-ES', 'fr', 'ja', 'pl', 'pt-BR', 'zh-TW',
        ],
    ],
    'firefox/private-browsing.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/sendto.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/sync.lang' => [
        'deadline'          => '2016-04-04',
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/tracking-protection-tour.lang' => [
        'deadline'          => '2016-02-29',
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_38.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_42.lang' => [
        'supported_locales' => $firefox_locales,
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
            'de', 'es-ES', 'fr', 'kab', 'pl', 'pt-BR', 'zh-TW',
        ],
    ],
    'legal/index.lang' => [
        'deadline'          => '2016-02-18',
        'priority'          => 1,
        'supported_locales' => $legal_locales,
    ],
    'lightbeam/lightbeam.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 5,
        'supported_locales' => [
            'am', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
            'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'fr', 'fy-NL', 'hi-IN',
            'hsb', 'it', 'ja', 'kab', 'km', 'ko', 'lt', 'ms', 'ncj', 'nl', 'nv',
            'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'son', 'sq', 'sr', 'sv-SE',
            'tr', 'uk', 'zam', 'zh-CN', 'zh-TW',
        ],
    ],
    'main.lang' => [
        'deadline'          => '2016-11-30',
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
    'mozorg/about/history-details.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => [
            'af', 'am', 'bn-BD', 'ca', 'cs', 'cy', 'de', 'dsb', 'en-GB',
            'es-CL', 'es-MX', 'eu', 'fa', 'fr', 'gl', 'hsb', 'it', 'ja', 'kab',
            'km', 'ko', 'lt', 'ncj', 'nl', 'nv', 'pa-IN', 'pt-BR', 'pt-PT',
            'ro', 'ru', 'sk', 'son', 'sq', 'sv-SE', 'uk', 'uz', 'zam', 'zh-CN',
            'zh-TW',
        ],
    ],
    'mozorg/about/history.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => [
            'af', 'am', 'ar', 'bg', 'bn-BD', 'ca', 'cs', 'cy', 'de', 'dsb',
            'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'fr',
            'fy-NL', 'gl', 'hr', 'hsb', 'id', 'it', 'ja', 'kab', 'km', 'ko',
            'lt', 'ms', 'ncj', 'nl', 'nv', 'pa-IN', 'pl', 'pt-BR', 'pt-PT',
            'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'ta', 'tr',
            'uk', 'uz', 'zam', 'zh-CN', 'zh-TW',
        ],
    ],
    'mozorg/about/manifesto.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => [
            'af', 'am', 'ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'cy', 'de', 'dsb',
            'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'fi',
            'fr', 'fy-NL', 'gd', 'gl', 'hi-IN', 'hr', 'hsb', 'hu', 'id', 'it',
            'ja', 'kab', 'km', 'ko', 'lt', 'mk', 'ms', 'ncj', 'nl', 'nv', 'pl',
            'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr',
            'sv-SE', 'tr', 'uk', 'uz', 'vi', 'xh', 'zam', 'zh-CN', 'zh-TW',
        ],
    ],
    'mozorg/contribute/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => $getinvolved_locales,
    ],
    'mozorg/contribute/signup.lang' => [
        'deadline' => '2016-06-06',
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
        'deadline'          => '2017-02-20',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/internet-health.lang' => [
        'deadline' => '2017-03-27',
        'flags'    => [
            'opt-in' => ['all'],
        ],
        'priority'          => 3,
        'supported_locales' => [
            'af', 'cy', 'de', 'es-ES', 'fr', 'kab', 'ko', 'pl', 'pt-BR', 'sq',
            'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/digital-inclusion.lang' => [
        'deadline' => '2017-04-10',
        'flags'    => [
            'opt-in' => ['all'],
        ],
        'priority'          => 3,
        'supported_locales' => [
            'af', 'cy', 'de', 'es-ES', 'fr', 'kab', 'pt-BR',
        ],
    ],
    'mozorg/internet-health/open-innovation.lang' => [
        'deadline' => '2017-04-14',
        'flags'    => [
            'opt-in' => ['all'],
        ],
        'priority'          => 3,
        'supported_locales' => [
            'cy', 'de', 'es-ES', 'fr', 'kab', 'pt-BR',
        ],
    ],
    'mozorg/internet-health/privacy-security.lang' => [
        'deadline' => '2017-03-27',
        'flags'    => [
            'opt-in' => ['all'],
        ],
        'priority'          => 3,
        'supported_locales' => [
            'af', 'cy', 'de', 'es-ES', 'fr', 'kab', 'ko', 'pt-BR', 'sq', 'sv-SE',
            'zh-TW',
        ],
    ],
    'mozorg/mission.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/newsletters.lang' => [
        'deadline'          => '2017-03-27',
        'priority'          => 2,
        'supported_locales' => $newsletter_locales,
    ],
    'mozorg/plugincheck-redesign.lang' => [
        'deadline'          => '2016-08-01',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/products.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/technology.lang' => [
        'deadline'          => '2016-11-30',
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
            'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab', 'ko', 'pl', 'pt-BR',
            'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'teach/smarton/security.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'hsb', 'it', 'kab', 'ja', 'ko', 'pl', 'pt-BR',
            'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'teach/smarton/surveillance.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab', 'ko', 'pl', 'pt-BR',
            'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'teach/smarton/tracking.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL', 'es-ES',
            'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab', 'ko', 'pl', 'pt-BR',
            'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
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
            'cy', 'cs', 'de', 'en-GB', 'es-ES', 'fi', 'fr', 'it', 'ja', 'kab',
            'ko', 'lt', 'nl', 'pl', 'pt-BR', 'ru', 'sq', 'uk', 'zh-TW',
        ],
    ],
    'thunderbird/features.lang' => [
        'deadline'          => '2017-02-20',
        'supported_locales' => $thunderbird_locales,
    ],
    'thunderbird/index.lang' => [
        'supported_locales' => $thunderbird_locales,
    ],
    'thunderbird/start/release.lang' => [
        'deadline'          => '2016-08-01',
        'supported_locales' => $thunderbird_locales,
    ],
];

// Default priority is 2
$firefoxhealthreport_lang = [
    'fhr.lang' => [
        'supported_locales' => array_diff($firefox_desktop_android, $mozorg_locales),
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
    'emails/2017/copyright.lang' => [
        'deadline'          => '2017-03-09',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/data_privacy_day.lang' => [
        'deadline'          => '2017-01-27',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/fundraising_thank_you.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it'],
    ],
    'emails/2017/survey_results.lang' => [
        'deadline'          => '2017-03-09',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/results_graphics.lang' => [
        'deadline'          => '2017-03-07',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/welcome-message.lang' => [
        'deadline'          => '2017-04-03',
        'priority'          => 4,
        'supported_locales' => ['de', 'fr'],
    ],
    'heartbeat/2016/sep2016.lang' => [
        'deadline'          => '2016-09-12',
        'supported_locales' => [
            'de', 'es-ES', 'es-MX', 'fr', 'hi-IN', 'id', 'it', 'ja', 'pl',
            'pt-BR', 'ru', 'zh-CN', 'zh-TW',
        ],
    ],
    'heartbeat/2016/nov2016.lang' => [
        'deadline'          => '2016-11-22',
        'supported_locales' => [
            'de', 'es-ES', 'es-MX', 'fr', 'hi-IN', 'id', 'it', 'ja', 'pl',
            'pt-BR', 'ru', 'zh-CN',
        ],
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
            'bg', 'cs', 'de', 'en-GB', 'es-ES', 'fr', 'it', 'nl', 'ro', 'sv-SE',
            'sl',
        ],
    ],
    'snippets/2016/nov2016.lang' => [
        'deadline'          => '2016-11-05',
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2016/dec2016.lang' => [
        'deadline'          => '2016-12-05',
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
    'social/2016/fundraising.lang' => [
        'supported_locales' => [
            'de', 'en-GB', 'es', 'fr', 'it', 'nl', 'pt-BR',
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
    'surveys/survey_hello_fx42.lang' => [
        'supported_locales' => [
            'ar', 'bg', 'cs', 'da', 'de', 'el', 'en-GB', 'es-ES', 'es-MX', 'fr',
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
        'deadline'          => '2017-03-31',
        'supported_locales' => $focus_android_store,
    ],
    'focus_android/screenshots_v1.lang' => [
        'deadline'          => '2017-03-31',
        'supported_locales' => [
            'es-ES', 'id', 'pt-BR', 'ru',
        ],
    ],
    'focus_ios/description_release.lang' => [
        'supported_locales' => $focus_ios_store,
    ],
    'focus_ios/screenshots_v2_1.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru', 'zh-CN',
        ],
    ],
    'focus_ios/whatsnew/focus_2_1.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $focus_ios_store,
    ],
    'focus_ios/whatsnew/focus_3_1.lang' => [
        'deadline'          => '2017-03-09',
        'supported_locales' => $focus_ios_store,
    ],
    'fx_android/description_beta.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/description_release.lang' => [
        'deadline'          => '2016-04-30',
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_50_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_50.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_51_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_51.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_52_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_52.lang' => [
        'deadline'          => '2017-03-07',
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_53_beta.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_ios/description_release.lang' => [
        'deadline'          => '2016-03-30',
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/screenshots_v3.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru',
            'zh-CN', 'zh-TW',
        ],
    ],
    'fx_ios/whatsnew/ios_5_0.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/whatsnew/ios_6_0.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/whatsnew/ios_7_0.lang' => [
        'deadline'          => '2017-03-20',
        'supported_locales' => $fx_ios_store,
    ],
];
