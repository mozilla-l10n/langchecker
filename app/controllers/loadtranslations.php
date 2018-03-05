<?php
namespace Langchecker;

/*
  This loads all translated strings of a file into an array to be used in
  different views.
*/

// $filename is set in /inc/init.php
$current_filename = $filename != '' ? $filename : 'snippets.lang';
$show_status = isset($_GET['show']) ? 'auto' : 'none';

$supported_file = false;
// Search which website has the requested file
foreach (Project::getWebsitesByDataType($sites, 'lang') as $site) {
    if (in_array($current_filename, Project::getWebsiteFiles($site))) {
        $current_website = $site;
        $supported_file = true;
        break;
    }
}

if (! $supported_file) {
    $error_message = "ERROR: file {$filename} does not exist";
    if ($json) {
        die($json_object->outputError($error_message));
    } else {
        Project::displayErrorTemplate($twig, $error_message);
    }
}

$reference_locale = Project::getReferenceLocale($current_website);
$reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

$all_strings = [];

$supported_locales = Project::getSupportedLocales($current_website, $current_filename);
foreach ($supported_locales as $current_locale) {
    if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
        // If the .lang file does not exist, just skip the locale for this file
        continue;
    }
    $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);

    foreach ($reference_data['strings'] as $string_id => $string_value) {
        if (LangManager::isStringLocalized($string_id, $locale_data, $reference_data)) {
            if ($store_by_string) {
                $all_strings[$string_id][$current_locale] = Utils::cleanString($locale_data['strings'][$string_id]);
            } else {
                $all_strings[$current_locale][$string_id] = Utils::cleanString($locale_data['strings'][$string_id]);
            }
        }
    }
}
