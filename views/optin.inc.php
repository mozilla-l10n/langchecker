<?php
namespace Langchecker;

use \Bugzilla\Bugzilla;

$html_output = '<p id="back"><a href="http://l10n.mozilla-community.org/webdashboard/">Back to Web Dashboard</a></p>';

// This view works only for mozilla.org (website ID 0)
$current_website = $sites[0];
$current_locale = $locale;

if (! Project::isSupportedLocale($current_website, $current_locale)) {
    exit($html_output . '<p>This locale is not supported on mozilla.org</p>');
}

// Create a list of opt-in pages
$optin_pages = [];
foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
    if (in_array('opt-in', Project::getFileFlags($current_website, $current_filename, $current_locale))) {
        $optin_pages[$current_filename] = Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets);
    }
}

if (count($optin_pages) == 0) {
    exit($html_output . '<p>There are no optional pages available at the moment.</p>');
}

$html_output .= "<h1>List of optional pages for <span>{$current_locale}</span></h1>
  <table class='optinpages'>
    <thead>
      <tr>
        <th>Filename</th>
        <th>Strings</th>
        <th>Words</th>
        <th>Opted-in</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>\n";

$bugzilla_locale_name = urlencode(Bugzilla::getBugzillaLocaleField($current_locale, 'www'));

foreach ($optin_pages as $current_filename => $supported_locales) {
    $reference_locale = Project::getReferenceLocale($current_website);
    $ref_lang_file = LangManager::loadSource($current_website, $reference_locale, $current_filename);

    $get_words = function($item) {
        return str_word_count(strip_tags($item));
    };

    $nb_words = array_sum(array_map($get_words, $ref_lang_file['strings']));
    $nb_strings = count($ref_lang_file['strings']);

    if (in_array($current_locale, $supported_locales)) {
        $status = '<span class=\'yes\'>yes</span>';
        $actions = '-';
    } else {
        $bugzilla_link = 'https://bugzilla.mozilla.org/enter_bug.cgi?alias=&assigned_to=francesco.lodolo%40gmail.com'
                       . '&blocked=&bug_file_loc=http%3A%2F%2F&bug_severity=normal&bug_status=NEW'
                       . '&comment=Please%20add%20%27' . $current_locale . '%27%20to%20the%20list%20of'
                       . '%20supported%20locales%20for%20' . $current_filename .'%20on%20mozilla.org'
                       . '&component=L10N&contenttypeentry=&contenttypemethod=autodetect'
                       . '&contenttypeselection=text%2Fplain&data=&dependson=&description=&flag_type-4=X'
                       . '&flag_type-418=X&flag_type-419=X&flag_type-506=X&flag_type-507=X&form_name=enter_bug'
                       . '&keywords=&maketemplate=Remember%20values%20as%20bookmarkable%20template&op_sys=All'
                       . '&priority=--&product=www.mozilla.org&qa_contact=pascalc%40gmail.com'
                       . '&rep_platform=All&short_desc=%5Bl10n%3A ' . $current_locale . '%5D%20Add%20%27'
                       . $current_locale . '%27%20to%20the%20list%20of%20supported%20locales%20for%20'
                       . $current_filename .'&target_milestone=---&version=Development%2FStaging'
                       . '&format=__default__&cf_locale=' . $bugzilla_locale_name;

        $status = '<span class=\'no\'>no</span> ';
        $actions = "<a href='{$bugzilla_link}' title='File a bug to request this page'>Opt-in</a>";
    }

    $html_output .= "<tr>\n" .
                   "  <td class='optin_filename'>{$current_filename}</td>\n" .
                   "  <td>{$nb_strings}</td>\n" .
                   "  <td>{$nb_words}</td>\n" .
                   "  <td class='optin_status'>{$status}</td>\n" .
                   "  <td class='optin_actions'>{$actions}</td>\n" .
                   "</tr>\n";
}

$html_output .= "</tbody>
  </table>\n";

echo $html_output;
