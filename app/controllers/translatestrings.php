<?php
namespace Langchecker;

// $filename is set in /inc/init.php
$current_filename = $filename != '' ? $filename : 'snippets.lang';
$show_status = isset($_GET['show']) ? 'auto' : 'none';

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

$all_strings = [];

$supported_locales = Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets);
foreach ($supported_locales as $current_locale) {
    if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
        // If the .lang file does not exist, just skip the locale for this file
        continue;
    }
    $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);

    foreach ($reference_data['strings'] as $string_id => $string_value) {
        if (LangManager::isStringLocalized($string_id, $locale_data, $reference_data)) {
            $all_strings[$string_id][$current_locale] = Utils::cleanString($locale_data['strings'][$string_id]);
        }
    }
}

// If requested output is JSON, we're ready
if ($json) {
    die($json_object->outputContent($all_strings, false, true));
}

// Colors used to display tags
$bg_colors = [
    '#459E09', '#B29EF9', '#2D68BA', '#E39530', '#D6D6D4',
    '#E3309E', '#FF4040', '#F5F562', '#F562C7', '#C0FCF2',
];
$font_colors = [
    '#FFF', '#FFF', '#FFF', '#FFF', '#000',
    '#FFF', '#FFF', '#000', '#FFF', '#000',
];

if (isset($reference_data['tag_bindings'])) {
    $tag_bindings = $reference_data['tag_bindings'];
    // I want keys in $available_tags to be progressive
    $available_tags = array_values(array_unique(array_values($tag_bindings)));
} else {
    $tag_bindings = [];
    $available_tags = [];
}

// Store all tags used in this page
if (! empty($available_tags)) {
    foreach ($available_tags as $tag_number => $tag_text) {
        $template_tags[$tag_text] = [
            'bg_color' => $bg_colors[$tag_number],
            'color'    => $font_colors[$tag_number],
            'text'     => $tag_text,
        ];
    }
} else {
    $template_tags = [];
}

$string_list = [];
foreach ($all_strings as $string_id => $available_translations) {
    if (isset($tag_bindings[$string_id])) {
        $current_tag = $template_tags[$tag_bindings[$string_id]];
    } else {
        $current_tag = '';
    }

    $displayed_rows = 0;
    $translations = [];
    foreach ($available_translations as $current_locale => $translation) {
        $translations[] = [
            'css_class'   => ($displayed_rows & 1) ? 'odd_row' : 'even_row',
            'locale'      => $current_locale,
            'translation' => $translation,
        ];
        $displayed_rows++;
    }

    $covered_locales = array_keys($available_translations);
    $string_list[] = [
        'coverage'     => Project::getUserBaseCoverage($covered_locales, $adu),
        'header'       => $string_id,
        'tag'          => $current_tag,
        'translations' => $translations,
    ];
}

print $twig->render(
    'translatestrings.twig',
    [
        'filename'    => $current_filename,
        'show_status' => $show_status,
        'string_list' => $string_list,
        'tags'        => $template_tags,
    ]
);
