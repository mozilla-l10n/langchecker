<?php
namespace Langchecker;

LangManager::$error_checking = false;
DotLangParser::$extract_metadata = false;
DotLangParser::$log_errors = false;

$untranslated = [];
$translated = [];
$file_count = [];
$all_strings = [];

foreach ($mozilla as $current_locale) {
    // Initialize locale
    $untranslated[$current_locale] = 0;
    $translated[$current_locale] = 0;
    $file_count[$current_locale] = 0;
    foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {
        $reference_locale = Project::getReferenceLocale($current_website);

        // Ignore reference language
        if ($current_locale == $reference_locale) {
            continue;
        }

        foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
            // File not supported
            if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename, $langfiles_subsets)) {
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

            $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);
            $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

            $untranslated[$current_locale] += count($locale_analysis['Identical']) + count($locale_analysis['Missing']);
            $translated[$current_locale] += count($locale_analysis['Translated']);
            $file_count[$current_locale] += 1;
        }
    }
    $all_strings[$current_locale] = $untranslated[$current_locale] + $translated[$current_locale];
}

// I need locales with more untranslated strings first
arsort($untranslated);

// For a JSON request data is ready
if ($json) {
    die($json_object->outputContent($untranslated, false, true));
}

// General table with untranslated/translated strings per locale
$locales_list = [];
foreach ($untranslated as $locale => $untranslated_count) {
    $locales_list[$locale] = [
        'css_class'    => ($untranslated_count == 0) ? 'count_complete' : '',
        'file_count'   => $file_count[$locale],
        'total'        => $all_strings[$locale],
        'translated'   => $translated[$locale],
        'untranslated' => $untranslated[$locale],
    ];
}

// Summary table code
// Those are tooltips displayed when hovering the row header
$tooltips = [
    'perfect'  => 'Everything is translated',
    'good'     => 'Less than 50 missing strings',
    'average'  => 'Between 50 and 200 missing strings',
    'bad'      => 'Between 200 and 500 missing strings',
    'very bad' => 'More than 500 missing strings',
];

$results = [];
foreach ($untranslated as $key => $val) {
    if ($val == 0) {
        $results['perfect'][] = $key;
        continue;
    }

    if ($val < 50) {
        $results['good'][] = $key;
        continue;
    }

    if ($val < 200 && $val > 50) {
        $results['average'][] = $key;
        continue;
    }

    if ($val < 500 && $val > 200) {
        $results['bad'][] = $key;
        continue;
    }

    $results['very bad'][] = $key;
}

$summary_table_rows = [];
foreach (array_reverse($results) as $category => $values) {
    sort($values);
    $th  = ucfirst($category);
    $tip = $tooltips[$category];
    $td1 = count($values);
    $td2 = implode(', ', $values);
    $on_locamotion = implode(', ', array_intersect($values, $locamotion_locales));
    $summary_table_rows[] = [
        'header'     => $th,
        'tooltip'    => $tip,
        'count'      => $td1,
        'locales'    => $td2,
        'locamotion' => $on_locamotion,
    ];
}

print $twig->render(
    'countstrings.twig',
    [
        'count_locales'      => count($mozilla),
        'summary_table_rows' => $summary_table_rows,
        'locales_list'       => $locales_list,
    ]
);
