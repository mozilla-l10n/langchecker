<?php
namespace Langchecker;

use Transvision\Json;

$json_data = [];

// $filename is set in /inc/init.php
$current_filename = $filename != '' ? $filename : 'snippets.lang';
$string_id = isset($_GET['stringid']) ? Utils::secureText($_GET['stringid']) : false;

$supported_file = false;
// Search which website has the requested file
foreach (Project::getWebsitesByDataType($sites, 'lang') as $site) {
    if (in_array($current_filename, Project::getWebsiteFiles($site))) {
        $current_website = $site;
        $supported_file = true;
        break;
    }
}

if (! $supported_file) {
    // File is not managed, throw error
    http_response_code(400);
    die("File {$current_filename} is not supported. Check the file name and try again.");
}

$reference_locale = Project::getReferenceLocale($current_website);
$reference_data = LangManager::loadSource($current_website, $reference_locale, $current_filename);

if (! $string_id) {
    // Display list of links to strings
    header("Content-type:text/html; charset=utf-8");
    echo "<ul>\n";
    foreach ($reference_data['strings'] as $current_string => $value) {
        $string_hash = sha1($current_string);
        if (isset($_GET['callback'])) {
            $string_link = "?action=api&file={$current_filename}&stringid={$string_hash}&callback={$_GET['callback']}";
        } else {
            $string_link = "?action=api&file={$current_filename}&stringid={$string_hash}";
        }
        echo "<li><a href='{$string_link}'>"
             . htmlspecialchars($current_string)
             . "</a></li>\n";
    }
    echo "</ul>\n";
} else {
    // I have a string_id to display, identify the reference string from provided hash
    $reference_string = '';
    foreach ($reference_data['strings'] as $current_string => $value) {
        if ($string_id == sha1($current_string)) {
            $reference_string = $current_string;
            break;
        }
    }

    if ($reference_string == '') {
        // String not found, throw error
        http_response_code(400);
        die("No string available with id: {$string_id}.");
    }

    $supported_locales = Project::getSupportedLocales($current_website, $current_filename, $langfiles_subsets);
    $json_data[$string_id][$reference_locale] = $reference_string;
    foreach ($supported_locales as $current_locale) {
        if (! file_exists(Project::getLocalFilePath($current_website, $current_locale, $current_filename))) {
            // If the .lang file does not exist, just skip the locale for this file
            continue;
        }
        $locale_data = LangManager::loadSource($current_website, $current_locale, $current_filename);
        // Add string to Json only if localized
        if (LangManager::isStringLocalized($reference_string, $locale_data, $reference_data)) {
            $json_data[$string_id][$current_locale] = Utils::cleanString($locale_data['strings'][$reference_string]);
        }
    }

    if (isset($_GET['plaintext'])) {
        header("Content-type: text/plain; charset=utf-8");
        foreach ($json_data[$string_id] as $key => $value) {
            echo "\n$key : $value\n";
        }
        exit;
    }

    $callback = isset($_GET['callback']) ? $_GET['callback'] : false;
    exit(Json::output($json_data, $callback, true));
}
