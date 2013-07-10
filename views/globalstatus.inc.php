<hr style="clear:both; border:0;">
<?php
$done = array();

// override to not have main.lang as default
$filename = (isset($_GET['file'])) ? secureText($_GET['file']) : ''; // which file are we comparing? Default to main.lang

if($filename != '' && in_array($filename, $sites[$website][4]))  {
    $sites[$website][4] = array($filename);
}

foreach($sites[$website][4] as $_file) {

    $reflang = $sites[$website][6];

    getEnglishSource($reflang, $website, $_file, $seconds);

    echo '<table class="globallist"><tr><th colspan="5" class="filename">' . $_file . '</th></tr>';
    echo '<tr><th>Locale</th><th>Identical</th><th>Translated</th><th>Missing</th><th>Obsolete</th></tr>';

    // reassign a lang file to a reduced set of locales
    @$targetted_locales = (is_array($langfiles_subsets[$sites[$website][0]][$_file])) ? $langfiles_subsets[$sites[$website][0]][$_file] : $sites[$website][3];

    // initialization of locales with 0 strings untranslated
    $count_done = 0;

    foreach( $targetted_locales as $_lang) {

        if ($_lang == 'en' || $_lang == 'en-GB' ) continue;

        // if the .lang file does not exist, we don't want to generate a php warning, just skip the locale for this file
        $local_lang_file = $sites[$website][1] . $sites[$website][2] . $_lang . '/' . $_file;

        if ( !@file_get_contents($local_lang_file) ) {
            continue;
        }
        analyseLangFile($_lang, $website, $_file, $seconds);
        //~ var_dump($GLOBALS[$_lang]);
        $todo    = count($GLOBALS[$_lang]['Identical']) + count($GLOBALS[$_lang]['Missing']);
        $total   = $todo + count($GLOBALS[$_lang]['Translated']);
        $color = 'rgba(255, 0, 0, ' . $todo/$total . ')';

        if($todo == 0) {
            $count_done++;
            $done[] = $_lang;
        }

        echo '<tr>';
        echo '<td style="background-color:' . $color . ';"><a href="./?locale=' . $_lang . '#' . $_file . '">' . $_lang . '</a></td>';
        foreach($GLOBALS[$_lang] as $key => $val) {
            if ($key == 'python_vars') {
                continue;
            }
            $counter = count($GLOBALS[$_lang][$key]);
            $counter = ($counter > 0) ? $counter : '';

            echo '<td>' . $counter . '</td>';
        }
        if ($_lang == 'lij') {
            //~ var_dump($GLOBALS[$_lang]);
        }
        unset($GLOBALS[$_lang]);
    }
    // adu count
    $done = array_flip($done);
    $done = array_intersect_key($adu, $done);
    $done = array_sum($done);
    $done = number_format($done/(array_sum($adu)-$adu['en-US']-$adu['en-GB']-$adu['en-ZA'])*100, 2) . '%';

    echo '<tr><td colspan= "5">' . $count_done . ' perfect locales (' . round($count_done/count($targetted_locales)*100) .'%)<br>' .  $done . ' of our l10n user base</td></tr>';
    echo '</table>';

    unset($GLOBALS['__english_moz']);
}
