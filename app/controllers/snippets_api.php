<?php
namespace Langchecker;

// This view works only for snippets (website ID 6)
$current_website = $sites[6];
$current_locale = $locale;
$json_data = [];

if ($locale == '') {
    die($json_object->outputError('Missing locale code in the request'));
}

if (! Project::isSupportedLocale($current_website, $current_locale)) {
    die($json_object->outputError('This locale is not supported for snippets'));
}

foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
    // File is not managed for this website+locale, ignore it
    if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename)) {
        continue;
    }

    // If the .lang file does not exist, just skip the locale for this file
    if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
        continue;
    }

    $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);
    foreach ($locale_data['strings'] as $reference_string => $translated_string) {
        // We're interested only in translated strings, also clean up {ok}
        if ($reference_string != $translated_string) {
            $json_data[$reference_string] = Utils::cleanString($translated_string);
        }
    }
}

ksort($json_data);

$callback = isset($_GET['callback']) ? $_GET['callback'] : false;
die($json_object->outputContent($json_data, $callback, true));
