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
        'af', 'an', 'ar', 'bn-BD', 'bn-IN', 'ca', 'el', 'es-AR',
        'eu', 'fa', 'gl', 'gn', 'hi-IN', 'ka', 'kab', 'kn',
        'lij', 'ml', 'ms', 'my', 'or', 'sq', 'sr',
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
    * deadline: string, date in ISO format

    * priorities: a multidimensional array, where each level of priority
      is associated to a list of locales. 1 is the highest priority, 3 is the
      lowest. 'all' can be used to indicate that priority applies to all
      supported locales. If not specified, the default priority defined in
      the project will be used.

    * flags: a multidimensional array. For each key (tag), there's an array
      of locales for which the tag is valid. 'all' can be used to
      indicate that tag applies to all supported locales, e.g.

      'flags' => [
          'opt-in' => ['all'],
      ],
*/

// Default priority is 3
$mozillaorg_lang = [
    'download_button.lang' => [
        'deadline'            => '2016-04-29',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/accounts.lang' => [
        'deadline'            => '2016-03-15',
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/android/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $android_landing_page,
    ],
    'firefox/australis/firefox_tour.lang' => [
        'supported_locales' => $firefox_locales,
    ],
    'firefox/channel/index.lang' => [
        'deadline'            => '2016-12-12',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg, // Has Firefox for Android download buttons
    ],
    'firefox/desktop/customize.lang' => [
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/desktop/fast.lang' => [
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/desktop/index.lang' => [
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/desktop/tips.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            2 => ['all'],
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
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/developer.lang' => [
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/dnt.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL', 'fa', 'fi', 'fr',
            'fy-NL', 'hsb', 'it', 'ja', 'kab', 'ko', 'lt', 'nl', 'pt-BR',
            'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'uk',
            'uz', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/family/index.lang' => [
        'deadline'            => '2017-01-30',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/features.lang' => [
        'deadline'            => '2016-10-04',
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/geolocation.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
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
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/ios.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $ios_landing_page,
    ],
    'firefox/new/horizon.lang' => [
        'deadline'            => '2017-02-20',
        'priorities'          => [
            1 => ['all'],
        ],
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
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/sendto.lang' => [
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/sync.lang' => [
        'deadline'            => '2016-04-04',
        'priorities'          => [
            1 => ['all'],
        ],
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
        'supported_locales' => [
            'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'is', 'it', 'ja', 'ko', 'lij', 'ms', 'nl', 'oc',
            'pa-IN', 'pl', 'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/annualreport/2011faq.lang' => [
        'supported_locales' => [
            'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'is', 'it', 'ja', 'ko', 'lij', 'ms', 'nl', 'oc',
            'pa-IN', 'pl', 'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/annualreport/2012/faq.lang' => [
        'supported_locales' => [
            'ar', 'ast', 'de', 'el', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'is', 'it', 'ja', 'ko', 'lij', 'ms', 'nl', 'oc',
            'pa-IN', 'pl', 'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/annualreport/2012/index.lang' => [
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
        'deadline'            => '2016-02-18',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $legal_locales,
    ],
    'lightbeam/lightbeam.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'am', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
            'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'fr', 'fy-NL', 'hi-IN',
            'hsb', 'it', 'ja', 'kab', 'km', 'ko', 'lt', 'ms', 'ncj', 'nl', 'nv',
            'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'son', 'sq', 'sr', 'sv-SE',
            'tr', 'uk', 'zam', 'zh-CN', 'zh-TW',
        ],
    ],
    'main.lang' => [
        'deadline'            => '2016-11-30',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/404.lang' => [
        'priorities' => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about.lang' => [
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about/history-details.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            2 => ['all'],
        ],
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
        'priorities'          => [
            2 => ['all'],
        ],
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
        'priorities'          => [
            2 => ['all'],
        ],
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
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $getinvolved_locales,
    ],
    'mozorg/contribute/signup.lang' => [
        'deadline' => '2016-06-06',
        'flags'    => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $getinvolved_locales,
    ],
    'mozorg/contribute/stories.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $getinvolved_locales,
    ],
    'mozorg/home/index.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/home/index-2016.lang' => [
        'deadline'            => '2017-02-20',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/internet-health.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => [
            'af', 'cy', 'de', 'es-ES', 'fr', 'kab', 'ko', 'pl', 'pt-BR', 'sq',
            'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/privacy-security.lang' => [
        'deadline' => '2017-01-28',
        'flags'    => [
            'opt-in' => ['all'],
        ],
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => [
            'af', 'de', 'es-ES', 'fr', 'kab', 'ko', 'pt-BR', 'sq', 'sv-SE',
            'zh-TW',
        ],
    ],
    'mozorg/mission.lang' => [
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/newsletters.lang' => [
        'deadline'            => '2017-02-03',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $newsletter_locales,
    ],
    'mozorg/plugincheck-redesign.lang' => [
        'deadline'            => '2016-08-01',
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/products.lang' => [
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/technology.lang' => [
        'deadline'            => '2016-11-30',
        'priorities'          => [
            2 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'newsletter.lang' => [
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'privacy/index.lang' => [
        'priorities'          => [
            1 => ['all'],
        ],
        'supported_locales' => array_diff($legal_locales, ['et']),
    ],
    'privacy/principles.lang' => [
        'priorities'          => [
            2 => ['all'],
        ],
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

$firefoxhealthreport_lang = [
    'fhr.lang' => [
        'supported_locales' => array_diff($firefox_desktop_android, $mozorg_locales),
    ],
];

$engagement_lang = [
    'ads/ios_ads_nov2015.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
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
    'snippets/2014/jan2014.lang' => [
        'supported_locales' => [
            'cs', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'hu', 'id', 'it',
            'ja', 'ko', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr',
            'sv-SE', 'tr', 'zh-CN', 'zh-TW',
        ],
    ],
    'snippets/2014/apr2014.lang' => [
        'supported_locales' => [
            'cs', 'da', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'hu', 'id',
            'it', 'ja', 'ko', 'nb-NO', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk',
            'sl', 'sq', 'sr', 'sv-SE', 'zh-CN', 'zh-TW',
        ],
    ],
    'snippets/2014/may2014.lang' => [
        'supported_locales' => [
            'cs', 'da', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'hu', 'id',
            'it', 'ja', 'ko', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq',
            'sr', 'sv-SE', 'tr', 'zh-CN', 'zh-TW',
        ],
    ],
    'snippets/2014/jun2014.lang' => [
        'supported_locales' => [
            'de', 'el', 'es-ES', 'fr', 'hi-IN', 'hu', 'id', 'it', 'nl', 'pl',
            'pt-BR', 'sr',
        ],
    ],
    'snippets/2014/aug2014_a.lang' => [
        'supported_locales' => ['es-ES'],
    ],
    'snippets/2014/aug2014_b.lang' => [
        'supported_locales' => ['cs'],
    ],
    'snippets/2014/aug2014_c.lang' => [
        'supported_locales' => [
            'de', 'fr', 'pl', 'nl', 'sl', 'sq', 'zh-TW',
        ],
    ],
    'snippets/2014/aug2014_d.lang' => [
        'supported_locales' => [
            'el', 'es-MX', 'it', 'ja', 'pt-BR', 'ru', 'tr', 'sv-SE', 'sr',
        ],
    ],
    'snippets/2014/sep2014_a.lang' => [
        'supported_locales' => [
            'cs', 'de', 'es-ES', 'fr', 'it', 'pl',
        ],
    ],
    'snippets/2014/sep2014_b.lang' => [
        'supported_locales' => [
            'id', 'ja', 'ko', 'nb-NO', 'nl', 'ru', 'zh-CN',
        ],
    ],
    'snippets/2014/sep2014_c.lang' => [
        'supported_locales' => ['el', 'hi-IN', 'hu'],
    ],
    'snippets/2014/sep2014_d.lang' => [
        'supported_locales' => ['pt-BR'],
    ],
    'snippets/2014/sep2014_e.lang' => [
        'supported_locales' => ['sq'],
    ],
    'snippets/2014/nov2014_a.lang' => [
        'supported_locales' => [
            'da', 'es-MX', 'fy-NL', 'ko', 'nb-NO', 'nn-NO', 'pa-IN', 'rm', 'sk',
            'sl', 'zh-TW',
        ],
    ],
    'snippets/2014/nov2014_b.lang' => [
        'supported_locales' => ['ja'],
    ],
    'snippets/2014/nov2014_c.lang' => [
        'supported_locales' => ['es-ES', 'hu'],
    ],
    'snippets/2014/nov2014_d.lang' => [
        'supported_locales' => [
            'de', 'fr', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2014/nov2014_e.lang' => [
        'supported_locales' => ['el', 'hi-IN', 'sr'],
    ],
    'snippets/2014/dec2014_a.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2014/dec2014_c.lang' => [
        'supported_locales' => ['sr'],
    ],
    'snippets/2015/jan2015a_b.lang' => [
        'supported_locales' => ['el', 'hi-IN', 'hu', 'sr'],
    ],
    'snippets/2015/jan2015a_c.lang' => [
        'supported_locales' => ['de', 'es-ES', 'pt-BR'],
    ],
    'snippets/2015/jan2015a_d.lang' => [
        'supported_locales' => ['fr', 'pl'],
    ],
    'snippets/2015/jan2015b_a.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2015/jan2015b_b.lang' => [
        'supported_locales' => [
            'el', 'hu', 'it', 'ja', 'nl',
        ],
    ],
    'snippets/2015/feb2015_a.lang' => [
        'supported_locales' => ['de', 'es-ES', 'pt-BR', 'ru'],
    ],
    'snippets/2015/feb2015_b.lang' => [
        'supported_locales' => ['fr'],
    ],
    'snippets/2015/feb2015_c.lang' => [
        'supported_locales' => ['id', 'it', 'ja', 'nl'],
    ],
    'snippets/2015/feb2015_d.lang' => [
        'supported_locales' => ['el', 'hu', 'sr'],
    ],
    'snippets/2015/feb2015_e.lang' => [
        'supported_locales' => ['pl'],
    ],
    'snippets/2015/mar2015_a.lang' => [
        'supported_locales' => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2015/mar2015_b.lang' => [
        'supported_locales' => ['el', 'hu', 'id', 'it', 'ja', 'nl', 'pl'],
    ],
    'snippets/2015/apr2015.lang' => [
        'supported_locales' => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2015/may2015_a.lang' => [
        'supported_locales' => ['de', 'fr', 'ru'],
    ],
    'snippets/2015/may2015_b.lang' => [
        'supported_locales' => ['es-ES', 'pt-BR'],
    ],
    'snippets/2015/spring2015.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2015/jun2015_a.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'snippets/2015/jun2015_b.lang' => [
        'supported_locales' => ['ja'],
    ],
    'snippets/2015/jun2015_c.lang' => [
        'supported_locales' => ['ru'],
    ],
    'snippets/2015/jun2015_d.lang' => [
        'supported_locales' => ['es', 'pt-BR'],
    ],
    'snippets/2015/jul2015_a.lang' => [
        'supported_locales' => ['de', 'fr', 'pt-BR'],
    ],
    'snippets/2015/jul2015_b.lang' => [
        'supported_locales' => ['es', 'ru'],
    ],
    'snippets/2015/jul2015_c.lang' => [
        'supported_locales' => ['ar'],
    ],
    'snippets/2015/aug2015_a.lang' => [
        'supported_locales' => ['de', 'fr', 'ru'],
    ],
    'snippets/2015/aug2015_b.lang' => [
        'supported_locales' => ['es', 'pt-BR'],
    ],
    'snippets/2015/aug2015_c.lang' => [
        'supported_locales' => ['el', 'id', 'pl'],
    ],
    'snippets/2015/aug2015_win10.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2015/sep2015.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2015/sep2015_ios.lang' => [
        'supported_locales' => ['de'],
    ],
    'snippets/2015/oct2015_a.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2015/oct2015_b.lang' => [
        'supported_locales' => ['hu', 'ro'],
    ],
    'snippets/2015/oct2015_c.lang' => [
        'supported_locales' => ['it', 'pl'],
    ],
    'snippets/2015/oct2015_mofo.lang' => [
        'supported_locales' => ['de'],
    ],
    'snippets/2015/fall2015.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2015/nov2015_eoy_mofo.lang' => [
        'supported_locales' => [
            'es', 'fr', 'id', 'it', 'pt-BR',
        ],
    ],
    'snippets/2015/nov2015_a.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2015/nov2015_b.lang' => [
        'supported_locales' => ['id', 'it', 'pl'],
    ],
    'snippets/2015/dec2015_a.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2015/dec2015_b.lang' => [
        'supported_locales' => ['id'],
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
    'social/2016/fundraising.lang' => [
        'supported_locales' => [
            'de', 'en-GB', 'es', 'fr', 'it', 'nl', 'pt-BR',
        ],
    ],
    'emails/2017/copyright_stories.lang' => [
        'deadline'          => '2017-03-09',
        'supported_locales' => ['de', 'fr'],
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
            'bg', 'cs', 'de', 'es', 'fr', 'it', 'nl', 'pl', 'sl',
        ],
    ],
    'surveys/survey_eoy_heartbeat.lang' => [
        'supported_locales' => ['de'],
    ],
    'tiles/careers.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'tiles/suggestedtiles_infographic.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'tiles/2015/tiles_jul2015.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'tiles/2015/tiles_aug2015.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'tiles/2015/tiles_sep2015.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'tiles/2015/tiles_oct2015.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'tiles/2015/tiles_nov2015.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'tiles/2016/tiles_jan2016.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
];

$appstores_lang = [
    'focus_ios/description_release.lang' => [
        'supported_locales' => $focus_ios_store,
    ],
    'focus_ios/screenshots_v2_1.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru', 'zh-CN',
        ],
    ],
    'focus_ios/whatsnew/focus_2_1.lang' => [
        'supported_locales' => $focus_ios_store,
    ],
    'fx_android/description_beta.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/description_release.lang' => [
        'deadline'          => '2016-04-30',
        'supported_locales' => array_merge($fx_android_store, ['ar']),
    ],
    'fx_android/whatsnew/android_44.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => ['fr', 'ja', 'zh-TW'],
    ],
    'fx_android/whatsnew/android_45.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => array_merge($fx_android_store, ['ar']),
    ],
    'fx_android/whatsnew/android_46_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_46.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => array_merge($fx_android_store, ['ar']),
    ],
    'fx_android/whatsnew/android_47_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_47.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => array_merge($fx_android_store, ['ar']),
    ],
    'fx_android/whatsnew/android_48_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_48.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => array_merge($fx_android_store, ['ar']),
    ],
    'fx_android/whatsnew/android_49_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_49.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => array_merge($fx_android_store, ['ar']),
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
        'supported_locales' => array_merge($fx_android_store, ['ar']),
    ],
    'fx_android/whatsnew/android_51_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_51.lang' => [
        'supported_locales' => array_merge($fx_android_store, ['ar']),
    ],
    'fx_android/whatsnew/android_52_beta.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_52.lang' => [
        'deadline'          => '2017-03-07',
        'supported_locales' => array_merge($fx_android_store, ['ar']),
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
    'fx_ios/whatsnew/ios_2_1.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/whatsnew/ios_4_0.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/whatsnew/ios_5_0.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/whatsnew/ios_6_0.lang' => [
        'deadline'          => '2017-01-06',
        'supported_locales' => $fx_ios_store,
    ],
];
