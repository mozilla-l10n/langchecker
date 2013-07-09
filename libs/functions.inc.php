<?php

if(!$called) die('no direct access');

/**
 * If the string exists in the language cache, return it, otherwise return what was
 * given to us. The language cache is build in the l10n_moz class
 */

function ___($str) {
    $foo = !empty($GLOBALS['__l10n_moz'][$str]) ? $GLOBALS['__l10n_moz'][$str] : $str;
    return (str_replace (' & ', ' &amp; ', $foo));
}


/**
 * print localized string
 *
 */

function e__($str, $clean=0) {
    echo ___($str, $clean);
}


/**
 * Checks if a string is localized returns true/false
 */

function c__($str) {
    return (!empty($GLOBALS['__l10n_moz'][$str])) ? true : false;
}

/**
 * Checks if a string is localized and not identical, returns true/false
 */

function i__($str) {
    if (!empty($GLOBALS['__l10n_moz'][$str]) && $GLOBALS['__l10n_moz'][$str] != $str) {
         return true;
     } else {
         return false;
     }
}



function getEnglishSource($locale, $website, $filename, $seconds=3600) {

    /* data sources */
    include __DIR__ . '/../config/sources.inc.php';

    $local_file = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;
    $toBeCached = false;

    $path = $local_file;
    // fetch the file and cache it or use the local cached version
    if($toBeCached == true) {
        $path = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;
        writeToCache($path, $local_file);
    } else {
        $path = $local_file;
    }

    /* load the English source file stored in $GLOBALS['__english_moz'] */
    l10n_moz::load($path);

    // it is important to reset the reference value just after getting the English strings
    unset($GLOBALS['reflang']);
}

function getTranslations($locale, $website, $filename) {

    /* data sources */
    include __DIR__ . '/../config/sources.inc.php';

    $local_file = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;
    /* load the English source file stored in $GLOBALS['__english_moz'] */
    l10n_moz::load($path);
    // it is important to reset the reference value just after getting the English strings
}

function goodForCache($local_file, $time) {

    if (!file_exists($local_file) || isset($_GET['nocache'])) {
        $toBeCached = true;
    } elseif (isset($_GET['usecache'])) {
            $toBeCached = false;
    } else {
        $age = $_SERVER['REQUEST_TIME'] - filemtime($local_file);
        $toBeCached = ($age > $time) ? true : false;
    }

    return $toBeCached;
}

function fileAge($local_file) {

    if (!file_exists($local_file)) return false;

    $age = $_SERVER['REQUEST_TIME'] - filemtime($local_file);
    return $age;
}

function analyseLangFile($locale, $website, $filename, $seconds=3600) {

    /* data sources */
    include __DIR__ . '/../config/sources.inc.php';

    /* Caching mechanism is here */
    //~ $local_file = $sites[$website][5] . '/' . $locale . '-' . str_replace('/', '_', $filename);
    //~ $toBeCached = goodForCache($local_file, $seconds);

    $local_file = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;
    $toBeCached = false;

    // fetch the file and cache it or use the local cached version
    if($toBeCached == true) {
        $path = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;
        writeToCache($path, $local_file);
    } else {
        $path = $local_file;
    }

    /* load the localized file stored in $GLOBALS['__l10n_moz'], we reset $locale here */
    l10n_moz::load($path);

    /* define sub-arrays for a locale */
    $GLOBALS[$locale]['Identical']   = array();
    $GLOBALS[$locale]['Translated']  = array();
    $GLOBALS[$locale]['Missing']     = array();
    $GLOBALS[$locale]['Obsolete']    = array();
    $GLOBALS[$locale]['python_vars'] = array();

    if (isset($GLOBALS['__l10n_moz'])) {
        foreach ($GLOBALS['__l10n_moz'] as $key => $val) {

            if ($key == 'filedescription' || $key == 'activated') {
                continue;
            }

            if (array_key_exists($key, $GLOBALS['__english_moz'])) {

                if ($val == $GLOBALS['__english_moz'][$key]) {
                    // add to identical strings global array
                    $GLOBALS[$locale]['Identical'][] = $key;
                } elseif ($val != $GLOBALS['__english_moz'][$key]) {
                    // add to OK translated strings global array
                    $GLOBALS[$locale]['Translated'][] = $key;
                    $GLOBALS[$filename][$key] = $val;

                    // We now test if all python variables are ok
                    $regex = '#%\(' . '[a-z0-9._-]+' .'\)s#';
                    preg_match_all($regex, $GLOBALS['__english_moz'][$key], $matches1);
                    preg_match_all($regex, $val, $matches2);

                    if ($matches1[0] != $matches2[0]) {
                     //~ var_dump($matches1[0], $matches2[0]); exit;
                        foreach ($matches1[0] as $python_var) {
                            if (!in_array($python_var, $matches2[0])) {
                                $GLOBALS[$locale]['python_vars'][$key] = $python_var;
                            }
                        }
                    }

                } elseif ($val == '') {
                    // add to missing strings global array
                    $GLOBALS[$locale]['Missing'][] = $key;
                }
            } else if (strstr($key, '{l10n-extra}') == true){
                // add to Identical strings global array
                $GLOBALS[$locale]['Obsolete'][] = str_replace('{l10n-extra}', '', $key);
            } else {
                // add to obsolete strings global array
                $GLOBALS[$locale]['Obsolete'][] = $key;
            }
        }



        foreach($GLOBALS['__english_moz'] as $key => $val) {

            if($key == 'filedescription' || $key == 'activated') {
                continue;
            }

            if(!array_key_exists($key, $GLOBALS['__l10n_moz']) && strstr($key, '{l10n-extra}') == false) {
                $GLOBALS[$locale]['Missing'][] = $key;
            }
        }
        /* We destroy $GLOBALS['__l10n_moz'] to allow multiple locales analysis */
        unset($GLOBALS['__l10n_moz']);
    }
}


/**
 * Function sanitizing a string or an array of strings.
 * Returns a string or an array, depending on the input
 *
 */

function secureText($var, $tablo = true) {
    if (!is_array($var)) {
        $var   = array($var);
        $tablo = false;
    }

    foreach ($var as $item => $value) {
        // CRLF XSS
        $item  = str_replace('%0D', '', $item);
        $item  = str_replace('%0A', '', $item);
        $value = str_replace('%0D', '', $value);
        $value = str_replace('%0A', '', $value);

        // Remove html tags and ASCII characters below 32
        // Deactivated filter since we are still on PHP <5.2 on mozilla.com...
/*
        $value = filter_var(
            $value,
            FILTER_SANITIZE_STRING,
            FILTER_FLAG_STRIP_LOW
        );
*/
        //

        $item  = htmlspecialchars(strip_tags($item), ENT_QUOTES);
        $value = htmlspecialchars(strip_tags($value), ENT_QUOTES);

        // Repopulate value
        $var2[$item] = $value;
    }

    return ($tablo == true) ? $var2 : $var2[0];
}


/*
 * convert short mozeu locales to long moco locales
 *
 */

function mozeuLocaleConvert($lang) {

    $mapme = array(
        'en-GB' => 'en',
        'es-ES' => 'es',
        'nb-NO' => 'no',
        'pt-PT' => 'pt',
        'sv-SE' => 'sv',
    );

    if (array_key_exists($lang, $mapme)) {
        return $mapme[$lang];
    } else {
        return $lang;
    }
}


function var_dump2($val) {
    echo '<pre>';
    echo 'LINE: ' . __LINE__ . '<br>';
    var_dump($val);
    echo '</pre>';
}


/*
 * caching functions
 */

function writeToCache($url, $local) {
    $page = @file_get_contents($url);
    if ($page == false) return;
    file_put_contents($local, $page);
}


function getmicrotime() {
    list($usec, $sec) = explode (' ', microtime());
    return ((float)$usec + (float)$sec);
}

function showPythonVar($str) {
    $regex = '#%\(' . '[a-z0-9._-]+' . '\)s#';
    preg_match_all($regex, $str, $matches);
    foreach ($matches[0] as $val) {
        $str = str_replace($val, "<em>${val}</em>", $str);
    }
    return $str;
}
