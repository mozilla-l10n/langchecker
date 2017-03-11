<?php
require __DIR__ . '/../../vendor/autoload.php';

date_default_timezone_set('Europe/Paris');

// Path to test files
define('TEST_FILES', __DIR__ . '/../testfiles/');

// Set an environment variable so that the instance will use content from test files
putenv('AUTOMATED_TESTS=true');
