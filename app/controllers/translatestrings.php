<?php
namespace Langchecker;

$store_by_string = true;
$show_status = isset($_GET['show']) ? 'auto' : 'none';
require_once $controllers_folder . 'loadtranslations.php';

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
