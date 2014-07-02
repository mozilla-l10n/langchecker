<?php
namespace Langchecker;

// Server shortcuts
$approot   = __DIR__ . '/../';
$libs      = $approot . 'libs/';
$conf      = $approot . 'config/';
$views     = $approot . 'views/';
$templates = $approot . 'templates/';

// Autoloading of composer dependencies
require_once $approot . 'vendor/autoload.php';

// App-wide variables
require $conf . 'locales.inc.php';
require $conf . 'sources.inc.php';

// User provided variables
$filename = isset($_GET['file'])    ? Utils::secureText($_GET['file'])    : '';
$locale   = isset($_GET['locale'])  ? Utils::secureText($_GET['locale'])  : ''; // Which locale are we analysing? No default
$website  = isset($_GET['website']) ? Utils::secureText($_GET['website']) : ''; // Which website are we looking at?
$action   = isset($_GET['action'])  ? Utils::secureText($_GET['action'])  : '';
$serial   = isset($_GET['serial']); // Do we want serialize data for the webdashboard?
$json     = isset($_GET['json']);   // Do we want json data for the webdashboard?
