<?php
namespace Langchecker;

include __DIR__ . '/../config/adu.inc.php';

if (! isset($_GET['locales'])) {
    die('ERROR: missing list of locales.');
}
$locales = $_GET['locales'];

if (! is_array($locales)) {
    die('ERROR: locales is not an array.');
}

echo Project::getUserBaseCoverage($locales, $adu);
