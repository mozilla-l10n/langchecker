<?php
namespace Langchecker;

?>

<p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>
<h1>Complete files not activated</h1>

<?php

$table_start_code = '<table class="sortable globallist">
  <thead>
    <tr>
      <th>Locale</th>
      <th>Filename</th>
      <th>Identical</th>
      <th>Translated</th>
      <th>Missing</th>
      <th>Obsolete</th>
      <th>Activated</th>
    </tr>
  </thead>
  <tbody>
';
$table_rows = '';
$table_end_code = "\n</tbody>\n</table>";

// We only consider mozilla.org for this view, so $sites[0]
$current_website = $sites[0];
$reference_locale = Project::getReferenceLocale($current_website);

foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
    // I need to check only files that can be activated
    if (! in_array($current_filename, $no_active_tag)) {
        // Read en-US data only once
        $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);
        $supported_locales = Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets);

        foreach ($supported_locales as $current_locale) {
            if ($current_locale == $reference_locale) {
                // Ignore reference language
                continue;
            }
            if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
                // If the .lang file does not exist, just skip the locale for this file
                continue;
            }
            if (Project::isObsoleteFile($current_website, $current_filename, $current_locale)) {
                // If the .lang file is obsolete, skip it
                continue;
            }

            $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

            $todo = count($locale_analysis['Identical']) +
                    count($locale_analysis['Missing']) +
                    LangManager::countErrors($locale_analysis['errors']);
            $activation_status = $locale_analysis['activated'] ? 'yes' : 'no';

            if (($todo == 0) && ($activation_status == 'no')) {
                $svn_path = 'http://viewvc.svn.mozilla.org/vc/projects/mozilla.com/trunk/locales/' . $current_locale . '/' . $current_filename;
                $table_rows .= "  <tr>\n";
                $table_rows .= '    <td><a href="./?locale=' . $current_locale . '" title="See full status of this locale">' . $current_locale . "</a></td>\n";
                $table_rows .= '    <td><a href="' . $svn_path . '" target="_blank" title="Open this file on SVN">' . $current_filename . "</a></td>\n";
                $table_rows .= '    <td>' . count($locale_analysis['Identical']) . "</td>\n";
                $table_rows .= '    <td>' . count($locale_analysis['Translated']) . "</td>\n";
                $table_rows .= '    <td>' . count($locale_analysis['Missing']) . "</td>\n";
                $table_rows .= '    <td>' . count($locale_analysis['Obsolete']) . "</td>\n";
                $table_rows .= '    <td>' . $activation_status . "</td>\n";
                $table_rows .= "  </tr>\n";
            }
        }
    }
}

if ($table_rows == '') {
    echo "<p>There are no complete files missing the active tag.</p>";
} else {
    echo $table_start_code . $table_rows . $table_end_code;
}
