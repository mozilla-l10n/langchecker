<?php
define('INSTALL_ROOT',  realpath(__DIR__ . '/../../') . '/');

// We always work with UTF8 encoding
mb_internal_encoding('UTF-8');

// Make sure we have a timezone set
date_default_timezone_set('Europe/Paris');

require __DIR__ . '/../../vendor/autoload.php';

// Set an environment variable so that the instance will use content from test files
putenv("AUTOMATED_TESTS=true");

// Launch PHP dev server in the background
chdir(INSTALL_ROOT);
exec('php -S 0.0.0.0:8083 -t web/> /dev/null 2>&1 & echo $!', $output);

// We will need the pid to kill it, beware, this is the pid of the php server started above
$pid = $output[0];

// Pause to let time for the dev server to launch in the background
sleep(3);

$json = [
    ['?action=count&json', 200, "{\n    \"it\": 6,\n    \"fr\": 0,\n    \"en-US\": 0\n}"],
    ['?action=coverage&locales=foo', 400, "{\n    \"error\": \"ERROR: locales is not an array.\"\n}"],
    ['?action=coverage', 400, "{\n    \"error\": \"ERROR: missing list of locales.\"\n}"],
    ['?action=listlocales&project=snippets&json', 200, "[\n    \"fr\",\n    \"it\"\n]"],
    ['?action=listlocales&json', 400, "{\n    \"error\": \"ERROR: please check you request: provide a project name, or a valid couple website+file.\"\n}"],
    ['?action=listlocales&website=2&file=page.lang&json', 200, "[\n    \"en-US\",\n    \"it\"\n]"],
    ['?action=listpages&website=2&json', 200, "{\"parsing_test\":{\"page.lang\":{\"obsolete\":false,\"source_type\":\"lang\",\"supported_locales\":[\"en-US\",\"it\"],\"strings_count\":16,\"url\":\"-\",\"words_count\":51}}}"],
    ['?action=listpages&website=9999&json', 400, "{\n    \"error\": \"ERROR: the requested website (9999) is not supported.\"\n}"],
    ['?action=snippets&locale=it', 200, "{\n    \"@@this is a test, do not remove@@\": \"Questo \u00e8 un test\",\n    \"Email\": \"Email\",\n    \"Fifth string with %(one)s, %(two)s\": \"Quinta stringa con %(one)s, %(two)s e ancora %(two)s\",\n    \"Fourth string with 90%% coverage\": \"Quarta stringa con copertura al 90%\",\n    \"Hello\": \"Ciao\",\n    \"Obsolete string\": \"Stringa obsoleta\",\n    \"Press center\": \"Sala stampa\",\n    \"Save file\": \"Salva file troppo lungo\",\n    \"Second string with %(num)s tags\": \"Seconda stringa con %(num)s etichette\",\n    \"Sixth string with %(one)s\": \"Sesta stringa con %(one)s e %(two)s\",\n    \"String with %(num)s tags\": \"Stringa con etichette e variabile sbagliata\",\n    \"String with multiple comments\": \"String con pi\u00f9 commenti\",\n    \"Third string with %s tags\": \"Terza stringa con variabile mancante\"\n}"],
    ['?action=translate&file=foo.lang&json', 400, "{\n    \"error\": \"ERROR: file foo.lang does not exist\"\n}"],
    ['?action=translate&file=page.lang&json', 200, "{\n    \"Email\": {\n        \"it\": \"Email\"\n    },\n    \"Hello\": {\n        \"it\": \"Ciao\"\n    },\n    \"Save file\": {\n        \"it\": \"Salva file troppo lungo\"\n    },\n    \"01\": {\n        \"it\": \"1\"\n    },\n    \"String with multiple comments\": {\n        \"it\": \"String con pi\u00f9 commenti\"\n    },\n    \"Press center\": {\n        \"it\": \"Sala stampa\"\n    },\n    \"@@this is a test, do not remove@@\": {\n        \"it\": \"Questo \u00e8 un test\"\n    },\n    \"String with %(num)s tags\": {\n        \"it\": \"Stringa con etichette e variabile sbagliata\"\n    },\n    \"Second string with %(num)s tags\": {\n        \"it\": \"Seconda stringa con %(num)s etichette\"\n    },\n    \"Third string with %s tags\": {\n        \"it\": \"Terza stringa con variabile mancante\"\n    },\n    \"Fourth string with 90%% coverage\": {\n        \"it\": \"Quarta stringa con copertura al 90%\"\n    },\n    \"Fifth string with %(one)s, %(two)s\": {\n        \"it\": \"Quinta stringa con %(one)s, %(two)s e ancora %(two)s\"\n    },\n    \"Sixth string with %(one)s\": {\n        \"it\": \"Sesta stringa con %(one)s e %(two)s\"\n    }\n}"],
    ['?website=2&file=page.lang&json&locale=it', 200, "{\n    \"page.lang\": {\n        \"it\": {\n            \"Errors\": 7,\n            \"Identical\": 2,\n            \"Missing\": 1,\n            \"Obsolete\": 1,\n            \"Translated\": 13,\n            \"tags\": [],\n            \"activated\": true\n        }\n    }\n}"],
    ['?website=2&file=page.lang&json', 200, "{\n    \"page.lang\": {\n        \"it\": {\n            \"Errors\": 7,\n            \"Identical\": 2,\n            \"Missing\": 1,\n            \"Obsolete\": 1,\n            \"Translated\": 13,\n            \"tags\": [],\n            \"activated\": true\n        }\n    }\n}"],
    ['?website=2&file=main.lang&json', 400, "{\n    \"error\": \"File main.lang does not exist. Check the value and try again.\"\n}"],
    ['?website=foo&file=main.lang&json', 400, "{\n    \"error\": \"foo is not a supported website. Check the value and try again.\"\n}"],
];

$text = [
    ['?action=api&file=page.lang', 200, "<ul>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=54a2cf5e634dbba0be2bf8a55f79252f5c790bdb\">Browser</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=84add5b2952787581cb9a8851eef63d1ec75d22b\">Email</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=f7ff9e8b7bb2e09b70935a5d785e0cc5d9d0abf0\">Hello</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=640ab2bae07bedc4c163f679a746f7ab7fb5d1fa\">Test</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=bedc846b24ca06a457bf9b9208de6b146969362f\">Save file</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=ddfe163345d338193ac2bdc183f8e9dcff904b43\">01</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=e27ab9a3b203bd8831760183e2bbff78878c5dac\">String with multiple comments</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=1c037c4d9e72bbf474008cf56eae8734368093e4\">Press center</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=a7b3f41052019d22a389a41e375534e65dd9dff3\">@@this is a test, do not remove@@</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=b075e68c4e2ae16b7e5fe1dec55ede7584706f55\">String with tag</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=268fbfe819c694d4d179d4943de7f7d4cec4b042\">String with %(num)s tags</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=9f13ceddb7ca0399b59b942f0c1d884870225f76\">Second string with %(num)s tags</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=4747af9ac14c7aa4985890e850b6452faf0ab649\">Third string with %s tags</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=c1b92fc8ff9a988f1729f7ffac55efab58cffc00\">Fourth string with 90%% coverage</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=f99de591a4f4f53a7335f41d68f0f28c422a8f10\">Fifth string with %(one)s, %(two)s</li>\n    <li><a href=\"./?action=api&amp;file=page.lang&amp;stringid=3a5667ca2f63ce4baeb13bb10395e1197d041572\">Sixth string with %(one)s</li>\n</ul>\n"],
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
$check($text, 'text');
$check($number, 'number');

$obj->report();

// Kill PHP dev server we launched in the background
exec('kill -9 ' . $pid);
die($obj->returnStatus());
