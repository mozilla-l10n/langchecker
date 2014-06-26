<?php
namespace Langchecker;

use \Transvision\Json;

$output_array = [];
if (isset($_GET['website']) && isset($_GET['file'])) {
    $current_website = $sites[$_GET['website']];
    $current_filename = $_GET['file'];
    $output_array = array_values(Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets));
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

echo Json::output($output_array, false, true);
