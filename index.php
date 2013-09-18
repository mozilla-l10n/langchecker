<?php

require_once __DIR__ . '/inc/init.php';

$case = 0;

if ($locale == '' && $action == '') {
    /* case 1: no locale is requested, we display links to all locales */
    $case = 1;
} elseif ($locale == '' && $action == 'errors') {
    /* case 2: no locale is requested, we display links to all locales */
    $case = 2;
} elseif ($locale != '' && $website == '' && $serial == false) {
    /* case 3: we have a locale but no website is defined, we display the status page for the locale */
    $case = 3;
} elseif ($website != '' && array_key_exists($website, $sites) && $serial == false && $action == '') {
    /* case 4: we have a website defined and just want to see the global status for lang files on this website */
    $case = 4;
} elseif ($locale != '' && $website == '' && $serial == true) {
    /* case 5: data fetched externally */
    $case = 5;
} elseif ($locale == ''  && $serial == false && $action == 'count') {
    /* case 6: list all locales and give the number of untranslated strings for all of them */
    $case = 6;
} elseif ($locale == ''  && $serial == false && $action == 'translate') {
    /* case 7: list all translations of a string for snippets */
    $case = 7;
}

if ($action == 'api') {
    $case = 8;
}

switch ($case) {
    case 1:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listlocales.inc.php';
        break;
    case 2:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'errors.inc.php';
        break;
    case 3:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listsitesforlocale.inc.php';
        break;
    case 4:
        if (!isset($_GET['json'])) {
            $template = $templates . 'template.inc.php';
            $view     = $views . 'globalstatus.inc.php';
        } else {
            $template= $views . 'globalstatus.inc.php';
        }
        break;
    case 5:
        // export mode for webdashboard
        $template = $views . 'export.inc.php';
        break;
    case 6:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'countstrings.inc.php';
        break;
    case 7:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'translatestrings.inc.php';
        break;
    case 8:
        $template = $views . 'json.inc.php';
        break;
    default:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listlocales.inc.php';
        break;
}

if (isset($view)) {
    // Extract the view name removing path ($views) and extension ('.inc.php')
    $viewname = substr($view, strlen($views), -8);
}

ob_start();
include $template;
