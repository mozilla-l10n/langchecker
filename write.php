<?php

date_default_timezone_set('Europe/Paris');

/* server shortcuts */
$called    = true;
$aproot    = __DIR__ . '/';
$libs      = $aproot . 'libs/';
$conf      = $aproot . 'config/';
$views     = $aproot . 'views/';
$templates = $aproot . 'templates/';

/* functions needed to manipulate .lang files */
require_once $libs . 'l10n_moz.class.php';
require_once $libs . 'functions.inc.php';

/* init l10n class to create the globals needed */
$initl10n = new l10n_moz();

/* app-wide variables */
require $conf . 'locales.inc.php';   // list of locales
require $conf . 'sources.inc.php';   // websites definition, needs locales.inc.php

/* user provided variables */
$filename = (isset($_GET['file']))    ? secureText($_GET['file'])    : 'firefox/partners/index.lang'; // which file are we comparing? Default to main.lang
$locale   = (isset($_GET['locale']))  ? secureText($_GET['locale'])  : '';          // which locale are we analysing? No default
$website  = (isset($_GET['website'])) ? secureText($_GET['website']) : '0';          // which website are we looking at?

/* temp variables */
$reflang  = $sites[$website][6];
$source   = $sites[$website][1] . $sites[$website][2] . $reflang . '/' . $filename;

echo "Reference English file: $source \n";

getEnglishSource($reflang, $website, $filename, 1);

/* Avant de lancer le script faire un $ chown -R pascalc:www-data locales
 *
 * Exemple d'utilisation:
 * http://localhost/dev/langchecker/write.php?website=0&file=firefoxlive.lang
 */

if ($GLOBALS['__english_moz'] == null) {
    die("$source does not exist");
}

if ($filename == 'all') {
    $files = $langfiles_subsets[$sites[$website][0]];
} else {
    $files = array($filename);
}

if ($locale != '' && in_array($locale, $langfiles_subsets[$sites[$website][0]][$filename])) {
    $locales = array($locale);
} else {
    $locales = $langfiles_subsets[$sites[$website][0]][$filename];
}

/* loop generating the files */
foreach ($files as $filename) {
    if (isset($langfiles_subsets[$sites[$website][0]][$filename])) {
        $result = '';
        foreach ($locales as $_lang) {

            $source = $sites[$website][1] . $sites[$website][2] . $_lang . '/' . $filename;

            /* here we load preexisting lang files */
            l10n_moz::load($source);

            //~ if ($_lang == 'fr') {
                //~ var_dump($GLOBALS["__l10n_moz"]);
                //~ exit;
            //~ }

            /* for surveys */
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/survey1.lang');
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/survey2.lang');
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/survey3.lang');
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/main.lang');
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/mobile.lang');
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/download.lang');
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/newsletter.lang');
            //~ l10n_moz::load($sites[$website][1] . $sites[$website][2] . $_lang . '/mozorg/contribute.lang');

            $exceptions = array(
                'Different by design'           => 'Different by Design',
                'Proudly<br />non-profit'       => 'Proudly <span>non-profit</span>',
                'Innovating<br />for you'       => 'Innovating <span>for you</span>',
                'Fast, flexible,<br />secure'   => 'Fast, flexible, <span>secure</span>',
            );
            $exceptions = array();

            $content = buildFile($exceptions);
            $path    = $source;

            file_force_contents($path, $content);

            $result .= $_lang  . "\n";
            $result .= $source . "\n";
            $result .= $path   . "\n";

            if (isset($GLOBALS['__l10n_moz'])) {
                unset($GLOBALS['__l10n_moz']);
            }
        }

        echo $result;
    }
}


function buildFile($exceptions=array()) {

    ob_start();

    header('Content-type: text/plain; charset=UTF-8');

    if ( $GLOBALS['__l10n_moz']['activated'] ) {
        echo "## active ##\n";
    }

    foreach ($GLOBALS['__english_moz'] as $key => $val) {

        if ($key == 'activated') {
            continue;
        }

        if ($key == 'filedescription') {
            foreach ($GLOBALS['__english_moz']['filedescription'] as $header) {
                echo '## NOTE: ' . $header . "\n";
            }
            echo "\n\n";
            continue;
        }

        echo dumpString($key, $exceptions);
    }

    //~ $newsignup = dumpString('Sign me up!');
    //~ $newsignup = str_replace('&nbsp;!', '', $newsignup);
    //~ $newsignup = str_replace('!', '', $newsignup);
    //~ $newsignup = str_replace('！', '', $newsignup);
    //~ $newsignup = trim($newsignup);
    //~ echo "# Button\n";
    //~ echo $newsignup;

    /* put l10n extras at the end of the file */
    foreach ($GLOBALS['__l10n_moz'] as $key => $val) {
        if (strstr($key, '{l10n-extra}') == true) {
            echo dumpString($key);
        }
    }

    $content = ob_get_contents();

    ob_end_clean();

    return $content;
}


function dumpString($english, $exceptions=array()) {

    if ($english == 'activated') {
        return $GLOBALS['__l10n_moz'][$english]. "\n";
    }

    $chunk = '';

    if (isset($GLOBALS['__l10n_comments'][$english])) {

        $comments = $GLOBALS['__l10n_comments'][$english];

        if (strpos($GLOBALS['__l10n_comments'][$english], 'sep@rator')) {
            $comments = explode('sep@rator', $GLOBALS['__l10n_comments'][$english]);
            $chunk .= '## ' . trim($comments[0]) . " ##\n";
            if (trim($comments[1]) != '') {
                $chunk .= '# ' . trim($comments[1]) . "\n";
            }
        } else {
            $chunk .= '# ' . trim($comments) . "\n";
        }
    }

    $chunk .= ";$english\n";

    $span_to_br = function($str) {
        return str_replace(array('<span>', '</span>'), array('<br />', ''), $str);
    };

    //~ if (array_key_exists($english, $exceptions) && isset($GLOBALS['__l10n_moz'][$english])) {
        //~ $chunk .= $span_to_br($GLOBALS['__l10n_moz'][$exceptions[$english]]);
    //~ } else {
        $chunk .= (array_key_exists($english, $GLOBALS['__l10n_moz'])) ? $GLOBALS['__l10n_moz'][$english]: $english;
    //~ }
    $chunk .= "\n\n\n";

    return $chunk;
}

function file_force_contents($dir, $contents){
    $parts = explode('/', $dir);
    $file = array_pop($parts);
    $dir = '';
    foreach($parts as $part)
        if(!is_dir($dir .= "/$part")) mkdir($dir);
    file_put_contents("$dir/$file", $contents);
}
