<?php

$no_active_tag = [
    'firefox/shared.lang',
    'firefox/compare/shared.lang',
    'main.lang',
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

$engagement_locales = [
    'bg', 'cs', 'cy', 'da', 'de', 'en-GB', 'es-ES', 'es', 'fr', 'hi-IN', 'id',
    'it', 'ja', 'nl', 'pl', 'pt-BR', 'ru', 'sl', 'sv-SE', 'sw', 'zh-TW',
];

$participation_locales = [
    'ar', 'de', 'es-ES', 'fr', 'hi-IN', 'id', 'it', 'ja', 'nl', 'pl', 'pt-BR',
    'ru', 'zh-CN', 'zh-TW',
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
   'firefox/accounts-2019.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/adblocker.lang' => [
        'supported_locales' => $mozillaorg,
    ],
    'firefox/all-unified.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/best-browser.lang' => [
        'supported_locales' => $mozillaorg,
    ],
    'firefox/browsers.lang' => [
        'deadline'          => '2020-03-31',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/campaign.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/campaign-trailhead.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/channel/index.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg, // Has Firefox for Android download buttons
    ],
    'firefox/compare.lang' => [
        'priority' => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/compare/chrome.lang' => [
        'priority' => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/compare/edge.lang' => [
        'priority' => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/compare/ie.lang' => [
        'priority' => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/compare/opera.lang' => [
        'priority' => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/compare/safari.lang' => [
        'priority' => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/compare/shared.lang' => [
        'priority' => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $mozillaorg,
    ],
    'firefox/enterprise/index.lang' => [
        'deadline'          => '2020-04-30',
        'priority'          => [
            1 => $key_market_locales,
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
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
    'firefox/home-master.lang' => [
        'deadline'          => '2019-11-25',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/installer-help.lang' => [
        'priority'          => 2,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/mobile-2019.lang' => [
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/new/quantum.lang' => [
        'deadline'          => '2018-09-23',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
    ],
    'firefox/new/trailhead.lang' => [
        'deadline'          => '2019-06-04',
        'priority'          => 1,
        'supported_locales' => $firefox_desktop_android,
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
            'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'ga-IE', 'gl', 'hi-IN',
             'hsb', 'ia', 'ja', 'kab', 'kk', 'ko', 'nl', 'nn-NO', 'pl', 'pt-PT',
            'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/privacy-hub.lang' => [
        'deadline'          => '2019-10-20',
        'priority'          => 1,
        'supported_locales' => $key_market_locales,
    ],
    'firefox/products.lang' => [
        'deadline'          => '2020-03-31',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/products/developer-quantum.lang' => [
        'deadline'          => '2018-10-29',
        'supported_locales' => $firefox_locales,
    ],
    'firefox/products/lockwise.lang' => [
        'deadline'          => '2019-10-20',
        'priority'          => 1,
        'supported_locales' => [
            'de', 'en-CA', 'en-GB', 'es-ES', 'fr', 'it',
        ],
    ],
    'firefox/retention/thank-you.lang' => [
        'priority'          => 1,
        'deadline'          => '2017-09-15',
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru', 'zh-TW',
        ],
    ],
    'firefox/set-default-thanks.lang' => [
        'deadline'          => '2020-02-04',
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/shared.lang' => [
        'deadline'          => '2017-08-15',
        'priority'          => 1,
        'supported_locales' => $mozillaorg,
    ],
    'firefox/welcome/page1.lang' => [
        'priority'          => 1,
        'deadline'          => '2019-09-30',
        'supported_locales' => $key_market_locales,
    ],
    'firefox/welcome/page2.lang' => [
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'deadline'          => '2019-11-25',
        'supported_locales' => [
            'en-CA', 'en-GB', 'de', 'fr', 'it', 'ja', 'ko', 'nl', 'pl',
            'pt-BR', 'pt-PT', 'ru', 'zh-CN', 'zh-TW',
        ],
    ],
    'firefox/welcome/page3.lang' => [
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
        ],
        'deadline'          => '2019-11-20',
        'supported_locales' => $mozillaorg,
    ],
    'firefox/welcome/page4.lang' => [
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
        ],
        'deadline'          => '2019-12-11',
        'supported_locales' => $mozillaorg,
    ],
    'firefox/welcome/page5.lang' => [
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
        ],
        'deadline'          => '2020-01-20',
        'supported_locales' => $mozillaorg,
    ],
    'firefox/welcome/page6.lang' => [
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
        ],
        'deadline'          => '2020-04-20',
        'supported_locales' => $mozillaorg,
    ],
    'firefox/welcome/page7.lang' => [
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
        ],
        'deadline'          => '2020-04-20',
        'supported_locales' => $mozillaorg,
    ],
    'firefox/whatsnew.lang' => [
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_70.lang' => [
        'deadline'          => '2019-10-11',
        'priority'          => 1,
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_71.lang' => [
        'deadline'          => '2019-12-03',
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_73.lang' => [
        'deadline'          => '2020-02-04',
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_74.lang' => [
        'deadline'          => '2020-03-05',
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_75.lang' => [
        'deadline'          => '2020-03-31',
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_76.lang' => [
        'deadline'          => '2020-04-24',
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/whatsnew_77.lang' => [
        'deadline'          => '2020-05-22',
        'priority'          => [
            1 => ['de', 'fr', 'en-GB', 'en-CA'],
            3 => ['all'],
        ],
        'supported_locales' => $firefox_locales,
    ],
    'firefox/windows-64-bit.lang' => [
        'priority'          => 3,
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
    'mozorg/about-2019.lang' => [
        'priority'          => 3,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/about/governance/policies/community-hotline.lang' => [
        'supported_locales' => $participation_locales,
    ],
    'mozorg/about/governance/policies/participation.lang' => [
        'supported_locales' => $participation_locales,
    ],
    'mozorg/about/governance/policies/reporting.lang' => [
        'supported_locales' => $participation_locales,
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
            'cs', 'cy', 'de', 'en-CA', 'en-GB', 'fr', 'kab', 'uk', 'zh-TW',
        ],
    ],
    'mozorg/contribute/index.lang' => [
        'flags' => [
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
    'mozorg/newsletters.lang' => [
        'deadline'          => '2018-09-09',
        'priority'          => 2,
        'supported_locales' => $newsletter_locales,
    ],
    'mozorg/products.lang' => [
        'priority'          => 2,
        'supported_locales' => $mozillaorg,
    ],
    'mozorg/what-is-a-browser.lang' => [
        'flags' => [
            'opt-in' => ['all'],
        ],
        'supported_locales' => [
            'cs', 'cy', 'de', 'en-CA', 'en-GB', 'fr', 'kab', 'uk',
        ],
    ],
    'newsletter/opt-out-confirmation.lang' => [
        'deadline'          => '2018-12-13',
        'priority'          => 1,
        'supported_locales' => ['de','es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru'],
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
];

// Default priority is 1
$engagement_lang = [
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
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/buyers_guide_2.lang' => [
        'supported_locales' => ['es'],
    ],
    'emails/2017/copyright_call.lang' => [
        'supported_locales' => ['de', 'fr', 'es', 'pl'],
    ],
    'emails/2017/copyright_call_IMCO.lang' => [
        'supported_locales' => ['de'],
    ],
    'emails/2017/copyright.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/copyright_sept.lang' => [
        'supported_locales' => [
            'de', 'fr', 'it', 'pl',
        ],
    ],
    'emails/2017/copyright_summer.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2017/data_privacy_day.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/fundraising_email_1.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_2.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_4_a.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_4_b.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_mitchell.lang' => [
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
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/iot_results_a.lang' => [
        'supported_locales' => ['es'],
    ],
    'emails/2017/iot_results_b.lang' => [
        'supported_locales' => ['de', 'fr', 'pt-BR'],
    ],
    'emails/2017/iot_survey.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2017/mozfest_call.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/paperstorm.lang' => [
        'supported_locales' => ['de', 'es-ES', 'fr', 'it'],
    ],
    'emails/2017/results_graphics.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/survey_results.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/template.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pl'],
    ],
    'emails/2017/welcome-message.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/cambridge_analytica.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/clear_history.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/cloudpets.lang' => [
        'supported_locales' => ['de'],
    ],
    'emails/2018/copyright_sept_vote.lang' => [
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'emails/2018/copyright_sept_vote_v2.lang' => [
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'emails/2018/copyright_stage_2.lang' => [
        'supported_locales' => [
            'de', 'fr', 'it',
        ],
    ],
    'emails/2018/copyright_win.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/cross_site_tracking_petition.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/cross_site_tracking_petition_kicker.lang' => [
        'supported_locales' => ['es', 'pt-BR'],
    ],
    'emails/2018/donor_mid_year_update.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/donor_survey_march.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/donor_update_feb.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/facebook_2fa.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_giving_tuesday.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_july.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_may.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_misinfo.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_mitchell.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_oct.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/fundraising_sept.lang' => [
        'supported_locales' => ['de', 'fr', 'pl'],
    ],
    'emails/2018/fundraising_surman.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_thank_you.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_valentines_day.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/ihr_launch.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/jan_mobile_app_updates.lang' => [
        'supported_locales' => ['es', 'pl', 'pt-BR', 'ru'],
    ],
    'emails/2018/jan_mobile_app_updates_fr.lang' => [
        'supported_locales' => ['fr'],
    ],
    'emails/2018/jan_mobile_app_updates_id.lang' => [
        'supported_locales' => ['id'],
    ],
    'emails/2018/zuckerberg_eu.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/zuckerberg_eu_hearing.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/ad_API.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/ai_survey.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/ai_survey_oct.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/ai_survey_results.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/amazon_privacy_policy.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2019/apple_privacy.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/apple_privacy_kicker.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/donation_receipt.lang' => [
        'supported_locales' => [
            'cs', 'da', 'de', 'es', 'fr', 'it', 'ja', 'nl', 'pl',
            'pt-BR', 'sv-SE', 'ru',
        ],
    ],
    'emails/2019/fb_2fa_win.lang' => [
        'supported_locales' => ['de', 'fr', 'pl'],
    ],
    'emails/2019/fb_employees_support.lang' => [
        'supported_locales' => ['fr'],
    ],
    'emails/2019/fb_open_letter.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fb_open_letter_response.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fundraising_eoy_ashley.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_eoy_mark.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_eoy_mitchell.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_giving_tuesday.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_june.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_nov_fx.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fundraising_sept.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/guardian_reportback.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/misinfo_survey.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/misinfo_survey_global.lang' => [
        'supported_locales' => ['pt-BR'],
    ],
    'emails/2019/ad_transparency_latam.lang' => [
        'supported_locales' => ['es', 'pt-BR'],
    ],
    'emails/2019/voice_assistants.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/yt_regrets.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2019/yt_regrets_site.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2020/donor_expired_card.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/fundraising_june.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/how_can_we_help.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2020/nextdoor.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2020/pni_video_apps.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/stophateforprofit.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2020/ring_win.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_e2e.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_email.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_report_back.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_victory.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2017/iot_results_assets.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pt-BR'],
    ],
    'other/2017/mozfest_form.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'other/2017/mozfest_design_assets.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'hi-IN', 'it', 'pt-BR', 'sw', 'zh-TW',
        ],
    ],
    'other/2018/cambridge_analytica_petition.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'other/2018/cloudpets_petition.lang' => [
        'supported_locales' => ['de'],
    ],
    'other/2018/copyright_postcards.lang' => [
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'other/2018/cross_site_tracking_petition.lang' => [
        'supported_locales' => ['cy', 'de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'other/2018/facebook_2fa_petition.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'other/2018/mozfest.lang' => [
        'supported_locales' => ['de', 'fr', 'it', 'pt-BR', 'sw'],
    ],
    'other/2018/mozfest_tickets.lang' => [
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
        'supported_locales' => ['cy', 'de', 'es', 'fr', 'pl'],
    ],
    'other/2019/about_us.lang' => [
        'supported_locales' => [
            'de', 'fr', 'es', 'pl', 'pt-BR',
        ],
    ],
    'other/2019/advocacy_page.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'other/2019/ai_survey_post_action_page.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'other/2019/amazon_privacy_policy_petition.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'other/2019/apple_privacy_petition.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2019/fundraising_banner.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2019/internet_health_page.lang' => [
        'supported_locales' => [
            'de', 'fr', 'es', 'pl', 'pt-BR',
        ],
    ],
    'other/2019/initiatives_page.lang' => [
        'supported_locales' => ['de'],
    ],
    'other/2019/join_us.lang' => [
        'supported_locales' => [
            'de', 'fr', 'es', 'pl', 'pt-BR',
        ],
    ],
    'other/2019/leadership.lang' => [
        'supported_locales' => [
            'de', 'fr', 'es', 'pl', 'pt-BR',
        ],
    ],
    'other/2019/misinfo_site.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'other/2019/newsletter_form.lang' => [
        'supported_locales' => [
            'de', 'fr', 'es', 'pl', 'pt-BR',
        ],
    ],
    'other/2019/participate_page.lang' => [
        'supported_locales' => ['de'],
    ],
    'other/2019/the_guardian_video.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2019/trustworthy_ai_page.lang' => [
        'supported_locales' => [
            'de', 'fr', 'es', 'pl', 'pt-BR',
        ],
    ],
    'other/2019/voice_assistants_blog.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2019/voice_assistants_graphics.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2019/yt_regrets_form.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'other/2020/mozfest_homepage.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'nl'],
    ],
    'other/2020/how_can_we_help_form.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2020/nextdoor_petition.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2020/pni_security_standards_badge.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2020/zoom_graphics.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'other/2020/zoom_snippet.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'other/2020/zoom_victory_blog.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2020/zoom_vote.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'social/2016/fundraising.lang' => [
        'supported_locales' => [
            'de', 'en-GB', 'es', 'fr', 'it', 'nl', 'pt-BR',
        ],
    ],
    'social/2017/copyright_sept.lang' => [
        'supported_locales' => [
            'de', 'es', 'fr', 'it', 'pl',
        ],
    ],
    'social/2017/iot_survey.lang' => [
        'priority'          => 5,
        'supported_locales' => [
            'de', 'es', 'fr', 'pt-BR',
        ],
    ],
    'social/2017/mozfest.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'social/2017/paperstorm.lang' => [
        'supported_locales' => [
            'de', 'es-ES', 'fr', 'it',
        ],
    ],
    'surveys/copyright_stories.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'surveys/copyright_call_survey.lang' => [
        'supported_locales' => ['de', 'fr', 'es', 'pl'],
    ],
    'surveys/donor_survey_2018.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'surveys/data_privacy_day.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'surveys/iot_survey.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pt-BR'],
    ],
    'surveys/misinfo.lang' => [
        'priority'          => 3,
        'supported_locales' => ['de', 'fr', 'pt-BR'],
    ],
    'surveys/survey_maker_party_2016.lang' => [
        'supported_locales' => [
            'bg', 'cs', 'de', 'es', 'fr', 'it', 'nl', 'sl',
        ],
    ],
];
