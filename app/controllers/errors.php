<?php
namespace Langchecker;

$errors = [];
// Checks on l10n files
foreach ($mozilla as $current_locale) {
    foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {
        $current_website_name = Project::getWebsiteName($current_website);
        if (Project::isSupportedLocale($current_website, $current_locale)) {
            foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
                if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename)) {
                    // File is not managed for this website+locale, ignore it
                    continue;
                }

                // Load reference strings
                $reference_locale = Project::getReferenceLocale($current_website);
                $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

                // If the .lang file does not exist, warn and skip this file
                $locale_filename = Project::getLocalFilePath($current_website, $current_locale, $current_filename);
                if (! is_file($locale_filename)) {
                    $errors[$current_locale][$current_website_name][$current_filename][] = [
                        'message' => "Missing file: {$locale_filename}",
                        'type'    => 'generic',
                    ];
                    continue;
                }

                // Extract data from locale
                $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

                // Check errors
                if (LangManager::countErrors($locale_analysis['errors'])) {
                    if (LangManager::countErrors($locale_analysis['errors'], 'python')) {
                        $errors[$current_locale][$current_website_name][$current_filename][] = [
                            'errors' => $locale_analysis['errors']['python'],
                            'type'   => 'python',
                        ];
                    }

                    if (LangManager::countErrors($locale_analysis['errors'], 'length')) {
                        $errors[$current_locale][$current_website_name][$current_filename][] = [
                            'errors' => $locale_analysis['errors']['length'],
                            'type'   => 'length',
                        ];
                    }

                    if (LangManager::countErrors($locale_analysis['errors'], 'ignoredstrings')) {
                        $errors[$current_locale][$current_website_name][$current_filename][] = [
                            'errors' => $locale_analysis['errors']['ignoredstrings'],
                            'type'   => 'ignored_strings',
                        ];
                    }
                }

                // Check if the lang file is not in UTF-8 or US-ASCII
                if (Utils::isUTF8($locale_filename) == false) {
                    $errors[$current_locale][$current_website_name][$current_filename][] = [
                        'message' => 'File is not saved with UTF-8 encoding.',
                        'type'    => 'generic',
                    ];
                }

                // Display errors on missing strings
                if (count($locale_analysis['Missing'])) {
                    $errors[$current_locale][$current_website_name][$current_filename][] = [
                        'message' => 'There are missing strings.',
                        'type'    => 'generic',
                    ];
                }

                // If locale has tags, display errors on unknown tags
                if (isset($locale_analysis['tags'])) {
                    $locale_file_tags = $locale_analysis['tags'];
                    if (isset($reference_data['tags'])) {
                        $extra_tags = array_diff($locale_file_tags, $reference_data['tags']);
                    } else {
                        $extra_tags = $locale_file_tags;
                    }
                    if (count($extra_tags)) {
                        foreach ($extra_tags as $extra_tag) {
                            $errors[$current_locale][$current_website_name][$current_filename][] = [
                                'message' => "Unknown tag: <strong>{$extra_tag}</strong>.",
                                'type'    => 'generic',
                            ];
                        }
                    }
                } else {
                    $locale_file_tags = [];
                }

                if (isset($reference_data['tag_bindings']) && $locale_analysis['activated']) {
                    // If file is activated, get a list of untranslated/identical strings bound to tags
                    $incomplete_tagged_strings = [];
                    foreach ($reference_data['tag_bindings'] as $string_id => $bound_tag) {
                        if (in_array($string_id, $locale_analysis['Missing']) ||
                            in_array($string_id, $locale_analysis['Identical'])) {
                            $incomplete_tagged_strings[$bound_tag][] = $string_id;
                        }
                    }

                    // Get all tags with missing strings
                    $incomplete_tags = array_unique(array_keys($incomplete_tagged_strings));
                    if (! empty($incomplete_tags)) {
                        foreach ($locale_file_tags as $locale_tag) {
                            if (in_array($locale_tag, $incomplete_tags)) {
                                // Tag is enabled, but strings are still missing
                                $errors[$current_locale][$current_website_name][$current_filename][] = [
                                    'errors' => $incomplete_tagged_strings[$locale_tag],
                                    'tag'    => $locale_tag,
                                    'type'   => 'incomplete_tags',
                                ];
                            }
                        }
                    }

                    // Get all missing tags completely localized
                    if (isset($reference_data['tags'])) {
                        /* I ignore tags not bound to strings for this report, so using unique
                         *  values of 'tag_bindings' instead of using 'tags' from reference data
                         */
                        $source_file_tags = array_unique(array_values($reference_data['tag_bindings']));
                    } else {
                        $source_file_tags = [];
                    }

                    $missing_tags = array_diff($source_file_tags, $locale_file_tags);
                    foreach ($missing_tags as $missing_tag) {
                        if (! in_array($missing_tag, $incomplete_tags)) {
                            $errors[$current_locale][$current_website_name][$current_filename][] = [
                                'message' => "Missing tag: <strong>{$missing_tag}</strong>.",
                                'type'    => 'generic',
                            ];
                        }
                    }
                }
            }
        }
    }

    foreach (Project::getWebsitesByDataType($sites, 'raw') as $current_website) {
        $current_website_name = Project::getWebsiteName($current_website);
        if (Project::isSupportedLocale($current_website, $current_locale)) {
            foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
                if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename)) {
                    // File is not managed for this website+locale, ignore it
                    continue;
                }

                $locale_filename = Project::getLocalFilePath($current_website, $current_locale, $current_filename);
                if (! in_array('optional', Project::getFileFlags($current_website, $current_filename, $current_locale)) &&
                    ! file_exists($locale_filename)) {
                    $errors[$current_locale][$current_website_name][$current_filename][] = [
                        'message' => 'File is missing.',
                        'type'    => 'generic',
                    ];
                }
            }
        }
    }
}

// Checks on reference files
foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {
    $current_website_name = Project::getWebsiteName($current_website);
    $reference_locale = Project::getReferenceLocale($current_website);
    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        // Load reference strings
        $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

        // Check for duplicate strings
        if (isset($reference_data['duplicates'])) {
            $errors[$reference_locale][$current_website_name][$current_filename][] = [
                'errors' => $reference_data['duplicates'],
                'type'   => 'duplicates',
            ];
        }

        // Check for strings "translated" in the source
        $reference_differences = [];
        foreach ($reference_data['strings'] as $string_id => $string_value) {
            if ($string_id != $string_value) {
                $reference_differences[] = $string_id;
            }
        }
        if (! empty($reference_differences)) {
            $errors[$reference_locale][$current_website_name][$current_filename][] = [
                'errors' => $reference_differences,
                'type'   => 'reference_diff',
            ];
        }

        // Check for max length errors
        $zero_length = [];
        if (isset($reference_data['max_lengths'])) {
            foreach ($reference_data['max_lengths'] as $reference_string => $max_length) {
                if ($max_length == 0) {
                    $zero_length[] = $reference_string;
                }
            }
        }
        if (! empty($zero_length)) {
            $errors[$reference_locale][$current_website_name][$current_filename][] = [
                'errors' => $zero_length,
                'type'   => 'zero_length',
            ];
        }
    }
}

foreach (Project::getWebsitesByDataType($sites, 'raw') as $current_website) {
    $current_website_name = Project::getWebsiteName($current_website);
    $reference_locale = Project::getReferenceLocale($current_website);
    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        $reference_filename = Project::getLocalFilePath($current_website, $reference_locale, $current_filename);
        if (! file_exists($reference_filename)) {
            $errors[$reference_locale][$current_website_name][$current_filename][] = [
                'message' => "File is missing: {$reference_filename}",
                'type'    => 'generic',
            ];
        }
    }
}

print $twig->render(
    'errors.twig',
    [
        'errors' => $errors,
    ]
);
