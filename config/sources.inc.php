<?php

$public_repo1 = 'https://svn.mozilla.org/projects/mozilla-europe.org/trunk/';
$public_repo2 = 'https://svn.mozilla.org/projects/mozilla.com/trunk/';
$public_repo3 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/fx36start/';
$public_repo4 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/surveys/';
$public_repo5 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/marketing/';
$public_repo6 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxhealthreport/';

if ($_SERVER['SERVER_NAME'] == 'l10n.mozilla-community.org') {
    $repo1 = 'http://svn.mozilla.org/projects/mozilla-europe.org/trunk/';
    $repo2 = '/home/pascalc/mozillaorgsvn/';
    $repo3 = '/home/pascalc/startpagesvn/';
    $repo4 = '/home/pascalc/surveys/';
    $repo5 = '/home/pascalc/marketing/';
    $repo6 = '/home/pascalc/firefoxhealthreport/';
    $root  = '/home/pascalc/public_html/langchecker/';
    include __DIR__ . '/../../webdashdata/data.locales.php';
    $mozilla = array_diff($mozillaorg, array('en-GB', 'es',));
    $mozillaorg = array_diff($mozillaorg, array('en-GB', 'es', 'lg', 'nn-NO', 'sw'));
} else {
    $repo1 = 'http://localhost/svnprojects/europeUS/';
    $repo2 = '/home/pascalc/repos/svn/mozillaorg/trunk/';
    $repo3 = '/home/pascalc/repos/svn/l10n-misc/fx36start/locale/';
    $repo4 = '/home/pascalc/repos/svn/l10n-misc/surveys/';
    $repo5 = '/home/pascalc/repos/svn/l10n-misc/marketing/';
    $repo6 = '/home/pascalc/repos/svn/l10n-misc/firefoxhealthreport/';
    $root  = $_SERVER['DOCUMENT_ROOT'] . '/dev/langchecker/';
    include __DIR__ . '/locales.inc.php';
    $mozillaorg = array_diff($mozilla, array('en-GB', 'es', 'lg', 'nn-NO', 'sw'));
}

$cache_path = $root.'cache/';

// no cache
$seconds = 1;

$mozillaorg_lang = array(
    'main.lang'                             => true,
    'download_button.lang'                  => true,
    'snippets.lang'                         => false,
    'newsletter.lang'                       => true,
    'download.lang'                         => true,
    'firefoxtesting.lang'                   => true,
    'euballot.lang'                         => false,
    'foundationsection.lang'                => false,
    'firefoxlive.lang'                      => false,
    'firefoxflicks.lang'                    => false,
    'mobile.lang'                           => true,
    'mozspaces.lang'                        => false,
    'upgradedialog.lang'                    => true,
    'upgradepromos.lang'                    => false,
    'esr.lang'                              => false,
    'channelsposter.lang'                   => false,
    'marketplace/partners.lang'             => false,
    'marketplace/marketplace.lang'          => true,
    'mozorg/contribute.lang'                => false,
    'mozorg/contribute-form.lang'           => false,
    'firefox/whatsnew.lang'                 => true,
    'videos/video_fx13.lang'                => false,
    'videos/video_evernote.lang'            => false,
    'videos/video_box.lang'                 => false,
    'videos/video_teambox.lang'             => false,
    'videos/video_kicksend.lang'            => false,
    'videos/video_mobbase.lang'             => false,
    'foundation/annualreport/2011.lang'     => false,
    'foundation/annualreport/2011faq.lang'  => false,
    'firefoxos/firefoxos.lang'              => true,
    'firefox/partners/index.lang'           => true,
    'tabzilla/tabzilla.lang'                => false,
    'mozorg/15years.lang'                   => false,
    'firefox/os/prelaunch.lang'             => true,
    'firefox/os/index.lang'                 => true,
    'firefox/new.lang'                      => true,
    'firefox/update.lang'                   => true,
    'mozorg/about/manifesto.lang'           => false,
    'mozorg/plugincheck.lang'               => true,
);

$firefoxhealthreport_lang = array(
    'fhr.lang'  => true,
);

$sites = array(

    0 => array( 'www.mozilla.org',
                $repo2,
                'locales/',
                $mozilla,
                array_keys($mozillaorg_lang),
                $cache_path .'mozilla',
                'en-GB', // source locale
                $public_repo2,
                ),

    1 => array( 'start.mozilla.org',
                $repo3,
                'locale/',
                $startpage36,
                array('fx36start.lang'),
                $cache_path .'mozilla',
                'en-US', // source locale
                $public_repo3,
                ),

    2 => array( 'surveys',
                $repo4,
                '',
                $surveys,
                array('survey1.lang', 'survey2.lang', 'survey3.lang', 'survey4.lang', 'survey5.lang', ),
                $cache_path .'mozilla',
                'en-GB', // source locale
                $public_repo4,
                ),

    3 => array( 'marketing',
                $repo5,
                '',
                $marketing,
                array('julyevent.lang'),
                $cache_path .'mozilla',
                'en-US', // source locale
                $public_repo5,
                ),

    4 => array( 'about:healthreport',
                $repo6,
                'locale/',
                $mozilla,
                array_keys($firefoxhealthreport_lang),
                $cache_path .'mozilla',
                'en-US', // source locale
                $public_repo6,
                ),

    //~ 1 => array( 'europe.mozilla.org',
                //~ $repo1,
                //~ '/l10n/',
                //~ $mozilla_europe,
                //~ array('main.lang'),
                //~ $cache_path .'europe',
                //~ 'en', // source locale
                //~ $public_repo1
                //~ ),
);

$langfiles_subsets = array(
    'www.mozilla.org' => array(
        'foundationsection.lang'               => array('de', 'cs', 'fr', 'es-ES', 'gl', 'hu',
                                                         'id', 'it', 'nl', 'pl', 'sl', 'sq',
                                                         'tr', 'zh-CN', 'zh-TW'),
        'firefoxlive.lang'                     => array('ar', 'de', 'fa', 'fr', 'es-ES', 'gl',
                                                         'hr', 'hu', 'ko', 'pl', 'pt-BR', 'rm',
                                                         'ro', 'ru', 'sk', 'sl', 'sq', 'tr',
                                                         'zh-CN', 'zh-TW' ),
        'firefoxflicks.lang'                   => array('ar', 'bg', 'de', 'fa', 'fr', 'gl',
                                                         'es-ES', 'hu', 'id', 'it', 'ja',
                                                         'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW'),
        'mozspaces.lang'                       => array('de', 'fr',),
        'mobile.lang'                          => array('be', 'ca', 'cs', 'da', 'de', 'es-AR',
                                                         'es-ES', 'et', 'eu', 'fr',  'fy-NL',
                                                         'ga-IE', 'gd', 'gl', 'he', 'hu', 'id',
                                                         'it', 'ja', 'ko', 'lt', 'nb-NO', 'nl',
                                                         'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'ro',
                                                         'ru', 'sk', 'sl', 'sq', 'sr', 'th',
                                                         'tr', 'zh-CN', 'zh-TW'),
        'upgradepromos.lang'                   => array('de', 'es-ES', 'fr', 'it', 'pl', 'ru', 'pt-BR'),
        'upgradedialog.lang'                   => $startpage36,
        'download.lang'                        => $mozilla,
        'firefox/new.lang'                     => $mozilla,
        'firefox/updates.lang'                 => $mozilla,
        'euballot.lang'                        => array('bg', 'hr', 'cs', 'da', 'nl', 'en-GB',
                                                         'et', 'fi', 'fr', 'de', 'el', 'hu', 'it',
                                                         'lv', 'lt', 'nb-NO', 'pl', 'pt-PT', 'ro',
                                                         'sk', 'sl', 'es-ES', 'sv-SE'),
        'firefoxtesting.lang'                  => $mozilla,
        'main.lang'                            => $mozillaorg,
        'download_button.lang'                 => $mozillaorg,
        'mozorg/plugincheck.lang'              => $mozillaorg,
        'snippets.lang'                        => $mozillaorg,
        'newsletter.lang'                      => $mozillaorg,
        'firefox/whatsnew.lang'                => $mozillaorg,
        'videos/video_fx13.lang'               => $mozillaorg,
        'tabzilla/tabzilla.lang'               => $mozillaorg,
        'esr.lang'                             => array('de', 'fr'),
        'channelsposter.lang'                  => array('pt-BR'),
        'videos/video_evernote.lang'           => array('es-ES', 'pt-BR'),
        'videos/video_box.lang'                => array('es-ES', 'pt-BR'),
        'videos/video_teambox.lang'            => array('es-ES', 'pt-BR'),
        'videos/video_kicksend.lang'           => array('es-ES', 'pt-BR'),
        'videos/video_mobbase.lang'            => array('es-ES', ),
        'marketplace/marketplace.lang'         => array('fr', 'es-ES', 'pl', 'pt-BR'),
        'marketplace/partners.lang'            => array('fr', 'es-ES', 'pt-BR'),
        'mozorg/about/manifesto.lang'          => array('ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'de', 'el', 'es-AR',
                                                        'es-CL', 'es-ES', 'es-MX', 'eu', 'fi', 'fr', 'fur',
                                                        'fy-NL', 'gl', 'hr', 'hu', 'id', 'it', 'ja', 'ko',
                                                        'mk', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk',
                                                        'sl', 'sq', 'sr', 'sv-SE', 'tr', 'vi', 'zh-CN', 'zh-TW'),
        'mozorg/contribute.lang'               => array('bs', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fr', 'hr', 'fy-NL', 'he', 'hi-IN', 'hr', 'id', 'it', 'lg', 'lt', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sl', 'sq', 'sr', 'sw', 'ta', 'tr', 'vi', 'zh-CN', 'zh-TW'),
        'foundation/annualreport/2011.lang'    => array('ar', 'ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
                                                        'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
                                                        'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
                                                        'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'),
        'foundation/annualreport/2011faq.lang' => array('ar', 'ast', 'cs', 'csb', 'de', 'el', 'eo', 'es-AR',
                                                        'es-CL', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it',
                                                        'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR', 'sq',
                                                        'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW'),
        'firefoxos/firefoxos.lang'             => array('fr', 'es-AR', 'es-ES', 'fy-NL', 'nl', 'pl', 'pt-BR'),
        'mozorg/15years.lang'                  => array('ar', 'cs', 'cy', 'de', 'el', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fr', 'hr', 'fy-NL', 'hi-IN', 'id', 'it', 'lg', 'ms', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sl', 'sq', 'sr', 'zh-CN', 'zh-TW'),
        'firefox/partners/index.lang'          => array('ca', 'de', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fr', 'it',
                                                         'ja', 'ko', 'pl', 'pt-BR', 'zh-CN', 'zh-TW'),
        'firefox/os/prelaunch.lang'          => array('es-ES', 'pl'),
        'firefox/os/index.lang'              => array('cs', 'de', 'el', 'es-ES', 'fr', 'hu', 'pl', 'pt-BR', 'ro', 'sr'),

        // 'mozorg/contribute-form.lang'    => array('es-ES', 'fr', 'he', 'hr', 'lt', 'pt-BR', 'sq'),
        ),

    'start.mozilla.org' => array(
        'fx36start.lang' => $startpage36,
        ),

    'about:healthreport' => array(
        //~ 'fhr.lang' => $mozilla,
        'fhr.lang' => array('af', 'an','ar','as','ast','be','bg','bn-BD','bn-IN','br','bs','ca','cs','csb','cy','da','de','el','en-GB','eo','es-AR','es-CL','es-ES','es-MX','et','eu','fa','ff','fi','fr','fy-NL','ga-IE','gd','gl','gu-IN','he','hi-IN','hr','hu','hy-AM','id','is','it','ja','ka','kk','km','kn','ko','ku','lg','lij','lt','lv','mai','mk','ml','mn','mr','ms','my','nb-NO','nl','nn-NO','nso','oc','or','pa-IN','pl','pt-BR','pt-PT','rm','ro','ru','sah','si','sk','sl','son','sq','sr','sv-SE','sw','ta','ta-LK','te','th','tr','uk','ur','vi','wo','zh-CN','zh-TW','zu'),
        ),

    'surveys' => array(
        'survey1.lang' => array('de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN', ),
        'survey2.lang' => array('de', 'es-ES', 'fr',  'it', 'pl', 'pt-BR', 'ru', ),
        'survey3.lang' => array('de', 'es-ES', 'fr', 'it', 'ja', 'ko', 'pl', 'pt-BR', 'ru', 'zh-CN', 'zh-TW'),
        'survey4.lang' => array('de', 'es-AR', 'es-ES', 'es-MX', 'fr', 'id', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN'),
        'survey5.lang' => array('de', 'fr', 'pl',),
        ),

    'marketing' => array(
        'julyevent.lang' => array('de', 'es-ES', 'fr', 'it', 'id', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW'),
        ),
);


$bugzilla_locales = array(
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
);
