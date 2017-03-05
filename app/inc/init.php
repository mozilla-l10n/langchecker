<?php
namespace Langchecker;

use Json\Json;

date_default_timezone_set('Europe/Paris');

// Server shortcuts
$root_folder = realpath(__DIR__ . '/../../') . '/';
$app_folder = $root_folder . 'app/';
$conf_folder = $app_folder . 'config/';
$controllers_folder = $app_folder . 'controllers/';
$libs_folder = $app_folder . 'libs/';
$templates_folder = $app_folder . 'templates/';
$views_folder = $app_folder . 'views/';

// Autoloading of composer dependencies
require_once $root_folder . 'vendor/autoload.php';

// Import settings and check mandatory parameters
$settings_file = "{$conf_folder}/settings.inc.php";
if (! file_exists($settings_file)) {
    die('File app/config/settings.inc.php is missing. Please check your configuration.');
} else {
    require $settings_file;
    if (! isset($local_storage)) {
        die('$local_storage is missing in your configuration file. Please update app/config/settings.inc.php');
    }
}

// URL used to include web assets
if (! isset($webroot_folder)) {
    die('$webroot_folder setting is missing from app/config/settings.inc.php. Please update your settings file.');
} else {
    $assets_folder = $webroot_folder . 'assets';
}

// URL to import iOS/Android/Stores locales
if (! defined('STORES_L10N')) {
    die('STORES_L10N constant is missing from app/config/settings.inc.php. Please update your settings file.');
}

// Cache class
if (! defined('CACHE_ENABLED')) {
    // Allow disabling cache via config
    define('CACHE_ENABLED', true);
}
define('CACHE_PATH', $root_folder . 'cache/');
define('CACHE_TIME', 7200);

// Re-usable JSON object
$json_object = new Json;

// App-wide variables
require $conf_folder . 'locales.inc.php';
require $conf_folder . 'store_locales.inc.php';
require $conf_folder . 'sources.inc.php';
require $conf_folder . 'websites.inc.php';

// Override sources for functional tests both locally and on Travis
if (getenv('AUTOMATED_TESTS')) {
    require $root_folder . 'tests/testfiles/config/sources.php';
}

// User provided variables
$action = Utils::getQueryParam('action');
$filename = Utils::getQueryParam('file');
$json = Utils::getQueryParam('json', false);   // Do we want json data for the webdashboard?
$locale = Utils::getQueryParam('locale');        // Which locale are we analysing? No default
$project = Utils::getQueryParam('project');
$serial = Utils::getQueryParam('serial', false); // Do we want serialize data for the webdashboard?
$website = Utils::getQueryParam('website');       // Which website are we looking at?
