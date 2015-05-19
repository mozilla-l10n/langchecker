<?php
namespace Langchecker;

use Transvision\Json;

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
            if (in_array('obsolete', Project::getFileFlags($current_website, $current_filename, $current_locale))) {
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

if ($json) {
    die(Json::output($untranslated, false, true));
}

// General table with untranslated/translated strings per locale
$rows = '';
foreach ($untranslated as $locale => $untranslated_count) {
    if ($untranslated_count == 0) {
        $class = 'class="count_complete"';
    } else {
        $class = '';
    }

    $rows .= "<tr {$class}>" .
             "  <td><a href='./?locale={$locale}'>{$locale}</a></td>\n" .
             "  <td>{$untranslated_count}</td>\n" .
             "  <td>{$translated[$locale]}</td>\n" .
             "  <td>{$all_strings[$locale]}</td>\n" .
             "  <td>{$file_count[$locale]}</td>\n" .
             "</tr>\n";
}

$general_table = "
<table class='sortable'>
  <thead>
    <tr>
        <th>Locale</th>
        <th>Untranslated</th>
        <th>Translated</th>
        <th>Total</th>
        <th>Files</th>
    </tr>
  </thead>
  <tbody>
{$rows}
  </tbody>
  <tfooter>
    <tr>
        <th colspan='4'>Number of locales</th>
        <td><strong>" . count($mozilla) . "</strong></td>
    </tr>
  </tfooter>
</table>
";

/* Summary table code */

// Those are tips displayed when hovering the row header
$title = [
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

$rows = '';
foreach (array_reverse($results) as $category => $values) {
    sort($values);
    $th  = ucfirst($category);
    $tip = $title[$category];
    $td1 = count($values);
    $td2 = implode(', ', $values);
    $on_locamotion = implode(', ', array_intersect($values, $locamotion_locales));
    $rows .= "
    <tr>
        <th title='{$tip}' class='help'>{$th}</th>
        <td>{$td1}</td>
        <td>{$td2}</td>
        <td>{$on_locamotion}</td>
    </tr>";
}

$summary_table = "
<table id='count_summary'>
    <tr>
        <th colspan='5'>Web Parts Completion Summary</th>
    </tr>
    <tr>
        <th>State</th>
        <th>Count</th>
        <th>Locales</th>
        <th>On locamotion</th>
    </tr>
{$rows}
</table>
";

print '<h2>General Completion of Web Parts</h2>';
print $general_table;
print $summary_table;
