<?php
namespace Langchecker;

$supported_locale = false;
$current_locale = $locale;
$websites = [];

$bugzilla_locale = urlencode(Bugzilla::getBugzillaLocaleField($current_locale, 'www'));

foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {
    $reference_locale = Project::getReferenceLocale($current_website);
    $repo = Project::getPublicRepoPath($current_website, $current_locale);
    $website_name = Project::getWebsiteName($current_website);

    if (! Project::isSupportedLocale($current_website, $current_locale)) {
        // Locale is not supported for this website, move to the next
        continue;
    }

    $files_done = [];
    $files_todo = [];
    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        // File not supported
        if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename)) {
            continue;
        }

        // File marked as obsolete
        if (Project::isObsoleteFile($current_website, $current_filename, $current_locale)) {
            continue;
        }

        // File doesn't exist
        if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
            continue;
        }

        $bugzilla_link = Bugzilla::getNewBugLink($current_locale, $bugzilla_locale, 'upload', [$current_filename]);

        // Load reference strings
        $reference_filename = Project::getLocalFilePath($current_website, $reference_locale, $current_filename);
        $reference_url = Project::getPublicFilePath($current_website, $reference_locale, $current_filename);
        $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

        // Extract data from locale
        $locale_filename = Project::getLocalFilePath($current_website, $current_locale, $current_filename);
        $locale_url = Project::getPublicFilePath($current_website, $current_locale, $current_filename);
        $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

        $count_identical = count($locale_analysis['Identical']);
        $count_missing = count($locale_analysis['Missing']);
        $count_errors = LangManager::countErrors($locale_analysis['errors']);

        if (! in_array($current_filename, $no_active_tag) &&
            $website_name == 'www.mozilla.org') {
            $status = $locale_analysis['activated'] ? ' file_activated' : ' file_notactivated';
        } else {
            $status = ' file_activated';
        }

        $errors = [];
        // Check if the lang file is in UTF-8
        if (Utils::isUTF8($locale_filename) == false) {
            $status .= ' file_notutf8';
            $count_errors += 1;
            $errors[] = [
                'title'   => 'Encoding error',
                'message' => 'File is not saved with UTF-8 encoding.',
                'type'    => 'generic',
            ];
        }

        if ($count_identical + $count_missing + $count_errors == 0) {
            // File is complete
            $files_done[$current_filename] = $status;
        } else {
            if (LangManager::countErrors($locale_analysis['errors'])) {
                if (LangManager::countErrors($locale_analysis['errors'], 'python')) {
                    $errors[] = [
                        'errors' => $locale_analysis['errors']['python'],
                        'type'   => 'python',
                    ];
                }

                if (LangManager::countErrors($locale_analysis['errors'], 'length')) {
                    $errors[] = [
                        'errors' => $locale_analysis['errors']['length'],
                        'type'   => 'length',
                    ];
                }

                if (LangManager::countErrors($locale_analysis['errors'], 'ignoredstrings')) {
                    $errors[] = [
                        'errors' => $locale_analysis['errors']['ignoredstrings'],
                        'type'   => 'ignored_strings',
                    ];
                }
            }

            $files_todo[$current_filename] = [
                'bugzilla_link'     => $bugzilla_link,
                'count_errors'      => $count_errors,
                'count_identical'   => $count_identical,
                'count_missing'     => $count_missing,
                'count_translated'  => count($locale_analysis['Translated']),
                'errors'            => $errors,
                'locale_url'        => $locale_url,
                'python_note'       => LangManager::countErrors($locale_analysis['errors'], 'python') > 0,
                'reference_url'     => $reference_url,
                'file_status'       => $status,
                'strings_identical' => $locale_analysis['Identical'],
                'strings_missing'   => $locale_analysis['Missing'],
            ];
        }
    }
    $websites[$website_name] = [
        'data_source' => 'lang',
        'files_done'  => $files_done,
        'files_todo'  => $files_todo,
        'repository'  => $repo,
    ];
}

foreach (Project::getWebsitesByDataType($sites, 'raw') as $current_website) {
    $repo = Project::getPublicRepoPath($current_website, $current_locale);
    $website_name = Project::getWebsiteName($current_website);

    if (! Project::isSupportedLocale($current_website, $current_locale)) {
        // Locale is not supported for this website, move to the next
        continue;
    }

    $html_rows = '';
    $files_done = [];
    $files_todo = [];
    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename)) {
            // File is not managed for this website+locale, ignore it
            continue;
        }

        $file_analysis = RawManager::compareRawFiles($current_website, $current_locale, $current_filename);
        $cmp_result = $file_analysis['cmp_result'];

        $displayed_filename = basename($current_filename);
        if ($cmp_result == 'ok') {
            // File is translated, store it for later and move on to the next file
            $files_done[] = $displayed_filename;
            continue;
        }

        if (in_array('optional', Project::getFileFlags($current_website, $current_filename, $current_locale)) &&
            $cmp_result != 'untranslated' && $cmp_result != 'outdated') {
            // If a file is optional, it can be deleted from locale repository without generating errors
            // But if it's outdated or untranslated, we display it
            continue;
        }

        $reference_lastupdate = isset($file_analysis['reference_lastupdate'])
            ? date("Y-m-d H:i", $file_analysis['reference_lastupdate'])
            : '';
        $reference_url = isset($file_analysis['reference_url'])
            ? $file_analysis['reference_url']
            : '';
        $locale_lastupdate = isset($file_analysis['locale_lastupdate'])
            ? date("Y-m-d H:i", $file_analysis['locale_lastupdate'])
            : '';
        $locale_url = isset($file_analysis['locale_url'])
            ? $file_analysis['locale_url']
            : '';

        $files_todo[$displayed_filename] = [
            'css_class'            => $cmp_result,
            'cmp_result'           => str_replace('_', ' ', $cmp_result),
            'locale_url'           => $locale_url,
            'locale_lastupdate'    => $locale_lastupdate,
            'reference_url'        => $reference_url,
            'reference_lastupdate' => $reference_lastupdate,
        ];
    }

    $websites[$website_name] = [
        'data_source' => 'raw',
        'files_done'  => $files_done,
        'files_todo'  => $files_todo,
        'repository'  => $repo,
    ];
}

print $twig->render(
    'listsitesforlocale.twig',
    [
        'locale'   => $current_locale,
        'websites' => $websites,
    ]
);
