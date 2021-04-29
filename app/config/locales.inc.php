<?php

use Cache\Cache;

/*
    $mozilla is the list of all locales supported on Langchecker.
    Don't forget to update other relevant arrays in this file when adding
    new locales.
*/
$mozilla = [
    'ach', 'af', 'am', 'an', 'ar', 'ast', 'az', 'azz', 'be', 'bg', 'bn',
    'br', 'bs', 'ca', 'cak', 'crh', 'cs', 'cy', 'da', 'de',
    'dsb', 'el', 'en-CA', 'en-GB', 'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
    'es', 'et', 'eu', 'fa', 'ff', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl',
    'gn', 'gu-IN', 'he', 'hi-IN', 'hr', 'hsb', 'hto', 'hu', 'hy-AM', 'ia',
    'id', 'is', 'it', 'ja', 'ka', 'kab', 'kk', 'km', 'kn', 'ko', 'lij', 'lo',
    'lt', 'ltg', 'lv', 'mk', 'ml', 'mr', 'ms', 'my', 'nb-NO', 'ne-NP', 'nl',
    'nn-NO', 'nv', 'oc', 'pa-IN', 'pai', 'pbb', 'ppl', 'pl', 'pt-BR', 'pt-PT',
    'qvi', 'rm', 'ro', 'ru', 'si', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'sw',
    'ta', 'te', 'th', 'tl', 'tr', 'trs', 'uk', 'ur', 'uz', 'vi', 'wo', 'xh',
    'zam', 'zh-CN', 'zh-HK', 'zh-TW', 'zu',
];
sort($mozilla);

// List of locales working on Pontoon
$cache_id = 'pontoon_locales';
if (! $pontoon_locales = Cache::getKey($cache_id, 60 * 60 * 24)) {
    $pontoon_locales = $json_object
        ->setURI(QUERY_L10N . '?tool=pontoon-mozorg')
        ->fetchContent();
    Cache::setKey($cache_id, array_values($pontoon_locales));
}
