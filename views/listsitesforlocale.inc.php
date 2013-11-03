<p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/?locale=<?=$locale?>">Back to Web Dashboard</a></p>

<h1>Lang format file checker <span><?=$locale?></span></h1>

<?php

// we define in the loop if the locale code is supported in one of the sites;
$localeok = false;

foreach ($sites as $key => $_site) {

    if (in_array($locale, $_site[3])) {

        $localeok = true;

        echo '<div class="website">';
        echo '<h2>' . $_site[0] . '</h2>';
        $repo = $sites[$key][6] . $sites[$key][2] . $locale . '/';
        echo "<p>Repository : <a href=\"$repo\">$repo</a></p>";

        $titleDoneFiles = false;
        $titleTodoFiles = false;
        $titleTodo = false;
        $doneFiles = '';
        $todoFiles = '';

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

            if ($locale == 'fa') {
                $qacontact = 'persian.fa@localization.bugs';
            } else {
                $qacontact = 'pascalc@gmail.com';
            }

            $bugzilla ='https://bugzilla.mozilla.org/enter_bug.cgi?alias=&assigned_to=pascalc%40gmail.com&blocked=&bug_file_loc=http%3A%2F%2F&bug_severity=normal&bug_status=NEW&comment=%28Attach%20your%20updated%20' . $filename .   '%20file%20to%20this%20bug%20or%20indicate%20the%20revision%20number%20of%20your%20commit%20in%20SVN%29&component=L10N&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text%2Fplain&data=&dependson=&description=&flag_type-4=X&flag_type-418=X&flag_type-419=X&flag_type-506=X&flag_type-507=X&form_name=enter_bug&keywords=&maketemplate=Remember%20values%20as%20bookmarkable%20template&op_sys=All&priority=--&product=' . $bugwebsite . '&qa_contact=' . $qacontact . '&rep_platform=All&short_desc=%5Bl10n%3A ' . $locale . '%5D%20updated%20' . $filename . '%20file%20for%20' . $_site[0].'&target_milestone=---&version=unspecified&format=__default__&cf_locale='.$locale.'%20%2F%20';

            getEnglishSource($reflang, $key, $filename);

            analyseLangFile($locale, $key, $filename);

            unset($reflang);

            // create a css class used to show if a file is activated or not
            if (!in_array($filename, $no_active_tag) && $_site[0] == 'www.mozilla.org') {
                 $status = $GLOBALS[$locale]['activated'] ? ' activated' : ' notactivated';
             } else {
                 $status = ' activated';
             }

             // check if the lang file is in utf8
             if (isUTF8($target) == false) {
                 $status .= ' notutf8';
             }

            if ((count($GLOBALS[$locale]['Missing']) + count($GLOBALS[$locale]['Identical'])) == 0
                && count($GLOBALS[$locale]['python_vars']) == 0)
            {
                $titleDone = true;
                $doneFiles .= "<a href='#$filename' class='filedone$status'>$filename</a>";
            } else {
                $titleTodo = true;
                $todoFiles .= '<div class="filename" id="' . $filename . '">';
                $todoFiles .= "<h3 class='filename'><a href='#$filename'>$filename</a></h3>
                      <table class=\"side\">
                      <tr><th>Identical</th><th>Translated</th><th>Missing</th></tr>
                      <tr>";

                foreach ($GLOBALS[$locale] as $k => $v) {
                    if ($k == 'Obsolete' || $k == 'python_vars' || $k == 'activated') {
                        continue;
                    }
                    $todoFiles .= '<td>' . count($GLOBALS[$locale][$k]) . '</td>';
                }

                $todoFiles .= '<tr><td colspan="3"><a href="' . $url_source . '">Original English source file</a></td></tr>';
                $todoFiles .= '<tr><td colspan="3"><a href="' . $url_target . '">Your translated file</a></td></tr>';
                $todoFiles .= '<tr><td colspan="3"><a href="' . $bugzilla . '">Attach your updated file to Bugzilla</a></td></tr>';
                $todoFiles .= '</table>';

                foreach ($GLOBALS[$locale] as $k => $v) {
                    if ($k == 'Translated' || $k == 'Obsolete') {
                        continue;
                    }

                    if ($k == 'Identical' && count($GLOBALS[$locale][$k]) > 0) {
                        $todoFiles .= '<h3>Strings identical to English:</h3>';
                    }

                    if ($k == 'Missing' && count($GLOBALS[$locale][$k]) > 0) {
                        $todoFiles .=  '<h3>Missing strings:</h3>';
                    }

                    if ($k != 'python_vars' && $k != $filename && count($GLOBALS[$locale][$k]) > 0) {
                        $todoFiles .= '<ul>';
                        foreach ($v as $k2 => $v2) {
                            $todoFiles .= '<li>' .trim(str_replace('{l10n-extra}', '', htmlspecialchars($GLOBALS[$locale][$k][$k2]))) . '</li>';
                        }
                        $todoFiles .= '</ul>';
                    }

                    if ($k == 'python_vars' && count($GLOBALS[$locale][$k]) > 0) {
                        $todoFiles .= '<h3>Errors in variables in the sentence:</h3>';
                        $todoFiles .= '<ul>';
                        foreach ($v as $k2 => $v2) {
                            $todoFiles .= "<p></p>";
                            $todoFiles .= "<table class=\"python\">
                                    <tr>
                                        <th><strong style=\"color:red\"> $v2</strong> in the English string is missing in:</th>
                                    </tr>
                                    <tr>
                                        <td>" . showPythonVar(htmlspecialchars($k2)) . "</td>
                                    </tr>
                                    <tr>
                                        <td>" . showPythonVar(htmlspecialchars($GLOBALS[$filename][$k2])) . "</td>
                                    </tr>
                            </table>";
                        }
                        $todoFiles .= '</ul>';
                    }


                }
            }

            if (count($GLOBALS[$locale]['Identical']) > 0) {
                $todoFiles .= '<div class="tip">
                <strong>Tip:</strong> if it is normal that a string is identical
                to the English one for your language, just add <code>{ok}</code>
                to your string and it will no longer be listed as "identical".
                Example:
                <blockquote>
                ;Plugins<br/>
                Plugins {ok}
                </blockquote>
                </div>';
            }

            unset($GLOBALS['__english_moz'], $GLOBALS[$locale]);
        }

        if ($titleDone) {
            echo '<h3>DONE</h3>';
            echo $doneFiles;
        }

        if ($titleTodo) {
            echo '<h3>TODO</h3>';
            echo $todoFiles;
        }

        echo '</div>';
    }
}

// The locale is not correct
if (!$localeok) {
    echo "this locale code is not supported on our sites";
}
