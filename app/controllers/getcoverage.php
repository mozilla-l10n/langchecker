<?php
namespace Langchecker;

if (! isset($_GET['locales'])) {
    die($json_object->outputError('ERROR: missing list of locales.'));
}
$locales = $_GET['locales'];

if (! is_array($locales)) {
    die($json_object->outputError('ERROR: locales is not an array.'));
}

echo Project::getUserBaseCoverage($locales, $adu);
