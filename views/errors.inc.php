<?php
namespace Langchecker;
?>
      <p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>
      <h1>Display errors for all locales</h1>
<?php

$htmloutput = '';
foreach ($mozilla as $current_locale) {
    $locale_with_errors = false;
    $locale_htmloutput = "\n      <h2>Locale: <a href='?locale={$current_locale}' target='_blank'>{$current_locale}</a></h2>\n";

    foreach ($sites as $current_website) {
        if (Project::isSupportedLocale($current_website, $current_locale)) {
            $repo = Project::getPublicRepoPath($current_website, $current_locale);

            foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
                if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename, $langfiles_subsets)) {
                    // File is not managed for this website+locale, ignore it
                    continue;
                }

                // Load reference strings
                $reference_locale = Project::getReferenceLocale($current_website);
                $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

                $current_website_name = Project::getWebsiteName($current_website);
                $opening_div = "      <div class='website'>\n" .
                               "        <h2>{$current_website_name}</h2>\n";

                // If the .lang file does not exist, warn and skip this file
                $locale_filename = Project::getLocalFilePath($current_website, $current_locale, $current_filename);
                if (! is_file($locale_filename)) {
                    if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>File missing: {$locale_filename}</p>\n";
                    continue;
                }

                // Extract data from locale
                $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);
                $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

                if (count($locale_analysis['python_vars']) != 0) {
                    if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>Repository: <a href='{$repo}'>{$repo}</a></p>\n";
                    $locale_htmloutput .= "        <div class='filename' id='{$current_filename}'>\n";
                    $locale_htmloutput .= "          <h3 class='filename'><a href='#{$current_filename}'>{$current_filename}</a></h3>\n";

                    $locale_htmloutput .= "          <h3>Errors in variables in the sentence:</h3>\n";
                    $locale_htmloutput .= "          <ul>\n";
                    foreach ($locale_analysis['python_vars'] as $stringid => $python_error) {
                        $locale_htmloutput .= "              <table class='python'>
                <tr>
                  <th><strong style='color:red'>{$python_error['var']}</strong> in the English string is missing in:</th>
                </tr>
                <tr>
                  <td>" . Utils::highlightPythonVar($stringid) . "</td>
                </tr>
                <tr>
                  <td>" . Utils::highlightPythonVar($python_error['text']) . "</td>
                </tr>
              </table>\n";
                    }
                    $locale_htmloutput .= "          </ul>\n";
                    $locale_htmloutput .= "        </div>\n";
                }

                // Check if the lang file is not in UTF-8 or US-ASCII
                if (Utils::isUTF8($locale_filename) == false) {
                   if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p><strong>{$current_filename}</strong> is not saved in UTF8</p>\n";
                }

                // Display errors on missing strings
                if (count($locale_analysis['Missing'])) {
                    if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>Missing strings in {$current_filename}</p>\n";
                }

                // If locale has tags, display errors on unknown tags
                if (isset($locale_data['tags'])) {
                    $locale_file_tags = $locale_data['tags'];
                    $extra_tags = array_diff($locale_file_tags, $reference_data['tags']);
                    if (count($extra_tags)) {
                        foreach ($extra_tags as $extra_tag) {
                            if (! $locale_with_errors) {
                                $locale_with_errors = true;
                                $locale_htmloutput .= $opening_div;
                            }
                            $locale_htmloutput .= "        <p>Unknown tag <strong>{$extra_tag}</strong> in {$current_filename}</p>\n";
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
                    if (count($incomplete_tags) > 0) {
                        foreach ($locale_file_tags as $locale_tag) {
                            if (in_array($locale_tag, $incomplete_tags)) {
                                // Tag is enabled, but strings are still missing
                                if (! $locale_with_errors) {
                                    $locale_with_errors = true;
                                    $locale_htmloutput .= $opening_div;
                                }
                                $locale_htmloutput .= "<p>Tag <strong>{$locale_tag}</strong> is enabled but the following strings are still missing:</p>\n<ul>\n</li>\n";
                                foreach ($incomplete_tagged_strings[$locale_tag] as $string_id) {
                                    $locale_htmloutput .= "<li>" . htmlspecialchars($string_id) . "</li>\n";
                                }
                                $locale_htmloutput .= "</ul>\n";
                            }
                        }
                    }

                    // Get all missing tags completely localized
                    $source_file_tags = isset($reference_data['tags'])
                                        ? $reference_data['tags']
                                        : [];
                    $missing_tags = array_diff($source_file_tags, $locale_file_tags);
                    foreach ($missing_tags as $missing_tag) {
                        if (! in_array($missing_tag, $incomplete_tags)) {
                            if (! $locale_with_errors) {
                                $locale_with_errors = true;
                                $locale_htmloutput .= $opening_div;
                            }
                            $locale_htmloutput .= "<p>Tag <strong>{$missing_tag}</strong> is missing in {$current_filename}.</p>\n";
                        }
                    }
                }
            }
        }
    }
    if ($locale_with_errors) {
        $locale_htmloutput .= "      </div>\n\n";
        $htmloutput .= $locale_htmloutput;
    }
}

if ($htmloutput == '') {
    // There are no errors
    echo "     <p>Everything looks good, no errors found.</p>";
} else {
    echo $htmloutput;
}
