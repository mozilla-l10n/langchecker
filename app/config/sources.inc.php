<?php

$no_active_tag = [
    'download_button.lang',
    'firefox/shared.lang',
    'main.lang',
    'mozorg/internet-health/shared.lang',
    'navigation.lang',
    'newsletter.lang',
];

$legal_locales = [
    'af', 'ar', 'bg', 'bn', 'ca', 'cs', 'de', 'el', 'es-AR',
    'es-CL', 'es-ES', 'es-MX', 'et', 'fa', 'ff', 'fr', 'fy-NL', 'hi-IN', 'hr',
    'hu', 'id', 'it', 'ja', 'ko', 'mk', 'my', 'nl', 'pl', 'pt-BR', 'ro', 'ru',
    'son', 'sq', 'sr', 'sv-SE', 'ta', 'tl', 'xh', 'zh-CN', 'zh-TW', 'zu',
];

$getinvolved_locales = [
    'af', 'am', 'ar', 'az', 'azz', 'bg', 'bn', 'bs', 'cak', 'crh', 'cs',
    'cy', 'de', 'dsb', 'el', 'en-CA', 'en-GB', 'es-AR', 'es-CL', 'es-ES',
    'es-MX', 'fa', 'fr', 'fy-NL', 'he', 'hi-IN', 'hr', 'hsb', 'ia', 'id', 'it',
    'kab', 'ko', 'lt', 'ms', 'nl', 'nn-NO', 'nv', 'pai', 'pl', 'pt-BR', 'pt-PT',
    'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'sw', 'ta', 'tr', 'uk',
    'xh', 'zam', 'zh-CN', 'zh-TW',
];

// List of locales supported for the landing page (larger than the App Store)
$ios_landing_page = array_unique(array_merge(
    $ios_locales,
    [
        'af', 'an', 'ar', 'bn', 'bs', 'ca', 'cak', 'el',  'en-CA',
        'es-AR', 'eu', 'fa', 'fy-NL', 'gl', 'gn', 'he', 'hi-IN', 'ka', 'kab',
        'kn', 'lij', 'ml', 'ms', 'my', 'or', 'sq', 'sr', 'ta', 'ur', 'xh',
    ]
));

// List of locales supported for the landing page
$android_landing_page = array_unique(array_merge(
    $fx_android_locales,
    [
        'af', 'ast', 'bg', 'bn', 'bs', 'fa', 'kab',
    ]
));

$engagement_locales = [
    'ar', 'bg', 'cs', 'cy', 'da', 'de', 'el', 'en-CA', 'en-GB', 'es', 'es-ES',
    'es-MX', 'fa', 'fr', 'fy-NL', 'he', 'hi-IN', 'hu', 'id', 'it', 'ja', 'ko',
    'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'rm', 'ro', 'ru', 'sk',
    'sl', 'sq', 'sr', 'sv-SE', 'sw', 'tr', 'ur', 'zh-CN', 'zh-HK', 'zh-TW',
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
        'deadline'          => '2018-09-09',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/accounts.lang' => [
        'supported_locales' => $mozillaorg,
    ],
    'firefox/accounts-2018.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
   'firefox/accounts-2019.lang' => [
        'deadline'          => '2019-06-04',
        'priority'          => 1,
        'supported_locales' => [
            'en-CA', 'en-GB', 'fr', 'de',
        ],
    ],
    'firefox/all.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/campaign.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/channel/index.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg, // Has Firefox for Android download buttons
    ],
    'firefox/facebookcontainer/index.lang' => [
        'deadline'          => '2018-04-26',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
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
    'firefox/hub/home-quantum.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/installer-help.lang' => [
        'priority'          => 2,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/mobile.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/new/quantum.lang' => [
        'deadline'          => '2018-09-23',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/new/reggiewatts.lang' => [
        'priority'          => 1,
        'supported_locales' => ['de'],
    ],
    'firefox/new/trailhead.lang' => [
        'deadline'          => '2019-06-04',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
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
            'bn', 'bs', 'cak', 'cs', 'cy', 'de', 'dsb', 'en-CA', 'en-GB', 'eo',
            'es-CL', 'es-ES', 'fr', 'fy-NL', 'ga-IE', 'gl', 'hi-IN', 'hsb',
            'ia', 'ja', 'kab', 'kk', 'ko', 'nl', 'nn-NO', 'pl', 'pt-PT',
            'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/products/developer-quantum.lang' => [
        'deadline'          => '2018-10-29',
        'supported_locales' => $firefox_locales,
    ],
    'firefox/profile-per-install.lang' => [
        'deadline'          => '2018-10-05',
        'supported_locales' => $firefox_locales,
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
    'firefox/switch.lang' => [
        'priority' => [
            1 => ['de'],
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/tracking-protection-tour.lang' => [
        'priority'          => 1,
        'deadline'          => '2019-01-28',
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_57.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => array_diff(
            $firefox_locales,
            [
                'de', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fr', 'id',
                'pl', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
            ]),
    ],
    'firefox/whatsnew_59.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_61.lang' => [
        'deadline'          => '2018-06-15',
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_63.lang' => [
        'deadline'          => '2018-09-28',
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_66.lang' => [
        'deadline'          => '2019-03-06',
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_67.lang' => [
        'deadline'          => '2019-05-03',
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'foundation/advocacy.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-CA', 'en-GB', 'fr', 'ia', 'kab',
            'ko', 'pt-BR', 'ro', 'sk', 'sq',
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
            'bs', 'cak', 'cy', 'cs', 'de', 'en-CA', 'en-GB', 'es-ES', 'fr',
            'ia', 'kab', 'ko', 'pl', 'pt-BR', 'ro', 'sk', 'sq', 'zh-TW',
        ],
    ],
    'foundation/issues.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-CA', 'en-GB', 'fr', 'ia', 'kab',
            'ko', 'pt-BR', 'ro', 'sk', 'sq',
        ],
    ],
    'foundation/leadership-network.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'bs', 'cak', 'cy', 'cs', 'de', 'en-CA', 'en-GB', 'fr', 'ia', 'kab',
            'ko', 'pt-BR', 'ro', 'sk', 'sq',
        ],
    ],
    'legal/index.lang' => [
        'priority'          => 1,
        'supported_locales' => $legal_locales,
    ],
    'main.lang' => [
        'deadline'          => '2018-12-12',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/404.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/500.lang' => [
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about-2019.lang' => [
        'priority'          => 3,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about/governance/policies/participation.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'hi-IN', 'ja', 'pt-BR', 'zh-TW',
        ],
    ],
    'mozorg/about/governance/policies/reporting.lang' => [
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
            'af', 'am', 'azz', 'bn', 'bs', 'ca', 'cak', 'crh', 'cs', 'cy',
            'de', 'dsb', 'en-CA', 'en-GB', 'es-CL', 'es-MX', 'eu', 'fa', 'fr',
            'gl', 'hi-IN', 'hsb', 'ia', 'it', 'ja', 'kab', 'km', 'ko', 'lt',
            'lv', 'nl', 'nn-NO', 'nv', 'pa-IN', 'pai', 'pt-BR', 'pt-PT', 'ro',
            'ru', 'sk', 'son', 'sq', 'sv-SE', 'sw', 'uk', 'uz', 'zam', 'zh-CN',
            'zh-TW',
        ],
    ],
    'mozorg/about/history.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'priority'          => 2,
        'supported_locales' => [
            'af', 'am', 'ar', 'azz', 'bg', 'bn', 'bs', 'ca', 'cak', 'crh',
            'cs', 'cy', 'de', 'dsb', 'el', 'en-CA', 'en-GB', 'es-AR', 'es-CL',
            'es-ES', 'es-MX', 'eu', 'fa', 'fr', 'fy-NL', 'gl', 'hi-IN', 'hr',
            'hsb', 'ia', 'id', 'it', 'ja', 'kab', 'km', 'ko', 'lt', 'ms', 'nl',
            'nn-NO', 'nv', 'pa-IN', 'pai', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru',
            'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'sw', 'ta', 'tr', 'uk',
            'uz', 'zam', 'zh-CN', 'zh-TW',
        ],
    ],
    'mozorg/about/manifesto.lang' => [
        'priority'          => 3,
        'deadline'          => '2018-04-26',
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/browser-history.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'de', 'en-CA', 'en-GB', 'fr',
        ],
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
    'mozorg/home/index-quantum.lang' => [
        'deadline'          => '2017-11-30',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/internet-health/decentralization.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-CA', 'en-GB', 'es-CL',
            'es-ES', 'es-MX', 'fr', 'ia', 'id', 'it', 'kab', 'ko', 'nn-NO','pt-BR',
            'ro', 'sk', 'sl', 'sq', 'sv-SE', 'uk',
        ],
    ],
    'mozorg/internet-health/digital-inclusion.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-CA', 'en-GB', 'es-CL',
            'es-ES', 'es-MX', 'fr', 'ia', 'id', 'it', 'kab', 'ko', 'nn-NO', 'pt-BR',
            'ro', 'sk', 'sl', 'sq', 'sv-SE', 'uk',
        ],
    ],
    'mozorg/internet-health/index.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-CA', 'en-GB', 'es-CL',
            'es-ES', 'es-MX', 'fa', 'fr', 'hi-IN', 'ia', 'id', 'it', 'kab', 'ko',
            'nn-NO', 'pl', 'pt-BR', 'ro', 'sk', 'sl', 'sq', 'sv-SE', 'uk',
            'zh-TW', 'uk',
        ],
    ],
    'mozorg/internet-health/open-innovation.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-CA', 'en-GB', 'es-CL',
            'es-ES', 'es-MX', 'fr', 'ia', 'id', 'it', 'kab', 'ko', 'nn-NO', 'pt-BR',
            'ro', 'sk', 'sl', 'sq', 'sv-SE', 'uk',
        ],
    ],
    'mozorg/internet-health/privacy-security.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-CA', 'en-GB', 'es-CL',
            'es-ES', 'es-MX', 'fa', 'fr', 'ia', 'id', 'it', 'kab', 'ko', 'nn-NO',
            'pt-BR', 'ro', 'sk', 'sl', 'sq', 'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/shared.lang' => [
        'supported_locales' => [
            'af', 'bs', 'cak', 'cs', 'cy', 'de', 'en-CA', 'en-GB', 'es-CL',
            'es-ES', 'es-MX', 'fa', 'fr', 'hi-IN', 'ia', 'id', 'it', 'kab', 'ko',
            'nn-NO', 'pl', 'pt-BR', 'sk', 'sl', 'sq', 'sv-SE', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/internet-health/web-literacy.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'af', 'cak', 'cs', 'cy', 'de', 'en-CA', 'en-GB', 'es-CL', 'es-ES',
            'es-MX', 'fr', 'ia', 'id', 'it', 'kab', 'ko', 'nn-NO', 'pt-BR',
            'ro', 'sk', 'sl', 'sq', 'sv-SE', 'uk',
        ],
    ],
    'mozorg/mission.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/moss/index.lang' => [
        'deadline'          => '2018-07-15',
        'priority'          => 1,
        'supported_locales' => ['hi-IN'],
    ],
    'mozorg/moss/mission-partners-india.lang' => [
        'deadline'          => '2017-07-30',
        'priority'          => 1,
        'supported_locales' => ['hi-IN'],
    ],
    'mozorg/newsletters.lang' => [
        'deadline'          => '2018-09-09',
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
    'mozorg/what-is-a-browser.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'de', 'en-CA', 'en-GB', 'fr',
        ],
    ],
    'newsletter/opt-out-confirmation.lang' => [
        'deadline'          => '2018-12-13',
        'priority'          => 1,
        'supported_locales' => ['de','es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru'],
    ],
    'navigation.lang' => [
        'deadline'          => '2019-02-04',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'newsletter.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'privacy/faq.lang' => [
        'priority'          => 2,
        'deadline'          => '2018-07-30',
        'supported_locales' => $mozillaorg,
    ],
    'privacy/index.lang' => [
        'priority'          => 1,
        'deadline'          => '2019-03-06',
        'supported_locales' => $mozillaorg,
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
];

// Default priority is 1
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
    'emails/2017/buyers_guide_2.lang' => [
        'supported_locales' => ['es'],
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
        'deadline'          => '2018-06-13',
        'supported_locales' => [
            'de', 'fr', 'it', 'pl',
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
    'emails/2017/fundraising_email_2.lang' => [
        'deadline'          => '2017-12-10',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_4_a.lang' => [
        'deadline'          => '2017-12-24',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_4_b.lang' => [
        'deadline'          => '2017-12-24',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_mitchell.lang' => [
        'priority'          => 4,
        'supported_locales' => ['de', 'fr', 'pt-BR'],
    ],
    'emails/2017/fundraising_moco.lang' => [
        'supported_locales' => ['de'],
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
    'emails/2018/cambridge_analytica.lang' => [
        'deadline'          => '2018-03-22',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/clear_history.lang' => [
        'deadline'          => '2018-05-13',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/cloudpets.lang' => [
        'deadline'          => '2018-06-04',
        'supported_locales' => ['de'],
    ],
    'emails/2018/copyright_sept_vote.lang' => [
        'deadline'          => '2018-08-31',
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'emails/2018/copyright_sept_vote_v2.lang' => [
        'deadline'          => '2018-09-03',
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'emails/2018/copyright_stage_2.lang' => [
        'deadline'          => '2018-07-01',
        'supported_locales' => [
            'de', 'fr', 'it',
        ],
    ],
    'emails/2018/copyright_win.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/cross_site_tracking_petition.lang' => [
        'deadline'          => '2018-04-08',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/cross_site_tracking_petition_kicker.lang' => [
        'deadline'          => '2018-04-19',
        'supported_locales' => ['es', 'pt-BR'],
    ],
    'emails/2018/donor_mid_year_update.lang' => [
        'deadline'          => '2018-07-23',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/donor_survey_march.lang' => [
        'deadline'          => '2018-03-11',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/donor_update_feb.lang' => [
        'deadline'          => '2018-02-18',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/facebook_2fa.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/firefox_account_welcome_journey.lang' => [
        'deadline'          => '2018-10-28',
        'supported_locales' => ['es', 'fr', 'id', 'pl', 'pt-BR', 'ru'],
    ],
    'emails/2018/firefox_learning_journey.lang' => [
        'deadline'          => '2018-06-03',
        'supported_locales' => ['es', 'fr', 'id', 'pl', 'pt-BR', 'ru'],
    ],
    'emails/2018/fundraising_giving_tuesday.lang' => [
        'deadline'          => '2018-11-26',
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_july.lang' => [
        'deadline'          => '2018-07-26',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_may.lang' => [
        'deadline'          => '2018-06-07',
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_misinfo.lang' => [
        'deadline'          => '2018-12-12',
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_mitchell.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_oct.lang' => [
        'deadline'          => '2018-10-25',
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/fundraising_sept.lang' => [
        'deadline'          => '2018-10-08',
        'supported_locales' => ['de', 'fr', 'pl'],
    ],
    'emails/2018/fundraising_surman.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_thank_you.lang' => [
        'deadline'          => '2018-01-14',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_valentines_day.lang' => [
        'deadline'          => '2018-02-12',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/ihr_launch.lang' => [
        'deadline'          => '2018-04-08',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/jan_mobile_app_updates.lang' => [
        'deadline'          => '2018-02-06',
        'supported_locales' => ['es', 'pl', 'pt-BR', 'ru'],
    ],
    'emails/2018/jan_mobile_app_updates_fr.lang' => [
        'deadline'          => '2018-02-06',
        'supported_locales' => ['fr'],
    ],
    'emails/2018/jan_mobile_app_updates_id.lang' => [
        'deadline'          => '2018-02-06',
        'supported_locales' => ['id'],
    ],
    'emails/2018/zuckerberg_eu.lang' => [
        'deadline'          => '2018-04-19',
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/zuckerberg_eu_hearing.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/ad_API.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/apple_privacy.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/donation_receipt.lang' => [
        'supported_locales' => [
            'cs', 'da', 'de', 'es', 'fr', 'it', 'ja', 'nb-NO', 'nl', 'pl',
            'pt-BR', 'sv-SE', 'ru',
        ],
    ],
    'emails/2019/fb_open_letter.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fb_open_letter_response.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/guardian_reportback.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/misinfo_survey.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/misinfo_survey_global.lang' => [
        'priority'          => 3,
        'deadline'          => '2019-03-25',
        'supported_locales' => ['pt-BR'],
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
        'priority'          => 3,
        'supported_locales' => [
            'de', 'es', 'fr', 'hi-IN', 'it', 'pt-BR', 'sw', 'zh-TW',
        ],
    ],
    'other/2018/cambridge_analytica_petition.lang' => [
        'deadline'          => '2018-03-22',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'other/2018/cloudpets_petition.lang' => [
        'deadline'          => '2018-06-04',
        'supported_locales' => ['de'],
    ],
    'other/2018/copyright_postcards.lang' => [
        'deadline'          => '2018-08-31',
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'other/2018/cross_site_tracking_petition.lang' => [
        'deadline'          => '2018-04-08',
        'supported_locales' => ['cy', 'de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'other/2018/facebook_2fa_petition.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'other/2018/mozfest.lang' => [
        'priority'          => 3,
        'supported_locales' => ['de', 'fr', 'it', 'pt-BR', 'sw'],
    ],
    'other/2018/mozfest_tickets.lang' => [
        'priority'          => 3,
        'supported_locales' => ['de', 'fr', 'it', 'pt-BR'],
    ],
    'other/2018/wagtail_forms.lang' => [
        'supported_locales' => [
            'de', 'fr', 'es', 'pl', 'pt-BR',
        ],
    ],
    'other/2018/zuckerberg_eu_hearing_petition.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2018/zuckerberg_eu_petition.lang' => [
        'deadline'          => '2018-04-19',
        'supported_locales' => ['cy', 'de', 'es', 'fr', 'pl'],
    ],
    'other/2019/apple_privacy_petition.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2019/misinfo_site.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'other/2019/the_guardian_video.lang' => [
        'supported_locales' => ['de', 'fr'],
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
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/apr2017_b.lang' => [
        'deadline'          => '2017-03-31',
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2017/may2017.lang' => [
        'deadline'          => '2017-04-19',
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'pt-BR', 'ru', 'zh-TW',
        ],
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
    'snippets/2018/jan2018.lang' => [
        'deadline'          => '2018-02-01',
        'supported_locales' => [
          'cs', 'de', 'es', 'fr', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2018/apr2018.lang' => [
        'deadline'          => '2018-04-09',
        'supported_locales' => [
          'de', 'es', 'fr', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2018/apr2018_b.lang' => [
        'deadline'          => '2018-04-09',
        'supported_locales' => ['id'],
    ],
    'snippets/2018/apr2018_mofo.lang' => [
        'deadline'          => '2018-07-07',
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'snippets/2018/may2018.lang' => [
        'deadline'          => '2018-05-24',
        'supported_locales' => ['es', 'fr', 'pl', 'pt-BR', 'ru'],
    ],
    'snippets/2018/may2018_b.lang' => [
        'deadline'          => '2018-05-24',
        'supported_locales' => ['de'],
    ],
    'snippets/2018/may2018_c.lang' => [
        'deadline'          => '2018-05-24',
        'supported_locales' => ['id', 'zh-TW'],
    ],
    'snippets/2018/Firefox100-part1.lang' => [
        'deadline'          => '2018-07-11',
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2018/Firefox100-part2.lang' => [
        'deadline'          => '2018-07-25',
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2018/Firefox100-part3.lang' => [
        'deadline'          => '2018-08-08',
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2018/Firefox100-part4.lang' => [
        'deadline'          => '2018-08-22',
        'supported_locales' => [
            'de', 'es', 'fr', 'id', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'snippets/2018/fundraising.lang' => [
        'deadline'          => '2018-06-04',
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2018/fundraising_sept.lang' => [
        'supported_locales' => [
            'de', 'fr', 'it', 'pl', 'pt-BR', 'ru',
        ],
    ],
    'snippets/2018/fundraising_nov.lang' => [
        'deadline'          => '2018-12-03',
        'supported_locales' => [
            'de', 'fr', 'pl', 'pt-BR',
        ],
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
    'surveys/donor_survey_2018.lang' => [
        'deadline'          => '2018-03-11',
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'surveys/data_privacy_day.lang' => [
        'deadline'          => '2017-01-27',
        'supported_locales' => ['de', 'fr'],
    ],
    'surveys/iot_survey.lang' => [
        'deadline'          => '2017-08-06',
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pt-BR'],
    ],
    'surveys/misinfo.lang' => [
        'priority'          => 3,
        'deadline'          => '2019-03-25',
        'supported_locales' => ['de', 'fr', 'pt-BR'],
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
    'fx_android/whatsnew/android_59.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_60.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_61.lang' => [
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_62.lang' => [
        'deadline'          => '2018-09-05',
        'supported_locales' => $fx_android_store,
    ],
    'fx_android/whatsnew/android_63.lang' => [
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
    'fx_ios/whatsnew/ios_13.lang' => [
        'flags' => [
            'obsolete' => ['all'],
        ],
        'supported_locales' => $fx_ios_store,
    ],
    'fx_ios/whatsnew/ios_14.lang' => [
        'deadline'          => '2018-10-08',
        'supported_locales' => $fx_ios_store,
    ],
];
