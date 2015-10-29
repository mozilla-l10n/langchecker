<?php
namespace Langchecker;

// $filename is set in /inc/init.php
$current_filename = $filename;
if (! isset($sites[$website])) {
    Project::displayErrorTemplate($twig, 'This website is not supported.');
}

$current_website = $sites[$website];
$website_data_source = Project::getWebsiteDataType($current_website);
if ($current_filename == '' || ! in_array($current_filename, Project::getWebsiteFiles($current_website))) {
    Project::displayErrorTemplate($twig, "ERROR: file {$current_filename} does not exist");
}

$complete_locales_count = 0;
$complete_locales_list = [];

$reference_locale = Project::getReferenceLocale($current_website);
if ($website_data_source == 'lang') {
    // Websites using .lang files
    $displayed_filename = $current_filename;

    $activated_locales_count = 0;
    $activated_locales_list = [];
    $file_activable = ! in_array($current_filename, $no_active_tag);
    $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

    $files_list = [];
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

        $todo = count($locale_analysis['Identical']) + count($locale_analysis['Missing']);
        $total = $todo + count($locale_analysis['Translated']);

        // If there are errors, consider them as unstranslated strings
        $todo += LangManager::countErrors($locale_analysis['errors']);

        $css_class = ($todo / $total > 0.60) ? ' lightlink_cell' : '';
        $bg_color = 'rgba(255, 0, 0, ' . round($todo / $total, 2) . ')';

        if ($todo == 0) {
            $complete_locales_count++;
            $complete_locales_list[] = $current_locale;
        }

        // Activation status
        if ($locale_analysis['activated']) {
            $activated_locales_count++;
            $activated_locales_list[] = $current_locale;
        }

        $files_list[$current_locale] = [
            'activated' => $locale_analysis['activated'],
            'bg_color'  => $bg_color,
            'css_class' => $css_class,
            'page_url'  => Project::getLocalizedURL($reference_data, $current_locale),
        ];

        $keys = ['Errors', 'Identical', 'Missing', 'Obsolete', 'Translated'];
        foreach ($keys as $key) {
            $counter = $key == 'Errors'
                ? LangManager::countErrors($locale_analysis['errors'])
                : count($locale_analysis[$key]);
            if ($counter == 0) {
                $counter = '';
            }
            $files_list[$current_locale][$key] = $counter;
        }

        // Tags
        if (isset($locale_analysis['tags'])) {
            $locale_tags = $locale_analysis['tags'];
            sort($locale_tags);
            // Remove _promo from tags
            $locale_tags = array_map(
                function ($element) {
                    return str_replace('promo_', '', $element);
                },
                $locale_tags
            );
            $files_list[$current_locale]['tags'] = implode('<br>', $locale_tags);
        }
    }

    print $twig->render(
        'globalstatus_lang.twig',
        [
            'activated_locales'    => $activated_locales_count,
            'complete_locales'     => $complete_locales_count,
            'coverage_activated'   => Project::getUserBaseCoverage($activated_locales_list, $adu),
            'coverage_complete'    => Project::getUserBaseCoverage($complete_locales_list, $adu),
            'file_activable'       => $file_activable,
            'files_list'           => $files_list,
            'filename'             => $current_filename,
            'obsolete'             => Project::isObsoleteFile($current_website, $current_filename, 'all'),
            'percentage_activated' => round($activated_locales_count / count($supported_locales) * 100),
            'percentage_complete'  => round($complete_locales_count / count($supported_locales) * 100),
            'website_id'           => $website,
            'website_name'         => Project::getWebsiteName($current_website),
        ]
    );
} else {
    // Websites using raw files
    $files_list = [];
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
        if ($cmp_result == 'ok') {
            $complete_locales_count++;
            $complete_locales_list[] = $current_locale;
        }

        $files_list[$current_locale] = [
            'pretty_status' => str_replace('_', ' ', $cmp_result),
            'status'        => $cmp_result,
        ];
    }

    print $twig->render(
        'globalstatus_raw.twig',
        [
            'complete_locales' => $complete_locales_count,
            'coverage'         => Project::getUserBaseCoverage($complete_locales_list, $adu),
            'files_list'       => $files_list,
            'filename'         => basename($current_filename),
            'percentage'       => round($complete_locales_count / count($supported_locales) * 100),
            'website_name'     => Project::getWebsiteName($current_website),
        ]
    );
}
