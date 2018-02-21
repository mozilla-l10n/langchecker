<?php
namespace Langchecker;

// $filename is set in /inc/init.php
$current_filename = $filename != '' ? $filename : 'snippets.lang';
$single_locale = isset($_GET['single']) ? 'auto' : 'all';

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

$all_locale_data = [];

$supported_locales = array($locale);
if ($single_locale) {
    $supported_locales = Project::getSupportedLocales($current_website, $current_filename);
}

foreach ($supported_locales as $current_locale) {
    if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
        // If the .lang file does not exist, just skip the locale for this file
        continue;
    }
    $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);

    foreach ($reference_data['strings'] as $string_id => $string_value) {
        if (LangManager::isStringLocalized($string_id, $locale_data, $reference_data)) {
            $all_locale_data[$current_locale][$string_id] = Utils::cleanString($locale_data['strings'][$string_id]);
        }
    }
}

// If requested output is JSON, we're ready
if ($json) {
    die($json_object->outputContent($all_locale_data, false, true));
}

$locale_list = [];
foreach ($all_locale_data as $current_locale => $available_strings) {

    $translations = [];
    foreach ($available_strings as $string_id => $translation) {
        $translations[] = [
            'string_id'   => $string_id,
            'translation' => $translation,
        ];
    }

    $locale_list[] = [
        'locale'       => $current_locale,
        'translations' => $translations,
    ];
}

print $twig->render(
    'reviewstrings.twig',
    [
        'filename'    => $current_filename,
        'locale_list' => $locale_list,
    ]
);
