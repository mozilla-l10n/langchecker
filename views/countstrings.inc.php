<hr style="clear:both; border:0;">
<pre>
<?php


$todo  = array();
$total = array();

foreach($mozilla as $lang) {

    // we don't care about the reference language
    if ( $lang == 'en-GB' ) continue;


    $todo[$lang]  = 0;
    $total[$lang] = 0;

    foreach($sites[0][4] as $_file) {

        $reflang = 'en-GB';

        // skip the loop if we don't have this lang file for the locale
        if (!in_array($lang, $langfiles_subsets[$sites[0][0]][$_file])) continue;

        // if the .lang file does not exist, we don't want to generate a php warning, just skip the locale for this file
        if (!@file_get_contents($sites[0][1] . $sites[0][2] . $lang . '/' . $_file) ) continue;


        getEnglishSource($reflang, 0, $_file);
        analyseLangFile($lang, 0, $_file);

        $todo[$lang]  +=  count($GLOBALS[$lang]['Identical']) + count($GLOBALS[$lang]['Missing']);

        unset($GLOBALS[$lang]['Identical'], $GLOBALS[$lang]['Missing'] );
        unset($GLOBALS['__english_moz']);
    }

}

arsort($todo);
$locales_done = 0;

echo '<table>';
echo '<tr><th>locale</th><th>Untranslated</th></tr>';

foreach ($todo as $k => $v) {
    if ($v == 0) {
        $class = ' class="dim"';
        $locales_done++;
    } else {
        $class = '';
    }

    echo "<tr$class><td><a href=\"./?locale=$k\">$k</a></td><td>$v</td></tr>";
}

echo '<tr><td colspan="2">' . $locales_done . ' locales done</td></tr>';
echo '</table>';
