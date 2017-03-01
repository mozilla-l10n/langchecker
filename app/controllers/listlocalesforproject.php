<?php
namespace Langchecker;

$output_array = [];
$lang_based_sites = Project::getWebsitesByDataType($sites, 'lang');
if ($website != '') {
    $current_website = $lang_based_sites[$website];
    if (isset($lang_based_sites[$website])) {
        if ($filename != '') {
            // Return locales supported by this specific file
            $current_filename = $filename;
            if (in_array($current_filename, Project::getWebsiteFiles($current_website))) {
                $output_array = array_values(Project::getSupportedLocales($current_website, $current_filename));
            }
        } else {
            // Return locales supported by this website
            $output_array = array_values(Project::getSupportedLocales($current_website));
        }
    }
} elseif ($project != '') {
    switch ($project) {
        case 'langchecker':
            /*
                Returning the $mozilla array defined in config/locales.inc.php
                with all the supported locales.
            */
            $output_array = $mozilla;
        break;
        case 'locamotion':
            $output_array = $locamotion_locales;
        break;
        case 'marketplacebadge':
            $output_array = $marketplacebadge_locales;
        break;
        case 'slogans':
            $output_array = $slogans_locales;
        break;
    }
}

if (count($output_array) == 0) {
    // No locales: either wrong values or not enought parameters
    die($json_object->outputError('ERROR: please check your request: provide a project name, a website, or a website+file.'));
}

echo $json_object->outputContent($output_array, false, true);
