<?php
namespace Langchecker;

// $filename is set in /inc/init.php
$current_filename = $filename != '' ? $filename : 'snippets.lang';

$supported_file = false;
// Search which website has the requested file
foreach (Project::getWebsitesByDataType($sites, 'lang') as $site) {
    if (in_array($current_filename, Project::getWebsiteFiles($site))) {
        $current_website = $site;
        $supported_file = true;
        break;
    }
}

if (! $supported_file) {
    $error_message = "ERROR: file {$filename} does not exist";
    if ($json) {
        die($json_object->outputError($error_message));
    } else {
        Project::displayErrorTemplate($twig, $error_message);
    }
}

$reference_locale = Project::getReferenceLocale($current_website);
$reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

$all_locale_data = [];
$supported_locales = Project::getSupportedLocales($current_website, $current_filename);

foreach ($supported_locales as $current_locale) {
    if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
        // If the .lang file does not exist, just skip the locale for this file
        continue;
    }
    $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);

    foreach ($reference_data['strings'] as $string_id => $string_value) {
        if (LangManager::isStringLocalized($string_id, $locale_data, $reference_data)) {
            $all_locale_data[$current_locale][$string_id] = Utils::cleanString($locale_data['strings'][$string_id]);
        }
    }
}

$locale_list = [];
foreach ($all_locale_data as $current_locale => $available_strings) {

    $body_strings = $email_metadata = $callout_box = [];
    foreach ($available_strings as $string_id => $translation) {
        if (isset($reference_data['tag_bindings'][$string_id])) {
            $current_tag = $reference_data['tag_bindings'][$string_id];
        } else {
            $current_tag = '';
        }

        $string_data = [
            'string_id'   => $string_id,
            'translation' => $translation,
            'tag'         => $current_tag,
        ];
        if (in_array($current_tag, ['subject_line', 'preheader', 'metadata'])) {
            $email_metadata[] = $string_data;
        } else if (in_array($current_tag, ['callout_text', 'callout_button'])) {
            $callout_box[] = $string_data;
        } else {
            $body_strings[] = $string_data;
        }
    }

    $locale_list[] = [
        'locale'         => $current_locale,
        'body_strings'   => $body_strings,
        'callout_box'    => $callout_box,
        'email_metadata' => $email_metadata
    ];
}

print $twig->render(
    'reviewstrings.twig',
    [
        'filename'    => $current_filename,
        'locale_list' => $locale_list,
    ]
);
