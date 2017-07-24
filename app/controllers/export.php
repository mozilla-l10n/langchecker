<?php
namespace Langchecker;

$export_data = [];
$current_locale = $locale;

foreach ($sites as $website) {
    if (Project::isSupportedLocale($website, $current_locale)) {
        $website_data_source = Project::getWebsiteDataType($website);
        foreach (Project::getWebsiteFiles($website) as $filename) {
            if (! Project::isSupportedLocale($website, $current_locale, $filename)) {
                // File is not managed for this website+locale, ignore it
                continue;
            }

            $reference_locale = Project::getReferenceLocale($website);
            $website_name = Project::getWebsiteName($website);

            $displayed_filename = ($website_data_source == 'lang') ?
                                  $filename :
                                  basename($filename);

            $file_flags = Project::getFileFlags($website, $filename, $current_locale);

            if ($website_data_source == 'lang') {
                $locale_filename = Project::getLocalFilePath($website, $current_locale, $filename);
                if (! is_file($locale_filename) || Project::isObsoleteFile($website, $filename, $current_locale)) {
                    // File is missing or marked as obsolete
                    continue;
                }
                // Load reference strings
                $reference_data = LangManager::loadSource($website, $reference_locale, $filename);
                $locale_analysis = LangManager::analyzeLangFile($website, $current_locale, $filename, $reference_data);

                $export_data[$website_name][$displayed_filename]['identical'] = count($locale_analysis['Identical']);
                $export_data[$website_name][$displayed_filename]['missing'] = count($locale_analysis['Missing']);

                // If there are missing or identical strings, calculate missing words
                $missing_words = 0;
                if (count($locale_analysis['Identical']) > 0 ) {
                    foreach ($locale_analysis['Identical'] as $string_id) {
                        $missing_words += str_word_count(strip_tags($string_id));
                    }
                }
                if (count($locale_analysis['Missing']) > 0 ) {
                    foreach ($locale_analysis['Missing'] as $string_id) {
                        $missing_words += str_word_count(strip_tags($string_id));
                    }
                }
                $export_data[$website_name][$displayed_filename]['missing_words'] = $missing_words;

                $export_data[$website_name][$displayed_filename]['obsolete'] = count($locale_analysis['Obsolete']);
                $export_data[$website_name][$displayed_filename]['translated'] = count($locale_analysis['Translated']);

                $errors_number = LangManager::countErrors($locale_analysis['errors']);
                // Also include encoding problems as an error
                if (Utils::isUTF8($locale_filename) == false) {
                    $errors_number++;
                }
                $export_data[$website_name][$displayed_filename]['errors'] = $errors_number;
            } else {
                $file_analysis = RawManager::compareRawFiles($website, $current_locale, $filename);
                $cmp_result = $file_analysis['cmp_result'];
                $export_data[$website_name][$displayed_filename]['status'] = $cmp_result;
            }

            $export_data[$website_name][$displayed_filename]['data_source'] = $website_data_source;

            $export_data[$website_name][$displayed_filename]['priority'] = Project::getFilePriority($website, $filename, $current_locale);

            // Flags
            if ($file_flags) {
                $export_data[$website_name][$displayed_filename]['flags'] = $file_flags;
            }

            // Stage URL
            $export_data[$website_name][$displayed_filename]['url'] = Project::getLocalizedURL($reference_data, $current_locale);

            // Some files have a deadline
            $deadline = Project::getFileDeadline($website, $filename, $current_locale);
            if ($deadline != '') {
                $export_data[$website_name][$displayed_filename]['deadline'] = $deadline;
            }
        }
    }
}

if ($serial) {
    header('Content-type:text/plain');
    die(serialize($export_data));
}

if ($json) {
    die($json_object->outputContent($export_data, false, true));
}
