<?php
namespace Langchecker;

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
        <th>URL</th>
        <th>Strings</th>
        <th>Words</th>
        <th>Opted-in</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>\n";

$bugzilla_locale = urlencode(Bugzilla::getBugzillaLocaleField($current_locale, 'www'));
$available_optins = [];

foreach ($optin_pages as $current_filename => $supported_locales) {
    $reference_locale = Project::getReferenceLocale($current_website);
    $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

    $get_words = function ($item) {
        return str_word_count(strip_tags($item));
    };

    $nb_words = array_sum(array_map($get_words, $reference_data['strings']));
    $nb_strings = count($reference_data['strings']);

    if (in_array($current_locale, $supported_locales)) {
        $status = '<span class=\'yes\'>yes</span>';
        $actions = '-';
    } else {
        $available_optins[] = $current_filename;
        $status = '<span class=\'no\'>no</span> ';
        $actions = '<a href="' . Bugzilla::getNewBugLink($current_locale, $bugzilla_locale, 'opt-in', [$current_filename]) . '"' .
                   ' class="table_small_link" title="File a bug to request this page">Opt-in</a>';
    }

    $html_output .= "<tr>\n" .
                   "  <td class='optin_filename'>{$current_filename}</td>\n" .
                   '  <td>' .  Project::getLocalizedURL($reference_data, $current_locale, 'html') . "</td>\n" .
                   "  <td>{$nb_strings}</td>\n" .
                   "  <td>{$nb_words}</td>\n" .
                   "  <td class='optin_status'>{$status}</td>\n" .
                   "  <td class='optin_actions'>{$actions}</td>\n" .
                   "</tr>\n";
}

$html_output .= "</tbody>
  </table>\n";

if (count($available_optins) > 0) {
    $html_output .= '<p>You can also <a href="' .
                    Bugzilla::getNewBugLink($current_locale, $bugzilla_locale, 'opt-in', $available_optins) .
                    '">file a bug to opt-in for all pages</a> currently unsupported (' .
                    count($available_optins) . ').</p>';
}

echo $html_output;
