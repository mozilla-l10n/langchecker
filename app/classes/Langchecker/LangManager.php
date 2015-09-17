<?php
namespace Langchecker;

/**
 * LangManager class
 *
 * This class is used to read reference and localized files in .lang file format
 *
 *
 * @package Langchecker
 */
class LangManager
{
    /**
     * We store in this variable if we need to check for errors when analysing lang files
     *
     * @var boolean
     */
    public static $error_checking = true;

    /**
     * Load file, remove empty lines and return an array of strings
     *
     * @param array  $website  Website data
     * @param string $locale   Locale to analyze
     * @param string $filename File to analyze
     *
     * @return array Data parsed from lang file
     */
    public static function loadSource($website, $locale, $filename)
    {
        $is_reference_language = ($locale == Project::getReferenceLocale($website));
        $path = Project::getLocalFilePath($website, $locale, $filename);

        return DotLangParser::parseFile($path, $is_reference_language);
    }

    /**
     * Check string for Python errors
     *
     * @param string $reference   Reference string
     * @param string $translation Translation
     * @param string $errors      Current errors
     *
     * @return array Python errors
     */
    public static function checkPythonErrors($reference, $translation, $errors)
    {
        /* Test if all Python variables are present, analyzing both
         * format %(var)s or %s, or 'escaped' percentage sign (%%) */
        $matches_reference = Utils::getPythonVariables($reference);
        $matches_locale = Utils::getPythonVariables($translation);

        if ($matches_reference != $matches_locale) {
            /* Locale and reference have different variables. Count
             * instances of each variable and compare them. */
            $count_occurrences = function ($value, $array) {
                // Count occurrences of $value in $array
                $count_values = array_count_values($array);
                $occurrences = isset($count_values[$value]) ?
                              $count_values[$value] :
                              0;

                return $occurrences;
            };

            foreach ($matches_reference as $python_var) {
                if ($count_occurrences($python_var, $matches_locale) != $count_occurrences($python_var, $matches_reference)) {
                    $errors[$reference] = [
                        'text' => $translation,
                        'var'  => $python_var,
                    ];
                }
            }

            // Check if locale has extra variables
            foreach ($matches_locale as $python_var) {
                if (! in_array($python_var, $matches_reference)) {
                    $errors[$reference] = [
                        'text' => $translation,
                        'var'  => $python_var,
                    ];
                }
            }
        }

        return $errors;
    }

    /**
     * Check string for length errors
     *
     * @param string  $reference   Reference string
     * @param string  $translation Translation
     * @param integer $limit       Max length for this string
     * @param string  $errors      Current errors
     *
     * @return array Length errors
     */
    public static function checkLengthErrors($reference, $translation, $limit, $errors)
    {
        $str_length = Utils::getLength($translation);
        if ($str_length > $limit) {
            $errors[$reference] = [
                'current' => $str_length,
                'limit'   => $limit,
                'text'    => $translation,
            ];
        }

        return $errors;
    }

    /**
     * Load file, remove empty lines and return an array of strings
     *
     * @param array  $website        Website data
     * @param string $locale         Locale to analyze
     * @param string $filename       File to analyze
     * @param array  $reference_data Array with data from reference locale
     *
     * @return array Analysis data
     */
    public static function analyzeLangFile($website, $locale, $filename, $reference_data)
    {
        $locale_data = self::loadSource($website, $locale, $filename);
        $analysis_data = [
            'activated'  => $locale_data['activated'],
            'Identical'  => [],
            'Translated' => [],
            'Missing'    => [],
            'Obsolete'   => [],
            'errors'     => [
                'ignoredstrings' => [],
                'length'         => [],
                'python'         => [],
            ],
            'tags'       => [],
        ];

        foreach ($locale_data['strings'] as $reference => $translation) {
            if (isset($reference_data['strings'][$reference])) {
                if ($translation === $reference_data['strings'][$reference]) {
                    // Store as identical string
                    $analysis_data['Identical'][] = $reference;
                } elseif ($translation !== $reference_data['strings'][$reference]) {
                    // Store in translated strings
                    $analysis_data['Translated'][] = $reference;

                    // Error Checking is not needed everytime we use analyseLangFile()
                    if (self::$error_checking) {
                        // Search for Python errors only if there are '%' in the string
                        if (mb_strpos($reference, '%') !== false) {
                            $analysis_data['errors']['python'] = self::checkPythonErrors(
                                $reference,
                                $translation,
                                $analysis_data['errors']['python']
                            );
                        }

                        if (isset($reference_data['max_lengths'][$reference])) {
                            // Search for strings too long
                            $analysis_data['errors']['length'] = self::checkLengthErrors(
                                $reference,
                                $translation,
                                $reference_data['max_lengths'][$reference],
                                $analysis_data['errors']['length']
                            );
                        }

                        // Copy ignored strings errors to data analysis
                        $analysis_data['errors']['ignoredstrings'] = $locale_data['errors']['ignoredstrings'];
                    }
                } elseif ($translation === '') {
                    // Store in missing strings
                    $analysis_data['Missing'][] = $reference;
                }
            } else {
                // Store in obsolete strings
                $analysis_data['Obsolete'][] = $reference;
            }
        }

        // Use reference to determine missing strings
        foreach ($reference_data['strings'] as $reference => $translation) {
            if (! isset($locale_data['strings'][$reference])) {
                $analysis_data['Missing'][] = $reference;
            }
        }

        // Copy tags if available
        if (isset($locale_data['tags'])) {
            $analysis_data['tags'] = $locale_data['tags'];
        }

        return $analysis_data;
    }

    /**
     * Check if a string is localized
     *
     * @param string $string_id      String id to check
     * @param array  $locale_data    Array with data for locale
     * @param array  $reference_data Array with data for reference locale
     *
     * @return boolean True if string is localized
     */
    public static function isStringLocalized($string_id, $locale_data, $reference_data)
    {
        if (isset($locale_data['strings'][$string_id])) {
            // Only check if string is not missing from locale file
            if ($locale_data['strings'][$string_id] !== $reference_data['strings'][$string_id]) {
                return true;
            }
        }

        return false;
    }

    /**
     * Create lang file content
     *
     * @param array  $reference_data Array with data for reference locale
     * @param array  $locale_data    Array with data for locale
     * @param string $current_locale Requested locale
     * @param string $eol            EOL character to use
     *
     * @return string Lang file content
     */
    public static function buildLangFile($reference_data, $locale_data, $current_locale, $eol)
    {
        ob_start();
        header('Content-type: text/plain; charset=UTF-8');

        // Two empty lines between strings
        $spacer = "{$eol}{$eol}";

        // Activation status
        if ($locale_data['activated']) {
            echo "## active ##{$eol}";
        }

        // Tags: if reference doesn't have tags, locale shouldn't have them either
        if (isset($locale_data['tags']) &&
            isset($reference_data['tags'])) {
            $tags = $locale_data['tags'];
            // Ignore tags not available in reference
            $tags = array_intersect($tags, $reference_data['tags']);
            // Put tags in alphabetical order
            sort($tags);
            foreach ($tags as $tag) {
                echo "## {$tag} ##{$eol}";
            }
        }

        // Description
        if (isset($reference_data['filedescription'])) {
            foreach ($reference_data['filedescription'] as $description) {
                echo "## NOTE: {$description}{$eol}";
            }
            echo $spacer;
        }

        // List of string exceptions
        $exceptions = [
            '@@this is a test, do not remove@@', // Don't remove, used for tests
        ];

        foreach ($reference_data['strings'] as $string_id => $string_value) {
            // Do we have comments for this string?
            if (isset($reference_data['comments'][$string_id])) {
                foreach ($reference_data['comments'][$string_id] as $comment) {
                    echo "# {$comment}{$eol}";
                }
            }

            $translation = isset($locale_data['strings'][$string_id]) ?
                           $locale_data['strings'][$string_id] :
                           '';

            if (in_array($string_id, $exceptions)) {
                // This string needs to be managed as an exception
                $exception_string = self::manageStringExceptions($string_id, $translation, $current_locale);
                echo ";{$exception_string['reference']}{$eol}";
                echo "{$exception_string['translation']}{$eol}";
            } else {
                echo ";{$string_id}{$eol}";
                if ($translation !== '') {
                    // I have a translation
                    echo "{$translation}{$eol}";
                } else {
                    // No translation available, copy reference
                    echo "{$string_id}{$eol}";
                }
            }
            echo $spacer;
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Manage string exceptions
     *
     * @param string $string_id      String we need to manage
     * @param string $translation    Current translation
     * @param string $current_locale Requested locale
     *
     * @return array Modified reference and translated strings
     */
    public static function manageStringExceptions($string_id, $translation, $current_locale)
    {
        /* This function is used to manage exceptions for strings.
         * Function must return both reference and translation, since me may need
         * to change any of them.
         */

        // Example function used in tests, don't delete
        if ($string_id == '@@this is a test, do not remove@@' && $current_locale == 'it') {
            $result['reference'] = 'this is a test';
            $result['translation'] = str_replace('test', '<a href="%(url)s">test</a>', $translation);

            return $result;
        }

        return [
            'reference'   => $string_id,
            'translation' => $translation,
        ];
    }

    /**
     * Return count of all errors
     *
     * @param array $errors     Array of errors generated by analyzeLangFile
     * @param array $error_type Type of error to count (optional)
     *
     * @return integer Count of errors
     */
    public static function countErrors($errors, $error_type = 'all')
    {
        $error_count = 0;

        if ($error_type == 'all') {
            foreach ($errors as $error) {
                $error_count += count($error);
            }
        } else {
            // Specific type of error, which means a sub-array of 'errors'
            if (isset($errors[$error_type])) {
                $error_count = count($errors[$error_type]);
            }
        }

        return $error_count;
    }
}
