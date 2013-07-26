<?php

require_once __DIR__ . '/inc/init.php';

$case = 0;

if ($locale == '' && $action == '') {
    /* case 1: no locale is requested, we display links to all locales */
    $case = 1;
} elseif ($locale != '' && $website == '' && $serial == false) {
    /* case 2: we have a locale but no website is defined, we display the status page for the locale */
    $case = 2;
} elseif ($website != '' && array_key_exists($website, $sites) && $serial == false && $action == '') {
    /* case 3: we have a website defined and just want to see the global status for lang files on this website */
    $case = 3;
} elseif ($locale != '' && $website == '' && $serial == true) {
    /* case 4: data fetched externally */
    $case = 4;
} elseif ($locale == ''  && $serial == false && $action == 'count') {
    /* case 6: list all locales and give the number of untranslated strings for all of them */
    $case = 5;
} elseif ($locale == ''  && $serial == false && $action == 'translate') {
    /* case 7: list all translations of a string for snippets */
    $case = 6;
}

if ($action == 'api') {
    $case = 7;
}

switch ($case) {
    case 1:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listlocales.inc.php';
        break;
    case 2:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listsitesforlocale.inc.php';
        break;
    case 3:
        if (!isset($_GET['json'])) {
            $template = $templates . 'template.inc.php';
            $view     = $views . 'globalstatus.inc.php';
        } else {
            $template= $views . 'globalstatus.inc.php';
        }
        break;
    case 4:
        // export mode for webdashboard
        $template = $views . 'export.inc.php';
        break;
    case 5:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'countstrings.inc.php';
        break;
    case 6:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'translatestrings.inc.php';
        break;
    case 7:
        $template = $views . 'json.inc.php';
        break;
    default:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listlocales.inc.php';
        break;
}

ob_start();
include $template;
