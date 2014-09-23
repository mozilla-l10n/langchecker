<?php
namespace Langchecker;

use \Transvision\Json;

$export_data = [];
$current_locale = $locale;

foreach ($sites as $website) {
    if (Project::isSupportedLocale($website, $current_locale)) {
        $website_data_source = Project::getWebsiteDataType($website);
        foreach (Project::getWebsiteFiles($website) as $filename) {
            if (! Project::isSupportedLocale($website, $current_locale, $filename, $langfiles_subsets)) {
                // File is not managed for this website+locale, ignore it
                continue;
            }

            $reference_locale = Project::getReferenceLocale($website);
            $website_name = Project::getWebsiteName($website);

            $displayed_filename = ($website_data_source == 'lang') ?
                                  $filename :
                                  basename($filename);

            if ($website_data_source == 'lang') {
                // Load reference strings
                $reference_data = LangManager::loadSource($website, $reference_locale, $filename);
                $locale_filename = Project::getLocalFilePath($website, $current_locale, $filename);
                if (! is_file($locale_filename)) {
                    // File is missing
                    continue;
                }

                $locale_analysis = LangManager::analyzeLangFile($website, $current_locale, $filename, $reference_data);

                $export_data[$website_name][$displayed_filename]['identical'] = count($locale_analysis['Identical']);
                $export_data[$website_name][$displayed_filename]['missing'] = count($locale_analysis['Missing']);
                $export_data[$website_name][$displayed_filename]['obsolete'] = count($locale_analysis['Obsolete']);
                $export_data[$website_name][$displayed_filename]['translated'] = count($locale_analysis['Translated']);
            } else {
                $file_analysis = RawManager::compareRawFiles($website, $current_locale, $filename);
                $cmp_result = $file_analysis['cmp_result'];
                $export_data[$website_name][$displayed_filename]['status'] = $cmp_result;
            }

            $export_data[$website_name][$displayed_filename]['data_source'] = $website_data_source;

            if (Project::isCriticalFile($website, $filename, $current_locale)) {
                $export_data[$website_name][$displayed_filename]['critical'] = true;
            } else {
                $export_data[$website_name][$displayed_filename]['critical'] = false;
            }

            // Flags
            $file_flags = Project::getFileFlags($website, $filename, $current_locale);
            if ($file_flags) {
                $export_data[$website_name][$displayed_filename]['flags'] = $file_flags;
            }

            // Some files have a deadline
            if (isset($deadline[$filename])) {
                $export_data[$website_name][$displayed_filename]['deadline'] = $deadline[$filename];
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
