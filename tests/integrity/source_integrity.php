<?php
use \pchevrel\Verif as Verif;

define('INSTALL_ROOT',  realpath(__DIR__ . '/../../') . '/');

// We always work with UTF8 encoding
mb_internal_encoding('UTF-8');

// Make sure we have a timezone set
date_default_timezone_set('Europe/Paris');

require __DIR__ . '/../../vendor/autoload.php';

// We want to analyze the real configuration file
require INSTALL_ROOT . 'app/inc/init.php';

$errors = [];

// Check websites
$supported_files = [];
$supported_locales = array_merge($mozilla, ['en-US']);
$supported_websites = [];
foreach ($sites as $website_id => $website_data) {
    $website_name = $website_data[0];
    $supported_websites[] = $website_name;

    // Check supported locales
    if (empty($website_data[3])) {
        $errors[] = "Website with ID {$website_id} ({$website_name}) doesn't support any locale.";
    } else {
        $unknown_locales = array_diff($website_data[3], $supported_locales);
        if (! empty($unknown_locales)) {
            $errors[] = "Website with ID {$website_id} ({$website_name}) supports unknown locales: " . implode(', ', $unknown_locales) . '.';
        }
    }

    // Check reference locale
    $reference_locale = $website_data[5];
    if ($reference_locale == '') {
        $errors[] = "Website with ID {$website_id} ({$website_name}) doesn't have a reference locale.";
    } else {
        if (! in_array($reference_locale, $supported_locales)) {
            $errors[] = "Website with ID {$website_id} ({$website_name}) has an unknown reference locale ({$reference_locale})";
        }
    }

    // Check if there are supported files
    $website_files = array_keys($website_data[4]);
    if (empty($website_files)) {
        $errors[] = "Website with ID {$website_id} ({$website_name}) doesn't include any file.";
    } else {
        $supported_files = array_merge($supported_files, $website_files);
        // Check files data
        foreach ($website_data[4] as $filename => $file_data) {
            // Check if the deadline date is valid
            if (isset($file_data['deadline'])) {
                $date = DateTime::createFromFormat('Y-m-d', $file_data['deadline']);
                if (! $date || $date->format('Y-m-d') != $file_data['deadline']) {
                    $errors[] = "Deadline date {$file_data['deadline']} for {$filename} is incorrect.";
                };
            }

            // Check if supported locales are known
            if (isset($file_data['supported_locales'])) {
                $unknown_locales = array_diff($file_data['supported_locales'], $website_data[3]);
                if (! empty($unknown_locales)) {
                    $errors[] = "File {$filename} for website {$website_name} supports unknown locales: " . implode(', ', $unknown_locales) . '.';
                }
            }
        }

        // Check website's type
        if (! in_array($website_data[8], ['lang', 'raw'])) {
            $errors[] = "Website with ID {$website_id} ({$website_name}) has an unknown or empty type ('{$website_data[8]}').";
        }
    }
}

// Check $no_active_tag
foreach ($no_active_tag as $filename) {
    if (! in_array($filename, $supported_files)) {
        $errors[] = "Unknown file in array \$no_active_tag: {$filename}";
    }
}

if (! empty($errors)) {
    echo Verif::colorizeOutput('Detected errors during source integrity checks: ' . count($errors) . "\n", 'red');
    echo implode("\n", $errors);
    echo "\n";
    exit(1);
} else {
    echo Verif::colorizeOutput("All sources look OK.\n", 'green');
}
