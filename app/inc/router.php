<?php
namespace Langchecker;

require_once __DIR__ . '/init.php';

$request_params = [
    'action'   => $action,
    'filename' => $filename,
    'json'     => $json,
    'locale'   => $locale,
    'serial'   => $serial,
    'website'  => $website,
];

$view_selection = Project::selectView($request_params);

// Initialize and set-up Twig template
require_once __DIR__ . '/twig_init.php';

include $controllers_folder . $view_selection['file'] . '.php';
