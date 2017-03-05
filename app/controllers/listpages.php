<?php
namespace Langchecker;

$displayed_sites = [];
if ($website != '' && isset($sites[$website])) {
    $displayed_sites[$website] = $sites[$website];
} else {
    $displayed_sites = $sites;
}

$files_list = [];
foreach ($displayed_sites as $site_index => $current_website) {
    $website_name = Project::getWebsiteName($current_website);
    $website_data_source = Project::getWebsiteDataType($current_website);

    // Totals to display in the table footer
    $total_strings = $total_words = $total_files = 0;
    $files_website = [];
    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        $reference_locale = Project::getReferenceLocale($current_website);
        $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

        $get_words = function ($item) {
            return str_word_count(strip_tags($item));
        };

        $nb_words = array_sum(array_map($get_words, $reference_data['strings']));
        $nb_strings = count($reference_data['strings']);
        $total_strings += $nb_strings;
        $total_words += $nb_words;
        $total_files++;

        // Check if the file is obsolete for all locales
        $obsolete_file = Project::isObsoleteFile($current_website, $current_filename, 'all')
            ? true
            : false;

        $displayed_filename = ($website_data_source == 'lang')
            ? $current_filename
            : basename($current_filename);

        $files_website[$current_filename] = [
            'displayed_filename' => $displayed_filename,
            'obsolete'           => $obsolete_file,
            'page_url'           => Project::getLocalizedURL($reference_data, ''),
            'priority'           => Project::getFilePriority($current_website, $current_filename, 'all'),
            'strings_count'      => $nb_strings,
            'words_count'        => $nb_words,
        ];
    }

    $files_list[$website_name] = [
        'files_website' => $files_website,
        'site_index'    => $site_index,
        'source_type'   => $website_data_source,
        'total_files'   => $total_files,
        'total_strings' => $total_strings,
        'total_words'   => $total_words,
    ];
}

print $twig->render(
    'listpages.twig',
    [
        'files_list' => $files_list,
    ]
);
