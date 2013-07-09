<style>
    table {
        border-collapse:collapse;
        min-width:400px;
        font-size:12px;
    }

    table, th, td {
        border:1px solid lightblue;
    }

    th, td {
        padding: 2px 5px;
        text-align:center;
    }

    th.col1 {
        width:150px;
        color:brown;
    }

</style>
<?php

$locale = (isset($_GET['locale'])) ? secureText($_GET['locale']) : '';

if ($locale == '') {
    exit;
}

$data = unserialize(file_get_contents('http://www.langchecker.org/?locale=' . $locale . '&serial'));

foreach ($data as $site => $tablo) {

    echo "<table>
            <tr>
                <th class=\"col1\">$site</th>
                <th>Identical</th>
                <th>Missing</th>
            </tr>";

    foreach ($tablo as $file => $details) {
        echo "
            <tr>
                <th>$file</th>
                <td>$details[identical]</td>
                <td>$details[missing]</td>
            </tr>";
    }

    echo "</table>";
    echo '<br>';
}


function secureText($item) {
    // CRLF XSS
    $item  = str_replace('%0D', '', $item);
    $item  = str_replace('%0A', '', $item);
    $item  = strip_tags($item);
    return $item;
}
