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

                // Ignore fuzzy strings
                if (in_array('fuzzy', $translation_obj->getFlags())) {
                    continue;
                }

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
