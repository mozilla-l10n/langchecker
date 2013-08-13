<p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>

<h1>Display python errors for all locales</h1>

<?php

foreach ($mozilla as $locale) {

    // we define in the loop if the locale code is supported in one of the sites;
    $localeok = false;
    echo '  <h2>Locale: ' . $locale . "</h2>\n";

    $htmloutput = '';
    $localewitherrors = false;

    foreach ($sites as $key => $_site) {

        if (in_array($locale, $_site[3])) {

            $localeok = true;

            $repo = $sites[$key][6] . $sites[$key][2] . $locale . '/';

            $htmloutput .= '  <div class="website">' . "\n";
            $htmloutput .= '    <h2>' . $_site[0] . '</h2>' . "\n";
            $htmloutput .= "    <p>Repository: <a href=\"$repo\">$repo</a></p>\n";

            foreach ($_site[4] as $filename) {

                /*
                 *  Reassign a lang file to a reduced set of locales
                 */

                if (@is_array($langfiles_subsets[$_site[0]][$filename])
                    && !in_array($locale, $langfiles_subsets[$_site[0]][$filename])) {
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

                analyseLangFile($locale, $key, $filename);

                unset($reflang);

                if (count($GLOBALS[$locale]['python_vars']) != 0)
                {
                    $localewitherrors = true;
                    $htmloutput .= '    <div class="filename" id="' . $filename . '">' . "\n";
                    $htmloutput .= "      <h3 class='filename'><a href='#$filename'>$filename</a></h3>" . "\n";

                    foreach ($GLOBALS[$locale] as $k => $v) {
                        if ($k == 'python_vars' && count($GLOBALS[$locale][$k]) > 0) {
                            $htmloutput .= '      <h3>Errors in variables in the sentence:</h3>' . "\n";
                            $htmloutput .= '        <ul>' . "\n";
                            foreach ($v as $k2 => $v2) {
                                $htmloutput .= "          <p></p>\n";
                                $htmloutput .= "          <table class=\"python\">
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
                            $htmloutput .= "        </ul>\n";
                            $htmloutput .= "    </div>\n";
                        }
                    }
                }
                unset($GLOBALS['__english_moz'], $GLOBALS[$locale]);
            }

            $htmloutput .= "  </div>\n\n";
        }
    }

    if ($localewitherrors) {
        echo $htmloutput;
    } else {
        echo "  <p>Everything looks good</p>\n\n";
    }


    // The locale is not correct
    if (!$localeok) {
        echo " <p>This locale code is not supported on our sites</p>\n";
    }
}
