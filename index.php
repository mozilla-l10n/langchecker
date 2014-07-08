<?php
namespace Langchecker;

require_once __DIR__ . '/inc/init.php';

$request_params = [
    'action'   => $action,
    'filename' => $filename,
    'json'     => $json,
    'locale'   => $locale,
    'serial'   => $serial,
    'website'  => $website,
];

$view_selection = Project::selectView($request_params);

if ($view_selection['template'] !== '') {
    // I need to use a template
    $template = $templates . $view_selection['template'] . '.inc.php';
    $view = $views . $view_selection['file'] . '.inc.php';
} else {
    // No template (JSON output)
    $template = $views . $view_selection['file'] . '.inc.php';
}

$viewname = $view_selection['file'];

ob_start();

include $template;
