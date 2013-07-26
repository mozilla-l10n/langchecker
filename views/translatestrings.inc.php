<hr style="clear:both; border:0;">
<p>Click on the green English strings to expand/collapse the translations done</p>
<script>

  function showhide(id) {

    val = document.getElementById(id).style.display;

    if (val == '')
    {
        document.getElementById(id).style.display='none';
    }
    else
    {
        document.getElementById(id).style.display='';
    }

    return false;

  }

  </script>
  <style>
    td.done {
        text-align:left;
        font-style:italic;
        color: gray;
    }
  </style>
<?php



// override to not have main.lang as default
$filename = (isset($_GET['file'])) ? secureText($_GET['file']) : 'snippets.lang';


// a switch to show the strings as expanded or not
$show_status = (isset($_GET['show'])) ? 'auto' : 'none';

foreach ($sites as $site) {
    if ($filename != '' && in_array($filename, $site[4])) {
        $site[4] = array($filename);
        break;
    }
}

foreach ($site[4] as $_file) {

    echo '<h2>' . $_file . '</h2>';

    $reflang = $site[5];

    foreach ($sites as $k => $v) {
        if (in_array($site[0], $v)) {
            $target = $k;
            break;
        }
    }

    getEnglishSource($reflang, $target, $_file);


    // reassign a lang file to a reduced set of locales
    @$targetted_locales = (is_array($langfiles_subsets[$sites[$target][0]][$_file]))
                          ? $langfiles_subsets[$sites[$target][0]][$_file]
                          : $sites[$target][3];
    $val = 0;

    foreach ($GLOBALS['__english_moz'] as $k => $v) {

        if ($k == 'filedescription' || $k == 'activated') {
            continue;
        }

        echo "<p><a href='#'  style=\"color:green\" onclick=\"showhide('table$val');return false;\">"
             . trim(str_replace('{l10n-extra}', '', htmlspecialchars($k)))
             . "</a></p>";

        echo "<table style='width:100%; display:{$show_status};' id='table$val'>";

        $val++;

        $stripe = true;
        $total_translations = 0;
        foreach ($targetted_locales as $_lang) {
            // If the .lang file does not exist, just skip the locale for this file
            $local_lang_file = $sites[$target][1] . $sites[$target][2] . $_lang . '/' . $_file;
            if (!@file_get_contents($local_lang_file)) {
                continue;
            }

            l10n_moz::load($local_lang_file);

            if (i__($k)) {
                $total_translations++;
                if ($stripe == true) {
                    $stripe = false;
                    $stripe_color = '#F0F2F6';
                } else {
                    $stripe = true;
                    $stripe_color = 'white';
                }

                $result = trim(str_replace('{l10n-extra}', '', htmlspecialchars(___($k))));

                echo '<tr style="background-color:' . $stripe_color . '">
                      <th style="width:5em" >' . $_lang . '</th>
                      <td style="text-align:left;">' . $result . '</td>
                      </tr>';
            }
            unset($GLOBALS['__l10n_moz']);
        }
        echo "<tr>
              <td colspan='2' class='done'>Number of locales done: $total_translations</td>
              </tr>";
        echo "</table>";


    }
    unset($GLOBALS['__english_moz']);
}

echo '<br style="clear:both;">';
