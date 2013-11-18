<p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>

<h1>Complete files not activated</h1>

<?php

echo '<table class="sortable globallist">';
echo '<thead>';
echo '<tr>
        <th>Locale</th>
        <th>Filename</th>
        <th>Identical</th>
        <th>Translated</th>
        <th>Missing</th>
        <th>Obsolete</th>
        <th>Activated</th>
      </tr>';
echo '</thead>';

// We only consider mozilla.org for this view, so $sites[0]
$site = $sites[0];
$key = 0;

foreach ($site[4] as $filename) {
    $reflang = $site[5];
    if (!in_array($filename, $no_active_tag)) {
        // I need to check only files that can be activated

        // Find target locales for this filename
        $target_locales = (is_array($langfiles_subsets[$site[0]][$filename]))
                          ? $langfiles_subsets[$site[0]][$filename]
                          : $site[3];

        getEnglishSource($reflang, $key, $filename);

        foreach ($target_locales as $locale) {
            if ($locale == 'en' || $locale == 'en-GB') {
                continue;
            }

            // If the .lang file does not exist, just skip the locale for this file
            $local_lang_file = $site[1] . $site[2] . $locale . '/' . $filename;
            if (!file_exists($local_lang_file)) {
                continue;
            }

            analyseLangFile($locale, $key, $filename);
            $todo = count($GLOBALS[$locale]['Identical']) + count($GLOBALS[$locale]['Missing']);
            $activation_status = ($GLOBALS[$locale]['activated']) ? 'yes' : 'no';

            if (($todo==0) && ($activation_status=='no')) {
                $svn_path = 'http://viewvc.svn.mozilla.org/vc/projects/mozilla.com/trunk/locales/' . $locale . '/' . $filename;
                echo '<tr>';
                echo '  <td><a href="/?locale=' . $locale . '" title="See full status of this locale">' . $locale . '</a></td>';
                echo '  <td><a href="' . $svn_path . '" target="_blank" title="Open this file on SVN">' . $filename . '</a></td>';
                echo '  <td>' . count($GLOBALS[$locale]['Identical']) . '</td>';
                echo '  <td>' . count($GLOBALS[$locale]['Translated']) . '</td>';
                echo '  <td>' . count($GLOBALS[$locale]['Missing']) . '</td>';
                echo '  <td>' . count($GLOBALS[$locale]['Obsolete']) . '</td>';
                echo '  <td>' . $activation_status . '</td>';
                echo '</tr>';
            }
            unset($GLOBALS[$locale]);
        }
        unset($GLOBALS['__english_moz']);
    }
}
