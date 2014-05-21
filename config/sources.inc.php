<?php

$public_repo1 = 'https://svn.mozilla.org/projects/mozilla.com/trunk/';
$public_repo2 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/fx36start/';
$public_repo3 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/surveys/';
$public_repo4 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/marketing/';
$public_repo5 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxhealthreport/';
$public_repo6 = 'https://svn.mozilla.org/projects/granary/slogans/';
$public_repo7 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/snippets/';

// this is to avoid a warning in shell mode
if (!isset($_SERVER['SERVER_NAME'])) {
    $_SERVER['SERVER_NAME'] = '';
}

require __DIR__ . '/settings.inc.php';
include __DIR__ . '/adu.inc.php';

$locamotion_locales = ['ach', 'af', 'cy', 'dsb', 'en-ZA', 'es-MX', 'ff', 'gd', 'hi-IN',
                       'hsb', 'km', 'ku', 'ms', 'my', 'oc', 'son', 'ur', 'vi', 'xh'];

/*
    Locales removed from locamotion import because of commits on SVN
    kk (20130427)
*/


$mozillaorg_flags = [
    'download.lang'                           => [
        'critical' => 'all',
    ],
    'download_button.lang'                    => [
        'critical' => 'all',
    ],
    'esr.lang'                                => [
        'critical' => 'none',
    ],
    'euballot.lang'                           => [
        'critical' => 'none',
    ],
    'firefox/geolocation.lang'                => [
        'critical' => 'none',
    ],
    'firefox/new.lang'                        => [
        'critical' => 'all',
    ],
    'firefox/channel.lang'                    => [
        'critical' => 'all',
    ],
    'firefox/speed.lang'                      => [
        'critical' => 'none',
    ],
    'firefox/os/index.lang'                   => [
        'critical' => 'all',
    ],
    'firefox/os/faq.lang'                     => [
        'critical' => 'none',
    ],
    'firefox/partners/index.lang'             => [
        'critical' => 'all',
    ],
    'firefox/includes/mwc_2014_schedule.lang' => [
        'critical' => 'all',
    ],
    'firefox/desktop/index.lang'              => [
        'critical' => 'all',
    ],
    'firefox/desktop/customize.lang'          => [
        'critical' => 'all',
    ],
    'firefox/desktop/fast.lang'               => [
        'critical' => 'all',
    ],
    'firefox/desktop/trust.lang'              => [
        'critical' => 'all',
    ],
    'firefox/desktop/tips.lang'               => [
        'critical' => 'all',
    ],
    'firefox/sync.lang'                       => [
        'critical' => 'all',
    ],
    'mwc2014_promos.lang'                     => [
        'critical' => 'all',
    ],
    'firefox/whatsnew.lang'                   => [
        'critical' => 'all',
    ],
    'firefox/installer-help.lang'             => [
        'critical' => 'all',
    ],
    'firefox/australis/firefox_tour.lang'     => [
        'critical' => 'all',
    ],
    'firefoxflicks.lang'                      => [
        'critical' => 'none',
    ],
    'firefoxlive.lang'                        => [
        'critical' => 'none',
    ],
    'firefoxos/firefoxos.lang'                => [
        'critical' => 'all',
    ],
    'firefoxtesting.lang'                     => [
        'critical' => 'all',
    ],
    'foundation/annualreport/2011.lang'       => [
        'critical' => 'none',
    ],
    'foundation/annualreport/2011faq.lang'    => [
        'critical' => 'all',
    ],
    'foundation/annualreport/2012/index.lang' => [
        'critical' => 'all',
    ],
    'foundation/annualreport/2012/faq.lang'   => [
        'critical' => 'none',
    ],
    'foundationsection.lang'                  => [
        'critical' => 'none',
    ],
    'lightbeam/lightbeam.lang'                => [
        'critical' => 'none',
    ],
    'main.lang'                               => [
        'critical' => 'all',
    ],
    'marketplace/marketplace.lang'            => [
        'critical' => 'all',
    ],
    'marketplace/partners.lang'               => [
        'critical' => 'none',
    ],
    'mobile.lang'                             => [
        'critical' => 'all',
    ],
    'mozorg/15years.lang'                     => [
        'critical' => 'none',
    ],
    'mozorg/about.lang'                       => [
        'critical' => 'none',
    ],
    'mozorg/about/manifesto.lang'             => [
        'critical' => 'none',
    ],
    'mozorg/about/history.lang'               => [
        'critical' => 'none',
    ],
    'mozorg/about/history-details.lang'       => [
        'critical' => 'none',
    ],
    'mozorg/mission.lang'                     => [
        'critical' => 'none',
    ],
    'mozorg/contribute.lang'                  => [
        'critical' => 'none',
    ],
    'mozorg/plugincheck.lang'                 => [
        'critical' => 'all',
    ],
    'mozorg/products.lang'                    => [
        'critical' => 'none',
    ],
    'mozorg/home.lang'                        => [
        'critical' => 'all',
    ],
    'mozspaces.lang'                          => [
        'critical' => 'none',
    ],
    'newsletter.lang'                         => [
        'critical' => 'all',
    ],
    'privacy/privacy-day.lang'                => [
        'critical' => 'none',
    ],
    'snippets.lang'                           => [
        'critical' => 'none',
    ],
    'tabzilla/tabzilla.lang'                  => [
        'critical' => 'none',
    ],
    'upgradedialog.lang'                      => [
        'critical' => 'all',
    ],
    'upgradepromos.lang'                      => [
        'critical' => 'none',
    ],
    'firefox/nightly_firstrun.lang'           => [
        'critical' => 'none',
    ],
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
    //'firefox/windows-8-touch.lang',
];


$deadline = [
    // Australis release
    'firefox/desktop/index.lang'          => '2014-05-27', // was 2014-04-27
    'firefox/desktop/customize.lang'      => '2014-05-27', // was 2014-04-27
    'firefox/desktop/fast.lang'           => '2014-05-27', // was 2014-04-27
    'firefox/desktop/trust.lang'          => '2014-05-27', // was 2014-04-27
    'firefox/desktop/tips.lang'           => '2014-05-20', // was 2014-04-20
    'firefox/sync.lang'                   => '2014-05-27', // was 2014-04-27
    'apr2014.lang'                        => '2014-04-27',
    'may2014.lang'                        => '2014-05-20',
    'mozorg/home.lang'                    => '2014-04-27',
    'tabzilla/tabzilla.lang'              => '2014-04-27',
    'firefox/australis/firefox_tour.lang' => '2014-04-27',
    'mozorg/plugincheck.lang'             => '2013-12-31',
    'download_button.lang'                => '2013-12-31',
    'firefox/new.lang'                    => '2013-12-31',
    'firefox/channel.lang'                => '2013-12-31',
    'firefox/whatsnew.lang'               => '2013-12-31',
    'firefox/installer-help.lang'         => '2013-12-31',
    'mozorg/about.lang'                   => '2013-12-31',
    'mozorg/about/manifesto.lang'         => '2013-12-31',
    'mozorg/mission.lang'                 => '2013-12-31',
    'mozorg/products.lang'                => '2013-12-31',
];

$firefoxhealthreport_lang = ['fhr.lang' => true];

$slogans_lang = [
    'firefoxos.lang' => true,
    'marketplacebadge.lang' => true
];

$snippets_lang = [
    'jan2014.lang' => true,
    'apr2014.lang' => true,
    'may2014.lang' => true,
];

$slogans_locales = ['bg', 'ca', 'cs', 'de', 'el', 'el', 'es-ES', 'fr', 'hu', 'hr', 'it',
                    'ja', 'ko',  'pl', 'pt-BR', 'ro', 'sr', 'sr-Latn', 'zh-CN', 'zh-TW'];

$marketplacebadge_locales = ['bg', 'bn-BD', 'ca', 'cs', 'de', 'el', 'es-ES', 'hr', 'hu', 'it',
                             'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sr', 'sr-Latn', 'tr'];

$snippets_locales = ['cs', 'da', 'de', 'el', 'es-ES', 'fr', 'hu', 'id', 'it', 'ja', 'ko',
                     'nb-NO', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sr', 'zh-CN',
                     'zh-TW'];

$snippets_main_locales = ['cs', 'de', 'el', 'es-ES', 'fr', 'hu', 'id', 'it', 'ja', 'ko',
                          'pl', 'pt-BR', 'ru', 'sr', 'vi', 'zh-CN', 'zh-TW'];

$sites =
[
    0 => [
        'www.mozilla.org',
        $repo1,
        'locales/',
        $mozilla,
        array_keys($mozillaorg_flags),
        'en-GB', // source locale
        $public_repo1,
    ],

    1 => [
        'start.mozilla.org',
        $repo2,
        'locale/',
        $startpage36,
        ['fx36start.lang'],
        'en-US', // source locale
        $public_repo2,
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
    ],

    3 => [
        'marketing',
        $repo4,
        '',
        $marketing,
        ['julyevent.lang'],
        'en-US', // source locale
        $public_repo4,
    ],

    4 => [
        'about:healthreport',
        $repo5,
        'locale/',
        $mozilla,
        array_keys($firefoxhealthreport_lang),
        'en-US', // source locale
        $public_repo5,
    ],

    5 => [
        'slogans',
        $repo6,
        '',
        $slogans_locales,
        array_keys($slogans_lang),
        'en-US', // source locale
        $public_repo6,
    ],

    6 => [
        'snippets',
        $repo7,
        '',
        $snippets_locales,
        array_keys($snippets_lang),
        'en-US', // source locale
        $public_repo7,
    ],
];

$mwc_locales =  ['ca', 'cs', 'de', 'es-AR', 'el', 'es-CL', 'es-ES', 'es-MX',
 'fr', 'hu', 'it', 'ja', 'ko', 'pl', 'pt-BR', 'ro', 'sr', 'zh-CN', 'zh-TW'];

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
        'firefox/os/index.lang'                 =>
            ['ca' ,'cs', 'de', 'el', 'es-ES', 'et', 'fr', 'fy-NL', 'hr', 'hu', 'ja', 'it', 'nl', 'pl', 'pt-BR', 'ro', 'sr'],
        'firefox/os/faq.lang'                   =>
            ['ca' ,'cs', 'de', 'el', 'es-ES', 'et', 'fr', 'hr', 'hu', 'ja', 'it', 'pl', 'pt-BR', 'ro', 'sr'],
        'firefox/partners/index.lang'           => $mwc_locales,
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
        'foundation/annualreport/2012/index.lang'     =>
            ['ar', 'ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
             'ja', 'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
             'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2012/faq.lang'     =>
            ['ar', 'ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
             'ja', 'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
             'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundationsection.lang'                =>
            ['de', 'cs', 'fr', 'es-ES', 'gl', 'hu', 'id', 'it', 'nl',
             'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW'],
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
            ['ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'de', 'el', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'eu', 'fi', 'fr', 'fur',
             'fy-NL', 'gl', 'hr', 'hu', 'id', 'it', 'ja', 'ko', 'mk',
             'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq',
             'sr', 'sv-SE', 'tr', 'vi', 'zh-CN', 'zh-TW'],
        'mozorg/about/history.lang'             =>
            ['ar', 'bg', 'ca', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'eu', 'fr', 'hr', 'fy-NL', 'gl', 'id', 'it', 'lt', 'ms', 'nl',
             'pa-IN', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'ta', 'tr',
             'zh-CN', 'zh-TW'],
        'mozorg/about/history-details.lang'     =>
            ['ca', 'de', 'es-CL', 'eu', 'fr', 'gl', 'it', 'pa-IN', 'ro', 'sk', 'sq',
             'zh-TW'],
        'mozorg/contribute.lang'                =>
            ['ar', 'bs', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'fr', 'hr', 'fy-NL', 'he', 'hi-IN', 'hr', 'id',
             'it', 'lt', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sl',
             'sq', 'sr', 'ta', 'tr', 'vi', 'zh-CN', 'zh-TW'],
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
        'firefox/nightly_firstrun.lang'         => ['cs', 'de', 'fr', 'it', 'ru'],
        'firefox/desktop/tips.lang'             =>
            ['ca', 'cs', 'de', 'el', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu',
             'fr', 'gl', 'fy-NL', 'he', 'hu', 'id', 'it', 'ja', 'nl', 'pl',
             'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'zh-CN', 'zh-TW'],
        'firefox/geolocation.lang'             =>
            ['af', 'ar', 'as', 'ast', 'be', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs',
             'cy', 'da', 'de', 'el', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'et', 'eu', 'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd',
             'gl', 'gu-IN', 'he', 'hi-IN', 'hr', 'hu', 'hy-AM', 'id', 'is',
             'it', 'ka', 'kk', 'kn', 'ko', 'ku', 'lt', 'lv', 'mk', 'ml', 'mr',
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
             'te', 'th', 'tr', 'uk', 'ur', 'vi', 'xh', 'zh-CN',
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
    'vi'    => 'Vietnamese',
    'xh'    => 'Xhosa',
    'wo'    => 'Wolof',
    'zh-CN' => 'Chinese (Simplified)',
    'zh-TW' => 'Chinese (Traditional)',
    'zu'    => 'Zulu',
];
