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

// This is to avoid a warning in shell mode
if (! isset($_SERVER['SERVER_NAME'])) {
    $_SERVER['SERVER_NAME'] = '';
}

require __DIR__ . '/settings.inc.php';
include __DIR__ . '/adu.inc.php';

$locamotion_locales = ['ach', 'af', 'bn-BD', 'cy', 'dsb', 'en-ZA', 'es-MX', 'ff',
                       'gd', 'hi-IN', 'hsb', 'km', 'ku', 'ms', 'my', 'oc', 'si',
                       'son', 'ta', 'ur', 'uz', 'vi', 'xh'];

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
    'firefox/geolocation.lang',
    'firefox/new.lang',
    'firefox/channel.lang',
    'firefox/speed.lang',
    'firefox/os/devices.lang',
    'firefox/os/index.lang',
    'firefox/os/faq.lang',
    'firefox/partners/index.lang',
    'firefox/includes/mwc_2014_schedule.lang',
    'firefox/desktop/index.lang',
    'firefox/desktop/customize.lang',
    'firefox/desktop/fast.lang',
    'firefox/desktop/trust.lang',
    'firefox/desktop/tips.lang',
    'firefox/sync.lang',
    'mwc2014_promos.lang',
    'firefox/whatsnew.lang',
    'firefox/installer-help.lang',
    'firefox/australis/firefox_tour.lang',
    'firefoxflicks.lang',
    'firefoxlive.lang',
    'firefoxos/firefoxos.lang',
    'firefoxtesting.lang',
    'foundation/annualreport/2011.lang',
    'foundation/annualreport/2011faq.lang',
    'foundation/annualreport/2012/index.lang',
    'foundation/annualreport/2012/faq.lang',
    'foundationsection.lang',
    'legal/index.lang',
    'lightbeam/lightbeam.lang',
    'main.lang',
    'marketplace/marketplace.lang',
    'marketplace/partners.lang',
    'mobile.lang',
    'mozorg/about.lang',
    'mozorg/about/manifesto.lang',
    'mozorg/about/history.lang',
    'mozorg/about/history-details.lang',
    'mozorg/mission.lang',
    'mozorg/contribute.lang',
    'mozorg/plugincheck.lang',
    'mozorg/products.lang',
    'mozorg/home.lang',
    'mozspaces.lang',
    'newsletter.lang',
    'privacy/privacy-day.lang',
    'snippets.lang',
    'tabzilla/tabzilla.lang',
    'upgradedialog.lang',
    'upgradepromos.lang',
    'firefox/nightly_firstrun.lang',
];

$lang_flags['www.mozilla.org'] = [
    'download.lang'                           => [ 'critical' => ['all'] ],
    'download_button.lang'                    => [ 'critical' => ['all'] ],
    'firefox/new.lang'                        => [ 'critical' => ['all'] ],
    'firefox/channel.lang'                    => [ 'critical' => ['all'] ],
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
    'firefox/desktop/index.lang'              => [ 'critical' => ['all'] ],
    'firefox/desktop/customize.lang'          => [ 'critical' => ['all'] ],
    'firefox/desktop/fast.lang'               => [ 'critical' => ['all'] ],
    'firefox/desktop/trust.lang'              => [ 'critical' => ['all'] ],
    'firefox/desktop/tips.lang'               => [ 'critical' => ['all'] ],
    'firefox/sync.lang'                       => [ 'critical' => ['all'] ],
    'mwc2014_promos.lang'                     => [ 'critical' => ['all'] ],
    'firefox/whatsnew.lang'                   => [ 'critical' => ['all'] ],
    'firefox/installer-help.lang'             => [ 'critical' => ['all'] ],
    'firefox/australis/firefox_tour.lang'     => [ 'critical' => ['all'] ],
    'firefoxos/firefoxos.lang'                => [ 'critical' => ['all'] ],
    'firefoxtesting.lang'                     => [ 'critical' => ['all'] ],
    'foundation/annualreport/2011faq.lang'    => [ 'critical' => ['all'] ],
    'foundation/annualreport/2012/index.lang' => [ 'critical' => ['all'] ],
    'legal/index.lang'                        => [ 'critical' => ['all'] ],
    'main.lang'                               => [ 'critical' => ['all'] ],
    'marketplace/marketplace.lang'            => [ 'critical' => ['all'] ],
    'mobile.lang'                             => [ 'critical' => ['all'] ],
    'mozorg/contribute.lang'                  => [ 'critical' => ['all'] ],
    'mozorg/plugincheck.lang'                 => [ 'critical' => ['all'] ],
    'mozorg/home.lang'                        => [ 'critical' => ['all'] ],
    'newsletter.lang'                         => [ 'critical' => ['all'] ],
    'upgradedialog.lang'                      => [ 'critical' => ['all'] ],
];

$no_active_tag = [
    'download.lang',
    'download_button.lang',
    'esr.lang',
    'euballot.lang',
    'firefoxflicks.lang',
    'firefoxlive.lang',
    'firefoxtesting.lang',
    'foundationsection.lang',
    'main.lang',
    'marketplace/marketplace.lang',
    'marketplace/partners.lang',
    'mobile.lang',
    'mozspaces.lang',
    'newsletter.lang',
    'snippets.lang',
    'upgradepromos.lang',
    'mwc2014_promos.lang',
    'firefox/includes/mwc_2014_schedule.lang',
];

$deadline = [
    'download_button.lang'                => '2013-12-31',
    'firefox/australis/firefox_tour.lang' => '2014-04-27',
    'firefox/channel.lang'                => '2013-12-31',
    'firefox/desktop/index.lang'          => '2014-08-31',
    'firefox/desktop/customize.lang'      => '2014-05-27',
    'firefox/desktop/fast.lang'           => '2014-05-27',
    'firefox/desktop/trust.lang'          => '2014-05-27',
    'firefox/desktop/tips.lang'           => '2014-05-27',
    'firefox/installer-help.lang'         => '2013-12-31',
    'firefox/new.lang'                    => '2013-12-31',
    'firefox/os/index.lang'               => '2014-07-15',
    'firefox/os/devices.lang'             => '2014-07-15',
    'firefox/sync.lang'                   => '2014-09-26',
    'firefox/whatsnew.lang'               => '2013-12-31',
    'legal/index.lang'                    => '2014-10-14',
    'lightbeam/lightbeam.lang'            => '2014-05-27',
    'mozorg/about.lang'                   => '2014-08-31',
    'mozorg/about/manifesto.lang'         => '2014-08-31',
    'mozorg/contribute.lang'              => '2014-10-14',
    'mozorg/home.lang'                    => '2014-09-26',
    'mozorg/mission.lang'                 => '2013-12-31',
    'mozorg/plugincheck.lang'             => '2014-08-31',
    'mozorg/products.lang'                => '2013-12-31',
    'tabzilla/tabzilla.lang'              => '2014-04-27',
    'homefeeds.lang'                      => '2014-08-25',
    'sep2014_a.lang'                      => '2014-09-15',
    'sep2014_b.lang'                      => '2014-09-15',
    'sep2014_c.lang'                      => '2014-09-15',
    'sep2014_d.lang'                      => '2014-09-15',
    'sep2014_e.lang'                      => '2014-09-15',
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
    'jan2014.lang',
    'apr2014.lang',
    'may2014.lang',
    'jun2014.lang',
    'aug2014_a.lang',
    'aug2014_b.lang',
    'aug2014_c.lang',
    'aug2014_d.lang',
    'sep2014_a.lang',
    'sep2014_b.lang',
    'sep2014_c.lang',
    'sep2014_d.lang',
    'sep2014_e.lang',
];
$lang_flags['snippets'] = [
    'sep2014_a.lang' => [ 'critical' => ['all'] ],
    'sep2014_b.lang' => [ 'critical' => ['all'] ],
    'sep2014_c.lang' => [ 'critical' => ['all'] ],
    'sep2014_d.lang' => [ 'critical' => ['all'] ],
    'sep2014_e.lang' => [ 'critical' => ['all'] ],
];

$addons_lang = ['homefeeds.lang', 'worldcup.lang'];
$lang_flags['add-ons'] = [
    'worldcup.lang' => [ 'critical' => ['all'] ],
];

$firefox_updater_lang = ['updater.lang'];
$lang_flags['firefox-updater'] = [
    'updater.lang' => [ 'critical' => ['all'] ],
];

$fxos_marketing_lang = [
    'screenshots_dolphin.lang',
    'screenshots.lang',
    'screenshots_tarako.lang',
    'marketplace_l10n_feed.lang',
];
$lang_flags['firefoxos-marketing'] = [];

$firefox_tiles_lang = ['tiles.lang'];
$lang_flags['firefox-tiles'] = [
    'tiles.lang' => [ 'critical' => ['all'] ],
];

$slogans_locales = ['bg', 'ca', 'cs', 'de', 'el', 'el', 'es-ES', 'fr', 'hu', 'hr', 'it',
                    'ja', 'ko',  'pl', 'pt-BR', 'ro', 'sr', 'sr-Latn', 'zh-CN', 'zh-TW'];

$marketplacebadge_locales = ['bg', 'bn-BD', 'ca', 'cs', 'de', 'el', 'es-ES', 'fr', 'hi-IN', 'hr', 'hu', 'it',
                             'ja', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sr', 'sr-Latn', 'ta', 'tr'];

$snippets_locales = ['bn-BD', 'cs', 'da', 'de', 'el', 'es-CL', 'es-ES', 'es-MX', 'fr', 'hi-IN', 'hr', 'hu',
                     'id', 'it', 'ja', 'ko', 'nb-NO', 'mk', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq',
                     'sr', 'tr', 'sv-SE', 'zh-CN', 'zh-TW'];

$snippets_main_locales = ['cs', 'de', 'el', 'es-ES', 'fr', 'hu', 'id', 'it', 'ja', 'ko',
                          'pl', 'pt-BR', 'ru', 'sr', 'vi', 'zh-CN', 'zh-TW'];

$addons_locales = ['de', 'es-ES', 'fr', 'id', 'it', 'ja', 'pt-BR'];

$firefox_updater_locales = ['ar', 'cs', 'de', 'el', 'es-ES', 'fi', 'fr', 'hu', 'id', 'it', 'ja',
                            'nl', 'pl', 'pt-BR', 'pt-PT', 'ru', 'sl', 'sv-SE', 'th', 'tr', 'vi',
                            'zh-CN', 'zh-TW'];

$fxos_marketing = ['bg', 'bn-BD', 'cs', 'de', 'el', 'es-ES', 'fr', 'hi-IN', 'hr', 'hu', 'it', 'ja',
                   'mk', 'pl', 'pt-BR', 'ro', 'ru', 'sr', 'sr-Latn', 'ta', 'tr', 'zh-CN'];

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
    ],

    1 => [
        'start.mozilla.org',
        $repo2,
        'locale/',
        $startpage36,
        ['fx36start.lang'],
        'en-US', // source locale
        $public_repo2,
        [],
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
    ],
];

$mwc_locales = ['ca', 'cs', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'hu', 'it',
'ja', 'ko', 'pl', 'pt-BR', 'ro', 'sr', 'zh-CN', 'zh-TW'];

$firefox_os = ['bn-BD', 'bg', 'ca' ,'cs', 'de', 'el', 'es-ES', 'es-MX', 'et',
               'fr', 'fy-NL', 'hi-IN', 'hr', 'hu', 'ja', 'it', 'ko', 'mk',
               'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sq', 'sr', 'ta', 'zh-CN',
               'zh-TW'];

$firefox_os_partial = ['bn-BD', 'bg', 'ca' ,'cs', 'de', 'el', 'es-ES', 'es-MX',
               'fr', 'fy-NL', 'hi-IN', 'hr', 'hu', 'ja', 'it', 'ko', 'mk',
               'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sq', 'sr', 'ta', 'zh-CN',
               'zh-TW'];

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
        'firefox/new.lang'                      => $mozilla,
        'firefox/channel.lang'                  => $mozilla,
        'firefox/speed.lang'                    => ['pt-BR'],
        'firefox/os/devices.lang'               => $firefox_os,
        'firefox/os/index.lang'                 => $firefox_os,
        'firefox/os/faq.lang'                   => $firefox_os_partial,
        'firefox/partners/index.lang'           => $firefox_os_partial,
        'firefox/includes/mwc_2014_schedule.lang' => $mwc_locales,
        'mwc2014_promos.lang'                   => $mwc_locales,
        'firefox/whatsnew.lang'                 => ['hu', 'pl'],
        //'firefox/windows-8-touch.lang'          => $mozilla,
        'firefox/installer-help.lang'           => $mozilla,
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
            ['ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
             'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
             'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2011faq.lang'  =>
            ['ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
             'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
             'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2012/index.lang' =>
            ['ar', 'ast', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
             'ja', 'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
             'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2012/faq.lang' =>
            ['ar', 'ast', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
             'ja', 'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
             'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundationsection.lang'                =>
            ['de', 'cs', 'fr', 'es-ES', 'gl', 'hu', 'id', 'it', 'nl',
             'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW'],
        'legal/index.lang'                      => $firefox_os,
        'lightbeam/lightbeam.lang'              =>
            ['ca', 'cs', 'de', 'el', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
             'eu', 'fr', 'fy-NL', 'it', 'ja', 'nl', 'pl', 'sq', 'tr',
             'zh-CN'],
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
        'mozorg/mission.lang'                   => $mozillaorg,
        'mozorg/about/manifesto.lang'           =>
            ['ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'cy', 'de', 'dsb', 'el',
             'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu', 'fi', 'fr', 'fur',
             'fy-NL', 'gl', 'hr', 'hsb', 'hu', 'id', 'it', 'ja', 'ko', 'km',
             'mk', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq',
             'sr', 'sv-SE', 'tr', 'uz', 'vi', 'xh', 'zh-CN', 'zh-TW'],
        'mozorg/about/history.lang'             =>
            ['ar', 'bg', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'es-AR', 'es-CL',
             'es-ES', 'es-MX', 'eu', 'fr', 'fy-NL', 'gl', 'hr', 'hsb', 'id',
             'it', 'km', 'lt', 'ms', 'nl', 'pa-IN', 'pl', 'pt-BR', 'ro', 'ru',
             'sk', 'sl', 'sq', 'sr', 'ta', 'tr', 'uz', 'zh-CN', 'zh-TW'],
        'mozorg/about/history-details.lang'     =>
            ['ca', 'cy', 'de', 'dsb', 'es-CL', 'es-MX', 'eu', 'fr', 'gl',
             'hsb', 'it', 'km', 'pa-IN', 'ro', 'sk', 'sq', 'uz', 'zh-TW'],
        'mozorg/contribute.lang'                =>
            ['ar', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'fr', 'fy-NL', 'he', 'hi-IN', 'hr', 'id',
             'it', 'lt', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sl',
             'sq', 'sr', 'ta', 'tr', 'zh-CN', 'zh-TW'],
        'mozorg/plugincheck.lang'               => $mozillaorg,
        'mozorg/products.lang'                  => $mozillaorg,
        'mozspaces.lang'                        => ['de', 'fr'],
        'newsletter.lang'                       => $mozillaorg,
        'privacy/privacy-day.lang'              =>
            ['ca', 'cs', 'de', 'es-AR', 'es-ES', 'eu', 'fr', 'he',
             'it', 'ja', 'pl', 'pt-BR', 'sk', 'sq', 'zh-TW'],
        'snippets.lang'                         => $mozillaorg,
        'tabzilla/tabzilla.lang'                => $mozillaorg,
        'upgradedialog.lang'                    => $startpage36,
        'upgradepromos.lang'                    =>
            ['de', 'es-ES', 'fr', 'it', 'pl', 'ru', 'pt-BR'],
        'firefox/desktop/index.lang'            => $mozilla,
        'firefox/desktop/customize.lang'        => $mozilla,
        'firefox/desktop/fast.lang'             => $mozilla,
        'firefox/desktop/trust.lang'            => $mozilla,
        'firefox/sync.lang'                     => $mozilla,
        'firefox/australis/firefox_tour.lang'   => $mozilla,
        'firefox/nightly_firstrun.lang'         =>
            ['ar', 'ast', 'cs', 'de', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
             'fa', 'fr', 'fy-NL', 'gl', 'he', 'hu', 'id', 'it', 'ja', 'kk', 'ko',
             'lt', 'lv', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-PT', 'ru', 'sk',
             'sv-SE', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW'],
        'firefox/desktop/tips.lang'             =>
            ['ca', 'cs', 'de', 'el', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu',
             'fr', 'gl', 'fy-NL', 'he', 'hu', 'id', 'it', 'ja', 'nl', 'pl',
             'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'zh-CN', 'zh-TW'],
        'firefox/geolocation.lang'              =>
            ['af', 'ar', 'as', 'ast', 'be', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs',
             'cy', 'da', 'de', 'el', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'et', 'eu', 'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd',
             'gl', 'gu-IN', 'he', 'hi-IN', 'hr', 'hu', 'hy-AM', 'id', 'is',
             'it', 'ja', 'ka', 'kk', 'kn', 'ko', 'ku', 'lt', 'lv', 'mk', 'ml', 'mr',
             'nb-NO', 'nl', 'nn-NO', 'oc', 'pa-IN', 'pl', 'pt-BR', 'pt-PT',
             'rm', 'ro', 'ru', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'ta',
             'te', 'th', 'tr', 'uk', 'vi', 'zh-CN'],
    ],

    'start.mozilla.org' => ['fx36start.lang' => $startpage36],

    'about:healthreport' =>
    [
        'fhr.lang' =>
            ['af', 'an', 'ar', 'as', 'ast', 'az', 'be', 'bg', 'bn-BD',
             'bn-IN', 'br', 'bs', 'ca', 'cs', 'csb', 'cy', 'da', 'de',
             'dsb', 'el', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
             'et', 'eu', 'fa', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd',
             'gl', 'gu-IN', 'he', 'hi-IN', 'hr', 'hsb', 'hu', 'hy-AM',
             'id', 'is', 'it', 'ja', 'ka', 'kk', 'km', 'kn', 'ko', 'ku',
             'lij', 'lt', 'lv', 'mai', 'mk', 'ml', 'mr', 'ms',
             'my', 'nb-NO', 'nl', 'nn-NO', 'oc', 'or', 'pa-IN',
             'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'si',
             'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'sw', 'ta',
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
        'jan2014.lang' => $snippets_main_locales,
        'apr2014.lang' => $snippets_locales,
        'may2014.lang' => $snippets_locales,
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
    ],

    'add-ons' => [
        'worldcup.lang'  => $addons_locales,
        'homefeeds.lang' => $addons_locales
    ],

    'firefox-updater' => [
        'updater.lang'  => $firefox_updater_locales,
    ],

    'firefoxos-marketing' => [
        'screenshots_dolphin.lang'  => ['bn-BD'],
        'screenshots.lang'  => ['cs', 'de', 'el', 'es-ES', 'hr', 'hu',
                                'fr', 'it', 'mk', 'pl', 'pt-BR', 'ro',
                                'sr'],
        'screenshots_tarako.lang'  => ['hi-IN', 'ru', 'ta'],
        'marketplace_l10n_feed.lang' => ['bg', 'bn-BD', 'cs', 'de', 'el', 'es-ES', 'fr', 'hr', 'hu', 'it', 'ja',
                                         'mk', 'pl', 'pt-BR', 'ru', 'sr', 'sr-Latn', 'tr', 'zh-CN'],
    ],
];

$bugzilla_locales =
[
    'ach'   => 'Acholi',
    'af'    => 'Afrikaans',
    'ar'    => 'Arabic',
    'as'    => 'Assamese',
    'ast'   => 'Asturian',
    'az'    => 'Azerbaijani',
    'be'    => 'Belarusian',
    'bg'    => 'Bulgarian',
    'bn-BD' => 'Bengali (Bangladesh)',
    'bn-IN' => 'Bengali (India)',
    'br'    => 'Breton',
    'bs'    => 'Bosnian',
    'ca'    => 'Catalan',
    'cs'    => 'Czech',
    'csb'   => 'Kashubian',
    'cy'    => 'Welsh',
    'da'    => 'Danish',
    'de'    => 'German',
    'dsb'   => 'Lower Sorbian',
    'el'    => 'Greek',
    'en-GB' => 'English (British)',
    'eo'    => 'Esperanto',
    'es-AR' => 'Spanish (Argentina)',
    'es-CL' => 'Spanish (Chile)',
    'es-ES' => 'Spanish (Spain)',
    'es-MX' => 'Spanish (Mexico)',
    'et'    => 'Estonian',
    'eu'    => 'Basque',
    'fa'    => 'Persian',
    'ff'    => 'Fulah',
    'fi'    => 'Finnish',
    'fr'    => 'French',
    'fy-NL' => 'Frisian',
    'ga-IE' => 'Irish (Ireland)',
    'gd'    => 'Gaelic (Scotland)',
    'gl'    => 'Galician',
    'gu-IN' => 'Gujarati',
    'he'    => 'Hebrew',
    'hi-IN' => 'Hindi (India)',
    'hr'    => 'Croatian',
    'hsb'   => 'Upper Sorbian',
    'hu'    => 'Hungarian',
    'hy-AM' => 'Armenian',
    'id'    => 'Indonesian',
    'is'    => 'Icelandic',
    'it'    => 'Italian',
    'ja'    => 'Japanese',
    'ka'    => 'Georgian',
    'kk'    => 'Kazakh',
    'km'    => 'Khmer',
    'kn'    => 'Kannada',
    'ko'    => 'Korean',
    'ku'    => 'Kurdish',
    'lg'    => 'Luganda',
    'lij'   => 'Ligurian',
    'lt'    => 'Lithuanian',
    'lv'    => 'Latvian',
    'mai'   => 'Maithili',
    'mk'    => 'Macedonian',
    'ml'    => 'Malayalam',
    'mr'    => 'Marathi',
    'ms'    => 'Malay',
    'my'    => 'Burmese',
    'nb-NO' => 'Norwegian (Bokmål)',
    'nl'    => 'Dutch',
    'nn-NO' => 'Norwegian (Nynorsk)',
    'nso'   => 'Northern Sotho',
    'oc'    => 'Occitan (Lengadocian)',
    'or'    => 'Oriya',
    'pa-IN' => 'Punjabi',
    'pl'    => 'Polish',
    'pt-BR' => 'Portuguese (Brazilian)',
    'pt-PT' => 'Portuguese (Portugal)',
    'rm'    => 'Romansh',
    'ro'    => 'Romanian',
    'ru'    => 'Russian',
    'si'    => 'Sinhala',
    'sk'    => 'Slovak',
    'sl'    => 'Slovenian',
    'sq'    => 'Albanian',
    'sr'    => 'Serbian',
    'sv-SE' => 'Swedish',
    'sw'    => 'Swahili',
    'ta'    => 'Tamil',
    'ta-LK' => 'Tamil (Sri Lanka)',
    'te'    => 'Telugu',
    'th'    => 'Thai',
    'tr'    => 'Turkish',
    'uk'    => 'Ukrainian',
    'ur'    => 'Urdu',
    'uz'    => 'Uzbek',
    'vi'    => 'Vietnamese',
    'xh'    => 'Xhosa',
    'wo'    => 'Wolof',
    'zh-CN' => 'Chinese (Simplified)',
    'zh-TW' => 'Chinese (Traditional)',
    'zu'    => 'Zulu',
];
