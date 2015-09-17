<?php
namespace Langchecker;

use Transvision\Json;

// This view works only for snippets (website ID 6)
$current_website = $sites[6];
$current_locale = $locale;
$json_data = [];

if ($locale == '') {
    exit(Json::invalidAPICall('Missing locale code in the request'));
}

if (! Project::isSupportedLocale($current_website, $current_locale)) {
    exit(Json::invalidAPICall('This locale is not supported for snippets'));
}

foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
    if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename, $langfiles_subsets)) {
        // File is not managed for this website+locale, ignore it
        continue;
    }
    if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
        // If the .lang file does not exist, just skip the locale for this file
        continue;
    }

    $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);
    foreach ($locale_data['strings'] as $reference_string => $translated_string) {
        if ($reference_string != $translated_string) {
            // Interested only in translated strings, clean up {ok}
            $json_data[$reference_string] = Utils::cleanString($translated_string);
        }
    }
}

ksort($json_data);

$callback = isset($_GET['callback']) ? $_GET['callback'] : false;
exit(Json::output($json_data, $callback, true));
