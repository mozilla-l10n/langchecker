<?php
namespace Langchecker;

/* server shortcuts */
$aproot    = __DIR__ . '/../';
$libs      = $aproot . 'libs/';
$conf      = $aproot . 'config/';
$views     = $aproot . 'views/';
$templates = $aproot . 'templates/';

/* utility functions */
require_once $libs . 'functions.inc.php';

/* autoloading of composer dependencies */
require_once $aproot . 'vendor/autoload.php';

/* app-wide variables */
require $conf . 'locales.inc.php';
require $conf . 'sources.inc.php';

/* user provided variables */
$filename = isset($_GET['file'])    ? secureText($_GET['file'])    : '';
$locale   = isset($_GET['locale'])  ? secureText($_GET['locale'])  : ''; // which locale are we analysing? No default
$website  = isset($_GET['website']) ? secureText($_GET['website']) : ''; // which website are we looking at?
$action   = isset($_GET['action'])  ? secureText($_GET['action'])  : '';
$serial   = isset($_GET['serial']);  // Do we want serialize data for the webdashboard?
$json     = isset($_GET['json']);  // Do we want json data for the webdashboard?
