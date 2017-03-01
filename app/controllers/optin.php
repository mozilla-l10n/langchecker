<?php
namespace Langchecker;

// This view works only for mozilla.org (website ID 0)
$current_website = $sites[0];
$current_locale = $locale;

if (! Project::isSupportedLocale($current_website, $current_locale)) {
    Project::displayErrorTemplate($twig, 'This locale is not supported on mozilla.org');
}

// Create a list of opt-in pages
$optin_pages = [];
foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
    if (in_array('opt-in', Project::getFileFlags($current_website, $current_filename, $current_locale))) {
        $optin_pages[$current_filename] = Project::getSupportedLocales($current_website, $current_filename);
    }
}

$bugzilla_locale = urlencode(Bugzilla::getBugzillaLocaleField($current_locale, 'www'));
$available_optins = [];
$files_list = [];
foreach ($optin_pages as $current_filename => $supported_locales) {
    $reference_locale = Project::getReferenceLocale($current_website);
    $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

    $get_words = function ($item) {
        return str_word_count(strip_tags($item));
    };
    $nb_words = array_sum(array_map($get_words, $reference_data['strings']));
    $nb_strings = count($reference_data['strings']);

    $locale_included = in_array($current_locale, $supported_locales);
    if (! $locale_included) {
        $available_optins[] = $current_filename;
    }

    $deadline = Project::getFileDeadline($current_website, $current_filename);
    $files_list[$current_filename] = [
        'opted_in' => $locale_included,
        'deadline' => $deadline != '' ? $deadline : '-',
        'page_url' => Project::getLocalizedURL($reference_data, $current_locale),
        'status'   => $locale_included ? 'yes' : 'no',
        'strings'  => $nb_strings,
        'words'    => $nb_words,
    ];
}

if (! empty($available_optins)) {
    $optin_url = Bugzilla::getNewBugLink($current_locale, $bugzilla_locale, 'opt-in', $available_optins);
} else {
    $optin_url = '';
}

print $twig->render(
    'optin.twig',
    [
        'available_optins' => count($available_optins),
        'locale'           => $current_locale,
        'optin_url'        => $optin_url,
        'files_list'       => $files_list,
    ]
);
