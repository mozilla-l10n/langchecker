<?php

require_once __DIR__ . '/inc/init.php';

$case = 0;

if ($locale == '' && $action == '') {
    /* case 1: no locale is requested, we display links to all locales */
    $case = 1;
} elseif ($locale == '' && $action == 'errors') {
    /* case 2: no locale is requested, we display errors for all locales */
    $case = 2;
} elseif ($locale == '' && $action == 'activation') {
    /* case 3: no locale is requested, we display a list of pages completely translated but not activated */
    $case = 3;
} elseif ($locale != '' && $website == '' && $serial == false) {
    /* case 4: we have a locale but no website is defined, we display the status page for the locale */
    $case = 4;
} elseif ($website != '' && array_key_exists($website, $sites) && $serial == false && $action == '') {
    /* case 5: we have a website defined and just want to see the global status for lang files on this website */
    $case = 5;
} elseif ($locale != '' && $website == '' && $serial == true) {
    /* case 6: data fetched externally */
    $case = 6;
} elseif ($locale == ''  && $serial == false && $action == 'count') {
    /* case 7: list all locales and give the number of untranslated strings for all of them */
    $case = 7;
} elseif ($locale == ''  && $serial == false && $action == 'translate') {
    /* case 8: list all translations of a string for snippets */
    $case = 8;
}

if ($action == 'api') {
    $case = 9;
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
        $view     = $views . 'activation.inc.php';
        break;
    case 4:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listsitesforlocale.inc.php';
        break;
    case 5:
        if (!isset($_GET['json'])) {
            $template = $templates . 'template.inc.php';
            $view     = $views . 'globalstatus.inc.php';
        } else {
            $template= $views . 'globalstatus.inc.php';
        }
        break;
    case 6:
        // export mode for webdashboard
        $template = $views . 'export.inc.php';
        break;
    case 7:
        if (!isset($_GET['json'])) {
            $template = $templates . 'template.inc.php';
            $view     = $views . 'countstrings.inc.php';
        } else {
            $template= $views . 'countstrings.inc.php';
        }
        break;
    case 8:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'translatestrings.inc.php';
        break;
    case 9:
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
