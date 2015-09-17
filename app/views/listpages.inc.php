<?php
namespace Langchecker;

?>
      <p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>
      <h1>List of indexed pages</h1>
<?php

$html_output = '';
$displayed_sites = [];

if ($website != '' && isset($sites[$website])) {
    $displayed_sites[$website] = $sites[$website];
} else {
    $displayed_sites = $sites;
}

foreach ($displayed_sites as $site_index => $current_website) {
    $websitename = Project::getWebsiteName($current_website);
    $website_data_source = Project::getWebsiteDataType($current_website);

    if ($website_data_source == 'lang') {
        $table_headers = "<th>Filename</th><th>URL</th><th>Status</th><th>Translations</th><th>Strings</th><th>Words</th>";
    } else {
        $table_headers = "<th>Filename</th>\n<th>Status</th>\n\n";
    }
    $html_output .= "\n\t<h2 id='{$websitename}'><a href='#{$websitename}'>{$websitename}</a></h2>\n";
    $html_output .= "\t<table class='listpages'>
        <thead>
            <tr>{$table_headers}</tr>
        </thead>
        <tbody>\n";

    // Totals to display in the table footer
    $total_strings = $total_words = $total_files = 0;

    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        if ($website_data_source == 'lang') {
            $reference_locale = Project::getReferenceLocale($current_website);
            $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

            $get_words = function ($item) {
                return str_word_count(strip_tags($item));
            };

            $nb_words = array_sum(array_map($get_words, $reference_data['strings']));
            $nb_strings = count($reference_data['strings']);
            $total_strings += $nb_strings;
            $total_words += $nb_words;
            $total_files++;

            $html_output .= "<tr>\n";
            // Check if the file is obsolete for all locales
            if (Project::isObsoleteFile($current_website, $current_filename, 'all')) {
                $html_output .= "  <td class='obsolete' title='Obsolete file'>{$current_filename}</td>\n";
            } else {
                $html_output .= "  <td>{$current_filename}</td>\n";
            }
            $html_output .= '  <td>' .  Project::getLocalizedURL($reference_data, '', 'html') . "</td>\n" .
                            "  <td><a class='table_small_link' href='?locale=all&amp;website={$site_index}&amp;file={$current_filename}'>Status</a></td>\n" .
                            "  <td><a class='table_small_link' href='?website={$site_index}&amp;file={$current_filename}&amp;action=translate&amp;show'>Show</a></td>\n" .
                            "  <td>{$nb_strings}</td>\n" .
                            "  <td>{$nb_words}</td>\n" .
                            "</tr>\n";
        } else {
            $html_output .= "<tr>\n" .
                            "  <td>" . basename($current_filename) . "</td>\n" .
                            "  <td><a class='table_small_link' href='?locale=all&amp;website={$site_index}&amp;file={$current_filename}'>Status</a></td>\n" .
                            "</tr>\n";
        }
    }

    $total_files .= ($total_files != 1) ? ' files' : ' file';

    if ($website_data_source == 'lang') {
        $html_output .= "<tr class=\"tabletotals\">\n" .
                        "  <th colspan=\"3\">Total</th>\n" .
                        "  <td>{$total_files}</td>\n" .
                        "  <td>{$total_strings}</td>\n" .
                        "  <td>{$total_words}</td>\n" .
                        "</tr>\n";
    }

    $html_output .= "    </tbody>\n</table>\n\n";
}

if ($html_output == '') {
    echo "<p>No files available.</p>";
} else {
    echo $html_output;
}
