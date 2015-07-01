<?php
namespace Langchecker;

use Transvision\Json;

if (! isset($_GET['locales'])) {
    die(Json::invalidAPICall('ERROR: missing list of locales.'));
}
$locales = $_GET['locales'];

if (! is_array($locales)) {
    die(Json::invalidAPICall('ERROR: locales is not an array.'));
}

echo Project::getUserBaseCoverage($locales, $adu);
