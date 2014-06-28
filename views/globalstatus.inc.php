<?php
namespace Langchecker;

ob_start();

$done = array();

// Override to not have main.lang as default
$filename = isset($_GET['file']) ? secureText($_GET['file']) : '';

if ($filename != '' && in_array($filename, $sites[$website][4])) {
    $sites[$website][4] = array($filename);
} else {
    die('<p>ERROR: The file "' . $filename . '" does not exist</p>');
}

foreach ($sites[$website][4] as $_file) {

    $json = array();

    $reflang = $sites[$website][5];

    getEnglishSource($reflang, $website, $_file);

    $translation_link = "?website={$website}&amp;file={$_file}&amp;action=translate";
    echo '
<table class="sortable globallist">
  <caption class="filename"><a href="' . $translation_link . '" title="View available translations for this file">' . $_file . '</a></caption>
  <thead>
    <tr>
      <th>Locale</th>
      <th>Identical</th>
      <th>Translated</th>
      <th>Missing</th>
      <th>Obsolete</th>
      <th>Tags</th>
      <th>Activated</th>
    </tr>
  </thead>
  <tbody>
';

    // Reassign a lang file to a reduced set of locales
    @$targetted_locales = is_array($langfiles_subsets[$sites[$website][0]][$_file])
                            ? $langfiles_subsets[$sites[$website][0]][$_file]
                            : $sites[$website][3];

    // Initialization of locales with 0 strings untranslated
    $count_done = 0;

    foreach ($targetted_locales as $_lang) {

        if ($_lang == 'en' || $_lang == 'en-GB') {
            continue;
        }

        // If the .lang file does not exist, we don't want to generate a php warning, just skip the locale for this file
        $local_lang_file = $sites[$website][1] . $sites[$website][2] . $_lang . '/' . $_file;

        if (!@file_get_contents($local_lang_file)) {
            continue;
        }

        analyseLangFile($_lang, $website, $_file);

        //~ var_dump($GLOBALS[$_lang]);

        $todo  = count($GLOBALS[$_lang]['Identical']) + count($GLOBALS[$_lang]['Missing']);
        $total = $todo + count($GLOBALS[$_lang]['Translated']);

        $cssclass = $todo/$total>0.60 ? ' lightlink' : '';
        $color = 'rgba(255, 0, 0, ' . $todo/$total . ')';

        if ($todo == 0) {
            $count_done++;
            $done[] = $_lang;
        }

        echo "    <tr>\n";
        echo '      <td class="linklocale' . $cssclass . '" style="background-color:'
              . $color
              . ';">
        <a href="./?locale='
              . $_lang
              . '#'
              . $_file
              . '">'
              . $_lang
              . "</a>
      </td>\n";
        foreach ($GLOBALS[$_lang] as $key => $val) {

            // standardize the creation of a table cell
            $td = function ($content, $class = false) {
                return '      <td'
                        . ($class ? " class='{$class}'>" : '>')
                        . "{$content}</td>\n";
            };

            if ($key == 'python_vars' || $key == 'tag_bindings') {
                continue;
            }

            if ($key == 'tags') {
                $json[$_file][$_lang][$key] = $val;

                // remove promo_suffix
                $val = str_replace('promo_', '', $val);

                sort($val);

                if (!empty($val)) {
                    echo $td(implode('<br>', $val), 'tags_column');
                } else {
                    echo $td('');
                }

                continue;
            }

            if ($key == 'activated') {
                $json[$_file][$_lang][$key] = $val;

                if ($val) {
                    echo $td('', 'activated');
                } else {
                    echo $td('');
                }

                continue;
            }

            $counter = count($GLOBALS[$_lang][$key]);
            $counter = ($counter > 0) ? $counter : '';
            $json[$_file][$_lang][$key] = (int) $counter;

            echo $td($counter);
        }

        echo "    </tr>\n";
        unset($GLOBALS[$_lang]);
    }

    $done = getUserBaseCoverage($done) . '%';

    echo '
  </tbody>
  <tfoot>
    <tr>
      <td colspan= "7">'
        . $count_done
        . ' perfect locales ('
        . round($count_done/count($targetted_locales)*100)
        . '%)<br>'
        . $done
        . ' of our l10n user base'
        . '</td>
    </tr>
  </tfoot>
</table>
';

}

$htmlresult = ob_get_contents();
ob_clean();

echo !isset($_GET['json']) ? $htmlresult : jsonOutput($json);
