<?php
namespace Langchecker;

/**
 * Utils class
 *
 * Utility functions like string management.
 *
 *
 * @package Langchecker
 */
class Utils
{
    /**
     * Remove a substring from the left of a string, return the trimmed result
     *
     * @param   string  $origin     Original string
     * @param   string  $substring  Substring to remove
     *
     * @return  string              Resulting string
     */
    public static function leftStrip($origin, $substring)
    {
        return trim(substr($origin, mb_strlen($substring)));
    }

    /**
     * Return a string without extra tags like {ok}
     *
     * @param   string  $origin  Original string
     *
     * @return  string           String cleaned from extra-tags
     */
    public static function cleanString($origin)
    {
        return trim(str_ireplace('{ok}', '', $origin));
    }

    /**
     * Check if $haystack starts with a string in $needles.
     * $needles can be a string or an array of strings.
     *
     * @param   string   $haystack  String to analyse
     * @param   array    $needles   The string to look for
     *
     * @return  boolean  True       if the $haystack string starts with a
     *                              string in $needles
     */
    public static function startsWith($haystack, $needles)
    {
        foreach((array) $needles as $prefix) {
            if (! strncmp($haystack, $prefix, mb_strlen($prefix))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get multibyte UTF-8 string length, html tags stripped
     *
     * @param   string  $str  A multibyte string
     *
     * @return  int           The length of the string after removing all html
     */
    public static function getLength($str)
    {
        return mb_strlen(strip_tags($str), 'UTF-8');
    }

    /**
     * Function sanitizing a string or an array of strings.
     *
     * @param   mixed         $origin    String/Array of strings to sanitize
     * @param   boolean       $isarray   If $origin must be treated as array
     *
     * @return  mixed                    Sanitized string or array
     */
    public static function secureText($origin, $isarray = true)
    {
        if (! is_array($origin)) {
            // If $origin is a string, always return a string
            $origin  = array($origin);
            $isarray = false;
        }

        foreach ($origin as $item => $value) {
            // CRLF XSS
            $item  = str_replace('%0D', '', $item);
            $item  = str_replace('%0A', '', $item);
            $value = str_replace('%0D', '', $value);
            $value = str_replace('%0A', '', $value);

            $value = filter_var(
                $value,
                FILTER_SANITIZE_STRING,
                FILTER_FLAG_STRIP_LOW
            );

            $item  = htmlspecialchars(strip_tags($item), ENT_QUOTES);
            $value = htmlspecialchars(strip_tags($value), ENT_QUOTES);

            // Repopulate value
            $sanitized[$item] = $value;
        }

        return ($isarray == true) ? $sanitized : $sanitized[0];
    }

    /**
     * Highlight Python variables in string
     *
     * @param   array   $origin  Original string
     *
     * @return  string           String withon Python variables marked with <em>
     */
    public static function highlightPythonVar($origin)
    {
        $origin = htmlspecialchars($origin);
        $regex = '#%(\([a-z0-9._-]+\)s|[s%])#';
        preg_match_all($regex, $origin, $matches);
        foreach ($matches[0] as $python_var) {
            $origin = str_replace($python_var, "<em>${python_var}</em>", $origin);
        }

        return $origin;
    }

    /**
     * Return false if file is not in UTF-8 or US-Ascii format
     *
     * @param   string   $filename  File to analyze
     *
     * @return  boolean             False if file is in the wrong encoding
     */
    public static function isUTF8($filename)
    {
        $info = finfo_open(FILEINFO_MIME_ENCODING);
        $type = finfo_buffer($info, file_get_contents($filename));
        finfo_close($info);

        return ($type == 'utf-8' || $type == 'us-ascii') ? true : false;
    }

    /**
     * Return
     *
     * @param   string  $filename  File to analyze
     *
     * @return  int                Timestamp of last commit from SVN,
     *                             or local if that fails
     */
    public function getSVNCommitTimestamp($filename)
    {
        exec("svn info --xml {$filename} 2>/dev/null", $output, $return_code);

        if ($return_code) {
            return filemtime($filename);
        }

        $file = new \SimpleXMLElement(implode('', $output));
        $date = new \DateTime($file->entry->commit->date);

        return $date->getTimestamp();
    }

    /**
     * Print error, quit application if requested
     *
     * @param  string  $message  Message to display
     * @param  string  $action   If 'quit', leave the app
     */
    public static function logger($message, $action = '')
    {
        error_log($message . "\n");
        if ($action == 'quit') {
            die;
        }
    }

    /**
     * Check type of EOL used in the file
     *
     * @param   string  $line  First line of the file
     *
     * @return  string         End of line characters, default Unix "\n"
     */
    public static function checkEOL($line)
    {
        if (substr($line, -2) === "\r\n") {
            return "\r\n";
        }

        return "\n";
    }

    /**
     * Save file in path, create folders if necessary
     *
     * @param  string  $path     File path
     * @param  string  $content  File content
     */
    public static function fileForceContent($path, $content)
    {
        $parts = explode('/', $path);
        $file = array_pop($parts);
        $dir = '';

        foreach ($parts as $part) {
            if (!is_dir($dir .= "/{$part}")) {
                mkdir($dir);
            }
        }

        file_put_contents("{$dir}/{$file}", $content);
    }

    /**
     * Read GET parameter if set, or fallback
     *
     * @param   string  $param     GET parameter to check
     * @param   string  $fallback  Optional fallback value
     *
     * @return  string             Parameter value, or fallback
     */
    public static function getQueryParam($param, $fallback = '') {
        if (isset($_GET[$param])) {
            return is_bool($fallback)
                   ? true
                   : self::secureText($_GET[$param]);
        }

        return $fallback;
    }

    /**
     * Read CLI parameter if set, or fallback
     *
     * @param   integer  $paramnum  Argument number
     * @param   array    $options   Array of parameters
     * @param   string   $fallback  Optional fallback value
     *
     * @return  string              Parameter value, or fallback
     */
    public static function getCliParam($paramnum, $options, $fallback = '') {
        if (isset($options[$paramnum])) {
            return self::secureText($options[$paramnum]);
        }

        return $fallback;
    }
}
