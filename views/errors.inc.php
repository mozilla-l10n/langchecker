<?php
namespace Langchecker;
?>
      <p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>
      <h1>Display errors for all locales</h1>
<?php

$htmloutput = '';

// Checks on l10n files
foreach ($mozilla as $current_locale) {
    $locale_with_errors = false;
    $locale_htmloutput = "\n      <h2>Locale: <a href='?locale={$current_locale}' target='_blank'>{$current_locale}</a></h2>\n";

    foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {
        $website_with_errors = false;
        if (Project::isSupportedLocale($current_website, $current_locale)) {
            $repo = Project::getPublicRepoPath($current_website, $current_locale);
            $current_website_name = Project::getWebsiteName($current_website);
            $opening_div = "      <div class='website_container'>\n" .
                           "        <h2>{$current_website_name}</h2>\n";

            foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
                if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename, $langfiles_subsets)) {
                    // File is not managed for this website+locale, ignore it
                    continue;
                }

                // Load reference strings
                $reference_locale = Project::getReferenceLocale($current_website);
                $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

                // If the .lang file does not exist, warn and skip this file
                $locale_filename = Project::getLocalFilePath($current_website, $current_locale, $current_filename);
                if (! is_file($locale_filename)) {
                    if (! $website_with_errors) {
                        $website_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>File missing: {$locale_filename}</p>\n";
                    continue;
                }

                // Extract data from locale
                $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);
                $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

                if (count($locale_analysis['python_vars']) != 0) {
                    if (! $website_with_errors) {
                        $website_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>Repository: <a href='{$repo}'>{$repo}</a></p>\n";
                    $locale_htmloutput .= "        <div class='file_container' id='{$current_filename}'>\n";
                    $locale_htmloutput .= "          <h3 class='filename'><a href='#{$current_filename}'>{$current_filename}</a></h3>\n";

                    $locale_htmloutput .= "          <h3>Errors in variables in the sentence:</h3>\n";
                    $locale_htmloutput .= "          <ul>\n";
                    foreach ($locale_analysis['python_vars'] as $stringid => $python_error) {
                        $locale_htmloutput .= "              <table class='python'>
                <tr>
                  <th>Check the following variables: <strong style='color:red'>{$python_error['var']}</strong></th>
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
                   if (! $website_with_errors) {
                        $website_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p><strong>{$current_filename}</strong> is not saved in UTF8</p>\n";
                }

                // Display errors on missing strings
                if (count($locale_analysis['Missing'])) {
                    if (! $website_with_errors) {
                        $website_with_errors = true;
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
                            if (! $website_with_errors) {
                                $website_with_errors = true;
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
                                if (! $website_with_errors) {
                                    $website_with_errors = true;
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
                            if (! $website_with_errors) {
                                $website_with_errors = true;
                                $locale_htmloutput .= $opening_div;
                            }
                            $locale_htmloutput .= "<p>Tag <strong>{$missing_tag}</strong> is missing in {$current_filename}.</p>\n";
                        }
                    }
                }
            }
        }

        if ($website_with_errors) {
            $locale_htmloutput .= "      </div>\n\n";
            if (! $locale_with_errors) {
                $locale_with_errors = true;
            }
        }
    }

    foreach (Project::getWebsitesByDataType($sites, 'raw') as $current_website) {
        $website_with_errors = false;
        if (Project::isSupportedLocale($current_website, $current_locale)) {
            $repo = Project::getPublicRepoPath($current_website, $current_locale);
            $current_website_name = Project::getWebsiteName($current_website);
            $opening_div = "      <div class='website_container'>\n" .
                           "        <h2>{$current_website_name}</h2>\n";

            foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
                if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename, $langfiles_subsets)) {
                    // File is not managed for this website+locale, ignore it
                    continue;
                }

                $locale_filename = Project::getLocalFilePath($current_website, $current_locale, $current_filename);
                if (! in_array('optional', Project::getFileFlags($current_website, $current_filename, $current_locale)) &&
                    ! file_exists($locale_filename)) {
                    if (! $website_with_errors) {
                        $website_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>File missing: {$locale_filename}</p>\n";
                    continue;
                }
            }
        }

        if ($website_with_errors) {
            $locale_htmloutput .= "      </div>\n\n";
            if (! $locale_with_errors) {
                $locale_with_errors = true;
            }
        }
    }

    if ($locale_with_errors) {
        $htmloutput .= $locale_htmloutput;
    }
}

// Checks on reference files
foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {
    $reference_with_errors = false;

    $current_website_name = Project::getWebsiteName($current_website);
    $reference_locale = Project::getReferenceLocale($current_website);

    $reference_output = "      <h2>Reference locale: {$reference_locale}</h2>\n";
    $opening_div = "      <div class='website_container'>\n" .
                   "        <h2>{$current_website_name}</h2>\n";

    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        // Load reference strings
        $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

        if (isset($reference_data['duplicates'])) {
            if (! $reference_with_errors) {
                $reference_with_errors = true;
                $reference_output .= $opening_div;
            }
            $reference_output .= "        <p><strong>{$current_filename}</strong> has duplicated strings</p>\n        <ul>\n";
            foreach ($reference_data['duplicates'] as $key => $string_id) {
                $reference_output .= "        <li>" . htmlspecialchars($string_id) . "</li>\n";
            }
            $reference_output .= "</ul>\n";
        }
    }

    if ($reference_with_errors) {
        $reference_output .= "      </div>\n\n";
        $htmloutput .= $reference_output;
    }
}

foreach (Project::getWebsitesByDataType($sites, 'raw') as $current_website) {
    $reference_with_errors = false;

    $current_website_name = Project::getWebsiteName($current_website);
    $reference_locale = Project::getReferenceLocale($current_website);

    $reference_output = "      <h2>Reference locale: {$reference_locale}</h2>\n";
    $opening_div = "      <div class='website_container'>\n" .
                   "        <h2>{$current_website_name}</h2>\n";

    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        $reference_filename = Project::getLocalFilePath($current_website, $reference_locale, $current_filename);
        if (! file_exists($reference_filename)) {
            if (! $reference_with_errors) {
                $reference_with_errors = true;
                $reference_output .= $opening_div;
            }
            $reference_output .= "        <p><strong>{$current_filename}</strong> is missing</p>\n";
        }
    }

    if ($reference_with_errors) {
        $reference_output .= "      </div>\n\n";
        $htmloutput .= $reference_output;
    }
}

if ($htmloutput == '') {
    // There are no errors
    echo "     <p>Everything looks good, no errors found.</p>";
} else {
    echo $htmloutput;
}
