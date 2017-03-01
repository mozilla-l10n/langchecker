<?php
namespace Langchecker;

$displayed_sites = [];
if ($website != '') {
    if (isset($sites[$website])) {
        $displayed_sites[$website] = $sites[$website];
    } else {
        die($json_object->outputError("ERROR: the requested website ({$website}) is not supported."));
    }
} else {
    $displayed_sites = $sites;
}

$export_data = [];
foreach ($displayed_sites as $site_index => $current_website) {
    $website_name = Project::getWebsiteName($current_website);
    $website_data_source = Project::getWebsiteDataType($current_website);

    foreach (Project::getWebsiteFiles($current_website) as $current_filename) {
        $displayed_filename = ($website_data_source == 'lang')
            ? $current_filename
            : basename($current_filename);

        if ($website_data_source == 'lang') {
            $reference_locale = Project::getReferenceLocale($current_website);
            $reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

            $get_words = function ($item) {
                return str_word_count(strip_tags($item));
            };
            $nb_words = array_sum(array_map($get_words, $reference_data['strings']));
            $nb_strings = count($reference_data['strings']);

            $export_data[$website_name][$displayed_filename] = [
                'obsolete'          => Project::isObsoleteFile($current_website, $current_filename, 'all'),
                'source_type'       => $website_data_source,
                'supported_locales' => Project::getSupportedLocales($current_website, $current_filename),
                'strings_count'     => $nb_strings,
                'url'               => Project::getLocalizedURL($reference_data, ''),
                'words_count'       => $nb_words,
            ];
        } else {
            $export_data[$website_name][$displayed_filename] = [
                'obsolete'          => Project::isObsoleteFile($current_website, $current_filename, 'all'),
                'source_type'       => $website_data_source,
                'supported_locales' => Project::getSupportedLocales($current_website, $current_filename),
                'strings_count'     => '',
                'url'               => '-',
                'words_count'       => '',
            ];
        }
    }
}

die($json_object->outputContent($export_data, false, false));
