<?php
namespace Bugzilla;

/**
 * Bugzilla class
 *
 * Bugzilla functions: perform searches, map locale code to componente name
 *
 *
 * @package Bugzilla
 */
class Bugzilla {
    /**
     * @var  array  $locales_mappings  Map locale codes to Bugzilla's component name
     */
    private static $locales_mappings = [
                'ach'       => 'Acholi',
                'af'        => 'Afrikaans',
                'an'        => 'Aragonese',
                'ar'        => 'Arabic',
                'as'        => 'Assamese',
                'ast'       => 'Asturian',
                'az'        => 'Azerbaijani',
                'be'        => 'Belarusian',
                'bg'        => 'Bulgarian',
                'bn-BD'     => 'Bengali',
                'bn-BD-www' => 'Bengali (Bangladesh)',
                'bn-IN'     => 'Bengali (India)',
                'br'        => 'Breton',
                'bs'        => 'Bosnian',
                'ca'        => 'Catalan',
                'cs'        => 'Czech',
                'csb'       => 'Kashubian',
                'cy'        => 'Welsh',
                'da'        => 'Danish',
                'de'        => 'German',
                'dsb'       => 'Lower Sorbian',
                'el'        => 'Greek',
                'en-GB'     => 'English (United Kingdom)',
                'en-GB-www' => 'English (British)',
                'eo'        => 'Esperanto',
                'es-AR'     => 'Spanish (Argentina)',
                'es-CL'     => 'Spanish (Chile)',
                'es-ES'     => 'Spanish',
                'es-ES-www' => 'Spanish (Spain)',
                'es-MX'     => 'Spanish (Mexico)',
                'et'        => 'Estonian',
                'eu'        => 'Basque',
                'fa'        => 'Persian',
                'ff'        => 'Fulah',
                'fi'        => 'Finnish',
                'fr'        => 'French',
                'fy-NL'     => 'Frisian',
                'ga-IE'     => 'Irish',
                'ga-IE-www' => 'Irish (Ireland)',
                'gd'        => 'Scottish Gaelic',
                'gd-www'    => 'Gaelic (Scotland)',
                'gl'        => 'Galician',
                'gu-IN'     => 'Gujarati',
                'he'        => 'Hebrew',
                'hi-IN'     => 'hindi',
                'hi-IN-www' => 'Hindi (India)',
                'hr'        => 'Croatian',
                'hsb'       => 'Upper Sorbian',
                'hu'        => 'Hungarian',
                'hy-AM'     => 'Armenian',
                'id'        => 'Indonesian',
                'is'        => 'Icelandic',
                'it'        => 'Italian',
                'ja'        => 'Japanese',
                'ka'        => 'Georgian',
                'kk'        => 'Kazakh',
                'km'        => 'Khmer',
                'kn'        => 'Kannada',
                'ko'        => 'Korean',
                'ku'        => 'Kurdish',
                'lg'        => 'Luganda',
                'lij'       => 'Ligurian',
                'lt'        => 'Lithuanian',
                'lv'        => 'Latvian',
                'mai'       => 'Maithili',
                'mk'        => 'Macedonian',
                'ml'        => 'Malayalam',
                'mn'        => 'Mongolian',
                'mr'        => 'Marathi',
                'ms'        => 'Malay',
                'my'        => 'Burmese',
                'nb-NO'     => 'Norwegian Bokmål',
                'nb-NO-www' => 'Norwegian (Bokmål)',
                'nl'        => 'Dutch',
                'nn-NO'     => 'Norwegian Nynorsk',
                'nn-NO-www' => 'Norwegian (Nynorsk)',
                'nso'       => 'Northern Sotho (Pedi)',
                'nso-www'   => 'Northern Sotho',
                'oc'        => 'Occitan',
                'oc-www'    => 'Occitan (Lengadocian)',
                'or'        => 'Oriya',
                'pa-IN'     => 'Punjabi',
                'pl'        => 'Polish',
                'pt-BR'     => 'Portuguese (Brazil)',
                'pt-BR-www' => 'Portuguese (Brazilian)',
                'pt-PT'     => 'Portuguese',
                'pt-PT-www' => 'Portuguese (Portugal)',
                'rm'        => 'Romansh',
                'ro'        => 'Romanian',
                'ru'        => 'Russian',
                'sat'       => 'Santali',
                'si'        => 'Sinhala',
                'sk'        => 'Slovak',
                'sl'        => 'Slovene',
                'sl-www'    => 'Slovenian',
                'son'       => 'Songhay',
                'sq'        => 'Albanian',
                'sr'        => 'Serbian',
                'sv-SE'     => 'Swedish',
                'sw'        => 'Swahili',
                'ta'        => 'Tamil',
                'ta-LK'     => 'Tamil (Sri Lanka)',
                'te'        => 'Telugu',
                'th'        => 'Thai',
                'tr'        => 'Turkish',
                'uk'        => 'Ukrainian',
                'ur'        => 'Urdu',
                'uz'        => 'Uzbek',
                'vi'        => 'Vietnamese',
                'wo'        => 'Wolof',
                'xh'        => 'Xhosa',
                'zh-CN'     => 'Chinese (Simplified)',
                'zh-TW'     => 'Chinese (Traditional)',
                'zu'        => 'Zulu',
            ];

    /**
     * Fetch a remote CSV file generated by an advanced search in Bugzilla
     *
     * @param   string  $csv   URI of the CSV file
     * @param   string  $full  Return short or long results (default to false)
     *
     * @return  array          List of bugs and their descriptions
     */
    public static function getBugsFromCSV($csv, $full = false)
    {
        $fullBugs = [];
        $shortBugs = [];
        $singleBug = [];

        $file_handle = fopen($csv, 'r');
        if ($file_handle !== false) {
            while (($data = fgetcsv($file_handle, 300, ',')) !== false) {
                if ($data[0] == 'bug_id') {
                    /* If it starts with bug_id, I'm reading the first line
                     * with all field names
                     */
                    $fields = $data;
                    continue;
                }
                foreach ($fields as $key => $field) {
                    $singleBug[$field] = $data[$key];
                }
                $shortBugs[$singleBug['bug_id']] = $singleBug['short_desc'];
                $fullBugs[] = $singleBug;
            }
            fclose($file_handle);
        }

        return $full ? $fullBugs : $shortBugs;
    }

    /**
     * Given a locale code and a product, determine the correct component name
     * on Bugzilla
     *
     * @param   string   $locale      Locale code
     * @param   string   $component   If I need the locale code for Mozilla
     *                                Localizations or www.mozilla.org (default)
     * @param   boolean  $log_errors  If I need to log the error for missing locale
     *
     * @return  string                "Locale / Language name" for Bugzilla queries
     */
    public static function getBugzillaLocaleField($locale, $component = 'www', $log_errors = true) {
        $locale_web = "{$locale}-www";
        if ($component == 'www' && isset(self::$locales_mappings[$locale_web])) {
            // This locale has a specific language name for www.mozilla.org
            return $locale . ' / ' . self::$locales_mappings[$locale_web];
        }
        if (isset(self::$locales_mappings[$locale])) {
            // Return the default language name if it exists
            return $locale . ' / ' . self::$locales_mappings[$locale];
        }
        // Locale does not exist in mapping. Log error if necessary
        if ($log_errors) {
            error_log("Missing locale {$locale} in locale mappings (Bugzilla Class)");
        }

        return $locale;
    }
}
