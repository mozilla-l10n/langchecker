<?php
namespace Langchecker;

use \Transvision\Json;

$export_data = [];
$current_locale = $locale;

foreach ($sites as $website) {
    if (Project::isSupportedLocale($website, $current_locale)) {
        foreach (Project::getWebsiteFiles($website) as $filename) {
            if (! Project::isSupportedLocale($website, $current_locale, $filename, $langfiles_subsets)) {
                // File is not managed for this website+locale, ignore it
                continue;
            }

            // Load reference strings
            $reference_locale = Project::getReferenceLocale($website);
            $reference_data = LangManager::loadSource($website, $reference_locale, $filename);

            $website_name = Project::getWebsiteName($website);

            $locale_filename = Project::getLocalFilePath($website, $current_locale, $filename);
            if (! is_file($locale_filename)) {
                // File is missing
                continue;
            }

            $locale_analysis = LangManager::analyzeLangFile($website, $current_locale, $filename, $reference_data);

            $export_data[$website_name][$filename]['identical'] = count($locale_analysis['Identical']);
            $export_data[$website_name][$filename]['missing'] = count($locale_analysis['Missing']);
            $export_data[$website_name][$filename]['obsolete'] = count($locale_analysis['Obsolete']);
            $export_data[$website_name][$filename]['translated'] = count($locale_analysis['Translated']);

            if (Project::isCriticalFile($website, $filename, $current_locale)) {
                $export_data[$website_name][$filename]['critical'] = true;
            } else {
                $export_data[$website_name][$filename]['critical'] = false;
            }

            // Flags
            $file_flags = Project::getFileFlags($website, $filename, $current_locale);
            if ($file_flags) {
                $export_data[$website_name][$filename]['flags'] = $file_flags;
            }

            // Some files have a deadline
            if (isset($deadline[$filename])) {
                $export_data[$website_name][$filename]['deadline'] = $deadline[$filename];
            }
        }
    }
}

if ($serial) {
    header("Content-type:text/plain");
    die(serialize($export_data));
}

if ($json) {
    die(Json::output($export_data, false, true));
}
