<?php
namespace Langchecker;

use \Transvision\Json;

$todo  = [];

foreach ($mozilla as $current_locale) {

    $todo[$current_locale] = 0;

    foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {

        $reference_locale = Project::getReferenceLocale($current_website);

        // Ignore reference language
        if ($current_locale == $reference_locale) {
            continue;
        }

        foreach (Project::getWebsiteFiles($current_website) as $current_filename) {

            // Skip the loop if we don't have this lang file for the locale
            if (! Project::isSupportedLocale($current_website, $current_locale, $langfiles_subsets, $current_filename)) {
                continue;
            }

            // Skip the locale for this file if it's missing
            if (! is_file(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
                continue;
            }

            // Skip the locale if we do have a lang file but don't need it for the locale
            if (isset($langfiles_subsets[$current_website[0]][$current_filename])
                && ! in_array($current_locale, $langfiles_subsets[$current_website[0]][$current_filename])) {
                continue;
            }

            $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);
            $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

            $todo[$current_locale] += count($locale_analysis['Identical']) + count($locale_analysis['Missing']);
        }
    }
}

arsort($todo);

if ($json) {
    die(Json::output($todo, false, true));
}

// General table with missing strings per locale

$rows = '';
foreach ($todo as $key => $val) {
    if ($val == 0) {
        $class = 'class="dim"';
    } else {
        $class = '';
    }

    $rows .= "<tr {$class}><td><a href='./?locale={$key}'>{$key}</a></td><td>{$val}</td></tr>\n";
}

$general_table = "
<table>
    <tr>
        <th>Locale</th>
        <th>Untranslated</th>
    </tr>
{$rows}
    <tr>
        <th>Total</th>
        <td><strong>" . count($mozilla) . "</strong></td>
    </tr>
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

foreach ($todo as $key => $val) {
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
foreach(array_reverse($results) as $category => $values) {
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
