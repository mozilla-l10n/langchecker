<?php

/*
    $mozilla is the list of all locales supported on Langchecker.
    Don't forget to update other relevant arrays in this file when adding
    new locales.
*/
$mozilla = [
    'ach', 'af', 'am', 'an', 'ar', 'as', 'ast', 'az', 'bg', 'bn-BD', 'bn-IN', 'br',
    'bs', 'ca', 'cak', 'cs', 'cy', 'da', 'de', 'dsb', 'el', 'en-GB', 'en-ZA',
    'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'es', 'et', 'eu', 'fa', 'ff',
    'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gn', 'gu-IN', 'he', 'hi-IN',
    'hr', 'hsb', 'hto', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'ka', 'kab',
    'kk', 'km', 'kn', 'ko', 'lij', 'lo', 'lt', 'ltg', 'lv', 'mai', 'mk', 'ml',
    'mr', 'ms', 'my', 'nb-NO', 'ne-NP', 'nl', 'nn-NO', 'nv', 'oc', 'or', 'pa-IN',
    'pbb', 'pl', 'pt-BR', 'pt-PT', 'qvi', 'rm', 'ro', 'ru', 'si', 'sk', 'sl',
    'son', 'sq', 'sr', 'sv-SE', 'ta', 'te', 'th', 'tl', 'tr', 'trs', 'uk',
    'ur', 'uz', 'vi', 'xh', 'zh-CN', 'zh-TW', 'zu',
];
sort($mozilla);

/*
    $mozillaorg is the list of locales supported on mozilla.org
    Remove locales not supported on mozilla.org from the full array
*/
$mozillaorg = array_diff($mozilla, ['es']);

// List of locales only working on Fennec
$fennec_locales = [
    'cak', 'hto', 'lo', 'pbb', 'qvi', 'trs',
];

// List of locales only working on mozilla.org
$mozorg_locales = [
    'am', 'nv',
];

/*
    List of locales we support on desktop (Firefox). We need to remove
    locales used only for Gaia (es, sr-Latn), locales working only on Gaia
    (e.g. new African locales) or Fennec
*/
$firefox_locales = array_diff(
    $mozilla,
    $fennec_locales,
    ['es']
);

// All locales working on Firefox desktop + Android
$firefox_desktop_android = array_merge($firefox_locales, $fennec_locales);

/*
    source: https://raw.githubusercontent.com/mozilla/firefox-ios/v6.x/shipping_locales.txt
    translations are at: https://github.com/mozilla-l10n/firefoxios-l10n/
    Make sure to update the store_l10n project when you update this list:
    https://github.com/mozilla-l10n/stores_l10n/blob/15633f598a78357575630fdc235f9cbccc4c6ed3/app/classes/Stores/Project.php#L43
*/
$ios_locales = [
    'ast', 'az', 'bg', 'bn-BD', 'br', 'ca', 'cs', 'cy', 'da', 'de', 'dsb',
    'en-GB', 'en-US', 'eo', 'es', 'es-CL', 'es-MX', 'eu', 'fr', 'fy-NL',
    'ga-IE', 'gd', 'he', 'hsb', 'hu', 'id', 'is', 'it', 'ja', 'kab', 'kk', 'km',
    'ko', 'lo', 'lt', 'lv', 'nb-NO', 'ne-NP', 'nl', 'nn-NO', 'pl', 'pt-BR',
    'pt-PT', 'rm', 'ro', 'ru', 'ses', 'sk', 'sl', 'sv-SE', 'te', 'th', 'tl',
    'tr', 'uk', 'uz', 'zh-CN', 'zh-TW',
];
/*
    Some changes are needed from the raw list of locales:
    * es -> es-ES
    * ses -> son
    * drop en-US
*/
$ios_locales = array_diff($ios_locales, ['es', 'en-US', 'ses']);
$ios_locales = array_merge($ios_locales, ['es-ES', 'son']);
sort($ios_locales);

/*
    Source: https://l10n.mozilla-community.org/stores_l10n/api/apple/localesmapping/?reverse
    Locales supported by the Apple Store
    See also https://developer.apple.com/library/content/documentation/LanguagesUtilities/Conceptual/iTunesConnect_Guide/Appendices/AppStoreTerritories.html
*/
$apple_store_locales = [
    'da', 'de', 'el', 'en-GB', 'es-ES', 'es-MX', 'fi', 'fr', 'id',
    'it', 'ja', 'ko', 'ms', 'nb-NO', 'nl', 'pt-BR', 'pt-PT', 'ru',
    'sv-SE', 'th', 'tr', 'vi', 'zh-CN', 'zh-TW',
];

// Locales that we do support and that Apple Store supports too
$apple_store_target = array_intersect($ios_locales, $apple_store_locales);

/*
    Source : http://hg.mozilla.org/releases/mozilla-release/raw-file/tip/mobile/android/locales/maemo-locales
    Source : http://hg.mozilla.org/releases/mozilla-beta/raw-file/tip/mobile/android/locales/maemo-locales
    Source : http://hg.mozilla.org/releases/mozilla-aurora/raw-file/tip/mobile/android/locales/maemo-locales
    When updating, make sure to update store_l10n project as well:
    https://github.com/mozilla-l10n/stores_l10n/blob/15633f598a78357575630fdc235f9cbccc4c6ed3/app/classes/Stores/Project.php#L16
*/
$android_locales = [
    'an', 'as', 'ast', 'az', 'bn-IN', 'br', 'ca', 'cak', 'cs', 'cy', 'da', 'de',
    'dsb', 'en-GB', 'en-ZA', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'et',
    'eu', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gn', 'gu-IN',
    'hi-IN', 'hr', 'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'ka', 'kk',
    'kn', 'ko', 'lt', 'lv', 'mai', 'ml', 'mr', 'ms', 'my', 'nb-NO', 'nl',
    'nn-NO', 'or', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sk',
    'sl', 'son', 'sq', 'sr', 'sv-SE', 'ta', 'te', 'th', 'tr', 'uk', 'uz', 'xh',
    'zh-CN', 'zh-TW',
];

// List provided by Release-drivers, needs access to a Google Play publishing account
$google_play_locales = [
    'af', 'ar', 'be', 'bg', 'cs', 'ca', 'da', 'de', 'el', 'en-GB',
    'es-MX', 'es-ES', 'et', 'fa', 'fi', 'fr', 'hi-IN', 'hu', 'hr',
    'id', 'it', 'he', 'ja', 'ko', 'lt', 'lv', 'ms', 'nl', 'nb-NO',
    'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sk', 'sl', 'sr',
    'sv-SE', 'sw', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW', 'zu',
];

// Locales that we do support and that Google Play supports too
$google_play_target = array_intersect($android_locales, $google_play_locales);

/*
    Thunderbird locales on Release channel
    Source: http://hg.mozilla.org/releases/comm-release/raw-file/tip/mail/locales/shipped-locales
*/
$thunderbird_locales = [
    'ar', 'ast', 'az', 'bg', 'bn-BD', 'br', 'ca', 'cs', 'cy',
    'da', 'de', 'dsb', 'el', 'en-GB', 'es-AR', 'es-ES', 'et',
    'eu', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'he', 'hr',
    'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'ko', 'lt',
    'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'pt-PT',
    'rm', 'ro', 'ru', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE',
    'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
];

// List of locales with active newsletter
$newsletter_locales = [
    'bg', 'cs', 'de', 'es-ES', 'fr', 'hu', 'id', 'it', 'nl',
    'pl', 'pt-BR', 'ru',
];

// List of locales working on Pootle
$locamotion_locales = [
    'ach', 'af', 'bm', 'bn-BD', 'br', 'ca', 'cak', 'cy', 'ee',
    'en-ZA', 'ff', 'ga-IE', 'gn', 'ha', 'hi-IN', 'hto', 'ig',
    'kk', 'ln', 'lt', 'lv', 'mai', 'mg', 'nb-NO',
    'ne-NP', 'nn-NO', 'nv', 'oc', 'or', 'pbb', 'qvi', 'son',
    'sw', 'ta', 'tn', 'trs', 'ur', 'wo', 'xh', 'yo', 'zu',
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
