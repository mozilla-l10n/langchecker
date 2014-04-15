<?php
$output_array = [];
if (isset($_GET['website']) && isset($_GET['file'])) {
    $website = $_GET['website'];
    $output_array = array_values($langfiles_subsets[$sites[$website][0]][$_GET['file']]);
} elseif (isset($_GET['project'])) {
    switch ($_GET['project']) {
        case 'locamotion':
            $output_array = $locamotion_locales;
        break;
        case 'marketplacebadge':
            $output_array = $marketplacebadge_locales;
        break;
        case 'slogans':
            $output_array = $slogans_locales;
        break;
        case 'snippets':
            $output_array = $snippets_locales;
        break;
        case 'snippets_main':
            $output_array = $snippets_main_locales;
        break;
    }
}

echo Transvision\Json::output($output_array, false, true);
