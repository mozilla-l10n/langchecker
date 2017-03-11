<?php
define('INSTALL_ROOT', realpath(__DIR__ . '/../../') . '/');

// We always work with UTF8 encoding
mb_internal_encoding('UTF-8');

// Make sure we have a timezone set
date_default_timezone_set('Europe/Paris');

require __DIR__ . '/../../vendor/autoload.php';

// Set an environment variable so that the instance will use content from test files
putenv('AUTOMATED_TESTS=true');

// Launch PHP dev server in the background
chdir(INSTALL_ROOT);
exec('php -S 0.0.0.0:8083 -t web/> /dev/null 2>&1 & echo $!', $output);

// We will need the pid to kill it, beware, this is the pid of the php server started above
$pid = $output[0];

// Pause to let time for the dev server to launch in the background
sleep(3);

$json = [
    ['?action=count&json', 200, "{\n    \"fr\": 16,\n    \"it\": 6,\n    \"en-US\": 0\n}"],
    ['?action=coverage&locales=foo', 400, "{\n    \"error\": \"ERROR: locales is not an array.\"\n}"],
    ['?action=coverage', 400, "{\n    \"error\": \"ERROR: missing list of locales.\"\n}"],
    ['?action=listlocales&project=slogans&json', 200, "[\n    \"fr\",\n    \"it\"\n]"],
    ['?action=listlocales&project=langchecker&json', 200, "[\n    \"en-US\",\n    \"fr\",\n    \"it\"\n]"],
    ['?action=listlocales&json', 400, "{\n    \"error\": \"ERROR: please check your request: provide a project name, a website, or a website+file.\"\n}"],
    ['?action=listlocales&website=6&json', 200, "[\n    \"en-US\",\n    \"fr\",\n    \"it\"\n]"],
    ['?action=listlocales&website=2&file=page.lang&json', 200, "[\n    \"en-US\",\n    \"it\"\n]"],
    ['?action=listpages&website=2&json', 200, '{"parsing_test":{"page.lang":{"obsolete":false,"source_type":"lang","supported_locales":["en-US","it"],"strings_count":16,"url":"-","words_count":51}}}'],
    ['?action=listpages&website=9999&json', 400, "{\n    \"error\": \"ERROR: the requested website (9999) is not supported.\"\n}"],
    ['?action=snippets&locale=it', 200, "{\n    \"@@this is a test, do not remove@@\": \"Questo \u00e8 un test\",\n    \"Email\": \"Email\",\n    \"Fifth string with %(one)s, %(two)s\": \"Quinta stringa con %(one)s, %(two)s e ancora %(two)s\",\n    \"Fourth string with 90%% coverage\": \"Quarta stringa con copertura al 90%\",\n    \"Hello\": \"Ciao\",\n    \"Obsolete string\": \"Stringa obsoleta\",\n    \"Press center\": \"Sala stampa\",\n    \"Save file\": \"Salva file troppo lungo\",\n    \"Second string with %(num)s tags\": \"Seconda stringa con %(num)s etichette\",\n    \"Sixth string with %(one)s\": \"Sesta stringa con %(one)s e %(two)s\",\n    \"String with %(num)s tags\": \"Stringa con etichette e variabile sbagliata\",\n    \"String with multiple comments\": \"String con pi\u00f9 commenti\",\n    \"Third string with %s tags\": \"Terza stringa con variabile mancante\"\n}"],
    ['?action=translate&file=foo.lang&json', 400, "{\n    \"error\": \"ERROR: file foo.lang does not exist\"\n}"],
    ['?action=translate&file=page.lang&json', 200, "{\n    \"Email\": {\n        \"it\": \"Email\"\n    },\n    \"Hello\": {\n        \"it\": \"Ciao\"\n    },\n    \"Save file\": {\n        \"it\": \"Salva file troppo lungo\"\n    },\n    \"01\": {\n        \"it\": \"1\"\n    },\n    \"String with multiple comments\": {\n        \"it\": \"String con pi\u00f9 commenti\"\n    },\n    \"Press center\": {\n        \"it\": \"Sala stampa\"\n    },\n    \"@@this is a test, do not remove@@\": {\n        \"it\": \"Questo \u00e8 un test\"\n    },\n    \"String with %(num)s tags\": {\n        \"it\": \"Stringa con etichette e variabile sbagliata\"\n    },\n    \"Second string with %(num)s tags\": {\n        \"it\": \"Seconda stringa con %(num)s etichette\"\n    },\n    \"Third string with %s tags\": {\n        \"it\": \"Terza stringa con variabile mancante\"\n    },\n    \"Fourth string with 90%% coverage\": {\n        \"it\": \"Quarta stringa con copertura al 90%\"\n    },\n    \"Fifth string with %(one)s, %(two)s\": {\n        \"it\": \"Quinta stringa con %(one)s, %(two)s e ancora %(two)s\"\n    },\n    \"Sixth string with %(one)s\": {\n        \"it\": \"Sesta stringa con %(one)s e %(two)s\"\n    }\n}"],
    ['?website=2&file=page.lang&json&locale=it', 200, "{\n    \"page.lang\": {\n        \"it\": {\n            \"Errors\": 7,\n            \"Identical\": 2,\n            \"Missing\": 1,\n            \"Obsolete\": 1,\n            \"Translated\": 13,\n            \"tags\": [],\n            \"activated\": true\n        }\n    }\n}"],
    ['?website=2&file=page.lang&json', 200, "{\n    \"page.lang\": {\n        \"it\": {\n            \"Errors\": 7,\n            \"Identical\": 2,\n            \"Missing\": 1,\n            \"Obsolete\": 1,\n            \"Translated\": 13,\n            \"tags\": [],\n            \"activated\": true\n        }\n    }\n}"],
    ['?website=2&file=main.lang&json', 400, "{\n    \"error\": \"File main.lang does not exist. Check the value and try again.\"\n}"],
    ['?website=foo&file=main.lang&json', 400, "{\n    \"error\": \"foo is not a supported website. Check the value and try again.\"\n}"],
];

$number = [
    ['?action=coverage&locales[]=it&locales[]=fr', 200, '1.90'],
    ['?action=coverage&locales[]=fr', 200, '0.32'],
    ['?action=coverage&locales[]=foo', 200, '0.00'],
];

$obj = new \pchevrel\Verif('Check API HTTP responses');
$obj->setHost('localhost:8083');

$check = function ($paths, $type) use ($obj) {
    foreach ($paths as $values) {
        list($path, $http_code, $content) = $values;
        $obj
            ->setPath($path)
            ->fetchContent()
            ->hasResponseCode($http_code)
            ->isEqualTo($content);

        switch ($type) {
            case 'json':
                $obj->isJson();
                break;
            case 'number':
                $obj->isNumeric();
                break;
            default:
                break;
        }
    }
};

$check($json, 'json');
$check($number, 'number');

$obj->report();

// Kill PHP dev server we launched in the background
exec('kill -9 ' . $pid);
die($obj->returnStatus());
