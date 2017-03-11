<?php

$templates = new Twig_Loader_Filesystem(__DIR__ . '/../templates/');
$options = [
    'cache' => false,
    // Enable only for debug (throws exception on missing variables)
    //'strict_variables' => true,
];
$twig = new Twig_Environment($templates, $options);

// Global variables
$twig->addGlobal('assets_folder', $assets_folder);
$twig->addGlobal('view_name', $view_selection['file']);
$twig->addGlobal('webroot_folder', $webroot_folder);

// Functions
$getPluralForm = new Twig_SimpleFunction('getPluralForm', function ($parameter, $text) {
    // Get an English dumb plural form
    $count = is_array($parameter) ? count($parameter) : intval($parameter);
    $output = "{$count} {$text}";
    if ($count != 1) {
        $output .= 's';
    }

    return $output;
});

$getViewLink = new Twig_SimpleFunction('getViewLink', function ($url) {
    $link = $url == '-'
        ? '-'
        : "<a href=\"{$url}\" class=\"table_small_link\">view</a>";

    return $link;
});

$highlightPythonVar = new Twig_SimpleFunction('highlightPythonVar', function ($text) {
    return Langchecker\Utils::highlightPythonVar($text);
});

$perfInformationFunction = new Twig_SimpleFunction('displayPerformanceInformation', function () {
    $time = 'Elapsed time (s): ' . round((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']), 4);
    $memory = 'Memory usage (MB): ' . round(memory_get_peak_usage(true) / (1024 * 1024), 2);

    if (defined('DEBUG') && DEBUG) {
        error_log($time);
        error_log($memory);
    }

    return "\n<!-- {$time} -->\n<!-- {$memory} -->\n";
});

$twig->addFunction($getPluralForm);
$twig->addFunction($getViewLink);
$twig->addFunction($highlightPythonVar);
$twig->addFunction($perfInformationFunction);
