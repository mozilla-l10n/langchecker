<?php

$public_repo1 = 'https://svn.mozilla.org/projects/mozilla.com/trunk/';
$public_repo2 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/fx36start/';
$public_repo3 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/surveys/';
$public_repo4 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/marketing/';
$public_repo5 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxhealthreport/';
$public_repo6 = 'https://svn.mozilla.org/projects/granary/slogans/';

// this is to avoid a warning in shell mode
if (!isset($_SERVER['SERVER_NAME'])) {
    $_SERVER['SERVER_NAME'] = '';
}

require __DIR__ . '/settings.inc.php';
include __DIR__ . '/adu.inc.php';

$locamotion_locales = ['af', 'ach', 'az', 'cy', 'en-ZA', 'ff', 'gd', 'kk',
'km', 'lg', 'mn', 'ms', 'my', 'oc', 'sah', 'son', 'tr', 'ur', 'vi', 'xh'];

$mozillaorg_lang = [
    'download.lang'                         => true,
    'download_button.lang'                  => true,
    'esr.lang'                              => false,
    'euballot.lang'                         => false,
    'firefox/new.lang'                      => true,
    'firefox/os/index.lang'                 => true,
    'firefox/partners/index.lang'           => true,
    //~ 'firefox/update.lang'                   => true,
    'firefox/whatsnew.lang'                 => true,
    'firefoxflicks.lang'                    => false,
    'firefoxlive.lang'                      => false,
    'firefoxos/firefoxos.lang'              => true,
    'firefoxtesting.lang'                   => true,
    'foundation/annualreport/2011.lang'     => false,
    'foundation/annualreport/2011faq.lang'  => false,
    'foundationsection.lang'                => false,
    'main.lang'                             => true,
    'marketplace/marketplace.lang'          => true,
    'marketplace/partners.lang'             => false,
    'mobile.lang'                           => true,
    'mozorg/15years.lang'                   => false,
    'mozorg/about.lang'                     => false,
    'mozorg/about/manifesto.lang'           => false,
    'mozorg/mission.lang'                   => false,
    'mozorg/contribute.lang'                => false,
    'mozorg/plugincheck.lang'               => true,
    'mozorg/products.lang'                  => false,
    'mozorg/home.lang'                      => true,
    'mozspaces.lang'                        => false,
    'newsletter.lang'                       => true,
    'privacy/ffos_privacy.lang'             => true,
    'snippets.lang'                         => false,
    'tabzilla/tabzilla.lang'                => false,
    'upgradedialog.lang'                    => true,
    'upgradepromos.lang'                    => false,
];

$firefoxhealthreport_lang = ['fhr.lang' => true];

$slogans_lang = [
    'firefoxos.lang' => true,
    'marketplacebadge.lang' => true
];

$slogans_locales = ['bg', 'de', 'cs', 'el', 'es-ES', 'mk', 'hr', 'hu', 'pl', 'pt-BR', 'ro', 'sr', 'sr-Latn', 'sq'];
$marketplacebadge_locales = ['ca', 'cs', 'de', 'el', 'es-ES', 'hr', 'hu', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sr', 'tr'];

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
        ['survey1.lang', 'survey2.lang', 'survey3.lang', 'survey4.lang', 'survey5.lang'],
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
        'firefox/new.lang'                      => $mozilla,
        'firefox/os/index.lang'                 =>
            ['cs', 'de', 'el', 'es-ES', 'fr', 'hu', 'ja', 'it', 'pl', 'pt-BR', 'ro', 'sr'],
        'firefox/partners/index.lang'           =>
            ['ca', 'de', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fr', 'it',
             'ja', 'ko', 'pl', 'pt-BR', 'ro', 'zh-CN', 'zh-TW'],
        //~ 'firefox/update.lang'                   => $mozilla,
        'firefox/whatsnew.lang'                 => $mozillaorg,
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
            ['ar', 'ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
             'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
             'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundation/annualreport/2011faq.lang'  =>
            ['ar', 'ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
             'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
             'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'],
        'foundationsection.lang'                =>
            ['de', 'cs', 'fr', 'es-ES', 'gl', 'hu', 'id', 'it', 'nl',
             'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW'],
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
            ['ar', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'fr', 'hr', 'fy-NL', 'hi-IN', 'id', 'it', 'lg',
             'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sl', 'sq', 'sr',
             'zh-CN', 'zh-TW'],
        'mozorg/about.lang'                     => $mozillaorg,
        'mozorg/home.lang'                      => $mozillaorg,
        'mozorg/mission.lang'                   => ['de', 'fr', 'he'],
        'mozorg/about/manifesto.lang'           =>
            ['ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'de', 'el', 'es-AR',
             'es-CL', 'es-ES', 'es-MX', 'eu', 'fi', 'fr', 'fur',
             'fy-NL', 'gl', 'hr', 'hu', 'id', 'it', 'ja', 'ko', 'mk',
             'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq',
             'sr', 'sv-SE', 'tr', 'vi', 'zh-CN', 'zh-TW'],
        'mozorg/contribute.lang'                =>
            ['bs', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES',
             'es-MX', 'fr', 'hr', 'fy-NL', 'he', 'hi-IN', 'hr', 'id',
             'it', 'lg', 'lt', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru',
             'sl', 'sq', 'sr', 'sw', 'ta', 'tr', 'vi', 'zh-CN', 'zh-TW'],
        'mozorg/plugincheck.lang'               => $mozillaorg,
        'mozorg/products.lang'                  => $mozillaorg,
        'mozspaces.lang'                        => ['de', 'fr'],
        'newsletter.lang'                       => $mozillaorg,
        'privacy/ffos_privacy.lang'             => ['es-ES', 'pl'],
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
            ['af', 'an', 'ar', 'as', 'ast', 'be', 'bg', 'bn-BD',
             'bn-IN', 'br', 'bs', 'ca', 'cs', 'csb', 'cy', 'da', 'de',
             'el', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
             'et', 'eu', 'fa', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd',
             'gl', 'gu-IN', 'he', 'hi-IN', 'hr', 'hu', 'hy-AM', 'id',
             'is', 'it', 'ja', 'ka', 'kk', 'km', 'kn', 'ko', 'ku', 'lg',
             'lij', 'lt', 'lv', 'mai', 'mk', 'ml', 'mn', 'mr', 'ms',
             'my', 'nb-NO', 'nl', 'nn-NO', 'nso', 'oc', 'or', 'pa-IN',
             'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sah', 'si',
             'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'sw', 'ta',
             'ta-LK', 'te', 'th', 'tr', 'uk', 'ur', 'vi', 'wo', 'zh-CN',
             'zh-TW', 'zu'],
    ],

    'surveys' =>
    [
        'survey1.lang' => ['de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN'],
        'survey2.lang' => ['de', 'es-ES', 'fr',  'it', 'pl', 'pt-BR', 'ru'],
        'survey3.lang' => ['de', 'es-ES', 'fr', 'it', 'ja', 'ko', 'pl', 'pt-BR', 'ru', 'zh-CN', 'zh-TW'],
        'survey4.lang' => ['de', 'es-AR', 'es-ES', 'es-MX', 'fr', 'id', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN'],
        'survey5.lang' => ['de', 'fr', 'pl'],
    ],

    'marketing' => ['julyevent.lang' => ['de', 'es-ES', 'fr', 'it', 'id', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW']],

    'slogans' => [
        'firefoxos.lang' => $slogans_locales,
        'marketplacebadge.lang' => $marketplacebadge_locales
    ],
];

$bugzilla_locales =
[
    'ach'   => 'Acholi',
    'af'    => 'Afrikaans',
    'ar'    => 'Arabic',
    'as'    => 'Assamese',
    'ast'   => 'Asturian',
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
    'mn'    => 'Mongolian',
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
    'wo'    => 'Wolof',
    'zh-CN' => 'Chinese (Simplified)',
    'zh-TW' => 'Chinese (Traditional)',
    'zu'    => 'Zulu',
];
