<?php

if (php_sapi_name() != 'cli') {
    die('This command can only be used in CLI mode.');
}

if (isset($argv[1])) {
    if (in_array($argv[1], ['-h', '--help']) && isset($command_help)) {
        die($command_help);
    }
}

if (isset($min_parameters)) {
    if (count($argv) < $min_parameters+1) {
        die($missing_parameter);
    }
}

date_default_timezone_set('Europe/Paris');

require_once __DIR__ . '/init.php';
