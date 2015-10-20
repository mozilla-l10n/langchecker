<?php
namespace Langchecker;

// We only consider mozilla.org for this view, so $sites[0]
$current_website = $sites[0];
$reference_locale = Project::getReferenceLocale($current_website);

$files_list = [];
foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
    // I need to check only files that can be activated
    if (! in_array($current_filename, $no_active_tag)) {
        // Read en-US data only once
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
            if (Project::isObsoleteFile($current_website, $current_filename, $current_locale)) {
                // If the .lang file is obsolete, skip it
                continue;
            }

            $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

            $todo = count($locale_analysis['Identical']) +
                    count($locale_analysis['Missing']) +
                    LangManager::countErrors($locale_analysis['errors']);
            $activation_status = $locale_analysis['activated'] ? 'yes' : 'no';

            if (($todo == 0) && ($activation_status == 'no')) {
                $files_list[] = [
                    'activated' => $activation_status,
                    'filename'  => $current_filename,
                    'locale'    => $current_locale,
                    'strings'   => $locale_analysis,
                    'url'       => Project::getPublicFilePath($current_website, $current_locale, $current_filename),
                ];
            }
        }
    }
}

print $twig->render(
    'activation.twig',
    [
        'files_list' => $files_list,
    ]
);
