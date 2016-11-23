<?php
namespace Langchecker;

use Gettext\Translations;

/**
 * GetTextManager class
 *
 * This class is used to read reference and localized files in GetText format
 *
 *
 * @package Langchecker
 */
class GetTextManager
{
    /**
     * Extract strings from Translations collection
     *
     * @param array  $locale_strings Array of locale strings
     * @param string $current_file   Description of the file being analyzed,
     *                               for console messages
     * @param object $translations   Collection of Translation objects
     * @param string $output         Display output when updating strings
     *
     * @return array Array of updated strings. errors
     *
     */
    public static function extractStrings($locale_strings, $current_file, $translations, $output = true)
    {
        $result = [
          'imported' => false,
          'errors'   => [],
          'strings'  => [],
        ];

        foreach ($locale_strings as $string_id => $existing_translation) {
            $translation_obj = $translations->find(null, $string_id);
            if ($translation_obj) {
                $new_translation = trim($translation_obj->getTranslation());
                // Ignore empty strings
                if ($new_translation == '') {
                    continue;
                }

                // If translation is identical to English, add '{ok}'
                if ($new_translation == $string_id) {
                    $new_translation .= ' {ok}';
                }

                if (Utils::startsWith($new_translation, ';')) {
                    // Translations can't start with ";"
                    $result['errors'][] = "({$current_file}): translation starts with prohibited character ;\n{$new_translation}";
                } elseif ($new_translation !== $existing_translation) {
                    // Translation in the .po file is different, store the new one
                    if ($output) {
                        Utils::logger("Updated translation ({$current_file}): {$string_id} => {$new_translation}");
                    }
                    $locale_strings[$string_id] = $new_translation;
                    $result['imported'] = true;
                }
            }
        }
        $result['strings'] = $locale_strings;

        return $result;
    }

    /**
     * Read .po file from Locamotion's github repository, return updated strings
     *
     * @param array  $locale_data      Array of data for locale file
     * @param string $current_filename Analyzed file
     * @param string $current_locale   Requested locale
     * @param string $lomocation_repo  Path to local clone of Locamotion's repository
     *
     * @return array Result of import (boolean), errors (array),
     *               updated strings (array)
     */
    public static function importLocamotion($locale_data, $current_filename, $current_locale, $locamotion_repo)
    {
        $local_import = $locamotion_repo != '' ? true : false;

        /*
            Some locales need to me mapped because our systems and Pootle use
            different locale codes.

            Array format: Langchecker code => Pootle code

            Use dashes and not underscores for Pootle, e.g. gn-PY instead of gn_PY.
        */
        $locale_mapping = [
            'gn'    => 'gn-PY',
            'ne-NP' => 'ne',
            'pt-PT' => 'pt',
        ];
        $locamotion_locale = isset($locale_mapping[$current_locale]) ?
                             $locale_mapping[$current_locale] :
                             $current_locale;

        if ($local_import) {
            // Import from local clone
            $file_path = $locamotion_repo .
                         str_replace('-', '_', $locamotion_locale)
                         . '/' . $current_filename . '.po';
            $po_exists = file_exists($file_path);
        } else {
            // Import data from remote
            $locamotion_url = 'https://raw.githubusercontent.com/translate/mozilla-lang/master/'
                              . str_replace('-', '_', $locamotion_locale)
                              . '/' . $current_filename . '.po';
            $http_response = get_headers($locamotion_url, 1)[0];
            $po_exists = strstr($http_response, '200') ? true : false;
        }

        if ($po_exists) {
            if ($local_import) {
                $translations = Translations::fromPoFile($file_path);
            } else {
                Utils::logger("Fetching {$current_filename} from Locamotion.");
                // Create temporary file (temp.po), delete it after extracting strings
                file_put_contents('temp.po', file_get_contents($locamotion_url));
                $translations = Translations::fromPoFile('temp.po');
                unlink('temp.po');
            }

            $result = self::extractStrings($locale_data['strings'], "{$current_locale} - {$current_filename}", $translations);
        } else {
            if ($local_import) {
                Utils::logger("{$file_path} does not exist.");
            } else {
                Utils::logger("{$locamotion_url} does not exist, HTTP response code was {$http_response}");
            }

            return $result;
        }

        return $result;
    }

    /**
     * Read local .po file, return updated strings
     *
     * @param string  $po_filename    Path to po file
     * @param array   $locale_data    Array of data for locale file
     * @param boolean $output_message True (default) to output messages in console
     *
     * @return array Result of import (boolean), errors (array),
     *               updated strings (array)
     */
    public static function importLocalPoFile($po_filename, $locale_data, $output_message = true)
    {
        // Read po file
        $translations = Translations::fromPoFile($po_filename);
        $result = self::extractStrings($locale_data['strings'], $po_filename, $translations, $output_message);

        if ($output_message) {
            if ($result['imported']) {
                Utils::logger('Data imported.');
            } else {
                Utils::logger('No data imported.');
            }
        }

        return $result;
    }
}
