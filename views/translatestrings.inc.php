<?php
namespace Langchecker;
?>
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
$filename = isset($_GET['file']) ? secureText($_GET['file']) : '';

// a switch to show the strings as expanded or not
$show_status = isset($_GET['show']) ? 'auto' : 'none';

$file_found = false;
foreach ($sites as $site) {
    if ($filename != '' && in_array($filename, $site[4])) {
        $file_found = true;
        break;
    }
}

if (! $file_found) {
    die('<p>ERROR: The file "' . $filename . '" does not exist</p>');
}

echo '<p>Click on the green English strings to expand/collapse the translations done</p>
      <h2>' . $filename . '</h2>';

$reflang = $site[5];

foreach ($sites as $k => $v) {
    if (in_array($site[0], $v)) {
        $target = $k;
        break;
    }
}

getEnglishSource($reflang, $target, $filename);


// reassign a lang file to a reduced set of locales
@$target_locales = is_array($langfiles_subsets[$sites[$target][0]][$filename])
                      ? $langfiles_subsets[$sites[$target][0]][$filename]
                      : $sites[$target][3];
$val = 0;

$bg_colors = ['#459E09', '#B29EF9', '#2D68BA', '#E39530', '#D6D6D4',
              '#E3309E', '#FF4040', '#F5F562', '#F562C7', '#C0FCF2'];
$font_colors = ['#FFF', '#FFF', '#FFF', '#FFF', '#000',
                '#FFF', '#FFF', '#000', '#FFF', '#000'];

foreach ($GLOBALS['__english_moz'] as $k => $v) {
    if (in_array($k, ['filedescription', 'activated', 'tags', 'tag_bindings'])) {
        continue;
    }

    $tag_bindings = $GLOBALS['__english_moz']['tag_bindings'];
    // I want keys in $available_tags to be progressive
    $available_tags = array_values(array_unique(array_values($tag_bindings)));
    $header_string = trim(str_replace('{l10n-extra}', '', htmlspecialchars($k)));
    if (isset($tag_bindings[$k])) {
        $current_tag = $tag_bindings[$k];
        $tag_number = array_search($current_tag, $available_tags);
        $style = "style='background-color: {$bg_colors[$tag_number]}; color: {$font_colors[$tag_number]};'";
        $header_string .= "</a><span title='Associated tag' class='tag' {$style}>" . $current_tag . "</span>";
    } else {
        $header_string .= "</a>";
    }

    echo "<p><a href='#'  style=\"color:green\" onclick=\"showhide('table$val');return false;\">"
         . $header_string . "</p>";

    echo "<table style='width:100%; display:{$show_status};' id='table$val'>";

    $val++;

    $stripe = true;
    $total_translations = 0;
    $covered_locales = [];
    foreach ($target_locales as $_lang) {
        // If the .lang file does not exist, just skip the locale for this file
        $local_langfilename = $sites[$target][1] . $sites[$target][2] . $_lang . '/' . $filename;
        if (! @file_get_contents($local_langfilename)) {
            continue;
        }

        DotLangParser::load($local_langfilename);

        if (i__($k)) {
            $total_translations++;
            $covered_locales[] = $_lang;
            if ($stripe == true) {
                $stripe = false;
                $stripe_color = '#FAF6ED';
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
    echo '<tr>'
        . "<td colspan='2' class='done'>Number of locales done: $total_translations"
        . ' (' .getUserBaseCoverage($covered_locales) . '% of our l10n user base)'
        . '</td>'
        . '</tr>'
        . '</table>';
}
