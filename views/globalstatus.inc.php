<?php
namespace Langchecker;

use \Transvision\Json;

ob_start();

// $filename is set in /inc/init.php
$current_filename = $filename;

if (! isset($sites[$website])) {
  // This website is not available
  if ($json) {
    http_response_code(400);
    die("{$website} is not a supported website. Check the value and try again.");
  } else {
    die("<p>This website is not supported.</p>");
  }
}

$current_website = $sites[$website];
$website_data_source = Project::getWebsiteDataType($current_website);

if ($current_filename == '' || ! in_array($current_filename, Project::getWebsiteFiles($current_website))) {
    if ($json) {
        http_response_code(400);
        die("File {$current_filename} does not exist. Check the value and try again.");
    } else {
        die("<p>ERROR: file {$current_filename} does not exist</p>");
    }
}

$complete_locales_count = 0;
$complete_locales_list = [];
$activated_locales_count = 0;
$activated_locales_list = [];
$json_data = [];

$reference_locale = Project::getReferenceLocale($current_website);

if ($website_data_source == 'lang') {
    // Websites using .lang files
    $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

    $translation_link = "?website={$website}&amp;file={$current_filename}&amp;action=translate";
    echo '
    <table class="sortable globallist">
      <caption class="filename"><a href="' . $translation_link . '" title="View available translations for this file">' . $current_filename . '</a></caption>
      <thead>
        <tr>
          <th>Locale</th>
          <th>Identical</th>
          <th>Translated</th>
          <th>Missing</th>
          <th>Obsolete</th>
          <th>Tags</th>
          <th>URL</th>
          <th>Activated</th>
        </tr>
      </thead>
      <tbody>
    ';

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
        $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);

        $todo = count($locale_analysis['Identical']) + count($locale_analysis['Missing']);
        $total = $todo + count($locale_analysis['Translated']);

        $cssclass = ($todo/$total>0.60) ? ' lightlink_cell' : '';
        $color = 'rgba(255, 0, 0, ' . $todo/$total . ')';

        if ($todo == 0) {
            $complete_locales_count++;
            $complete_locales_list[] = $current_locale;
        }

        echo "    <tr>\n";
        echo "      <td class='linklocale_cell {$cssclass}' style='background-color: {$color}'>\n";
        echo "        <a href='./?locale={$current_locale}#{$current_filename}'>{$current_locale}</a>\n";
        echo "      </td>\n";

        $keys = ['Identical', 'Translated', 'Missing', 'Obsolete'];
        foreach ($keys as $key) {
            $counter = count($locale_analysis[$key])
                       ? count($locale_analysis[$key])
                       : '';
            echo "      <td>{$counter}</td>\n";
            $json_data[$current_filename][$current_locale][$key] = intval($counter);
        }

        // Tags
        if (isset($locale_data['tags'])) {
            $locale_tags = $locale_data['tags'];
            sort($locale_tags);
            $json_data[$current_filename][$current_locale]['tags'] = $locale_tags;
            // Remove _promo from tags
            $locale_tags = array_map(
                function($element) {
                    return str_replace('promo_', '', $element);
                },
                $locale_tags
            );
            echo "      <td class='tags_cell'>" . implode('<br>', $locale_tags) ."</td>\n";
        } else {
            echo "      <td></td>\n";
            $json_data[$current_filename][$current_locale]['tags'] = [];
        }

        // URL to stage server
        echo '      <td>'  .  Project::getLocalizedURL($reference_data, $current_locale, 'html') . "</td>\n";

        // Activation status
        $active = $locale_analysis['activated'];
        $json_data[$current_filename][$current_locale]['activated'] = $active;
        if ($active) {
            echo "      <td class='activated_cell'>active</td>\n";
            $activated_locales_count++;
            $activated_locales_list[] = $current_locale;
        } else {
            echo "      <td></td>\n";
        }
        echo "    </tr>\n";
    }

    $coverage_complete = Project::getUserBaseCoverage($complete_locales_list, $adu) . '%';
    $coverage_activated = Project::getUserBaseCoverage($activated_locales_list, $adu) . '%';

    echo "
      </tbody>
      <tfoot>
        <tr>
          <td colspan= '8'>
            Complete locales: {$complete_locales_count} (" . round($complete_locales_count/count($supported_locales)*100) . "%) - {$coverage_complete} of our l10n user base<br/>
            Activated locales: {$activated_locales_count} (" . round($activated_locales_count/count($supported_locales)*100) . "%) - {$coverage_activated} of our l10n user base
          </td>
        </tr>
      </tfoot>
    </table>\n";
} else {
    // Websites using raw files
    echo '
    <table class="sortable rawfiles">
      <caption class="filename">' . basename($current_filename) . '</caption>
      <thead>
        <tr>
          <th>Locale</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
    ';

    $complete_locales_count = 0;
    $complete_locales_list = [];

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

        $json_data[$current_filename][$current_locale]['status'] = $cmp_result;

        $website_name = Project::getWebsiteName($current_website);
        $locale_link = "<a href='./?locale={$current_locale}#{$website_name}'>{$current_locale}</a>";

        echo "
        <tr>
          <td class='maincolumn'>{$locale_link}</td>
          <td><span class='rawstatus {$cmp_result}'>" . str_replace('_', ' ', $cmp_result) . "</span></td>
        </tr>\n";
    }

    $coverage = Project::getUserBaseCoverage($complete_locales_list, $adu) . '%';
    echo '
      </tbody>
      <tfoot>
        <tr>
          <td colspan= "2">'
            . $complete_locales_count
            . ' translated locales ('
            . round($complete_locales_count/count($supported_locales)*100)
            . '%)<br>'
            . $coverage
            . ' of our l10n user base'
            . '</td>
        </tr>
      </tfoot>
    </table>
    ';
}

$htmlresult = ob_get_contents();
ob_clean();

if ($json) {
    if ($locale == 'all' || $locale == '') {
        echo Json::output($json_data, false, true);
    } else {
        // Only one locale
        if (isset($json_data[$current_filename][$locale])) {
            $single_locale_json[$current_filename][$locale] = $json_data[$current_filename][$locale];
            echo Json::output($single_locale_json, false, true);
        } else {
            // Unknown locale
            http_response_code(400);
            die("Unknown locale: {$locale}. Check the value and try again.");
        }
    }
} else {
    echo $htmlresult;
}