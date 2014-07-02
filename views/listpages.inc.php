<?php
namespace Langchecker;
?>
      <p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>
      <h1>List of indexed pages</h1>
<?php

$htmloutput = '';
foreach ($sites as $site_index => $current_website) {
    $htmloutput .= "\n\t<h2>" . Project::getWebsiteName($current_website) . "</h2>\n";
    $htmloutput .= "\t<table class='listpages'>
        <thead>
            <tr>
                <th>Filename</th>
                <th>Status</th>
                <th>Translate</th>
            </tr>
        </thead>
        <tbody>\n";
    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        $htmloutput .= "\t\t<tr>
            <td>{$current_filename}</td>
            <td><a href='?locale=all&amp;website={$site_index}&amp;file={$current_filename}'>Status</a></td>
            <td><a href='?website={$site_index}&amp;file={$current_filename}&amp;action=translate&amp;show'>Translate</a></td>
        </tr>\n";
    }
    $htmloutput .= "    </tbody>\n</table>\n\n";
}

if ($htmloutput == '') {
    echo "<p>No files available.</p>";
} else {
    echo $htmloutput;
}
