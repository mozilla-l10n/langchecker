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

$locamotion_locales = ['ach', 'af', 'cy', 'en-ZA', 'ff', 'gd', 'hi-IN', 'hsb', 'kk',
                       'km', 'ku', 'ms', 'my', 'oc', 'son', 'ur', 'vi', 'xh'];

$mozillaorg_lang = [
    'download.lang'                           => true,
    'download_button.lang'                    => true,
    'esr.lang'                                => false,
    'euballot.lang'                           => false,
    'firefox/new.lang'                        => true,
    'firefox/channel.lang'                    => true,
    'firefox/speed.lang'                      => false,
    'firefox/os/index.lang'                   => true,
    'firefox/os/faq.lang'                     => false,
    'firefox/partners/index.lang'             => true,
    'firefox/includes/mwc_2014_schedule.lang' => true,
    'firefox/desktop/index.lang'              => true,
    'firefox/desktop/customize.lang'          => true,
    'firefox/desktop/fast.lang'               => true,
    'firefox/desktop/trust.lang'              => true,
    'firefox/sync.lang'                       => true,
    'mwc2014_promos.lang'                     => true,
    'firefox/whatsnew.lang'                   => true,
//    'firefox/windows-8-touch.lang'            => false,
    'firefox/installer-help.lang'             => true,
    'firefox/australis/firefox_tour.lang'     => true,
    'firefoxflicks.lang'                      => false,
    'firefoxlive.lang'                        => false,
    'firefoxos/firefoxos.lang'                => true,
    'firefoxtesting.lang'                     => true,
    'foundation/annualreport/2011.lang'       => false,
    'foundation/annualreport/2011faq.lang'    => true,
    'foundation/annualreport/2012/index.lang' => true,
    'foundation/annualreport/2012/faq.lang'   => false,
    'foundationsection.lang'                  => false,
    'lightbeam/lightbeam.lang'                => false,
    'main.lang'                               => true,
    'marketplace/marketplace.lang'            => true,
    'marketplace/partners.lang'               => false,
    'mobile.lang'                             => true,
    'mozorg/15years.lang'                     => false,
    'mozorg/about.lang'                       => false,
    'mozorg/about/manifesto.lang'             => false,
    'mozorg/mission.lang'                     => false,
    'mozorg/contribute.lang'                  => false,
    'mozorg/plugincheck.lang'                 => true,
    'mozorg/products.lang'                    => false,
    'mozorg/home.lang'                        => true,
    'mozspaces.lang'                          => false,
    'newsletter.lang'                         => true,
    'privacy/ffos_privacy.lang'               => true,
    'privacy/privacy-day.lang'                => false,
    'snippets.lang'                           => false,
    'tabzilla/tabzilla.lang'                  => false,
    'upgradedialog.lang'                      => true,
    'upgradepromos.lang'                      => false,
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
    'firefox/desktop/index.lang'              => '2014-04-27',
    'firefox/desktop/customize.lang'          => '2014-04-27',
    'firefox/desktop/fast.lang'               => '2014-04-27',
    'firefox/desktop/trust.lang'              => '2014-04-27',
    'firefox/sync.lang'                       => '2014-04-27',
    'apr2014.lang'                            => '2014-04-27',
    'firefox/australis/firefox_tour.lang'     => '2014-04-27',

];

$firefoxhealthreport_lang = ['fhr.lang' => true];

$slogans_lang = [
    'firefoxos.lang' => true,
    'marketplacebadge.lang' => true
];

$snippets_lang = [
    'jan2014.lang' => true,
    'apr2014.lang' => true,
];

$slogans_locales = ['bg', 'ca', 'cs', 'de', 'el', 'el', 'es-ES', 'fr', 'hu', 'hr', 'it',
                    'ja', 'ko',  'pl', 'pt-BR', 'ro', 'sr', 'sr-Latn', 'zh-CN', 'zh-TW'];

$marketplacebadge_locales = ['bg', 'bn-BD', 'ca', 'cs', 'de', 'el', 'es-ES', 'hr', 'hu', 'it',
                             'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sr', 'sr-Latn', 'tr'];

$snippets_locales = ['bg', 'cs', 'da', 'de', 'el', 'es-ES', 'fr', 'hu', 'id', 'it', 'ja', 'ko',
                     'nb-NO', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sr', 'vi', 'zh-CN',
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
        array_keys($mozillaorg_lang),
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
            ['ca' ,'cs', 'de', 'el', 'es-ES', 'et', 'fr', 'hr', 'hu', 'ja', 'it', 'pl', 'pt-BR', 'ro', 'sr'],
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
        'mozorg/15years.lang'                   =>
            ['ar', 'bg', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'fr', 'hr', 'fy-NL', 'hi-IN', 'id', 'it', 'lg', 'lt',
             'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sl', 'sq', 'sr', 'ta',
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
        'mozorg/contribute.lang'                =>
            ['ar', 'bs', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'fr', 'hr', 'fy-NL', 'he', 'hi-IN', 'hr', 'id',
             'it', 'lg', 'lt', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru',
             'sl', 'sq', 'sr', 'sw', 'ta', 'tr', 'vi', 'zh-CN', 'zh-TW'],
        'mozorg/plugincheck.lang'               => $mozillaorg,
        'mozorg/products.lang'                  => $mozillaorg,
        'mozspaces.lang'                        => ['de', 'fr'],
        'newsletter.lang'                       => $mozillaorg,
        'privacy/ffos_privacy.lang'             => ['hu', 'it', 'pt-BR', 'sr'],
        'privacy/privacy-day.lang'              =>
            ['ca', 'cs', 'de', 'es-AR', 'es-ES',
            'fr', 'it', 'pl', 'pt-BR', 'zh-TW'],
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
    ],

    'start.mozilla.org' => ['fx36start.lang' => $startpage36],

    'about:healthreport' =>
    [
        'fhr.lang' =>
            ['af', 'an', 'ar', 'as', 'ast', 'az', 'be', 'bg', 'bn-BD',
             'bn-IN', 'br', 'bs', 'ca', 'cs', 'csb', 'cy', 'da', 'de',
             'el', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
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
