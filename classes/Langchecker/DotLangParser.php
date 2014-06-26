<?php
namespace Langchecker;

/*
 * DotLangParser class
 *
 * This class is for all the methods we use to read .lang files
 *
 *
 * @package Langchecker
 */
class DotLangParser
{
    /*
     * Load file, remove empty lines and return an array of strings
     *
     * @param   string          $path         Filename to analyze
     * @param   boolean         $show_errors  Display or not errors in case of missing file
     * @return  array/boolean                 Cleaned up array of lines, or false if file is missing
     */
    public static function getFile($path, $show_errors = true)
    {
        if (! is_file($path)) {
            if ($show_errors) {
                Utils::logger("{$path} does not exist.");
            }
            return false;
        }

        $file_content = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        // Remove BOM
        if (count($file_content) > 0) {
            $file_content[0] = trim($file_content[0], "\xEF\xBB\xBF");
        }

        return $file_content;
    }

    /*
     * Read file of strings and return an array with all relevant data.
     *
     * @param   string   $path              Full path to filename to analyze
     * @param   boolean  $reference_locale  If I'm currently analyzing the reference locale
     * @return  array                       Extracted data
     */
    public static function parseFile($path, $reference_locale = false)
    {
        $dotlang_data = [];
        // In case the file is missing we set an empty array
        $dotlang_data['strings'] = [];
        $file_content = self::getFile($path);

        if ($file_content !== false) {
            // File exists, I can parse its content
            for ($i = 0, $lines = count($file_content); $i < $lines; $i++) {
                $current_line = $file_content[$i];

                /* First line may contain an activation status
                 * Tags are read with regexp "^## (\w+) ##", so trailing spaces can be ignored
                 */
                if ($i == 0 && rtrim($current_line) == '## active ##') {
                    $dotlang_data['activated'] = true;
                    continue;
                }

                // Get file description
                if (Utils::startsWith($current_line, '## NOTE:')) {
                    $dotlang_data['filedescription'][] = Utils::leftStrip($current_line, '## NOTE:');
                    continue;
                }

                // Other tags like ## promo_news ##, but not meta data
                if (Utils::startsWith($current_line, '##') &&
                    ! Utils::startsWith($current_line, '## NOTE:') &&
                    ! Utils::startsWith($current_line, '## TAG:')) {
                    $dotlang_data['tags'][] = trim(str_replace('##', '', $current_line));
                    continue;
                }

                if ($i < $lines-1) {
                    $next_line = $file_content[$i+1];
                } else {
                    $next_line = '';
                }

                if (Utils::startsWith($current_line, ';') &&
                    ! empty($next_line)) {
                    // Source strings start with ";". I have a reference string followed by something
                    $reference = Utils::leftStrip($current_line, ';');
                    $translation = trim($next_line);

                    if (Utils::startsWith($translation, ';') || Utils::startsWith($translation, '#')) {
                        /* Empty translation: what I'm reading as translation is either the next reference string
                         * or the next meta tag (comment, tag binding). I consider this string untranslated.
                         */
                        $dotlang_data['strings'][$reference] = $reference;
                        continue;
                    } else {
                        // Store the translation
                        $dotlang_data['strings'][$reference] = $translation;

                        /* These meta tags are available before a reference string, but I store them only if I'm
                         * reading the reference locale
                         */
                        if ($i >= 2 && $reference_locale) {
                            // Tag bindings
                            if (Utils::startsWith($file_content[$i-1], '## TAG:')) {
                                // Only tag binding
                                $dotlang_data['tag_bindings'][$reference] = Utils::leftStrip($file_content[$i-1], '## TAG:');
                            } elseif (Utils::startsWith($file_content[$i-2], '## TAG:')) {
                                // Tag binding and comment
                                $dotlang_data['tag_bindings'][$reference] = Utils::leftStrip($file_content[$i-2], '## TAG:');
                            }

                            // Comments (#) but not meta tags (##)
                            if (Utils::startsWith($file_content[$i-1], '#') &&
                                ! Utils::startsWith($file_content[$i-1], '##')) {
                                // Only l10n comment
                                $dotlang_data['comments'][$reference] = Utils::leftStrip($file_content[$i-1], '#');
                            } elseif (Utils::startsWith($file_content[$i-2], '#') &&
                                ! Utils::startsWith($file_content[$i-2], '##')) {
                                // L10n comment and tag binding
                                $dotlang_data['comments'][$reference] = Utils::leftStrip($file_content[$i-2], '#');
                            }
                        }
                    }
                    $i++;
                }
            }
        }

        // Make sure there's always an activation status to avoid controls later
        if (! isset($dotlang_data['activated'])) {
            $dotlang_data['activated'] = false;
        }

        return $dotlang_data;
    }
}
