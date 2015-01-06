<?php
namespace Langchecker;

use \Bugzilla\Bugzilla;

?>
<p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/?locale=<?=$locale?>">Back to Web Dashboard</a></p>
<h1>Lang format file checker <span><?=$locale?></span></h1>

<?php

$supported_locale = false;
$current_locale = $locale;
$html_output = '';
$bugwebsite = 'www.mozilla.org';

$bugzilla_locale_name = urlencode(Bugzilla::getBugzillaLocaleField($current_locale, 'www'));

foreach (Project::getWebsitesByDataType($sites, 'lang') as $current_website) {
    $reference_locale = Project::getReferenceLocale($current_website);
    $repo = Project::getPublicRepoPath($current_website, $current_locale);
    $website_name = Project::getWebsiteName($current_website);

    if (! Project::isSupportedLocale($current_website, $current_locale)) {
        // Locale is not supported for this website, move to the next
        continue;
    }

    $html_output .= "\n<div class='website_container'>\n";
    $html_output .= "  <h2 id='{$website_name}'><a href='#{$website_name}'>{$website_name}</a><span class='datasource'>lang</span></h2>\n";
    $html_output .= "  <p>Repository: <a href='{$repo}'>{$repo}</a></p>\n";

    $done_files = '';
    $todo_files = '';

    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename, $langfiles_subsets)) {
            // File is not managed for this website+locale, ignore it
            continue;
        }
        if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
            // If the .lang file does not exist, just skip the locale for this file
            continue;
        }

        $supported_locale = true;

        if ($locale == 'fa') {
            $qa_contact = 'persian.fa@localization.bugs';
        } else {
            $qa_contact = 'pascalc@gmail.com';
        }

        $bugzilla_link = 'https://bugzilla.mozilla.org/enter_bug.cgi?alias=&assigned_to=pascalc%40gmail.com'
                       . '&blocked=&bug_file_loc=http%3A%2F%2F&bug_severity=normal&bug_status=NEW'
                       . '&comment=%28Attach%20your%20updated%20' . $current_filename . '%20file%20to%20'
                       . 'this%20bug%20or%20indicate%20the%20revision%20number%20of%20your%20commit%20in'
                       . '%20SVN%29&component=L10N&contenttypeentry=&contenttypemethod=autodetect'
                       . '&contenttypeselection=text%2Fplain&data=&dependson=&description=&flag_type-4=X'
                       . '&flag_type-418=X&flag_type-419=X&flag_type-506=X&flag_type-507=X&form_name=enter_bug'
                       . '&keywords=&maketemplate=Remember%20values%20as%20bookmarkable%20template&op_sys='
                       . 'All&priority=--&product=' . $bugwebsite . '&qa_contact=' . $qa_contact
                       . '&rep_platform=All&short_desc=%5Bl10n%3A ' . $current_locale . '%5D%20updated%20'
                       .  $current_filename . '%20file%20for%20' . $website_name .'&target_milestone=---&version=unspecified'
                       . '&format=__default__&cf_locale=' . $bugzilla_locale_name;

        // Load reference strings
        $reference_filename = Project::getLocalFilePath($current_website, $reference_locale, $current_filename);
        $reference_url = Project::getPublicFilePath($current_website, $reference_locale, $current_filename);
        $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);
        // Extract data from locale
        $locale_filename = Project::getLocalFilePath($current_website, $current_locale, $current_filename);
        $locale_url = Project::getPublicFilePath($current_website, $current_locale, $current_filename);
        $locale_analysis = LangManager::analyzeLangFile($current_website, $current_locale, $current_filename, $reference_data);

        if (! in_array($current_filename, $no_active_tag) &&
            $website_name == 'www.mozilla.org') {
            $status = $locale_analysis['activated'] ? ' file_activated' : ' file_notactivated';
        } else {
            $status = ' file_activated';
        }

        // check if the lang file is in utf8
        if (Utils::isUTF8($locale_filename) == false) {
            $status .= ' file_notutf8';
        }

        $count_identical = count($locale_analysis['Identical']);
        $count_missing = count($locale_analysis['Missing']);
        $count_errors = LangManager::countErrors($locale_analysis['errors']);

        if ($count_identical + $count_missing + $count_errors == 0) {
            // File is complete
            $done_files .= "  <a href='#{$current_filename}' class='file_done{$status}'>{$current_filename}</a>\n";
        } else {
            $todo_files .= "  <div class='file_container' id='{$current_filename}'>\n" .
                           "    <h3 class='filename'><a href='#{$current_filename}'>{$current_filename}</a></h3>\n" .
                           "    <table class='sidetable'>\n" .
                           "      <thead>\n" .
                           "        <tr>\n" .
                           "          <th>Identical</th>\n" .
                           "          <th>Trans.</th>\n" .
                           "          <th>Missing</th>\n" .
                           "          <th>Errors</th>\n" .
                           "        </tr>\n" .
                           "      </thead>\n" .
                           "      <tbody>\n" .
                           "        <tr>\n" .
                           "          <td>{$count_identical}</td>" .
                           "          <td>" . count($locale_analysis['Translated']) . "</td>" .
                           "          <td>{$count_missing}</td>" .
                           "          <td>{$count_errors}</td>" .
                           "        </tr>\n" .
                           "        <tr>\n" .
                           "          <td colspan='4'>\n" .
                           "            <a href='{$reference_url}'>Original English source file</a>\n" .
                           "          </td>\n" .
                           "        </tr>\n" .
                           "        <tr>\n" .
                           "          <td colspan='4'>\n" .
                           "            <a href='{$locale_url}'>Your translated file</a>\n" .
                           "          </td>\n" .
                           "        </tr>\n" .
                           "        <tr>\n" .
                           "          <td colspan='4'>\n" .
                           "            <a href='{$bugzilla_link}'>Attach your updated file to Bugzilla</a>\n" .
                           "          </td>\n" .
                           "        </tr>\n" .
                           "      </tbody>\n" .
                           "    </table>\n";

            if ($count_identical > 0) {
                $todo_files .= "\n    <h3>Strings identical to English:</h3>\n";
                $todo_files .= "    <ul>\n";
                foreach ($locale_analysis['Identical'] as $identical_string) {
                    $todo_files .= "      <li>" . htmlspecialchars(Utils::cleanString($identical_string)) . "</li>\n";
                }
                $todo_files .= "    </ul>\n";
            }

            if ($count_missing > 0) {
                $todo_files .= "\n    <h3>Missing strings:</h3>\n";
                $todo_files .= "    <ul>\n";
                foreach ($locale_analysis['Missing'] as $missing_string) {
                    $todo_files .= "      <li>" . htmlspecialchars(Utils::cleanString($missing_string)) . "</li>\n";
                }
                $todo_files .= "    </ul>\n";
            }

            if (LangManager::countErrors($locale_analysis['errors'])) {
                    if (LangManager::countErrors($locale_analysis['errors'], 'python')) {
                        $todo_files .= "\n    <h3>Errors in variables in the sentence:</h3>\n";
                        $todo_files .= "    <ul>\n";
                        foreach ($locale_analysis['errors']['python'] as $stringid => $python_error) {
                            $todo_files .= "              <table class='python'>
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
                        $todo_files .= "    </ul>\n";
                    }

                    if (LangManager::countErrors($locale_analysis['errors'], 'length')) {
                        $todo_files .= "\n    <h3>Some strings are longer than allowed:</h3>\n";
                        $todo_files .= "    <ul>\n";
                        foreach ($locale_analysis['errors']['length'] as $stringid => $length_error) {
                            $todo_files .= "<li>" . htmlspecialchars($length_error['text']) . "<br/><em>Currently {$length_error['current']} characters long (maximum allowed {$length_error['limit']})</em></li>";
                            }
                        $todo_files .= "    </ul>\n";
                    }
            }
            $todo_files .= "  </div>\n";

            if (count($locale_analysis['Identical']) > 0) {
                $todo_files .= "  <div class='tip'>\n" .
                               "    <p><strong>Tip:</strong> if it is normal that a string is identical\n" .
                               "     to the English one for your language, just add <code>{ok}</code>\n" .
                               "     to your string and it will no longer be listed as \"identical\"\n" .
                               "     Example: </p><blockquote>;Plugins<br/>Plugins {ok}</blockquote>\n" .
                               "  </div>\n";
            }
        }
    }

    if ($done_files != '') {
        $html_output .= "\n  <h3>DONE</h3>\n  <p>{$done_files}  </p>\n";
    }

    if ($todo_files != '') {
        $html_output .= "\n  <h3>TODO</h3>\n{$todo_files}\n";
    }

    $html_output .= "</div>\n";
}

foreach (Project::getWebsitesByDataType($sites, 'raw') as $current_website) {
    $repo = Project::getPublicRepoPath($current_website, $current_locale);
    $website_name = Project::getWebsiteName($current_website);

    if (! Project::isSupportedLocale($current_website, $current_locale)) {
        // Locale is not supported for this website, move to the next
        continue;
    }

    $html_output .= "\n<div class='website_container'>\n";
    $html_output .= "  <h2 id='{$website_name}'><a href='#{$website_name}'>{$website_name}</a><span class='datasource'>raw</span></h2>\n";
    $html_output .= "  <p>Repository: <a href='{$repo}'>{$repo}</a></p>\n";

    $html_rows = '';
    $done_files = '';
    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        if (! Project::isSupportedLocale($current_website, $current_locale, $current_filename, $langfiles_subsets)) {
            // File is not managed for this website+locale, ignore it
            continue;
        }

        $file_analysis = RawManager::compareRawFiles($current_website, $current_locale, $current_filename);
        $cmp_result = $file_analysis['cmp_result'];

        if ($cmp_result == 'ok') {
            // File is translated, store it for later and move on to the next file
            $done_files .=   "<a class='file_done activated'>" . basename($current_filename) . "</a>\n";
            continue;
        }

        if (in_array('optional', Project::getFileFlags($current_website, $current_filename, $current_locale)) &&
            $cmp_result != 'untranslated' && $cmp_result != 'outdated') {
            // If a file is optional, it can be deleted from locale repository without generating errors
            // But if it's outdated or untranslated, we display it
            continue;
        }

        if ($file_analysis['reference_exists']) {
            $reference_link = "<a href='{$file_analysis['reference_url']}'>Reference file</a> " .
                              "<span class='last_update' title='last update'>(" .
                              date ("Y-m-d H:i", $file_analysis['reference_lastupdate']) . ")</span>";
        } else {
            $reference_link = "-";
        }
        if ($file_analysis['locale_exists']) {
            $locale_link = "<a href='{$file_analysis['locale_url']}'>Locale file</a> " .
                           "<span class='last_update' title='last update'>(" .
                           date ("Y-m-d H:i", $file_analysis['locale_lastupdate']) . ")</span>";
        } else {
            $locale_link = "-";
        }

        $html_rows .= "  <tr>\n" .
                        "    <td class='maincolumn'>" . basename($current_filename) . "</td>\n" .
                        "    <td><span class='rawstatus {$cmp_result}'>" . str_replace('_', ' ', $cmp_result) . "</span></td>\n" .
                        "    <td>{$reference_link}</td>\n" .
                        "    <td>{$locale_link}</td>\n" .
                        "  </tr>\n";
    }

    if ($done_files != '') {
        // We have complete files
        $html_output .= "<h3>DONE</h3>\n{$done_files}\n<p>";
    }

    if ($html_rows != '') {
        $html_output .= "  <p>Note: for 'raw' files – like text files – we can only rely on update dates. Warnings or errors for <em>optional</em> files are not displayed.<br>" .
                        "  </p>\n" .
                        "<table class='rawfiles'>\n" .
                        "  <tr>\n" .
                        "    <th>Filename</th>\n" .
                        "    <th>Status</th>\n" .
                        "    <th>Reference file</th>\n" .
                        "    <th>Locale file</th>\n" .
                        "  </tr>\n" .
                        $html_rows .
                        "</table>\n</div>";
    }
}

if (! $supported_locale) {
    $html_output = "<p>This locale code is not supported on our sites.</p>\n";
}

echo $html_output;
