<?php

/* server shortcuts */
$called    = true;
$aproot    = __DIR__ . '/';
$libs      = $aproot . 'libs/';
$conf      = $aproot . 'config/';
$views     = $aproot . 'views/';
$templates = $aproot . 'templates/';

/* functions needed to manipulate .lang files */
require_once $libs . 'l10n_moz.class.php';
require_once $libs . 'functions.inc.php';

/* app-wide variables */
require $conf . 'sources.inc.php';   // websites definition, needs locales.inc.php

/* user provided variables */
$filename = (isset($_GET['file']))    ? secureText($_GET['file'])    : 'main.lang'; // which file are we comparing? Default to main.lang
$locale   = (isset($_GET['locale']))  ? secureText($_GET['locale'])  : '';          // which locale are we analysing? No default
$website  = (isset($_GET['website'])) ? secureText($_GET['website']) : '';          // which website are we looking at?
$action   = (isset($_GET['action']))  ? secureText($_GET['action'])  : '';          // which website are we looking at?
$serial   = isset($_GET['serial']);                                                 // Do we want serialize data for the webdashboard?
$case     = 0;

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
} elseif ($locale == '' && array_key_exists($website, $sites) && $serial == false && $action == 'cachestatus') {
    /* case 5: list status of cached files for a site */
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
switch($case) {
    case 1:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listlocales.inc.php';
        break;
    case 2:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'listsitesforlocale.inc.php';
        break;
    case 3:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'globalstatus.inc.php';
        break;
    case 4:
        // export mode for webdashboard
        $template = $views . 'export.inc.php';
        break;
    case 5:
        $template = $templates . 'template.inc.php';
        $view     = $views . 'cachestatus.inc.php';
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

ob_start();
include $template;
