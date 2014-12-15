<?php

$mozilla_europe = [
    'bg', 'ca', 'cs', 'da', 'de', 'el', 'en-GB', 'es-ES', 'eu', 'fi',
    'fr', 'hu', 'it', 'lt', 'nb-NO', 'nl', 'pl', 'pt-PT', 'ro', 'ru',
    'sk', 'sq', 'sv-SE', 'sr', 'tr', 'uk'
];

$mozilla = [
    'ach', 'af', 'ak', 'an', 'ar', 'as', 'ast', 'az', 'be', 'bg', 'bn-IN',
    'bn-BD', 'br', 'bs', 'ca', 'cs', 'csb', 'cy', 'da', 'de', 'dsb', 'el',
    'eo', 'es-AR', 'es-ES', 'es-CL', 'es-MX', 'et', 'eu', 'fa', 'ff',
    'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gu-IN', 'he', 'hi-IN',
    'hr', 'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'ka', 'kk', 'kn',
    'km', 'ko', 'ku', 'lg', 'lij', 'lt', 'lv', 'mai', 'mk', 'ml', 'mr',
    'ms', 'my', 'nb-NO', 'nl', 'nn-NO', 'nso', 'oc', 'or', 'pa-IN',
    'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sat', 'si', 'sk', 'sl',
    'son', 'sq', 'sr', 'sv-SE', 'sw', 'ta', 'ta-LK', 'te', 'th', 'tr', 'uk',
    'ur', 'uz', 'vi', 'wo', 'xh', 'zh-CN', 'zh-TW', 'zu',
];

$mozilla = array_diff($mozilla, ['en-ZA', 'es']);
// Remove dropped locales
$mozilla = array_diff($mozilla, ['ak', 'csb', 'ku', 'lg', 'mn', 'nso', 'sah', 'sw', 'ta-LK', 'wo']);
sort($mozilla);

$mozillaorg = array_diff($mozilla, ['en-GB']);

$startpage36 = [
    'af', 'ar', 'as', 'ast', 'be', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs',
    'cy', 'da', 'de', 'el', 'en-GB', 'eo', 'es-AR', 'es-ES', 'es-MX',
    'et', 'eu', 'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gu-IN',
    'he', 'hi-IN', 'hr', 'hu', 'id', 'is', 'it', 'ja', 'kk', 'kn', 'ko',
    'lt', 'lv', 'mk', 'ml', 'mr', 'nb-NO', 'nl', 'nn-NO',
    'or', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'si', 'sk',
    'sl', 'sq', 'sr', 'sv-SE', 'ta', 'ta-LK', 'te', 'th', 'tr', 'uk',
    'vi', 'zh-CN', 'zh-TW'
];

$surveys = [
    'de', 'es-AR', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'ko', 'pl',
    'pt-BR', 'ru', 'tr', 'vi', 'zh-CN', 'zh-TW'
];

$marketing = [
    'de', 'es-ES', 'fr', 'it', 'id', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW'
];
