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
$get_param = function($param, $fallback = '') {
    if (isset($_GET[$param])) {
        return is_bool($fallback)
               ? true
               : Utils::secureText($_GET[$param]);
    }

    return $fallback;
};

// User provided variables
$action   = $get_param('action');
$filename = $get_param('file');
$json     = $get_param('json', false);   // Do we want json data for the webdashboard?
$locale   = $get_param('locale');        // Which locale are we analysing? No default
$project  = $get_param('project');
$serial   = $get_param('serial', false); // Do we want serialize data for the webdashboard?
$website  = $get_param('website');       // Which website are we looking at?
