<?php
namespace Langchecker;

use \Transvision\Json;

$todo  = [];
$total = [];

// We consider only mozilla.org, so $sites[0]
$current_website = $sites[0];
$reference_locale = Project::getReferenceLocale($current_website);

foreach ($mozilla as $current_locale) {
    // Ignore reference language
    if ($current_locale == $reference_locale) {
        continue;
    }

    $todo[$current_locale]  = 0;
    $total[$current_locale] = 0;

    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        // Skip the loop if we don't have this lang file for the locale
        if (! Project::isSupportedLocale($current_website, $current_locale, $langfiles_subsets, $current_filename)) {
            continue;
        }

        // Skip the locale for this file if it's missing
        if (! is_file(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
            continue;
        }

        $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);
        $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

        $todo[$current_locale] += count($locale_analysis['Identical']) + count($locale_analysis['Missing']);
    }
}

arsort($todo);
$locales_done = 0;

if (isset($_GET['json'])) {
    die(Json::output($todo, false, true));
}

echo '<table>';
echo '<tr><th>locale</th><th>Untranslated</th></tr>';

foreach ($todo as $key => $val) {
    if ($val == 0) {
        $class = 'class="dim"';
        $locales_done++;
    } else {
        $class = '';
    }

    echo "<tr {$class}><td><a href='./?locale={$key}'>{$key}</a></td><td>{$val}</td></tr>\n";
}

echo "<tr><td colspan='2'>{$locales_done} locales done</td></tr>\n";
echo "</table>\n";
