<?php
// Webhook to update a repo for each push on GitHub

date_default_timezone_set('Europe/Paris');

// App variables
$app_root = realpath(__DIR__ . '/../');
$composer = "{$app_root}/composer.phar";

// Git variables
$branch = 'master';
$header = 'HTTP_X_HUB_SIGNATURE';

// Include GitHub secret from settings
require "{$app_root}/app/config/settings.inc.php";

// Logging function to output content to /github_log.txt
function logHookResult($message, $app_root, $success = false)
{
    $log_headers = "$message\n";
    if (! $success) {
        foreach ($_SERVER as $header => $value) {
            $log_headers .= "$header: $value \n";
        }
    }
    file_put_contents("{$app_root}/logs/github_log.txt", $log_headers);
}

// CHECK: Download composer in the app root if it is not already there
if (! file_exists($composer)) {
    file_put_contents(
        $composer,
        file_get_contents('https://getcomposer.org/composer.phar')
    );
}

if (isset($_SERVER[$header])) {
    $validation = hash_hmac(
        'sha1',
        file_get_contents("php://input"),
        GITHUB_SECRET
    );

    if ($validation == explode('=', $_SERVER[$header])[1]) {
        $log = '';

        // Aknowledge request
        ob_start();
        echo '{}';
        header($_SERVER["SERVER_PROTOCOL"] . " 202 Accepted");
        header("Status: 202 Accepted");
        header("Content-Type: application/json");
        header('Content-Length: ' . ob_get_length());
        ob_end_flush();
        ob_flush();
        flush();

        // Pull latest changes
        $log .= "Updating Git repository\n";
        exec("git checkout $branch; git pull origin $branch");

        // Delete cache
        $log .= "Removing existing cache\n";
        $removed_files = 0;
        foreach (glob("{$app_root}/cache/*.cache") as $filename) {
            if (unlink($filename)) {
                $removed_files++;
            }
        }
        $log .= "Cache items removed from {$app_root}/cache: {$removed_files}";

        // Install or update dependencies
        if (file_exists($composer)) {
            chdir($app_root);

            // www-data does not have a HOME or COMPOSER_HOME, create one
            $cache_folder = "{$app_root}/.composer_cache";
            if (! is_dir($cache_folder)) {
                $log .= "Creating folder {$cache_folder}\n";
                mkdir($cache_folder);
            }

            putenv("COMPOSER_HOME={$app_root}/.composer_cache");

            if (file_exists("{$app_root}/vendor")) {
                $log .= "Updating Composer\n";
                exec("php {$composer} update > /dev/null 2>&1");
            } else {
                $log .= "Installing Composer\n";
                exec("php {$composer} install > /dev/null 2>&1");
            }
        }

        $log .= 'Last update: ' . date('d-m-Y H:i:s');
        logHookResult($log, $app_root, true);
    } else {
        logHookResult('Invalid GitHub secret', $app_root);
    }
} else {
    logHookResult("{$header} header missing, define a secret key for your project in GitHub", $app_root);
}
