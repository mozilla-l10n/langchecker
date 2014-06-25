<?php
namespace Langchecker;
?>
      <p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>
      <h1>List of indexed pages</h1>
<?php

$htmloutput = '';
foreach ($sites as $key => $site) {
    $htmloutput .= "\n\t<h2>{$site[0]}</h2>\n";
    $htmloutput .= "\t<table class='listpages'>
        <thead>
            <tr>
                <th>Filename</th>
                <th>Status</th>
                <th>Translate</th>
            </tr>
        </thead>
        <tbody>\n";
    asort($site[4]);
    foreach ($site[4] as $filename) {
        $htmloutput .= "\t\t<tr>
            <td>{$filename}</td>
            <td><a href='?locale=all&amp;website={$key}&amp;file={$filename}'>Status</a></td>
            <td><a href='?website={$key}&amp;file={$filename}&amp;action=translate&amp;show'>Translate</a></td>
        </tr>\n";
    }
    $htmloutput .= "    </tbody>\n</table>\n\n";
}

if ($htmloutput == '') {
    echo "<p>No files available.</p>";
} else {
    echo $htmloutput;
}
