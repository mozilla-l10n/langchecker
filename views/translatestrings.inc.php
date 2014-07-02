<?php
namespace Langchecker;
?>
<script>
  function showhide(id) {
    val = document.getElementById(id).style.display;
    if (val == '') {
        document.getElementById(id).style.display='none';
    } else {
        document.getElementById(id).style.display='';
    }

    return false;
  }
  </script>
<?php

$current_filename = (isset($_GET['file'])) ? Utils::secureText($_GET['file']) : 'snippets.lang';
$show_status = isset($_GET['show']) ? 'auto' : 'none';

$supported_file = false;
// Search which website has the requested file
foreach ($sites as $site) {
    if (in_array($current_filename, Project::getWebsiteFiles($site))) {
        $current_website = $site;
        $supported_file = true;
        break;
    }
}

if (! $supported_file) {
    die("<p>ERROR: file {$filename} does not exist</p>");
}

echo "<p>Click on the green English strings to expand/collapse the translations done</p>\n";
echo "<h2>{$current_filename}</h2>\n\n";

$reference_locale = Project::getReferenceLocale($current_website);
$reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

$all_strings = [];

$supported_locales = Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets);
foreach ($supported_locales as $current_locale) {
    if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
        // If the .lang file does not exist, just skip the locale for this file
        continue;
    }
    $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);

    foreach ($reference_data['strings'] as $string_id => $string_value) {
        if (LangManager::isStringLocalized($string_id, $locale_data, $reference_data)) {
            $all_strings[$string_id][$current_locale] = Utils::cleanString($locale_data['strings'][$string_id]);
        }
    }
}

// Colors used to display tags
$bg_colors = ['#459E09', '#B29EF9', '#2D68BA', '#E39530', '#D6D6D4',
              '#E3309E', '#FF4040', '#F5F562', '#F562C7', '#C0FCF2'];
$font_colors = ['#FFF', '#FFF', '#FFF', '#FFF', '#000',
                '#FFF', '#FFF', '#000', '#FFF', '#000'];

if (isset($reference_data['tag_bindings'])) {
    $tag_bindings = $reference_data['tag_bindings'];
    // I want keys in $available_tags to be progressive
    $available_tags = array_values(array_unique(array_values($tag_bindings)));
} else {
    $tag_bindings = [];
    $available_tags = [];
}

$counter = 0;
foreach ($all_strings as $string_id => $available_translations) {
    // Display paragraph with reference string
    echo "<p><a href='#' style='color:green' onclick='showhide(\"table$counter\");'>";
    $header_string = trim(htmlspecialchars($string_id));
    if (isset($tag_bindings[$string_id])) {
        $current_tag = $tag_bindings[$string_id];
        $tag_number = array_search($current_tag, $available_tags);
        $style = "style='background-color: {$bg_colors[$tag_number]}; color: {$font_colors[$tag_number]};'";
        $header_string .= "</a><span title='Associated tag' class='tag' {$style}>" . $current_tag . "</span>";
    } else {
        $header_string .= "</a>";
    }

    echo "<p><a href='#' style='color:green' onclick='showhide(\"table$counter\");'>{$header_string}</p>\n";

    // Display sub-table with localizations for this string
    echo "<table style='width:100%; display: {$show_status};' id='table$counter' class='translations'>";

    $total_translations = count($available_translations);
    $covered_locales = array_keys($available_translations);

    $displayed_rows = 0;
    foreach ($available_translations as $current_locale => $translation) {
        $css_class = ($displayed_rows & 1) ? 'odd' : 'even';
        echo "<tr class='{$css_class}'>\n"
             . "  <th>{$current_locale}</th>\n "
             . "  <td>{$translation}</td>\n"
             . "</tr>\n";
        $displayed_rows++;
    }

    echo "  <td colspan='2' class='done'>Number of locales done: {$total_translations}"
        . ' (' . Project::getUserBaseCoverage($covered_locales, $adu) . '% of our l10n user base)'
        . "  </td>\n</tr>\n</table>";

    $counter++;
}
