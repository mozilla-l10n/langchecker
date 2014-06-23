<?php
namespace Langchecker;

class DotLangParser
{
    public function __construct()
    {
        $GLOBALS['__l10n_moz']       = array();
        $GLOBALS['__l10n_moz_files'] = array();
        $GLOBALS['__l10n_comments']  = array();
        $GLOBALS['__english_moz']    = array();
    }


    /*
     *  Method mostly used in contexts where we can't make a call to ___()
     *  such as heredoc blocks where we can only include variables called from
     *  the class.
     */
    public function get($key)
    {
        if (array_key_exists($key, $GLOBALS['__l10n_moz']) && !empty($GLOBALS['__l10n_moz'][$key])) {
            return $GLOBALS['__l10n_moz'][$key];
        }

        return $key;
    }

    /*
     * Loads the file and returns a cleaned up array of the lines
     */
    public static function getFile($file)
    {
        if (!is_file($file)) {
            error_log($file . ' does not exist!');

            return false;
        }

        $file = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (count($file) > 0) {
            $file[0] = trim($file[0], "\xEF\xBB\xBF");
        }

        return $file;
    }

    /*
     * Remove specific tags in strings before analysis
     */
    public static function cleanStrings($f)
    {
        for ($i = 0, $j = count($f); $i < $j; $i++) {
            if (self::startsWith($f[$i], ';') && !empty($f[$i+1])) {
                $f[$i] = trim(str_replace('{l10n-extra}', '', $f[$i]));
                $GLOBALS['__l10n_moz'][trim(substr($f[$i], 1))] = trim(str_replace('{ok}', '&shy;', $f[$i+1]));
                $i++;
            }
        }

        return $f;
    }

    /*
       Reads in a file of strings into a global array.  File format is:

        ## active ##    // optional, only valid at the beginning of the file
        ## tag_name ##  // optional tags after the activation status

        ## NOTE: file description // optional

        ## TAG: tag_name // optional, used to bind a string to a tag
        # Comment  // optional
        ;String in english
        translated string

        ;Another string
        another translated string

     */
    public static function load($file)
    {
        global $reflang;
        $GLOBALS['__l10n_moz_files'][] = $file;
        $englishes = array('en-GB', 'en', 'en-US', 'en-ZA');
        $array_name = in_array($reflang, $englishes) ? '__english_moz' : '__l10n_moz';
        $GLOBALS[$array_name]['activated'] = $active = false;
        $f = self::getFile($file);

        for ($i = 0, $lines = count($f); $i < $lines; $i++) {
            /* First line may contain an activation status
             * Tags are read with regexp "^## (\w+) ##", so trailing spaces can be ignored
             */
            if ($i == 0 && rtrim($f[0]) == '## active ##') {
                $GLOBALS[$array_name]['activated'] = $active = true;
                continue;
            }

            // Get file description
            if (self::startsWith($f[$i], '## NOTE:')) {
                $GLOBALS[$array_name]['filedescription'][] = trim(substr($f[$i], 8));
                continue;
            }

            // Other tags (promos)
            if (self::startsWith($f[$i], '##') &&
                ! self::startsWith($f[$i], '## NOTE:') &&
                ! self::startsWith($f[$i], '## TAG:')) {
                $GLOBALS[$array_name]['tags'][] = trim(str_replace('##', '', $f[$i]));
                continue;
            }

            if (self::startsWith($f[$i], ';') && !empty($f[$i+1])) {

                $english = trim(substr($f[$i], 1));
                $translation = trim($f[$i+1]);

                if (self::startsWith($translation, ';') || self::startsWith($translation, '#')) {
                    /* Empty translation: what I'm reading as translation is either the next reference string
                     * or the next meta tag (comment, tag binding). I'll consider the string untranslated.
                     */
                    $GLOBALS[$array_name][$english] = $english;
                    continue;
                } else {
                    // locamotion support conditional
                    if (!isset($GLOBALS[$array_name][$english])
                        || $GLOBALS[$array_name][$english] == $english) {
                        $GLOBALS[$array_name][$english] = $translation;
                    }

                    if ($i >= 2 && in_array($reflang, $englishes)) {
                        if (self::startsWith($f[$i-1], '## TAG:')) {
                            // Only tag binding
                            $GLOBALS[$array_name]['tag_bindings'][$english] = trim(substr($f[$i-1], 7));
                        }
                        if (self::startsWith($f[$i-2], '## TAG:')) {
                            // Tag binding and comment
                            $GLOBALS[$array_name]['tag_bindings'][$english] = trim(substr($f[$i-2], 7));
                        }
                        if (self::startsWith($f[$i-1], '#') && !self::startsWith($f[$i-1], '##')) {
                            // Only l10n comment
                            $GLOBALS['__l10n_comments'][$english] = trim(substr($f[$i-1], 1));
                        }
                        if (self::startsWith($f[$i-2], '#') && !self::startsWith($f[$i-2], '##')) {
                            // L10n comment and tag binding
                            $GLOBALS['__l10n_comments'][$english] = trim(substr($f[$i-2], 1));
                        }
                    }
                }
                $i++;
            }
        }

        unset($f);
    }

    /*
     * Check if $haystack starts with the $needle string
     *
     * @param $haystack string
     * @param $needle string
     * @return boolean
     */
    public static function startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }
}
