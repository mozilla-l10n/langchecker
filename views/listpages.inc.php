<?php
namespace Langchecker;
?>
      <p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>
      <h1>List of indexed pages</h1>
<?php

$htmloutput = '';
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
        $table_headers = "<th>Filename</th><th>Status</th><th>Translations</th><th>Strings</th><th>Words</th>";
    } else {
        $table_headers = "<th>Filename</th>\n<th>Status</th>\n\n";
    }
    $htmloutput .= "\n\t<h2 id='{$websitename}'><a href='#{$websitename}'>{$websitename}</a></h2>\n";
    $htmloutput .= "\t<table class='listpages'>
        <thead>
            <tr>{$table_headers}</tr>
        </thead>
        <tbody>\n";

    // Totals to display in the table footer
    $total_strings = $total_words = $total_files = 0;

    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        if ($website_data_source == 'lang') {
            $reference_locale = Project::getReferenceLocale($current_website);
            $ref_lang_file = LangManager::loadSource($current_website, $reference_locale, $current_filename);

            $get_words = function($item) {
                return str_word_count(strip_tags($item));
            };

            $nb_words = array_sum(array_map($get_words, $ref_lang_file['strings']));
            $nb_strings = count($ref_lang_file['strings']);
            $total_strings += $nb_strings;
            $total_words += $nb_words;
            $total_files++;

            $htmloutput .= "<tr>\n" .
                           "  <td>{$current_filename}</td>\n" .
                           "  <td><a href='?locale=all&amp;website={$site_index}&amp;file={$current_filename}'>Status</a></td>\n" .
                           "  <td><a href='?website={$site_index}&amp;file={$current_filename}&amp;action=translate&amp;show'>Show</a></td>\n" .
                           "  <td>{$nb_strings}</td>\n" .
                           "  <td>{$nb_words}</td>\n" .
                           "</tr>\n";
        } else {
            $htmloutput .= "<tr>\n" .
                           "  <td>" . basename($current_filename) . "</td>\n" .
                           "  <td><a href='?locale=all&amp;website={$site_index}&amp;file={$current_filename}'>Status</a></td>\n" .
                           "</tr>\n";
        }
    }

    $total_files .= ($total_files != 1) ? ' files' : ' file';

    if ($website_data_source == 'lang') {
        $htmloutput .= "<tr class=\"tabletotals\">\n" .
                       "  <th colspan=\"2\">Total</th>\n" .
                       "  <td>{$total_files}</td>\n" .
                       "  <td>{$total_strings}</td>\n" .
                       "  <td>{$total_words}</td>\n" .
                       "</tr>\n";
    }

    $htmloutput .= "    </tbody>\n</table>\n\n";
}

if ($htmloutput == '') {
    echo "<p>No files available.</p>";
} else {
    echo $htmloutput;
}
