<?php
namespace Langchecker;

use Transvision\Json;

$output_array = [];
$lang_based_sites = Project::getWebsitesByDataType($sites, 'lang');
if ($website != '' && $filename != '') {
    if (isset($lang_based_sites[$website])) {
        $current_website = $lang_based_sites[$website];
        $current_filename = $filename;
        if (in_array($current_filename, Project::getWebsiteFiles($current_website))) {
            $output_array = array_values(Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets));
        }
    }
} elseif ($project != '') {
    switch ($project) {
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

if (count($output_array) == 0) {
    // No locales: either wrong values or not enought parameters
    http_response_code(400);
    $output_array[] = 'Please check you request: provide a project name, or a valid couple website+file.';
}

echo Json::output($output_array, false, true);
