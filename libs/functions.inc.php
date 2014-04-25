<?php

/**
 * If the string exists in the language cache, return it, otherwise return what was
 * given to us. The language cache is build in the l10n_moz class
 */

function ___($str)
{
    $foo = !empty($GLOBALS['__l10n_moz'][$str]) ? $GLOBALS['__l10n_moz'][$str] : $str;
    return (str_replace(' & ', ' &amp; ', $foo));
}


/**
 * print localized string
 *
 */

function e__($str, $clean = 0)
{
    echo ___($str, $clean);
}


/**
 * Checks if a string is localized returns true/false
 */

function c__($str)
{
    return (!empty($GLOBALS['__l10n_moz'][$str])) ? true : false;
}

/**
 * Checks if a string is localized and not identical, returns true/false
 */

function i__($str)
{
    if (!empty($GLOBALS['__l10n_moz'][$str]) && $GLOBALS['__l10n_moz'][$str] != $str) {
        return true;
    } else {
        return false;
    }
}



function getEnglishSource($locale, $website, $filename)
{

    /* data sources */
    include __DIR__ . '/../config/sources.inc.php';

    $path = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;

    /* load the English source file stored in $GLOBALS['__english_moz'] */
    l10n_moz::load($path);

    // it is important to reset the reference value just after getting the English strings
    unset($GLOBALS['reflang']);
}

function getTranslations($locale, $website, $filename)
{
    /* data sources */
    include __DIR__ . '/../config/sources.inc.php';

    $local_file = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;
    /* load the English source file stored in $GLOBALS['__english_moz'] */
    l10n_moz::load($path);
    // it is important to reset the reference value just after getting the English strings
}

function analyseLangFile($locale, $website, $filename)
{
    /* data sources */
    include __DIR__ . '/../config/sources.inc.php';

    $path = $sites[$website][1] . $sites[$website][2] . $locale . '/' . $filename;

    /* load the localized file stored in $GLOBALS['__l10n_moz'], we reset $locale here */
    l10n_moz::load($path);

    /* define sub-arrays for a locale */
    $GLOBALS[$locale]['Identical']   = array();
    $GLOBALS[$locale]['Translated']  = array();
    $GLOBALS[$locale]['Missing']     = array();
    $GLOBALS[$locale]['Obsolete']    = array();
    $GLOBALS[$locale]['python_vars'] = array();
    $GLOBALS[$locale]['tags']        = array();
    $GLOBALS[$locale]['activated']   = false;


    if (isset($GLOBALS['__l10n_moz'])) {
        foreach ($GLOBALS['__l10n_moz'] as $key => $val) {

            if ($key == 'filedescription') {
                continue;
            }

            if ($key == 'activated') {
                $GLOBALS[$locale]['activated'] = $val;
                continue;
            }

            if ($key == 'tags') {
                $GLOBALS[$locale]['tags'] = $val;
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
                        // var_dump($matches1[0], $matches2[0]); exit;
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
            } elseif (strstr($key, '{l10n-extra}') == true) {
                // add to Identical strings global array
                $GLOBALS[$locale]['Obsolete'][] = str_replace('{l10n-extra}', '', $key);
            } else {
                // add to obsolete strings global array
                $GLOBALS[$locale]['Obsolete'][] = $key;
            }
        }



        foreach ($GLOBALS['__english_moz'] as $key => $val) {

            if (in_array($key, ['filedescription', 'activated', 'tags'])) {
                continue;
            }

            if (!array_key_exists($key, $GLOBALS['__l10n_moz']) && strstr($key, '{l10n-extra}') == false) {
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

function secureText($var, $tablo = true)
{
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

function var_dump2($val)
{
    echo '<pre>';
    echo 'LINE: ' . __LINE__ . '<br>';
    var_dump($val);
    echo '</pre>';
}

function showPythonVar($str)
{
    $regex = '#%\(' . '[a-z0-9._-]+' . '\)s#';
    preg_match_all($regex, $str, $matches);
    foreach ($matches[0] as $val) {
        $str = str_replace($val, "<em>${val}</em>", $str);
    }

    return $str;
}


function jsonOutput(array $data, $jsonp = false)
{
    $json = json_encode($data);
    $mime = 'application/json';

    if ($jsonp && is_string($jsonp)) {
        $mime = 'application/javascript';
        $json = $jsonp . '(' . $json . ')';
    }

    ob_start();
    header("access-control-allow-origin: *");
    header("Content-type: {$mime}; charset=UTF-8");
    echo $json;
    $json = ob_get_contents();
    ob_end_clean();
    return $json;
}

/**
 * getUserBaseCoverage()
 *
 * @param array $locales an array of locales
 *
 * @return string a percent value of our coverage for the user base
 */

function getUserBaseCoverage($locales)
{
    include __DIR__ . '/../config/adu.inc.php';

    // Japanese has 2 builds
    $adu['ja'] = $adu['ja'] + $adu['ja-JP-mac'];
    unset($adu['ja-JP-mac']);

    $english = $adu['en-GB'] + $adu['en-US'] + $adu['en-ZA'];
    $locales = array_intersect_key($adu, array_flip($locales));

    return number_format( array_sum($locales) / (array_sum($adu) - $english) *100, 2);
}


/*
 *  SAPI file (lang_update)
 */

function buildFile($eol, $exceptions = [])
{
    ob_start();
    header('Content-type: text/plain; charset=UTF-8');

    if ($GLOBALS['__l10n_moz']['activated']) {
        print '## active ##' . $eol;
    }

    $tags = isset($GLOBALS['__l10n_moz']['tags'])
            ? $GLOBALS['__l10n_moz']['tags']
            : [];
    $tags = array_intersect(
        $tags,
        getAllowedTagsInFile()
    );

    foreach ($tags as $tag) {
        print "## {$tag} ##" . $eol;
    }

    foreach ($GLOBALS['__english_moz'] as $key => $val) {
        if ($key == 'activated' || $key == 'tags') {
            continue;
        }

        if ($key == 'filedescription') {
            foreach ($GLOBALS['__english_moz']['filedescription'] as $header) {
                print '## NOTE: ' . $header . $eol;
            }
            print  $eol . $eol;
            continue;
        }
        print dumpString($key, $eol, $exceptions);
    }

    /* put l10n extras at the end of the file */
    foreach ($GLOBALS['__l10n_moz'] as $key => $val) {
        if (strstr($key, '{l10n-extra}') == true) {
            print dumpString($key, $eol);
        }
    }

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

/**
 * Get the list of allowed tags for a file
 * @param array $tags_in_file Optional, list of tags provided, otherwise NULL
 * @param array $reference_tags Optional, list of tags allowed, otherwise NULL
 * @return array List of tags allowed for the lang file
 */
function getAllowedTagsInFile($tags_in_file = null, $reference_tags = null)
{
    /*
        We want to be able to override GLOBALS with custom sets of tags
    */

    if ($tags_in_file == null) {
        $tags_in_file = isset($GLOBALS['__l10n_moz']['tags'])
            ? $GLOBALS['__l10n_moz']['tags']
            : [];
    }

    if ($reference_tags == null) {
        $reference_tags = isset($GLOBALS['__english_moz']['tags'])
            ? $GLOBALS['__english_moz']['tags']
            : [];
    }

    return array_intersect($tags_in_file, $reference_tags);
}

/*
 *  SAPI file (lang_update)
 */
function dumpString($english, $eol, $exceptions = array())
{
    if ($english == 'activated') {
        return;
    }

    $chunk = '';

    if (isset($GLOBALS['__l10n_comments'][$english])) {
        $chunk .= '# ' . trim($GLOBALS['__l10n_comments'][$english]) . $eol;
    }

    $chunk .= ";$english" . $eol;

    $span_to_br = function ($str) {
        return str_replace(array('<span>', '</span>'), array('<br />', ''), $str);
    };

    if (array_key_exists($english, $exceptions)
        && isset($GLOBALS['__l10n_moz'][$exceptions[$english]])
        ) {
        //$tempString = strip_tags($GLOBALS['__l10n_moz'][$exceptions[$english]]);
        $tempString = $GLOBALS['__l10n_moz'][$exceptions[$english]];
        if (!in_array($GLOBALS['__l10n_moz']['locale_code'], ['hu', 'sr'])) {
            $brands = ['Movistar', 'T-Mobile', 'Telekom', 'Telenor', 'Cosmote', 'Congstar', 'Vivo', 'TIM'];
            $brands_links = ['<a href="%s">Movistar</a>', '<a href="%s">T-Mobile</a>',
                       '<a href="%s">Telekom</a>', '<a href="%s">Telenor</a>',
                       '<a href="%s">Cosmote</a>', '<a href="%s">Congstar</a>',
                       '<a href="%s">Vivo</a>', '<a href="%s">TIM</a>'];
        } elseif ($GLOBALS['__l10n_moz']['locale_code'] == 'sr') {
            $brands = ['Movistar-у', 'T-Mobile-у', 'Telekom-у', 'Telenor-у', 'Cosmote-у', 'Congstar-у', 'Vivo-у', 'TIM-у'];
            $brands_links = ['<a href="%s">Movistar-у</a>', '<a href="%s">T-Mobile-у</a>',
                       '<a href="%s">Telekom-у</a>', '<a href="%s">Telenor-у</a>',
                       '<a href="%s">Cosmote-у</a>', '<a href="%s">Congstar-у</a>',
                       '<a href="%s">Vivo-у</a>', '<a href="%s">TIM-у</a>'];
        } else {
            $brands = ['Movistarnál', 'T-Mobile-nál', 'Telekomnál', 'Telenornál', 'Cosmote-nál', 'Congstarnál', 'Vivonál', 'TIM-nél'];
            $brands_links = ['<a href="%s">Movistarnál</a>', '<a href="%s">T-Mobile-nál</a>',
                       '<a href="%s">Telekomnál</a>', '<a href="%s">Telenornál</a>',
                       '<a href="%s">Cosmote-nál</a>', '<a href="%s">Congstarnál</a>',
                       '<a href="%s">Vivonál</a>', '<a href="%s">TIM-nél</a>'];
        }

        if ($english == 'Hungary with both <a href="%s">Telenor</a> and <a href="%s">T-Mobile</a>') {
            if ($GLOBALS['__l10n_moz']['locale_code'] != 'hu') {
                $tempString = str_replace('Telekom', 'T-Mobile', $tempString);
            } else {
                $tempString = str_replace('Telekom', 'T-Mobile-', $tempString);
            }
        }

        $chunk .= str_replace($brands, $brands_links, $tempString);
    } else {
        $chunk .= (array_key_exists($english, $GLOBALS['__l10n_moz'])) ? $GLOBALS['__l10n_moz'][$english]: $english;
    }

    $chunk .= $eol . $eol . $eol;

    return $chunk;
}

/**
 * Import a string from Transvision API
 * @param string $id UID of the string
 * @param string $locale locale code
 * @param string $repo repository (aurora, beta, release, central, gaia...)
 * @return string Translation if it exists or empty string
 */
function getFromTransvision($id, $locale, $repo) {
    $site = 'http://transvision.mozfr.org/?recherche=';
    $url = $site . $id . '&repo=' . $repo . '&sourcelocale=en-US&locale='
           . $locale . '&search_type=entities&json&json';
    $translation = json_decode(file_get_contents($url), true);

    return array_values($translation[$id])[0];
}


/*
 *  SAPI file (lang_update)
 */
function fileForceContents($dir, $contents)
{
    $parts = explode('/', $dir);
    $file = array_pop($parts);
    $dir = '';

    foreach ($parts as $part) {
        if (!is_dir($dir .= "/$part")) {
            mkdir($dir);
        }
    }

    file_put_contents("$dir/$file", $contents);
}


/*
 *  SAPI file (lang_update)
 */
function isWindowsEOL($line)
{
    return (substr($line, -2) === "\r\n") ? true : false;
}


/*
 *  SAPI file (lang_update)
 */
function scrapLocamotion($lang, $filename, $source)
{
    global $mozillaorg_lang;
    global $locamotion_locales;
    $imported_strings = false;

    if (!in_array($lang, $locamotion_locales)) {
        return false;
    }

    logger('== ' . $lang . ' ==');

    /* import data from locamotion */
    $locamotion = 'https://raw.github.com/translate/mozilla-lang/master/'
                  . str_replace('-', '_', $lang)
                  . '/' . $filename . '.po';
    $http_response = get_headers($locamotion, 1)[0];
    $po_exists = strstr($http_response, '200') ? true : false;

    if ($po_exists) {
        logger("Fetching $filename from Locamotion");
        file_put_contents('temp.po', file_get_contents($locamotion));

        $po_parser = new Sepia\PoParser();
        $po_strings = $po_parser->read('temp.po');
        unlink('temp.po');

        $temp_lang  = '';

        if (count($po_strings) > 0) {
            // Create a temp.lang file containing strings extracted from Locamotion's .po file
            foreach ($po_strings as $entry) {
                if (!isset($entry['fuzzy']) && implode($entry['msgstr']) != '') {
                    if (implode($entry['msgid']) == implode($entry['msgstr'])) {
                        // Add {ok} if the translation is identical to the English string
                        $string_status = ' {ok}';
                    } else {
                        $string_status = '';
                    }
                    $temp_lang .=
                        ';'
                        . implode($entry['msgid']) . PHP_EOL
                        . implode($entry['msgstr']) . $string_status . PHP_EOL . PHP_EOL . PHP_EOL;
                }
            }
            file_put_contents('temp.lang', $temp_lang);

            // Store "__l10n_moz" containing the strings currently available in SVN
            $local_lang_file = $GLOBALS['__l10n_moz'];
            unset($GLOBALS['__l10n_moz']);

            // Load temp.lang and store strings coming from Locamotion
            l10n_moz::load('temp.lang');
            unlink('temp.lang');
            $imported_lang_file = $GLOBALS['__l10n_moz'];

            foreach ($imported_lang_file as $key => $val) {
                $val = is_array($val) ? $val[0] : $val;
                if ($key != 'filedescription'
                    && $key != 'activated'
                    && $key != 'tags'
                    && array_key_exists($key, $local_lang_file)
                    ) {
                    if ($local_lang_file[$key] != $val) {
                        logger('Imported string: ' . $key .' => ' . $val);
                        $imported_strings = true;
                    }
                }
            }
            // Clean up
            unset($po_parser);

            // Copy tags from the original local file if we need to use temp.lang as source
            if ($imported_strings && isset($local_lang_file['tags'])) {
                $GLOBALS['__l10n_moz']['tags'] = $local_lang_file['tags'];
            }
        } else {
            logger($filename . '.po has no strings in it');
        }


    } else {
        logger("$locamotion does not exist, http code was $http_response");
    }

    if ($imported_strings) {
        logger("Data from Locamotion extracted and added to local repository.");
        return true;
    } else {
        logger("No new strings from Locamotion added to local repository.");
        return false;
    }
}


/*
 *  SAPI file (lang_update)
 */

function logger($str, $action='')
{
    error_log($str . "\n");
    if ($action == 'quit') {
        die;
    }
}

function isUTF8($filename)
{
    $info = finfo_open(FILEINFO_MIME_ENCODING);
    $type = finfo_buffer($info, file_get_contents($filename));
    finfo_close($info);

    return ($type == 'utf-8' || $type == 'us-ascii') ? true : false;
}
