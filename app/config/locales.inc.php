<?php

/*
    $mozilla is the list of all locales supported on Langchecker.
    Don't forget to update other relevant arrays in this file when adding
    new locales.
*/
$mozilla = [
    'ach', 'af', 'an', 'ar', 'as', 'ast', 'az', 'be', 'bg',
    'bm', 'bn-BD', 'bn-IN', 'br', 'brx', 'bs', 'ca', 'cak',
    'cs', 'cy', 'da', 'de', 'dsb', 'ee', 'el', 'en-GB', 'en-ZA',
    'eo', 'es', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'et', 'eu',
    'fa', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gn',
    'gu-IN', 'ha', 'he', 'hi-IN', 'hr', 'hsb', 'hto', 'hu',
    'hy-AM', 'id', 'ig', 'is', 'it', 'ja', 'ka', 'kk', 'km',
    'kn', 'ko', 'kok', 'ks', 'lij', 'ln', 'lo', 'lt', 'ltg',
    'lv', 'mai', 'mg', 'mk', 'ml', 'mr', 'ms', 'my', 'nb-NO',
    'ne-NP', 'nl', 'nn-NO', 'oc', 'or', 'pa-IN', 'pbb', 'pl',
    'pt-BR', 'pt-PT', 'qvi', 'rm', 'ro', 'ru', 'sat', 'si',
    'sk', 'sl', 'son', 'sq', 'sr', 'sr-Latn', 'sv-SE', 'sw',
    'ta', 'te', 'th', 'tl', 'tn', 'tr', 'trs', 'uk',
    'ur', 'uz', 'vi', 'wo', 'xh', 'yo', 'zh-CN', 'zh-TW', 'zu',
];
sort($mozilla);

/*
    $mozillaorg is the list of locales supported on mozilla.org
    Remove locales not supported on mozilla.org from the full array
*/
$mozillaorg = array_diff($mozilla, ['en-ZA', 'es', 'sr-Latn']);

// List of locales only working on Firefox OS
$fxos_locales = [
    'bm', 'ee', 'es', 'ha', 'ig', 'ln', 'mg', 'sr-Latn',
    'sw', 'tl', 'tn', 'wo', 'yo',
];

// List of locales only working on Fennec
$fennec_locales = [
    'cak', 'hto', 'lo', 'my', 'pbb', 'qvi', 'trs',
];

/*
    List of locales we support on desktop (Firefox). We need to remove
    locales used only for Gaia (es, sr-Latn), locales working only on Gaia
    (e.g. new African locales) or Fennec
*/
$firefox_locales = array_diff(
    $mozilla,
    $fxos_locales,
    $fennec_locales
);

// All locales working on Firefox desktop + Android
$firefox_desktop_android = array_merge($firefox_locales, $fennec_locales);

/*
    source: https://raw.githubusercontent.com/mozilla/firefox-ios/v3.x/shipping_locales.txt
    translations are at: https://github.com/mozilla-l10n/firefoxios-l10n/
    For iOS we used the locale code es for Spanish from Spain, that was a
    mistake, this is why I changed it to es-ES in the array below, otherwise
    the Spanish team would have to work in the es-ES folder for Android and
    the es folder for iOS
    Make sure to update the store_l10n project when you update this list:
    https://github.com/mozilla-l10n/stores_l10n/blob/15633f598a78357575630fdc235f9cbccc4c6ed3/app/classes/Stores/Project.php#L43
*/
$ios_locales = [
    'az', 'bg', 'br', 'cs', 'cy', 'da', 'de', 'dsb', 'eo',
    'es-ES', 'es-CL', 'es-MX', 'fr', 'fy-NL', 'ga-IE', 'gd',
    'hsb', 'id', 'is', 'it', 'ja', 'kk', 'km', 'ko', 'lo',
    'lt', 'lv', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-BR', 'pt-PT',
    'rm', 'ro', 'ru', 'sk', 'sl', 'sv-SE', 'th', 'tl', 'tr',
    'uk', 'uz', 'zh-CN', 'zh-TW',
];

/*
    Source: https://l10n.mozilla-community.org/~pascalc/stores_l10n/api/apple/localesmapping/?reverse
    Locales supported by the Apple Store
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
    'an', 'as', 'az', 'be', 'bn-IN', 'br', 'ca', 'cs', 'cy', 'da', 'de',
    'dsb', 'en-GB', 'en-ZA', 'eo', 'es-AR', 'es-ES', 'es-MX', 'et', 'eu',
    'fi', 'ff', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gu-IN', 'hi-IN', 'hr',
    'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'kk', 'kn', 'ko', 'lt',
    'lv', 'mai', 'ml', 'mr', 'ms', 'my', 'nb-NO', 'nl', 'or', 'pa-IN', 'pl',
    'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sv-SE', 'ta',
    'te', 'th', 'tr', 'uk', 'uz', 'zh-CN', 'zh-TW',
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
    'ar', 'ast', 'az', 'be', 'bg', 'bn-BD', 'br', 'ca', 'cs', 'cy',
    'da', 'de', 'dsb', 'el', 'en-GB', 'es-AR', 'es-ES', 'et',
    'eu', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'he', 'hr',
    'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'ko', 'lt',
    'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'pt-PT',
    'rm', 'ro', 'ru', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE',
    'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
];

// List of locales with active newsletter
$newsletter_locales = ['de', 'es-ES', 'fr', 'hu', 'id', 'pl', 'pt-BR', 'ru'];

// List of locales working on Pootle
$locamotion_locales = [
    'ach', 'af', 'bm', 'bn-BD', 'br', 'ca', 'cak', 'cy',
    'ee', 'en-ZA', 'ff', 'ga-IE', 'gn', 'ha', 'hi-IN',
    'hto', 'ig', 'kk', 'km', 'kok', 'ks', 'ln', 'lt',
    'lv', 'mai', 'mg', 'ms', 'ne-NP', 'nb-NO', 'nn-NO',
    'oc', 'or', 'pbb', 'qvi', 'sat', 'son', 'sw', 'ta',
    'tl', 'tn', 'trs', 'ur', 'vi', 'wo', 'xh', 'yo', 'zu',
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
