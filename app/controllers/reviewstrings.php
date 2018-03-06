<?php
namespace Langchecker;

$store_by_string = false;
require_once $controllers_folder . 'loadtranslations.php';

$locale_list = [];
foreach ($all_strings as $current_locale => $available_strings) {
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

        // Split tagged strings in groups
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
        'email_metadata' => $email_metadata,
    ];
}

print $twig->render(
    'reviewstrings.twig',
    [
        'filename'    => $current_filename,
        'locale_list' => $locale_list,
    ]
);
