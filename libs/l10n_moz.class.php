<?php

class l10n_moz
{
    public function __construct()
    {
        $GLOBALS['__l10n_moz'] = array();
        $GLOBALS['__l10n_moz_files'] = array();
        $GLOBALS['__l10n_comments'] = array();
        $GLOBALS['__english_moz'] = array();
    }


    /**
     *  method mostly used in contexts where we can't male a call to ___()
     *  such ad heredoc blocks where we can only include variables called from
     *  the class
     */
    public function get($key)
    {
        if (array_key_exists($key, $GLOBALS['__l10n_moz']) && !empty($GLOBALS['__l10n_moz'][$key])) {
            return $GLOBALS['__l10n_moz'][$key];
        } else {
            return $key;
        }
    }

    /*
     * loads the file and returns a cleaned up array of the lines
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
        for ($i = 0; $i < count($f); $i++) {
            if (self::startsWith($f[$i], ';') && !empty($f[$i+1])) {
                $f[$i] = trim(str_replace('{l10n-extra}', '', $f[$i]));
                $GLOBALS['__l10n_moz'][trim(substr($f[$i], 1))] = trim(str_replace('{ok}', '&shy;', $f[$i+1]));
                $i++;
            }
        }

        return $f;
    }

    /**
     * Reads in a file of strings into a global array.  File format is:
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
        //~ $f = self::cleanStrings($f);

        for ($i = 0, $lines = count($f); $i < $lines; $i++) {
            if ($i == 0  && $f[0] == '## active ##') {
                $GLOBALS[$array_name]['activated'] = $active = true;
                continue;
            }

            // no active tag
            if (($i == 0 or $i == 1)
                && self::startsWith($f[$i], '## NOTE:')
            ) {
                $GLOBALS[$array_name]['filedescription'][] = trim(substr($f[$i], 8));
                continue;
            }

            // active tag
            if (($i == 1 or $i == 2)
                && $active === true
                && self::startsWith($f[$i], '## NOTE:')
            ) {
                $GLOBALS[$array_name]['filedescription'][] = trim(substr($f[$i], 8));
                continue;
            }

            if (self::startsWith($f[$i], ';') && !empty($f[$i+1])) {

                $english = trim(substr($f[$i], 1));
                $translation = trim($f[$i+1]);

                /* locamotion support conditional */
                if (!isset($GLOBALS[$array_name][$english])
                    || $GLOBALS[$array_name][$english] == $english) {
                    $GLOBALS[$array_name][$english] = $translation;
                }

                if ($i >= 2 && in_array($reflang, $englishes)) {
                    $GLOBALS['__l10n_comments'][$english] = '';

                    if (self::startsWith($f[$i-1], '#') && !self::startsWith($f[$i-1], '##')) {
                        $GLOBALS['__l10n_comments'][$english] .= trim(substr($f[$i-1], 1));
                    }

                    if ($GLOBALS['__l10n_comments'][$english] == '') {
                        unset($GLOBALS['__l10n_comments'][$english]);
                    }
                }
                $i++;
            }
        }

        unset($f);
    }

    /**
     * Gettext import file function
     */
    public static function getPoFile($file)
    {
        if (!file_exists($file)) {
            return false;
        }

        $fc      = implode('', file($file));
        $res     = array();
        $matched = preg_match_all('/(msgid\s+("([^"]|\\\\")*?"\s*)+)\s+'.
        '(msgstr\s+("([^"]|\\\\")*?"\s*)+)/',
        $fc, $matches);

        if (!$matched) {
            return false;
        }

        for ($i=0; $i<$matched; $i++) {
            $msgid  = preg_replace('/\s*msgid\s*"(.*)"\s*/s','\\1',  $matches[1][$i]);
            $msgstr = preg_replace('/\s*msgstr\s*"(.*)"\s*/s','\\1', $matches[4][$i]);
            $res[l10n_moz::poString($msgid)] = l10n_moz::poString($msgstr);
        }

        if (!empty($res[''])) {
            $meta = $res[''];
            unset($res['']);
        }

        return $res;
    }


    /**
     * Gettext import string function
     */
    public static function poString($string,$reverse=false)
    {
        if ($reverse) {
            $smap = array('"', "\n", "\t", "\r");
            $rmap = array('\\"', '\\n"' . "\n" . '"', '\\t', '\\r');
            return (string) str_replace($smap, $rmap, $string);
        } else {
            $smap = array('/"\s+"/', '/\\\\n/', '/\\\\r/', '/\\\\t/', '/\\"/');
            $rmap = array('', "\n", "\r", "\t", '"');
            return (string) preg_replace($smap, $rmap, $string);
        }
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
