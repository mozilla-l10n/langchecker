<?php
namespace Langchecker;

/**
 * DotLangParser class
 *
 * This class is for all the methods we use to read .lang files
 *
 *
 * @package Langchecker
 */
class DotLangParser
{
    /**
     * We store in this variable the result of lang files already parsed because
     * parsing is CPU intensive
     *
     * @var array
     */
    private static $parsed_files = [];

    /**
     * We store in this variable if we want to extract file metadata for a view.
     *
     * @var boolean
     */
    public static $extract_metadata = true;

    /**
     * Logging errors has a performance impact avoid on public views
     *
     * @var boolean
     */
    public static $log_errors = true;

    /**
     * Load file, remove empty lines and return an array of strings
     *
     * @param string $path Filename to analyze
     *
     * @return mixed Cleaned up array of lines (array),
     *               or false if file is missing
     */
    public static function getFile($path)
    {
        if (! is_file($path)) {
            if (self::$log_errors) {
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

    /**
     * Read file of strings and return an array with all relevant data.
     *
     * @param string  $path             Full path to filename to analyze
     * @param boolean $reference_locale If I'm currently analyzing the
     *                                  reference locale
     *
     * @return array Extracted data
     */
    public static function parseFile($path, $reference_locale = false)
    {
        // Check if we haven't already parsed the file
        if (isset(self::$parsed_files[$path])) {
            return self::$parsed_files[$path];
        }

        $file_content = self::getFile($path);

        $dotlang_data = [];

        // In case the file is missing we set an empty array for strings
        $dotlang_data['strings'] = [];

        // Make sure there's always an activation status to avoid controls later
        $dotlang_data['activated'] = false;

        if ($file_content !== false) {
            // First pass: extract strings and metadata (tags, active status) relevant for all locales.
            $lines = count($file_content);
            foreach ($file_content as $i => $current_line) {
                if (! self::$extract_metadata && Utils::startsWith($current_line, '#')) {
                    continue;
                }

                /* First line may contain an activation status
                 * Tags are read with regexp "^## (\w+) ##", so trailing spaces can be ignored
                 */
                if ($i == 0 && rtrim($current_line) == '## active ##') {
                    $dotlang_data['activated'] = true;
                    continue;
                }

                // Get file description
                if (empty($dotlang_data['strings']) // File description is always before strings
                    && Utils::startsWith($current_line, '## NOTE:')) {
                    $dotlang_data['filedescription'][] = trim(Utils::leftStrip($current_line, '## NOTE:'));
                    continue;
                }

                // Get file stage URL
                if (! isset($dotlang_data['url'])
                    && empty($dotlang_data['strings']) // URL is always before strings
                    && Utils::startsWith($current_line, '## URL:')) {
                    $dotlang_data['url'] = trim(Utils::leftStrip($current_line, '## URL:'));
                    continue;
                }

                // Other tags like ## promo_news ##, but not meta data
                if (empty($dotlang_data['strings']) // Other tags are  always before strings
                    && Utils::startsWith($current_line, '##')
                    && ! Utils::startsWith($current_line, self::getMetaTags())) {
                    $dotlang_data['tags'][] = trim(str_replace('##', '', $current_line));
                    continue;
                }

                if ($i < $lines - 1) {
                    $next_line = $file_content[$i + 1];
                } else {
                    $next_line = '';
                }

                if (! empty($next_line) && Utils::startsWith($current_line, ';')) {
                    // Source strings start with ";". I have a reference string followed by something
                    $reference = Utils::leftStrip($current_line, ';');
                    $translation = trim($next_line);

                    if (isset($dotlang_data['strings'][$reference]) && $reference_locale) {
                        /* String is already stored, it's a duplicated string. If it's the reference
                         * locale I save the string ID to issue a warning where necessary.
                         */
                        $dotlang_data['duplicates'][] = $reference;
                    }

                    // If we don't extract metadata, we shouldn't test for #
                    $markers = self::$extract_metadata
                        ? [';', '#']
                        : [';'];

                    // We test the most common scenario first: reference string followed by a translation
                    if (! Utils::startsWith($translation, $markers)) {
                        // Store the translation
                        $dotlang_data['strings'][$reference] = $translation;
                        continue;
                    }

                    /* Empty translation: what I'm reading as translation is either the next reference string
                     * or the next meta tag (comment, tag binding). I consider this string untranslated.
                     */
                    $dotlang_data['strings'][$reference] = $reference;
                }
            }

            if ($reference_locale) {
                // Second pass: extract only metadata (comments, tag bindings) for reference locale.
                if (self::$extract_metadata) {
                    $dotlang_data = array_merge($dotlang_data, self::extractReferenceMetaData($file_content));
                }
                // Store reference locale data statically because it is used multiple times
                self::$parsed_files[$path] = $dotlang_data;
            }
        }

        return $dotlang_data;
    }

    /**
     * Provide all meta tags in format “## METATAG:”
     *
     * @return array All the meta tags we use with the right formatting
     */
    public static function getMetaTags()
    {
        // All meta tags in format “## METATAG:”, but not file tags (“## TAGNAME ##”)
        $meta_tags = ['NOTE', 'TAG', 'MAX_LENGTH', 'URL'];
        $meta_tags = array_map(
            function ($tag) {
                return "## {$tag}:";
            },
            $meta_tags
        );

        return $meta_tags;
    }

    /**
     *  Extract the metadata in English reference file
     *
     * @param array $file_content Content of a lang file
     *
     * @return array Parsed lang file with the associated reference metadata
     */
    private static function extractReferenceMetaData($file_content)
    {
        $dotlang_data = [];
        for ($i = 0, $lines = count($file_content); $i < $lines; $i++) {
            $current_line = $file_content[$i];
            if (Utils::startsWith($current_line, ';')) {
                // I have a reference string
                $reference = Utils::leftStrip($current_line, ';');
                $j = $i - 1;
                while ($j >= 0) {
                    // Stop if I find a line not starting with #
                    if (! Utils::startsWith($file_content[$j], '#')) {
                        break;
                    }
                    // Comments
                    if (Utils::startsWith($file_content[$j], '#') &&
                        ! Utils::startsWith($file_content[$j], '##')) {
                        $dotlang_data['comments'][$reference][] = Utils::leftStrip($file_content[$j], '#');
                    } else {
                        // Tag bindings
                        if (Utils::startsWith($file_content[$j], '## TAG:')) {
                            $dotlang_data['tag_bindings'][$reference] = Utils::leftStrip($file_content[$j], '## TAG:');
                        }
                        // Length limits
                        if (Utils::startsWith($file_content[$j], '## MAX_LENGTH:')) {
                            $dotlang_data['max_lengths'][$reference] = intval(Utils::leftStrip($file_content[$j], '## MAX_LENGTH:'));
                        }
                    }
                    $j--;
                }
                // Invert order of comments if available
                if (isset($dotlang_data['comments'][$reference])) {
                    $dotlang_data['comments'][$reference] = array_reverse($dotlang_data['comments'][$reference]);
                }
            }
        }

        return $dotlang_data;
    }
}
