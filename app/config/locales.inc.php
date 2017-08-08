<?php

/*
    $mozilla is the list of all locales supported on Langchecker.
    Don't forget to update other relevant arrays in this file when adding
    new locales.
*/
$mozilla = [
    'ach', 'af', 'am', 'an', 'ar', 'as', 'ast', 'az', 'azz', 'be', 'bg', 'bn-BD',
    'bn-IN', 'br', 'bs', 'ca', 'cak', 'cs', 'cy', 'da', 'de', 'dsb', 'el',
    'en-GB', 'en-ZA', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'es', 'et',
    'eu', 'fa', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gn', 'gu-IN',
    'he', 'hi-IN', 'hr', 'hsb', 'hto', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja',
    'ka', 'kab', 'kk', 'km', 'kn', 'ko', 'lij', 'lo', 'lt', 'ltg', 'lv', 'mai',
    'mk', 'ml', 'mr', 'ms', 'my', 'nb-NO', 'ne-NP', 'nl', 'nn-NO', 'nv',
    'oc', 'or', 'pa-IN', 'pai', 'pbb', 'pl', 'pt-BR', 'pt-PT', 'qvi', 'rm', 'ro',
    'ru', 'si', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'sw', 'ta', 'te', 'th', 'tl',
    'tr', 'trs', 'uk', 'ur', 'uz', 'vi', 'wo', 'xh', 'zam', 'zh-CN', 'zh-HK', 'zh-TW',
    'zu',
];
sort($mozilla);

/*
    $mozillaorg is the list of locales supported on mozilla.org
    Remove locales not supported on mozilla.org from the full array
*/
$mozillaorg = array_diff($mozilla, ['es', 'zh-HK']);

// List of locales only working on Fennec
$fennec_locales = [
    'hto', 'pbb', 'qvi', 'trs', 'wo',
];

// List of locales only working on mozilla.org
$mozorg_locales = [
    'am', 'azz', 'nv', 'pai', 'sw',
];

/*
    List of locales we support on desktop (Firefox). We need to remove
    locales used only for Gaia (es, sr-Latn), locales working only on Gaia
    (e.g. new African locales) or Fennec
*/
$firefox_locales = array_diff(
    $mozilla,
    $fennec_locales,
    ['es', 'zh-HK']
);

// All locales working on Firefox desktop + Android
$firefox_desktop_android = array_merge($firefox_locales, $fennec_locales);

/*
    Thunderbird locales on Release channel
    Source: http://hg.mozilla.org/releases/comm-release/raw-file/tip/mail/locales/shipped-locales

    Locales to remove: be, en-US, ta-LK
*/
$thunderbird_locales = [
    'ar', 'ast', 'bg', 'bn-BD', 'br', 'ca', 'cs', 'cy', 'da', 'de', 'dsb',
    'el', 'en-GB', 'es-AR', 'es-ES', 'et', 'eu', 'fi', 'fr', 'fy-NL', 'ga-IE',
    'gd', 'gl', 'he', 'hr', 'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'kab',
    'ko', 'lt', 'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm',
    'ro', 'ru', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE',  'tr', 'uk', 'vi',
    'zh-CN', 'zh-TW',
];

// List of locales with active newsletter
$newsletter_locales = [
    'bg', 'cs', 'de', 'es-ES', 'fr', 'hu', 'id', 'it', 'nl',
    'pl', 'pt-BR', 'ru', 'zh-TW',
];

// List of locales working on Pootle
$locamotion_locales = [
    'af', 'an', 'br', 'cy', 'en-ZA', 'ff', 'ga-IE', 'hi-IN', 'hto',
    'lt', 'mai', 'ne-NP', 'nv', 'or', 'pai', 'pbb', 'qvi', 'son', 'sw', 'ta',
    'trs', 'ur', 'zu',
];

/*
   List of Mozilla's locales supported by SurveyGizmo.
   Ref. http://help.surveygizmo.com/help/article/link/create-a-translated-survey#available-languages
*/
$surveygizmo = [
    'af', 'an', 'ar', 'as', 'az', 'be', 'bg', 'bm', 'bn-IN',
    'br', 'bs', 'ca', 'cs', 'cy', 'da', 'de', 'ee', 'el',
    'en-GB', 'eo', 'es-ES', 'es-MX', 'et', 'eu', 'fa', 'ff',
    'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gu-IN', 'ha',
    'he', 'hi-IN', 'hr', 'hu', 'hy-AM', 'id', 'ig', 'is', 'it',
    'ja', 'ka', 'kk', 'km', 'kn', 'ko', 'ks', 'ln', 'lt',
    'lv', 'mg', 'mk', 'ml', 'mr', 'ms', 'my', 'nb-NO', 'nl',
    'nn-NO', 'oc', 'or', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm',
    'ro', 'ru', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'sw',
    'ta', 'te', 'th', 'tl', 'tn', 'tr', 'uk', 'ur', 'uz',
    'vi', 'wo', 'xh', 'yo', 'zh-CN', 'zh-TW', 'zu',
];
