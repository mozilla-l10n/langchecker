<?php
namespace Langchecker;

// $filename is set in /inc/init.php
$current_filename = $filename;
if (! isset($sites[$website])) {
    die($json_object->outputError("{$website} is not a supported website. Check the value and try again."));
}

$current_website = $sites[$website];
$website_data_source = Project::getWebsiteDataType($current_website);

if ($current_filename == '' || ! in_array($current_filename, Project::getWebsiteFiles($current_website))) {
    die($json_object->outputError("File {$current_filename} does not exist. Check the value and try again."));
}

$json_data = [];
$reference_locale = Project::getReferenceLocale($current_website);
if ($website_data_source == 'lang') {
    // Websites using .lang files
    $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

    $supported_locales = Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets);
    foreach ($supported_locales as $current_locale) {
        if ($current_locale == $reference_locale) {
            // Ignore reference language
            continue;
        }
        if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
            // If the .lang file does not exist, just skip the locale for this file
            continue;
        }

        // Read locale data
        $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

        $keys = ['Errors', 'Identical', 'Missing', 'Obsolete', 'Translated'];
        foreach ($keys as $key) {
            $counter = $key == 'Errors'
                ? LangManager::countErrors($locale_analysis['errors'])
                : count($locale_analysis[$key]);
            $json_data[$current_filename][$current_locale][$key] = intval($counter);
        }

        // Tags
        if (isset($locale_analysis['tags'])) {
            $locale_tags = $locale_analysis['tags'];
            sort($locale_tags);
            $json_data[$current_filename][$current_locale]['tags'] = $locale_tags;
            // Remove _promo from tags
            $locale_tags = array_map(
                function ($element) {
                    return str_replace('promo_', '', $element);
                },
                $locale_tags
            );
        } else {
            $json_data[$current_filename][$current_locale]['tags'] = [];
        }

        // Activation status
        $active = $locale_analysis['activated'];
        $json_data[$current_filename][$current_locale]['activated'] = $active;
    }
} else {
    $supported_locales = Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets);
    foreach ($supported_locales as $current_locale) {
        if ($current_locale == $reference_locale) {
            // Ignore reference language
            continue;
        }
        if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
            // If the raw file does not exist, just skip the locale for this file
            continue;
        }

        $file_analysis = RawManager::compareRawFiles($current_website, $current_locale, $current_filename);
        $cmp_result = $file_analysis['cmp_result'];
        $json_data[$current_filename][$current_locale]['status'] = $cmp_result;
    }
}

if ($locale == 'all' || $locale == '') {
    echo $json_object->outputContent($json_data, false, true);
} else {
    // Only one locale
    if (isset($json_data[$current_filename][$locale])) {
        $single_locale_json[$current_filename][$locale] = $json_data[$current_filename][$locale];
        echo $json_object->outputContent($single_locale_json, false, true);
    } else {
        // Unknown locale
        die($json_object->outputError("Unknown locale: {$locale}. Check the value and try again."));
    }
}
