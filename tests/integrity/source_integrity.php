<?php
use pchevrel\Verif as Verif;

define('INSTALL_ROOT', realpath(__DIR__ . '/../../') . '/');

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
                $deadline = $file_data['deadline'];

                if (gettype($deadline) == 'string') {
                    // Single deadline
                    $date = DateTime::createFromFormat('Y-m-d', $deadline);
                    if (! $date || $date->format('Y-m-d') != $deadline) {
                        $errors[] = "Deadline date {$deadline} for {$filename} is incorrect.";
                    }
                } elseif (is_array($deadline)) {
                    // Multiple deadlines
                    foreach ($deadline as $key => $value) {
                        if (gettype($key) == 'string') {
                            $date = DateTime::createFromFormat('Y-m-d', $key);
                            if (! $date || $date->format('Y-m-d') != $key) {
                                $errors[] = "Deadline date {$key} for {$filename} is incorrect.";
                            }
                        } else {
                            $errors[] = "Deadline {$key} for {$filename} is of the wrong type (" . gettype($key) . '). It should be a string.';
                        }

                        if (! is_array($value)) {
                            $errors[] = "Deadline {$key} for {$filename} should be assigned to an array of locales.";
                        }
                    }
                } else {
                    // Wrong type
                    $errors[] = "Deadline {$deadline} for {$filename} is of the wrong type (" . gettype($priority) . '). It should be a string.';
                }
            }

            // Check priorities
            if (isset($file_data['priority'])) {
                $priority = $file_data['priority'];
                $min_priority = 1;
                $max_priority = 5;
                if (gettype($priority) == 'integer') {
                    // Single priority
                    if ($priority < $min_priority || $priority > $max_priority) {
                        $errors[] = "Priority {$priority} for {$filename} is incorrect. It should be an integer between {$min_priority} and {$max_priority}.";
                    }
                } elseif (is_array($priority)) {
                    // Multiple priorities
                    foreach ($priority as $key => $value) {
                        if (gettype($key) != 'integer') {
                            $errors[] = "Priority {$key} for {$filename} is of the wrong type (" . gettype($key) . '). It should be an integer between {$min_priority} and {$max_priority}.';
                        } else {
                            if ($key < $min_priority || $key > $max_priority) {
                                $errors[] = "Priority {$key} for {$filename} is incorrect. It should be an integer between {$min_priority} and {$max_priority}.";
                            }
                        }

                        if (! is_array($value)) {
                            $errors[] = "Priority {$key} for {$filename} should be assigned to an array of locales.";
                        }
                    }
                } else {
                    // Wrong type
                    $errors[] = "Priority {$priority} for {$filename} is of the wrong type (" . gettype($priority) . '). It should be an integer between {$min_priority} and {$max_priority}.';
                }
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
