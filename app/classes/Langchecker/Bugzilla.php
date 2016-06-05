<?php
namespace Langchecker;

use Bugzilla\Bugzilla as _Bugzilla;

/**
 * Bugzilla class
 *
 * This class extends the standard Bugzilla class to add methods specific
 * for Langchecker.
 *
 * @package Langchecker
 */
class Bugzilla extends _Bugzilla
{
    /**
     * Return URL to file a bug on Bugzilla.
     *
     * @param string $locale          Locale code
     * @param string $bugzilla_locale Locale component name on Bugzilla
     * @param string $bug_type        Type of bug to file (opt-in, upload)
     * @param array  $files           Single file name, or array of file
     *                                names
     *
     * @return string URL to file the bug on Bugzilla
     */
    public static function getNewBugLink($locale, $bugzilla_locale, $bug_type, $files)
    {
        if ($bug_type == 'opt-in') {
            // Bug to request optional pages. The bug body will be filed at run-time with JS
            $bug_title = "[l10n: {$locale}] Add opt-in pages to '{$locale}'";
            $bug_body = '';
        } else {
            // Bug to request upload of updated files to GitHub
            $bug_title = "[l10n: {$locale}] Updated file '{$files[0]}' for GitHub repository";
            $bug_body = "(Attach your updated {$files[0]} file to this bug or indicate the changeset of your commit in GitHub)";
        }

        $bug_assignee = urlencode('pmo@mozilla.com');
        $bug_cc = urlencode('francesco.lodolo@gmail.com');
        $bug_link = 'https://bugzilla.mozilla.org/enter_bug.cgi?alias=' .
                    '&assigned_to=' . $bug_assignee . '&cc=' .  $bug_cc .
                    '&blocked=&bug_file_loc=http%3A%2F%2F&bug_severity=normal&bug_status=NEW' .
                    '&component=L10N&contenttypeentry=&contenttypemethod=autodetect' .
                    '&contenttypeselection=text%2Fplain&data=&dependson=&description=&flag_type-4=X' .
                    '&flag_type-418=X&flag_type-419=X&flag_type-506=X&flag_type-507=X&form_name=enter_bug' .
                    '&keywords=&maketemplate=Remember%20values%20as%20bookmarkable%20template&op_sys=All' .
                    '&priority=--&product=www.mozilla.org' .
                    '&rep_platform=All&short_desc=' . urlencode($bug_title) .
                    '&target_milestone=---&version=Development%2FStaging' .
                    '&format=__default__&cf_locale=' . $bugzilla_locale .
                    '&comment=' . urlencode($bug_body);

        return $bug_link;
    }
}
