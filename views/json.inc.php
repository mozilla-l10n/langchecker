<?php
// we define in the loop if the locale code is supported in one of the sites;

$json = array();

// override to not have main.lang as default
$filename = (isset($_GET['file'])) ? secureText($_GET['file']) : 'snippets.lang';
$stringid = (isset($_GET['stringid'])) ? secureText($_GET['stringid']) : false;

foreach ($sites as $site) {
    if($filename != '' && in_array($filename, $site[4]))  {
        $site[4] = array($filename);
        break;
    }
}

$_file = $site[4][0];
$reflang = $site[6];

foreach($sites as $k => $v) {
    if (in_array($site[0], $v)) {
        $target = $k;
        break;
    }
}

getEnglishSource($reflang, $target, $_file, $seconds);


// reassign a lang file to a reduced set of locales
@$targetted_locales = (is_array($langfiles_subsets[$sites[$target][0]][$_file])) ? $langfiles_subsets[$sites[$target][0]][$_file] : $sites[$target][3];

$val = 0;

foreach ($GLOBALS['__english_moz'] as $k =>$v) {

    $sha1 = sha1($k);

    if ($k == 'filedescription') {
        continue;
    }

    if (isset($_GET['stringid']) && $_GET['stringid'] != $sha1) {
        continue;
    }
    $json[$sha1]['en-US']= trim($v);

    foreach ($targetted_locales as $_lang) {
        // if the .lang file does not exist, we don't want to generate a php warning, just skip the locale for this file
        $local_lang_file = $sites[$target][1] . $sites[$target][2] . $_lang . '/' . $_file;
        if ( !@file_get_contents($local_lang_file) ) {
            continue;
        }

        l10n_moz::load($local_lang_file);

        if(i__($k)) {
            $result = trim(str_replace('{l10n-extra}', '', ___($k)));
            $json[$sha1][$_lang]= $result;
        }
        unset($GLOBALS['__l10n_moz']);
    }
}

if (!$stringid) {
    header("Content-type:text/html; charset=utf-8");
    echo '<ul>';
    foreach ( $json as $key => $val) {
        echo '<li><a href="?action=api&file=' . $filename . '&stringid=' . $key . '">' . htmlspecialchars($val['en-US']) . '</a></li>';
    }
    echo '</ul>';
    exit;
}

if (isset($_GET['plaintext'])) {
    $mime = 'text/plain';
    header("Content-type: {$mime}; charset=UTF-8");
    foreach ($json[$_GET['stringid']] as $k => $v) {
        echo "\n$k : $v\n";
    }
    exit;
}

$json = json_encode($json);

if (isset($_GET['callback'])) {
    // JSONP with the defined callback
    $mime = 'application/javascript';
    $json = $_GET['callback'] . '(' . $json . ')';
} else {
    $mime = 'application/json';
    $mime = 'text/plain';
}

header("access-control-allow-origin: *");
header("Content-type: {$mime}; charset=UTF-8");
exit($json);

