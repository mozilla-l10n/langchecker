<?php

$serialdata = array();

foreach( $sites as $key => $val) {

    // skip locale if the site doesn't support it
    if(!in_array($locale, $sites[$key][3])) continue;

    $site = $sites[$key][0];

    foreach($val[4] as $file) {

        /* load the reference English file for the site, use a temp $reflang variable for that */
        $reflang = $sites[$key][6];                // mozeu uses short locale codes
        $source  = $sites[$key][1] . $sites[$key][2] . $reflang . '/' . $file;
        l10n_moz::load($source);
        unset($reflang);

        analyseLangFile($locale, $key, $file, $seconds);

        foreach($GLOBALS[$locale] as $key2 => $val2) {
            $serialdata[$site][$file][$key2] = count($GLOBALS[$locale][$key2]);
        }

        unset($GLOBALS['__english_moz']);
    }

}

echo serialize($serialdata);
