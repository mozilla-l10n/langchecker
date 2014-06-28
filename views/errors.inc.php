<?php
namespace Langchecker;
?>
      <p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>

      <h1>Display errors for all locales</h1>

<?php

$htmloutput = '';
foreach ($mozilla as $locale) {
    $locale_with_errors = false;
    $locale_htmloutput = "\n      <h2>Locale: <a href='?locale={$locale}' target='_blank'>{$locale}</a></h2>\n";

    foreach ($sites as $key => $_site) {
        if (in_array($locale, $_site[3])) {
            $repo = $sites[$key][6] . $sites[$key][2] . $locale . '/';

            foreach ($_site[4] as $filename) {
                /*
                 *  Reassign a lang file to a reduced set of locales
                 */

                if (@is_array($langfiles_subsets[$_site[0]][$filename])
                    && ! in_array($locale, $langfiles_subsets[$_site[0]][$filename])) {
                    continue;
                }

                /*
                 * Define English defaults stored in $GLOBALS['__english_moz']
                 * We temporarily define a $lang variable for that
                 */

                $reflang = $sites[$key][5];
                $bugwebsite = 'www.mozilla.org';

                $source = $sites[$key][1] . $sites[$key][2] . $reflang . '/' . $filename;
                $target = $sites[$key][1] . $sites[$key][2] . $locale  . '/' . $filename;

                $url_source = $sites[$key][6] . $sites[$key][2] . $reflang  . '/' . $filename;
                $url_target = $sites[$key][6] . $sites[$key][2] . $locale   . '/' . $filename;

                getEnglishSource($reflang, $key, $filename);

                $opening_div = "      <div class='website'>\n" .
                               "        <h2>{$_site[0]}</h2>\n";

                // If the .lang file does not exist, just skip the locale for this file
                $local_lang_file = $_site[1] . $_site[2] . $locale . '/' . $filename;
                if (! is_file($local_lang_file)) {
                    if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>File missing: $local_lang_file</p>\n";
                    continue;
                }

                analyseLangFile($locale, $key, $filename);

                unset($reflang);

                if (count($GLOBALS[$locale]['python_vars']) != 0)
                {
                    if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>Repository: <a href=\"$repo\">$repo</a></p>\n";
                    $locale_htmloutput .= "        <div class='filename' id='{$filename}'>\n";
                    $locale_htmloutput .= "          <h3 class='filename'><a href='#$filename'>$filename</a></h3>\n";

                    foreach ($GLOBALS[$locale] as $k => $v) {
                        if ($k == 'python_vars' && count($GLOBALS[$locale][$k]) > 0) {
                            $locale_htmloutput .= "          <h3>Errors in variables in the sentence:</h3>\n";
                            $locale_htmloutput .= "          <ul>\n";
                            foreach ($v as $k2 => $v2) {
                                $locale_htmloutput .= "              <table class='python'>
                <tr>
                  <th><strong style=\"color:red\"> $v2</strong> in the English string is missing in:</th>
                </tr>
                <tr>
                  <td>" . showPythonVar(htmlspecialchars($k2)) . "</td>
                </tr>
                <tr>
                  <td>" . showPythonVar(htmlspecialchars($GLOBALS[$filename][$k2])) . "</td>
                </tr>
              </table>\n";
                            }
                            $locale_htmloutput .= "          </ul>\n";
                            $locale_htmloutput .= "        </div>\n";
                        }
                    }
                }

                // check if the lang file is not in UTF-8 or US-ASCII
                if (isUTF8($target) == false) {
                   if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p><strong>$filename</strong> is not saved in UTF8</p>\n";
                }

                // Display errors on missing strings
                if (count($GLOBALS[$locale]['Missing'])) {
                    if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>Missing strings in {$filename}</p>\n";
                }

                // Display errors on unknown tags
                $locale_file_tags = $GLOBALS[$locale]['tags'];
                $extra_tags = array_diff(
                    $locale_file_tags,
                    getAllowedTagsInFile($GLOBALS[$locale]['tags'])
                );
                foreach ($extra_tags as $extra_tag) {
                    if (! $locale_with_errors) {
                        $locale_with_errors = true;
                        $locale_htmloutput .= $opening_div;
                    }
                    $locale_htmloutput .= "        <p>Unknown tag <strong>{$extra_tag}</strong> in {$filename}</p>\n";
                }

                if (isset($GLOBALS['__english_moz']['tag_bindings'])  &&
                    $GLOBALS[$locale]['activated']) {
                        // If file is activated, get a list of untranslated/identical strings bound to tags
                        $incomplete_tagged_strings = [];
                        foreach ($GLOBALS['__english_moz']['tag_bindings'] as $string_id => $bound_tag) {
                            if (in_array($string_id, $GLOBALS[$locale]['Missing']) ||
                                in_array($string_id, $GLOBALS[$locale]['Identical'])) {
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
                        $source_file_tags = isset($GLOBALS['__english_moz']['tags'])
                                            ? $GLOBALS['__english_moz']['tags']
                                            : [];
                        $missing_tags = array_diff(
                            $source_file_tags,
                            $locale_file_tags
                        );
                        foreach ($missing_tags as $missing_tag) {
                            if (! in_array($missing_tag, $incomplete_tags)) {
                                if (! $locale_with_errors) {
                                    $locale_with_errors = true;
                                    $locale_htmloutput .= $opening_div;
                                }
                                $locale_htmloutput .= "<p>Tag <strong>{$missing_tag}</strong> is missing in {$filename}.</p>\n";
                            }
                        }
                }

                unset($GLOBALS['__english_moz'], $GLOBALS[$locale]);
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
