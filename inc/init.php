<?php
namespace Langchecker;

date_default_timezone_set('Europe/Paris');

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
$action   = Utils::getQueryParam('action');
$filename = Utils::getQueryParam('file');
$json     = Utils::getQueryParam('json', false);   // Do we want json data for the webdashboard?
$locale   = Utils::getQueryParam('locale');        // Which locale are we analysing? No default
$project  = Utils::getQueryParam('project');
$serial   = Utils::getQueryParam('serial', false); // Do we want serialize data for the webdashboard?
$website  = Utils::getQueryParam('website');       // Which website are we looking at?

// Cache class
define('CACHE_ENABLED', true);
define('CACHE_PATH', __DIR__ . '/../cache/');
define('CACHE_TIME', 7200);
