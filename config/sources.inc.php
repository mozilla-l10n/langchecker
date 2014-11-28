<?php

$public_repo1  = 'https://svn.mozilla.org/projects/mozilla.com/trunk/';
$public_repo2  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/fx36start/';
$public_repo3  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/surveys/';
$public_repo4  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/marketing/';
$public_repo5  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxhealthreport/';
$public_repo6  = 'https://svn.mozilla.org/projects/granary/slogans/';
$public_repo7  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/snippets/';
$public_repo8  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/add-ons/';
$public_repo9  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxupdater/';
$public_repo10 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxos-marketing/';
$public_repo11 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxtiles/';
$public_repo12 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/googleplay/';

// This is to avoid a warning in shell mode
if (! isset($_SERVER['SERVER_NAME'])) {
    $_SERVER['SERVER_NAME'] = '';
}

require __DIR__ . '/settings.inc.php';
include __DIR__ . '/adu.inc.php';

$locamotion_locales = ['ach', 'af', 'bn-BD', 'cy', 'dsb', 'en-ZA',
                       'es-MX', 'ff', 'gd', 'hi-IN', 'hsb', 'km', 'ms',
                       'my', 'oc', 'si', 'son', 'ta', 'ur', 'uz', 'vi', 'xh',
                       'zu'];

/*
    Locales removed from locamotion import because of commits on SVN
    kk (20130427)
*/

/*
If a file is not listed in $lang_flags, it's assumed to be non critical for all
locales.
If a flag is valid for all locales, set it to ['all']. If it's not, set the flag
to the array of locales.
*/
$lang_flags = [];

$mozillaorg_lang = [
    'download.lang',
    'download_button.lang',
    'esr.lang',
    'euballot.lang',
    'firefox/android/index.lang',
    'firefox/australis/firefox_tour.lang',
    'firefox/channel.lang',
    'firefox/desktop/customize.lang',
    'firefox/desktop/fast.lang',
    'firefox/desktop/index.lang',
    'firefox/desktop/tips.lang',
    'firefox/desktop/trust.lang',
    'firefox/developer.lang',
    'firefox/geolocation.lang',
    'firefox/includes/mwc_2014_schedule.lang',
    'firefox/independent.lang',
    'firefox/installer-help.lang',
    'firefox/new.lang',
    'firefox/nightly_firstrun.lang',
    'firefox/os/devices.lang',
    'firefox/os/faq.lang',
    'firefox/os/index.lang',
    'firefox/partners/index.lang',
    'firefox/privacy_tour/privacy_tour.lang',
    'firefox/speed.lang',
    'firefox/sync.lang',
    'firefox/tiles.lang',
    'firefox/whatsnew.lang',
    'firefoxflicks.lang',
    'firefoxlive.lang',
    'firefoxos/firefoxos.lang',
    'firefoxtesting.lang',
    'foundation/annualreport/2011.lang',
    'foundation/annualreport/2011faq.lang',
    'foundation/annualreport/2012/faq.lang',
    'foundation/annualreport/2012/index.lang',
    'foundationsection.lang',
    'legal/index.lang',
    'lightbeam/lightbeam.lang',
    'main.lang',
    'marketplace/marketplace.lang',
    'marketplace/partners.lang',
    'mobile.lang',
    'mozorg/about.lang',
    'mozorg/about/history-details.lang',
    'mozorg/about/history.lang',
    'mozorg/about/manifesto.lang',
    'mozorg/contribute.lang',
    'mozorg/contribute/index.lang',
    'mozorg/contribute/stories.lang',
    'mozorg/home.lang',
    'mozorg/home/index.lang',
    'mozorg/mission.lang',
    'mozorg/plugincheck.lang',
    'mozorg/products.lang',
    'mozspaces.lang',
    'mwc2014_promos.lang',
    'newsletter.lang',
    'privacy/privacy-day.lang',
    'snippets.lang',
    'tabzilla/tabzilla.lang',
    'upgradedialog.lang',
    'upgradepromos.lang',
];

$lang_flags['www.mozilla.org'] = [
    'download.lang'                           => [ 'critical' => ['all'] ],
    'download_button.lang'                    => [ 'critical' => ['all'] ],
    'firefox/android/index.lang'              => [ 'critical' => ['all'] ],
    'firefox/australis/firefox_tour.lang'     => [ 'critical' => ['all'] ],
    'firefox/channel.lang'                    => [ 'critical' => ['all'] ],
    'firefox/new.lang'                        => [ 'critical' => ['all'] ],
    'firefox/desktop/customize.lang'          => [ 'critical' => ['all'] ],
    'firefox/desktop/fast.lang'               => [ 'critical' => ['all'] ],
    'firefox/desktop/index.lang'              => [ 'critical' => ['all'] ],
    'firefox/desktop/trust.lang'              => [ 'critical' => ['all'] ],
    'firefox/desktop/tips.lang'               => [ 'critical' => ['all'] ],
    'firefox/independent.lang'                => [ 'critical' => ['all'] ],
    'firefox/installer-help.lang'             => [ 'critical' => ['all'] ],
    'firefox/os/devices.lang'                 => [
        'critical'   => ['all'],
        'firefox os' => ['all'],
    ],
    'firefox/os/faq.lang'                 => [
        'firefox os' => ['all'],
    ],
    'firefox/os/index.lang'                   => [
        'critical'   => ['all'],
        'firefox os' => ['all'],
    ],
    'firefox/privacy_tour/privacy_tour.lang'  => [ 'critical' => ['all'] ],
    'firefox/sync.lang'                       => [ 'critical' => ['all'] ],
    'firefox/tiles.lang'                      => [ 'critical' => ['all'] ],
    'firefox/whatsnew.lang'                   => [ 'critical' => ['all'] ],
    'firefoxos/firefoxos.lang'                => [ 'critical' => ['all'] ],
    'firefoxtesting.lang'                     => [ 'critical' => ['all'] ],
    'foundation/annualreport/2012/index.lang' => [ 'critical' => ['all'] ],
    'legal/index.lang'                        => [ 'critical' => ['all'] ],
    'main.lang'                               => [ 'critical' => ['all'] ],
    'marketplace/marketplace.lang'            => [ 'critical' => ['all'] ],
    'mobile.lang'                             => [ 'critical' => ['all'] ],
    'mozorg/contribute/index.lang'            => [ 'critical' => ['all'] ],
    'mozorg/contribute/stories.lang'          => [ 'critical' => ['all'] ],
    'mozorg/home/index.lang'                  => [ 'critical' => ['all'] ],
    'mozorg/plugincheck.lang'                 => [ 'critical' => ['all'] ],
    'mwc2014_promos.lang'                     => [ 'critical' => ['all'] ],
    'newsletter.lang'                         => [
        'critical' => ['de', 'es-ES', 'fr', 'hu', 'id', 'pl', 'pt-BR', 'ru'],
    ],
    'upgradedialog.lang'                      => [ 'critical' => ['all'] ],
];

$startpage36_lang = ['fx36start.lang'];
$lang_flags['start.mozilla.org'] = [
    'fx36start.lang'                          => [ 'critical' => ['all'] ],
];

$firefoxhealthreport_lang = ['fhr.lang'];
$lang_flags['about:healthreport'] = [
    'fhr.lang' => [ 'critical' => ['all'] ],
];

$slogans_lang = ['firefoxos.lang', 'marketplacebadge.lang'];
$lang_flags['slogans'] = [
    'firefoxos.lang' => [ 'critical' => ['all'] ],
    'marketplacebadge.lang' => [ 'critical' => ['all'] ],
];

$snippets_lang = [
    'aug2014_a.lang',
    'aug2014_b.lang',
    'aug2014_c.lang',
    'aug2014_d.lang',
    'sep2014_a.lang',
    'sep2014_b.lang',
    'sep2014_c.lang',
    'sep2014_d.lang',
    'sep2014_e.lang',
    'nov2014_a.lang',
    'nov2014_b.lang',
    'nov2014_c.lang',
    'nov2014_d.lang',
    'nov2014_e.lang',
    'dec2014_a.lang',
    'dec2014_c.lang',
];
$lang_flags['snippets'] = [
    'dec2014_a.lang' => [ 'critical' => ['all'] ],
    'dec2014_c.lang' => [ 'critical' => ['all'] ],
];

$addons_lang = ['privacycoach.lang'];
$lang_flags['add-ons'] = [
    // 'worldcup.lang' => [ 'critical' => ['all'] ],
];

$firefox_updater_lang = ['updater.lang'];
$lang_flags['firefox-updater'] = [
    'updater.lang' => [ 'critical' => ['all'] ],
];

$fxos_marketing_lang = [
    'marketplace_l10n_feed.lang',
    'screenshots_2_0.lang',
    'screenshots_dolphin.lang',
    'screenshots.lang',
    'screenshots_tarako.lang',
];
$lang_flags['firefoxos-marketing'] = [];

$firefox_tiles_lang = ['tiles.lang'];
$lang_flags['firefox-tiles'] = [
    'tiles.lang' => [ 'critical' => ['all'] ],
];

$google_play_lang = ['description_page.lang'];
$lang_flags['google-play'] = [
    'description_page.lang' => [ 'critical' => ['de', 'fr'] ],
];

$getinvolved_autoreplies = [
    'templates/mozorg/contribute-2015/activism.txt',
    'templates/mozorg/contribute-2015/coding_addons.txt',
    'templates/mozorg/contribute-2015/coding_cloud.txt',
    'templates/mozorg/contribute-2015/coding_firefox.txt',
    'templates/mozorg/contribute-2015/coding_firefoxos.txt',
    'templates/mozorg/contribute-2015/coding_marketplace.txt',
    'templates/mozorg/contribute-2015/coding_webcompat.txt',
    'templates/mozorg/contribute-2015/coding_webdev.txt',
    'templates/mozorg/contribute-2015/dontknow.txt',
    'templates/mozorg/contribute-2015/education_fellowships.txt',
    'templates/mozorg/contribute-2015/education_hive.txt',
    'templates/mozorg/contribute-2015/education_sciencelab.txt',
    'templates/mozorg/contribute-2015/education_webmaker.txt',
    'templates/mozorg/contribute-2015/generic_template.txt',
    'templates/mozorg/contribute-2015/l10n_product.txt',
    'templates/mozorg/contribute-2015/l10n_tools.txt',
    'templates/mozorg/contribute-2015/l10n_web.txt',
    'templates/mozorg/contribute-2015/qa_addons.txt',
    'templates/mozorg/contribute-2015/qa_general.txt',
    'templates/mozorg/contribute-2015/qa_marketplace.txt',
    'templates/mozorg/contribute-2015/qa_webcompat.txt',
    'templates/mozorg/contribute-2015/sumo_sumo.txt',
    'templates/mozorg/contribute-2015/sumo_webcompat.txt',
    'templates/mozorg/contribute-2015/writing_addons.txt',
    'templates/mozorg/contribute-2015/writing_journalism.txt',
    'templates/mozorg/contribute-2015/writing_marketplace.txt',
    'templates/mozorg/contribute-2015/writing_social.txt',
    'templates/mozorg/contribute-2015/writing_txt_devs.txt',
    'templates/mozorg/contribute-2015/writing_txt_users.txt',
];

$lang_flags['contribute-autoreplies'] = [
    'templates/mozorg/contribute-2015/activism.txt'              => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_addons.txt'         => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_cloud.txt'          => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_firefox.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_firefoxos.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_marketplace.txt'    => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_webcompat.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_webdev.txt'         => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/dontknow.txt'              => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_fellowships.txt' => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_hive.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_sciencelab.txt'  => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_webmaker.txt'    => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/generic_template.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/l10n_product.txt'          => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/l10n_tools.txt'            => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/l10n_web.txt'              => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_addons.txt'             => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_general.txt'            => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_marketplace.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_webcompat.txt'          => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/sumo_sumo.txt'             => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/sumo_webcompat.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_addons.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_journalism.txt'    => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_marketplace.txt'   => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_social.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_txt_devs.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_txt_users.txt'     => [ 'optional' => ['all'] ],
];

$no_active_tag = [
    'download.lang',
    'download_button.lang',
    'esr.lang',
    'euballot.lang',
    'firefox/includes/mwc_2014_schedule.lang',
    'firefoxflicks.lang',
    'firefoxlive.lang',
    'firefoxtesting.lang',
    'foundationsection.lang',
    'main.lang',
    'marketplace/marketplace.lang',
    'marketplace/partners.lang',
    'mobile.lang',
    'mozspaces.lang',
    'mwc2014_promos.lang',
    'newsletter.lang',
    'snippets.lang',
    'upgradepromos.lang',
];

$deadline = [
    'description_page.lang'                  => '2014-11-09', //google-play project
    'download_button.lang'                   => '2014-10-27',
    'firefox/android/index.lang'             => '2014-10-27',
    'firefox/australis/firefox_tour.lang'    => '2014-04-27',
    'firefox/channel.lang'                   => '2014-11-24',
    'firefox/desktop/customize.lang'         => '2014-05-27',
    'firefox/desktop/fast.lang'              => '2014-05-27',
    'firefox/desktop/index.lang'             => '2014-08-31',
    'firefox/desktop/tips.lang'              => '2014-05-27',
    'firefox/desktop/trust.lang'             => '2014-11-24',
    'firefox/independent.lang'               => '2014-11-09',
    'firefox/installer-help.lang'            => '2013-12-31',
    'firefox/new.lang'                       => '2014-11-09',
    'firefox/os/devices.lang'                => '2014-11-24',
    'firefox/os/index.lang'                  => '2014-10-31',
    'firefox/privacy_tour/privacy_tour.lang' => '2014-11-04',
    'firefox/sync.lang'                      => '2014-11-09',
    'firefox/tiles.lang'                     => '2014-11-09',
    'firefox/whatsnew.lang'                  => '2013-12-31',
    'fx36start.lang'                         => '2014-12-04',
    'legal/index.lang'                       => '2014-10-14',
    'mozorg/about.lang'                      => '2014-08-31',
    'mozorg/about/manifesto.lang'            => '2014-08-31',
    'mozorg/contribute/index.lang'           => '2014-11-24',
    'mozorg/contribute/stories.lang'         => '2014-11-24',
    'mozorg/home/index.lang'                 => '2014-11-24',
    'mozorg/mission.lang'                    => '2013-12-31',
    'mozorg/plugincheck.lang'                => '2014-10-14',
    'mozorg/products.lang'                   => '2013-12-31',
    'newsletter.lang'                        => '2014-12-08',
    'dec2014_a.lang'                         => '2014-12-04',
    'dec2014_c.lang'                         => '2014-12-04',
    'privacycoach.lang'                      => '2014-11-07',  // add-ons project
    'tabzilla/tabzilla.lang'                 => '2014-10-31',
];

$slogans_locales = ['bg', 'ca', 'cs', 'de', 'el', 'el', 'es-ES', 'fr', 'hu', 'hr', 'it',
                    'ja', 'ko',  'pl', 'pt-BR', 'ro', 'sr', 'sr-Latn', 'sv-SE', 'zh-CN',
                    'zh-TW'];

$marketplacebadge_locales = ['bg', 'bn-BD', 'ca', 'cs', 'de', 'el', 'es-ES', 'fr', 'hi-IN',
                             'hr', 'hu', 'it', 'ja', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk',
                             'sr', 'sr-Latn', 'sv-SE', 'ta', 'tr'];

$snippets_locales = ['ast', 'bn-BD', 'cs', 'da', 'de', 'el', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
                     'fi', 'fr', 'fy-NL', 'he', 'hi-IN', 'hr', 'hu', 'id', 'it', 'lv', 'ja', 'ko',
                     'nb-NO', 'nn-NO', 'mk', 'nl', 'pa-IN', 'pl', 'pt-BR', 'rm', 'ro', 'ru', 'sk',
                     'sl', 'sq', 'sr', 'tr', 'sv-SE', 'zh-CN', 'zh-TW'];

$addons_locales = ['cs', 'de', 'es-ES', 'es-MX', 'fr', 'hu', 'id', 'it',
                   'ja', 'pl', 'pt-BR', 'ru', 'sq', 'zh-TW'];

$firefox_updater_locales = ['ar', 'cs', 'de', 'el', 'es-ES', 'fi', 'fr', 'hu', 'id', 'it', 'ja',
                            'nl', 'pl', 'pt-BR', 'pt-PT', 'ru', 'sl', 'sv-SE', 'th', 'tr', 'vi',
                            'zh-CN', 'zh-TW'];

$fxos_marketing = ['af', 'bg', 'bn-BD', 'cs', 'de', 'el', 'es-ES', 'fr', 'hi-IN', 'hr', 'hu', 'it', 'ja',
                   'mk', 'pl', 'pt-BR', 'ro', 'ru', 'sr', 'sr-Latn', 'ta', 'tr', 'xh', 'zh-CN', 'zu'];

$getinvolved_locales = ['ar', 'bg', 'bn-BD', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
                        'es-MX', 'fr', 'fy-NL', 'he', 'hi-IN', 'hr', 'id', 'it', 'lt',
                        'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sl', 'sq', 'sr', 'sv-SE',
                        'ta', 'tr', 'zh-CN', 'zh-TW'];

$privacy_tour_locales = ['ast', 'da', 'de', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
                         'fi', 'fr', 'fy-NL', 'he', 'hu', 'it', 'ja', 'ko',
                         'lv', 'nb-NO', 'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'rm',
                         'ru', 'sk', 'sl', 'zh-TW'];

$mwc_locales = ['ca', 'cs', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'hu', 'it',
'ja', 'ko', 'pl', 'pt-BR', 'ro', 'sr', 'zh-CN', 'zh-TW'];

$firefox_os = ['af', 'bn-BD', 'bg', 'ca' ,'cs', 'de', 'el', 'es-ES', 'es-MX',
               'et', 'fr', 'fy-NL', 'hi-IN', 'hr', 'hu', 'ja', 'it', 'ko', 'mk',
               'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sq', 'sr', 'sv-SE', 'ta',
               'xh', 'zh-CN', 'zh-TW', 'zu'];

// Source : http://hg.mozilla.org/releases/mozilla-release/raw-file/85d4fdc6d572/mobile/android/locales/maemo-locales
$android_locales = ['an', 'as', 'be', 'bn-IN', 'ca', 'cs', 'cy', 'da', 'de',
                    'es-AR', 'es-ES', 'es-MX', 'et', 'eu', 'fi', 'ff', 'fr',
                    'fy-NL', 'ga-IE', 'gd', 'gl' ,'gu-IN', 'hi-IN', 'hu',
                    'hy-AM', 'id', 'is', 'it', 'ja', 'kk', 'kn', 'ko', 'lt',
                    'lv', 'ml', 'mr', 'ms', 'nb-NO', 'nl', 'or', 'pa-IN',
                    'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sq', 'sk', 'sl',
                    'sv-SE', 'ta', 'te', 'th', 'tr', 'uk', 'zh-CN', 'zh-TW'];

// List provided by Release-drivers, needs access to a Google Play publishing account
$google_play_locales = ['af', 'ar', 'be', 'bg', 'cs', 'ca', 'da', 'de', 'el',
                        'en-GB', 'es-MX', 'es-ES', 'et', 'fa', 'fi', 'fr',
                        'hi-IN', 'hu', 'hr', 'id', 'it', 'he', 'ja', 'ko',
                        'lt', 'lv', 'ms', 'nl', 'nb-NO', 'pl', 'pt-BR',
                        'pt-PT', 'rm', 'ro', 'ru', 'sk', 'sl', 'sr', 'sv-SE',
                        'sw', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW', 'zu'];

// Locales that we do support and that Google Play supports too
$google_play_target = array_intersect($android_locales, $google_play_locales);

/* Array structure for single website
*
*   [
*       0 name,
*       1 path to local repo,
*       2 folder containing locale files,
*       3 array of supported locale,
*       4 array of supported file names,
*       5 reference locale,
*       6 url to public repo,
*       7 array of flags,
*       8 type of files (lang, raw)
*   ]
*
*/

$sites =
[
    0 => [
        'www.mozilla.org',
        $repo1,
        'locales/',
        $mozilla,
        $mozillaorg_lang,
        'en-GB', // source locale
        $public_repo1,
        $lang_flags['www.mozilla.org'],
        'lang',
    ],

    1 => [
        'start.mozilla.org',
        $repo2,
        'locale/',
        $startpage36,
        $startpage36_lang,
        'en-US', // source locale
        $public_repo2,
        $lang_flags['start.mozilla.org'],
        'lang',
    ],

    2 => [
        'surveys',
        $repo3,
        '',
        $surveys,
        ['survey1.lang', 'survey2.lang', 'survey3.lang', 'survey4.lang',
         'survey5.lang', 'getinvolved_march2014.lang'],
        'en-GB', // source locale
        $public_repo3,
        [],
        'lang',
    ],

    3 => [
        'marketing',
        $repo4,
        '',
        $marketing,
        ['julyevent.lang'],
        'en-US', // source locale
        $public_repo4,
        [],
        'lang',
    ],

    4 => [
        'about:healthreport',
        $repo5,
        'locale/',
        $mozilla,
        $firefoxhealthreport_lang,
        'en-US', // source locale
        $public_repo5,
        $lang_flags['about:healthreport'],
        'lang',
    ],

    5 => [
        'slogans',
        $repo6,
        '',
        $slogans_locales,
        $slogans_lang,
        'en-US', // source locale
        $public_repo6,
        $lang_flags['slogans'],
        'lang',
    ],

    6 => [
        'snippets',
        $repo7,
        '',
        $snippets_locales,
        $snippets_lang,
        'en-US', // source locale
        $public_repo7,
        $lang_flags['snippets'],
        'lang',
    ],

    7 => [
        'add-ons',
        $repo8,
        '',
        $addons_locales,
        $addons_lang,
        'en-US', // source locale
        $public_repo8,
        $lang_flags['add-ons'],
        'lang',
    ],

    8 => [
        'firefox-updater',
        $repo9,
        '',
        $firefox_updater_locales,
        $firefox_updater_lang,
        'en-US', // source locale
        $public_repo9,
        $lang_flags['firefox-updater'],
        'lang',
    ],

    9 => [
        'firefoxos-marketing',
        $repo10,
        '',
        $fxos_marketing,
        $fxos_marketing_lang,
        'en-US', // source locale
        $public_repo10,
        $lang_flags['firefoxos-marketing'],
        'lang',
    ],

    10 => [
        'firefox-tiles',
        $repo11,
        '',
        $mozilla,
        $firefox_tiles_lang,
        'en-US', // source locale
        $public_repo11,
        $lang_flags['firefox-tiles'],
        'lang',
    ],

    11 => [
        'contribute-autoreplies',
        $repo1,
        'locales/',
        $getinvolved_locales,
        $getinvolved_autoreplies,
        'en-GB', // source locale
        $public_repo1,
        $lang_flags['contribute-autoreplies'],
        'raw',
    ],

    12 => [
        'google-play',
        $repo12,
        '',
        $google_play_target,
        $google_play_lang,
        'en-US', // source locale
        $public_repo12,
        $lang_flags['google-play'],
        'lang',
    ],
];

$langfiles_subsets = [
    'www.mozilla.org' =>
    [
        'download.lang'                         => $mozilla,
        'download_button.lang'                  => $mozillaorg,
        'esr.lang'                              => ['de', 'fr'],
        'euballot.lang'                         =>
            ['bg', 'hr', 'cs', 'da', 'nl', 'en-GB', 'et', 'fi', 'fr',
             'de', 'el', 'hu', 'it', 'lv', 'lt', 'nb-NO', 'pl', 'pt-PT',
             'ro', 'sk', 'sl', 'es-ES', 'sv-SE'],
        'firefox/android/index.lang'            => $android_locales,
        'firefox/australis/firefox_tour.lang'   => $mozilla,
        'firefox/channel.lang'                  => $mozilla,
        'firefox/desktop/customize.lang'        => $mozilla,
        'firefox/desktop/fast.lang'             => $mozilla,
        'firefox/desktop/index.lang'            => $mozilla,
        'firefox/desktop/tips.lang'             =>
            ['af', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'es-AR', 'es-CL',
            'es-ES', 'es-MX', 'eu', 'ff', 'fr', 'gd', 'gl', 'fy-NL', 'he',
            'hi-IN', 'hsb', 'hu', 'id', 'it', 'ja', 'km', 'ms', 'nl',
             'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sv-SE',
             'uz', 'xh', 'zh-CN', 'zh-TW'],
        'firefox/desktop/trust.lang'            => $mozilla,
        'firefox/developer.lang'                => $mozilla,
        'firefox/geolocation.lang'              =>
            ['af', 'ar', 'as', 'ast', 'be', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs',
             'cy', 'da', 'de', 'el', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'et', 'eu', 'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd',
             'gl', 'gu-IN', 'he', 'hi-IN', 'hr', 'hu', 'hy-AM', 'id', 'is',
             'it', 'ja', 'ka', 'kk', 'kn', 'ko', 'lt', 'lv', 'mk', 'ml', 'mr',
             'nb-NO', 'nl', 'nn-NO', 'oc', 'pa-IN', 'pl', 'pt-BR', 'pt-PT',
             'rm', 'ro', 'ru', 'si', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE',
             'ta', 'te', 'th', 'tr', 'uk', 'vi', 'zh-CN'],
        'firefox/includes/mwc_2014_schedule.lang' => $mwc_locales,
        'firefox/independent.lang'              => $mozilla,
        'firefox/installer-help.lang'           => $mozilla,
        'firefox/new.lang'                      => $mozilla,
        'firefox/nightly_firstrun.lang'         =>
            ['ar', 'ast', 'cs', 'de', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
             'fa', 'fr', 'fy-NL', 'gd', 'gl', 'he', 'hu', 'id', 'it', 'ja', 'kk', 'ko',
             'lt', 'lv', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-PT', 'ru', 'sk',
             'sv-SE', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW'],
        'firefox/os/devices.lang'               => $firefox_os,
        'firefox/os/faq.lang'                   => $firefox_os,
        'firefox/os/index.lang'                 => $firefox_os,
        'firefox/partners/index.lang'           => $firefox_os,
        'firefox/privacy_tour/privacy_tour.lang' => $privacy_tour_locales,
        'firefox/speed.lang'                    => ['pt-BR'],
        'firefox/sync.lang'                     => $mozilla,
        'firefox/tiles.lang'                    => $mozilla,
        'firefox/whatsnew.lang'                 => ['hu', 'pl'],
        'firefoxflicks.lang'                    =>
            ['ar', 'bg', 'de', 'fa', 'fr', 'gl', 'es-ES', 'hu', 'id',
             'it', 'ja', 'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW'],
        'firefoxlive.lang'                      =>
            ['ar', 'de', 'fa', 'fr', 'es-ES', 'gl', 'hr', 'hu', 'ko',
             'pl', 'pt-BR', 'rm', 'ro', 'ru', 'sk', 'sl', 'sq', 'tr',
             'zh-CN', 'zh-TW'],
        'firefoxos/firefoxos.lang'              =>
            ['fr', 'es-AR', 'es-ES', 'fy-NL', 'nl', 'pl', 'pt-BR'],
        'firefoxtesting.lang'                   => $mozilla,
        'foundation/annualreport/2011.lang'     =>
            ['ast', 'cs', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
             'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
             'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2011faq.lang'  =>
            ['ast', 'cs', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
             'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
             'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2012/index.lang' =>
            ['ar', 'ast', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
             'ja', 'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
             'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2012/faq.lang' =>
            ['ar', 'ast', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
             'ja', 'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
             'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundationsection.lang'                =>
            ['de', 'cs', 'fr', 'es-ES', 'gl', 'hu', 'id', 'it', 'nl',
             'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW'],
        'legal/index.lang'                      => $firefox_os,
        'lightbeam/lightbeam.lang'              =>
            ['ca', 'cs', 'cy', 'de', 'dsb', 'el', 'es-AR', 'es-CL',
             'es-ES', 'es-MX', 'eu', 'fr', 'fy-NL', 'hsb', 'it', 'ja',
             'km', 'ms', 'nl', 'pl', 'sq', 'sv-SE', 'tr', 'zh-CN'],
        'main.lang'                             => $mozillaorg,
        'marketplace/marketplace.lang'          => ['fr', 'es-ES', 'pl', 'pt-BR'],
        'marketplace/partners.lang'             => ['fr', 'es-ES', 'pt-BR'],
        'mobile.lang'                           =>
            ['be', 'ca', 'cs', 'da', 'de', 'es-AR', 'es-ES', 'et', 'eu',
             'fr',  'fy-NL', 'ga-IE', 'gd', 'gl', 'he', 'hu', 'id',
             'it', 'ja', 'ko', 'lt', 'nb-NO', 'nl', 'pa-IN', 'pl',
             'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'th',
             'tr', 'zh-CN', 'zh-TW'],
        'mozorg/about.lang'                     => $mozillaorg,
        'mozorg/home.lang'                      => $mozillaorg,
        'mozorg/home/index.lang'                => $mozillaorg,
        'mozorg/mission.lang'                   => $mozillaorg,
        'mozorg/about/manifesto.lang'           =>
            ['ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'cy', 'de', 'dsb', 'el',
             'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu', 'fi', 'fr', 'fur',
             'fy-NL', 'gd', 'gl', 'hi-IN', 'hr', 'hsb', 'hu', 'id', 'it',
             'ja', 'ko', 'km', 'mk', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru',
             'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'tr', 'uz', 'vi', 'xh',
             'zh-CN', 'zh-TW'],
        'mozorg/about/history-details.lang'     =>
            ['ca', 'cy', 'de', 'dsb', 'es-CL', 'es-MX', 'eu', 'fr', 'gl',
             'hsb', 'it', 'km', 'pa-IN', 'ro', 'sk', 'sq', 'sv-SE', 'uz',
             'zh-TW'],
        'mozorg/about/history.lang'             =>
            ['ar', 'bg', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'es-AR', 'es-CL',
             'es-ES', 'es-MX', 'eu', 'fr', 'fy-NL', 'gl', 'hr', 'hsb', 'id',
             'it', 'km', 'lt', 'ms', 'nl', 'pa-IN', 'pl', 'pt-BR', 'ro', 'ru',
             'sk', 'sl', 'sq', 'sr', 'sv-SE', 'ta', 'tr', 'uz', 'zh-CN', 'zh-TW'],
        'mozorg/contribute.lang'                => $getinvolved_locales,
        'mozorg/contribute/index.lang'          => $getinvolved_locales,
        'mozorg/contribute/stories.lang'        => $getinvolved_locales,
        'mozorg/plugincheck.lang'               => $mozillaorg,
        'mozorg/products.lang'                  => $mozillaorg,
        'mozspaces.lang'                        => ['de', 'fr'],
        'mwc2014_promos.lang'                   => $mwc_locales,
        'privacy/privacy-day.lang'              =>
            ['ca', 'cs', 'de', 'es-AR', 'es-ES', 'eu', 'fr', 'he',
             'it', 'ja', 'pl', 'pt-BR', 'sk', 'sq', 'zh-TW'],
        'newsletter.lang'                       => $mozillaorg,
        'snippets.lang'                         => $mozillaorg,
        'tabzilla/tabzilla.lang'                => $mozillaorg,
        'upgradedialog.lang'                    => $startpage36,
        'upgradepromos.lang'                    =>
            ['de', 'es-ES', 'fr', 'it', 'pl', 'ru', 'pt-BR'],
    ],

    'start.mozilla.org' => ['fx36start.lang' => $startpage36],

    'about:healthreport' =>
    [
        'fhr.lang' =>
            ['af', 'an', 'ar', 'as', 'ast', 'az', 'be', 'bg', 'bn-BD',
             'bn-IN', 'br', 'bs', 'ca', 'cs', 'cy', 'da', 'de',
             'dsb', 'el', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
             'et', 'eu', 'fa', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd',
             'gl', 'gu-IN', 'he', 'hi-IN', 'hr', 'hsb', 'hu', 'hy-AM',
             'id', 'is', 'it', 'ja', 'ka', 'kk', 'km', 'kn', 'ko',
             'lij', 'lt', 'lv', 'mai', 'mk', 'ml', 'mr', 'ms',
             'my', 'nb-NO', 'nl', 'nn-NO', 'oc', 'or', 'pa-IN',
             'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'si',
             'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'ta',
             'te', 'th', 'tr', 'uk', 'ur', 'uz', 'vi', 'xh', 'zh-CN',
             'zh-TW', 'zu'],
    ],

    'surveys' =>
    [
        'survey1.lang' => ['de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN'],
        'survey2.lang' => ['de', 'es-ES', 'fr',  'it', 'pl', 'pt-BR', 'ru'],
        'survey3.lang' => ['de', 'es-ES', 'fr', 'it', 'ja', 'ko', 'pl', 'pt-BR', 'ru', 'zh-CN', 'zh-TW'],
        'survey4.lang' => ['de', 'es-AR', 'es-ES', 'es-MX', 'fr', 'id', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN'],
        'survey5.lang' => ['de', 'fr', 'pl'],
        'getinvolved_march2014.lang' => ['es-ES', 'id', 'pt-BR', 'zh-CN'],
    ],

    'marketing' => ['julyevent.lang' => ['de', 'es-ES', 'fr', 'it', 'id', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW']],

    'slogans' => [
        'firefoxos.lang' => $slogans_locales,
        'marketplacebadge.lang' => $marketplacebadge_locales
    ],

    'snippets' =>
    [
        'jun2014.lang' => ['de', 'el', 'es-ES', 'fr', 'hi-IN', 'hu', 'id', 'it', 'nl', 'pl', 'pt-BR', 'sr'],
        'aug2014_a.lang' => ['es-ES'],
        'aug2014_b.lang' => ['bn-BD', 'cs', 'hr', 'mk'],
        'aug2014_c.lang' => ['de', 'fr', 'pl', 'nl', 'sl', 'sq', 'zh-TW'],
        'aug2014_d.lang' => ['el', 'es-CL', 'es-MX', 'it', 'ja', 'pt-BR', 'ru', 'tr', 'sv-SE', 'sr'],
        'sep2014_a.lang' => ['cs', 'de', 'es-ES', 'fr', 'it', 'pl'],
        'sep2014_b.lang' => ['id', 'ja', 'ko', 'nb-NO', 'nl', 'ru', 'zh-CN'],
        'sep2014_c.lang' => ['bn-BD', 'el', 'hi-IN', 'hu'],
        'sep2014_d.lang' => ['pt-BR'],
        'sep2014_e.lang' => ['sq'],
        'nov2014_a.lang' => ['ast', 'da', 'es-AR', 'es-CL', 'es-MX', 'fi', 'fy-NL',
                             'he', 'ko', 'lv', 'nb-NO', 'nn-NO', 'pa-IN', 'rm', 'sk',
                             'sl', 'zh-TW'],
        'nov2014_b.lang' => ['ja'],
        'nov2014_c.lang' => ['es-ES', 'hu'],
        'nov2014_d.lang' => ['de', 'fr', 'it', 'pl', 'pt-BR', 'ru'],
        'nov2014_e.lang' => ['el', 'hi-IN', 'mk', 'sr'],
        'dec2014_a.lang' => ['de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru'],
        'dec2014_c.lang' => ['sr'],
    ],

    'add-ons' => [
        'privacycoach.lang' => $addons_locales
    ],

    'firefox-updater' => [
        'updater.lang' => $firefox_updater_locales,
    ],

    'google-play' => [
        'description_page.lang' => $google_play_target,
    ],

    'firefoxos-marketing' => [
        'marketplace_l10n_feed.lang' => ['bg', 'bn-BD', 'cs', 'de', 'el', 'es-ES', 'fr', 'hr', 'hu', 'it', 'ja',
                                         'mk', 'pl', 'pt-BR', 'ru', 'sr', 'sr-Latn', 'tr', 'zh-CN'],
        'screenshots_2_0.lang' => ['af', 'ja', 'xh', 'zu'],
        'screenshots_dolphin.lang' => ['bn-BD'],
        'screenshots.lang'  => ['cs', 'de', 'el', 'es-ES', 'hr', 'hu',
                                'fr', 'it', 'mk', 'pl', 'pt-BR', 'ro',
                                'ru', 'sr'],
        'screenshots_tarako.lang' => ['hi-IN', 'ru', 'ta'],
    ],
];
