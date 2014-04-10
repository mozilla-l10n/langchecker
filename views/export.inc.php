<?php

$export = array();

foreach ($sites as $key => $_site) {

    // we recheck if the locale is ok on each loop
    $localeok = false;

    if (in_array($locale, $_site[3])) {
        $localeok = true;

        foreach ($_site[4] as $filename) {

            // reassign a lang file to a reduced set of locales
            if (isset($langfiles_subsets[$_site[0]][$filename])
                && is_array($langfiles_subsets[$_site[0]][$filename])
                && !in_array($locale, $langfiles_subsets[$_site[0]][$filename]) ) {
                continue;
            }

            /*
             * Define English defaults stored in $GLOBALS['__english_moz']
             * we temporarilly define a $lang variable for that
             */
            $reflang = $sites[$key][5];


            $source = $sites[$key][1] . $sites[$key][2] . $reflang . '/' . $filename;
            $target = $sites[$key][1] . $sites[$key][2] . $locale  . '/' . $filename;

            getEnglishSource($reflang, $key, $filename);

            analyseLangFile($locale, $key, $filename);

            $export[$_site[0]][$filename]['identical']  = count($GLOBALS[$locale]['Identical']);
            $export[$_site[0]][$filename]['missing']    = count($GLOBALS[$locale]['Missing']);
            $export[$_site[0]][$filename]['obsolete']   = count($GLOBALS[$locale]['Obsolete']);
            $export[$_site[0]][$filename]['translated'] = count($GLOBALS[$locale]['Translated']);

            if ($_site[0] == 'www.mozilla.org' && array_key_exists($filename, $mozillaorg_lang)) {
                $export[$_site[0]][$filename]['critical'] = $mozillaorg_lang[$filename];
            }
            if ($_site[0] == 'about:healthreport' && array_key_exists($filename, $firefoxhealthreport_lang)) {
                $export[$_site[0]][$filename]['critical'] = $firefoxhealthreport_lang[$filename];
            }

            if ($_site[0] == 'slogans' && array_key_exists($filename, $slogans_lang)) {
                $export[$_site[0]][$filename]['critical'] = $slogans_lang[$filename];
            }
            if ($_site[0] == 'snippets' && array_key_exists($filename, $snippets_lang)) {
                $export[$_site[0]][$filename]['critical'] = $snippets_lang[$filename];
            }

            // Some files have a deadline
            if (array_key_exists($filename, $deadline)) {
                $export[$_site[0]][$filename]['deadline'] = $deadline[$filename];
            }

            unset($GLOBALS['__english_moz'], $GLOBALS[$locale]);
        }
    }
}

if ($serial) {
    header("Content-type:text/plain");
    die(serialize($export));
}

if ($json) {
    die(Transvision\Json::output($export, false, true));
}
