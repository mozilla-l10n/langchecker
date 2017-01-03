<?php

use Cache\Cache;
use Json\Json;

$json_object = new Json;

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

// Locales working on Firefox for iOS (from stores_l10n app)
$cache_id = 'ios_locales';
if (! $ios_locales = Cache::getKey($cache_id, 60 * 60)) {
    $ios_locales = $json_object
        ->setURI(STORES_L10N . 'fx_ios/supportedlocales/release')
        ->fetchContent();
    Cache::setKey($cache_id, $ios_locales);
}

// Locales supported by Apple App Store (from stores_l10n app)
$cache_id = 'apple_store_locales';
if (! $apple_store_locales = Cache::getKey($cache_id, 60 * 60 * 24)) {
    $apple_store_locales = $json_object
        ->setURI(STORES_L10N . 'apple/localesmapping/?reverse')
        ->fetchContent();
    Cache::setKey($cache_id, array_keys($apple_store_locales));
}

// Locales working on Focus for iOS (from stores_l10n app)
$cache_id = 'focus_ios_locales';
if (! $focus_ios_locales = Cache::getKey($cache_id, 60 * 60)) {
    $focus_ios_locales = $json_object
        ->setURI(STORES_L10N . 'focus_ios/supportedlocales/release')
        ->fetchContent();
    Cache::setKey($cache_id, $focus_ios_locales);
}

// Locales that we do support and that Apple Store supports too
$fx_ios_store = array_intersect($ios_locales, $apple_store_locales);
$focus_ios_store = array_intersect($focus_ios_locales, $apple_store_locales);
$apple_store = array_unique(array_merge($fx_ios_store, $focus_ios_store));

// Locales working on Firefox for Android Aurora (from stores_l10n app)
$cache_id = 'fx_android_locales';
if (! $fx_android_locales = Cache::getKey($cache_id, 60 * 60)) {
    $fx_android_locales = $json_object
        ->setURI(STORES_L10N . 'fx_android/supportedlocales/aurora')
        ->fetchContent();
    Cache::setKey($cache_id, $fx_android_locales);
}

// Locales supported by Apple App Store (from stores_l10n app)
$cache_id = 'google_play_locales';
if (! $google_play_locales = Cache::getKey($cache_id, 60 * 60 * 24)) {
    $google_play_locales = $json_object
        ->setURI(STORES_L10N . 'google/localesmapping/?reverse')
        ->fetchContent();
    Cache::setKey($cache_id, array_keys($google_play_locales));
}

// Locales that we support and that Google Play supports too
$fx_android_store = array_intersect($fx_android_locales, $google_play_locales);
$google_play = $fx_android_store;

/*
    Thunderbird locales on Release channel
    Source: http://hg.mozilla.org/releases/comm-release/raw-file/tip/mail/locales/shipped-locales
*/
$thunderbird_locales = [
    'ar', 'ast', 'az', 'bg', 'bn-BD', 'br', 'ca', 'cs', 'cy',
    'da', 'de', 'dsb', 'el', 'en-GB', 'es-AR', 'es-ES', 'et',
    'eu', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'he', 'hr',
    'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'kab', 'ko', 'lt',
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
