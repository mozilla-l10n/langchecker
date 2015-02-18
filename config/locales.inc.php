<?php

// $mozilla is the list of all locales supported on Langchecker
$mozilla = [
    'ach', 'af', 'an', 'ar', 'as', 'ast', 'az', 'be', 'bg',
    'bn-BD', 'bn-IN', 'br', 'bs', 'ca', 'cs', 'cy', 'da',
    'de', 'dsb', 'ee', 'el', 'en-GB', 'en-ZA', 'eo', 'es',
    'es-AR', 'es-CL', 'es-ES', 'es-MX', 'et', 'eu', 'fa',
    'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gu-IN',
    'ha', 'he', 'hi-IN', 'hr', 'hsb', 'hu', 'hy-AM', 'id',
    'ig', 'is', 'it', 'ja', 'ka', 'kk', 'km', 'kn', 'ko',
    'lij', 'ln', 'lt', 'lv', 'mai', 'mk', 'ml', 'mr', 'ms',
    'my', 'nb-NO', 'nl', 'nn-NO', 'oc', 'or', 'pa-IN', 'pl',
    'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sat', 'si', 'sk',
    'sl', 'son', 'sq', 'sr', 'sr-Latn', 'sv-SE', 'sw', 'ta',
    'te', 'th', 'tr', 'uk', 'ur', 'uz', 'vi', 'wo', 'xh',
    'yo', 'zh-CN', 'zh-TW', 'zu',
];
sort($mozilla);

/* $mozillaorg is the list of locales supported on mozilla.org
 * Remove locales not supported on mozilla.org from the full array
 */
$mozillaorg = array_diff($mozilla, ['en-ZA', 'es', 'sr-Latn']);

/* List of locales we support on desktop (Firefox). We need to remove
 * locales used only for Gaia (es, sr-Latn), locales working only on Gaia
 * (e.g. new African locales)
 */
$firefox_desktop = array_diff(
    $mozilla,
    ['ee', 'es', 'ha', 'ig', 'ln', 'my', 'sr-Latn', 'sw', 'wo', 'yo']
);
