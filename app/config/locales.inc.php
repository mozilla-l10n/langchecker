<?php

/* $mozilla is the list of all locales supported on Langchecker.
 * Don't forget to update other relevant arrays in this file when adding
 * new locales.
 */
$mozilla = [
    'ach', 'af', 'an', 'ar', 'as', 'ast', 'az', 'be', 'bg',
    'bm',  'bn-BD', 'bn-IN', 'br', 'brx', 'bs', 'ca', 'cak', 'cs',
    'cy', 'da', 'de', 'dsb', 'ee', 'el', 'en-GB', 'en-ZA',
    'eo', 'es', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'et',
    'eu', 'fa', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd',
    'gl', 'gn', 'gu-IN', 'ha', 'he', 'hi-IN', 'hr', 'hsb', 'hu',
    'hy-AM', 'id', 'ig', 'is', 'it', 'ja', 'ka', 'kk', 'km',
    'kn', 'ko', 'kok', 'ks', 'lij', 'ln', 'lo', 'lt', 'lv', 'mai',
    'mg', 'mk', 'ml', 'mr', 'ms', 'my', 'nb-NO', 'nl', 'nn-NO',
    'oc', 'or', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro',
    'ru', 'sat', 'si', 'sk', 'sl', 'son', 'sq', 'sr', 'sr-Latn',
    'sv-SE', 'sw', 'ta', 'te', 'th', 'tl', 'tn', 'tr', 'tsz', 'uk',
    'ur', 'uz', 'vi', 'wo', 'xh', 'yo', 'zh-CN', 'zh-TW', 'zu',
];
sort($mozilla);

/* $mozillaorg is the list of locales supported on mozilla.org
 * Remove locales not supported on mozilla.org from the full array
 */
$mozillaorg = array_diff($mozilla, ['en-ZA', 'es', 'sr-Latn']);

// List of locales only working on Firefox OS
$fxos_locales = [
    'bm', 'ee', 'es', 'ha', 'ig', 'ln', 'mg', 'sr-Latn',
    'sw', 'tl', 'tn', 'wo', 'yo',
];

// List of locales only working on Fennec
$fennec_locales = ['cak', 'lo', 'my', 'tsz'];

/* List of locales we support on desktop (Firefox). We need to remove
 * locales used only for Gaia (es, sr-Latn), locales working only on Gaia
 * (e.g. new African locales) or Fennec
 */
$firefox_locales = array_diff(
    $mozilla,
    $fxos_locales,
    $fennec_locales
);

// All locales working on Firefox desktop + Android
$firefox_desktop_android = array_merge($firefox_locales, $fennec_locales);

// List of locales with active newsletter
$newsletter_locales = ['de', 'es-ES', 'fr', 'hu', 'id', 'pl', 'pt-BR', 'ru'];

// List of locales working on Pootle
$locamotion_locales = [
    'ach', 'af', 'bm', 'bn-BD', 'br', 'ca', 'cak', 'cy',
    'dsb', 'ee', 'en-ZA', 'es-MX', 'ff', 'fi', 'ga-IE',
    'gn', 'ha', 'hi-IN', 'hr', 'hsb', 'ig', 'kk', 'km',
    'kok', 'ks', 'ln', 'lo', 'lt', 'lv', 'mai', 'mg',
    'mr', 'ms', 'my', 'nn-NO', 'oc', 'or', 'sat', 'son',
    'sw', 'ta', 'tl', 'tn', 'tsz', 'ur', 'vi',
    'wo', 'xh', 'yo', 'zu',
];

/* List of Mozilla's locales supported by SurveyGizmo.
 * Ref. http://help.surveygizmo.com/help/article/link/create-a-translated-survey#available-languages
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
