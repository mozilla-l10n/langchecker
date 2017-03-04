<?php
namespace Langchecker;

/**
 * Project class
 *
 * Get data from the project: list of supported locales, file paths, etc.
 *
 *
 * @package Langchecker
 */
class Project
{
    /**
     * Return reference locale for website
     *
     * @param array $website Website data
     *
     * @return string Reference locale
     */
    public static function getReferenceLocale($website)
    {
        if (isset($website[5])) {
            return $website[5];
        }

        return 'en-US';
    }

    /**
     * Return supported locales for a file in website. If not defined,
     * fall back to supported locales for the website itself.
     *
     * @param array  $website  Website data
     * @param string $filename File name, default empty
     *
     * @return array Supported locales
     */
    public static function getSupportedLocales($website, $filename = '')
    {
        // Default: use the website's supported locales
        $supported_locales = $website[3];

        if ($filename == '') {
            return $supported_locales;
        }

        $files_data = self::getWebsiteFiles($website, false);
        if (isset($files_data[$filename]['supported_locales'])) {
            $supported_locales = $files_data[$filename]['supported_locales'];
        }
        // Make sure locales are sorted
        sort($supported_locales);

        return $supported_locales;
    }

    /**
     * Check if locale is supported for the requested file
     *
     * @param array  $website  Website data
     * @param string $locale   Requested locale
     * @param string $filename File name, default empty
     *
     * @return boolean True if locale is supported
     */
    public static function isSupportedLocale($website, $locale, $filename = '')
    {
        return in_array(
            $locale,
            self::getSupportedLocales($website, $filename)
        );
    }

    /**
     * Check if file is marked as obsolete
     *
     * @param array  $website  Website data
     * @param string $filename File name
     * @param string $locale   Locale
     *
     * @return boolean True if file is marked as obsolete
     */
    public static function isObsoleteFile($website, $filename, $locale)
    {
        return in_array('obsolete', self::getFileFlags($website, $filename, $locale));
    }

    /**
     * Return a list of flags associated to the file
     *
     * @param array  $website  Website data
     * @param string $filename File name
     * @param string $locale   Locale
     *
     * @return array Array of flags for this file+locale
     */
    public static function getFileFlags($website, $filename, $locale)
    {
        $file_flags = [];
        $files_data = self::getWebsiteFiles($website, false);
        if (isset($files_data[$filename]['flags'])) {
            $flags = $files_data[$filename]['flags'];
            foreach ($flags as $flag => $locales) {
                if (in_array($locale, $locales) || in_array('all', $locales)) {
                    $file_flags[] = $flag;
                }
            }
            sort($file_flags);
        }

        return $file_flags;
    }

    /**
     * Return the deadline associated to the file
     *
     * @param array  $website  Website data
     * @param string $filename File name
     *
     * @return array Array of flags for this file+locale
     */
    public static function getFileDeadline($website, $filename)
    {
        $files_data = self::getWebsiteFiles($website, false);

        return isset($files_data[$filename]['deadline'])
            ? $files_data[$filename]['deadline']
            : '';
    }

    /**
     * Return the priority of a file. If not defined, fall back to the
     * default priority for the project.
     *
     * @param array  $website  Website data
     * @param string $filename File name
     * @param string $locale   Locale
     *
     * @return array Priority for requested file+locale
     */
    public static function getFilePriority($website, $filename, $locale)
    {
        // Default is to fall back to the project's priority
        $priority = $website[7];

        $files_data = self::getWebsiteFiles($website, false);
        if (isset($files_data[$filename]['priority'])) {
            $priorities = $files_data[$filename]['priority'];

            // If only one priority is defined, I can return this value
            if (gettype($priorities) == 'integer') {
                return $priorities;
            }

            foreach ($priorities as $current_priority => $locales) {
                /*
                    Return directly if there's a perfect match, store but keep
                    looking if 'all', in case there's a later definition for
                    this specific locale.
                */
                if (in_array($locale, $locales)) {
                    return $current_priority;
                } elseif (in_array('all', $locales)) {
                    $priority = $current_priority;
                }
            }
        }

        return $priority;
    }

    /**
     * Return website's name
     *
     * @param array $website Website data
     *
     * @return string Website name
     */
    public static function getWebsiteName($website)
    {
        return $website[0];
    }

    /**
     * Return list of files managed for website
     *
     * @param array   $website    Website data
     * @param boolean $only_names If true only return filenames, if false return
     *                            all data about supported files
     *
     * @return array Array of managed files (sorted alphabetically) or
     *               files data
     */
    public static function getWebsiteFiles($website, $only_names = true)
    {
        if (! $only_names) {
            return $website[4];
        }

        $file_list = array_keys($website[4]);
        sort($file_list);

        return $file_list;
    }

    /**
     * Return full local path to filename
     *
     * @param array  $website  Website data
     * @param string $locale   Requested locale
     * @param string $filename File name
     *
     * @return string Path to file
     */
    public static function getLocalFilePath($website, $locale, $filename)
    {
        if ($locale == '') {
            // Return only the main website folder
            return $website[1] . $website[2];
        }

        return $website[1] . $website[2] . $locale . '/' . $filename;
    }

    /**
     * Return full public path to filename
     *
     * @param array  $website  Website data
     * @param string $locale   Requested locale
     * @param string $filename File name
     *
     * @return string Path to file
     */
    public static function getPublicFilePath($website, $locale, $filename)
    {
        return $website[6] . $website[2] . $locale . '/' . $filename;
    }

    /**
     * Return website path repo
     *
     * @param array  $website Website data
     * @param string $locale  Requested locale
     *
     * @return string Path to file
     */
    public static function getPublicRepoPath($website, $locale)
    {
        return $website[6] . $website[2] . $locale . '/';
    }

    /**
     * Return websites that use a specific data type as source
     *
     * @param array $sites Array of all supported websites
     * @param array $type  Type of data (lang, raw)
     *
     * @return array Array of website records
     */
    public static function getWebsitesByDataType($sites, $type)
    {
        foreach ($sites as $key => $site) {
            if (self::getWebsiteDataType($site) != $type) {
                unset($sites[$key]);
            }
        }

        return $sites;
    }

    /**
     * Return data type used by website
     *
     * @param array $website Website data
     *
     * @return string Type of data (lang, raw)
     */
    public static function getWebsiteDataType($website)
    {
        return $website[8];
    }

    /**
     * Return the path to the local repository used by the website
     *
     * @param array $website Website data
     *
     * @return string Local path to the repository
     */
    public static function getWebsiteLocalRepository($website)
    {
        return $website[1];
    }

    /**
     * Return localized URL for stage (if available)
     *
     * @param array  $reference_data Data for reference locale
     * @param string $locale         Requested locale, empty to get the
     *                               generic URL without locale code
     * @param string $type           If the return value is a plain URL or
     *                               HTML link
     *
     * @return string Localized URL
     */
    public static function getLocalizedURL($reference_data, $locale = '', $type = 'txt')
    {
        if (! isset($reference_data['url'])) {
            // No URL available for this page

            return '-';
        }

        // If $locale is empty, I need to remove the slash before %LOCALE%
        $page_url = str_replace(
                        ['%LOCALE%', '//', ':/'],
                        [$locale, '/', '://'],
                        $reference_data['url']
                    );

        return ($type == 'html')
            ? "<a href='{$page_url}' class='table_small_link'>view</a>"
            : $page_url;
    }

    /**
     * Return user base coverage for list of locales
     *
     * @param array $locales Array of locales
     *
     * @return string Percent value of our coverage for the user base
     */
    public static function getUserBaseCoverage($locales, $adu)
    {
        if (isset($adu['ja']) && isset($adu['ja-JP-mac'])) {
            // Japanese has 2 builds
            $adu['ja'] = $adu['ja'] + $adu['ja-JP-mac'];
            unset($adu['ja-JP-mac']);
        }

        $englishes = ['en-US', 'en-ZA'];
        $english_adu = 0;
        foreach ($englishes as $english) {
            if (isset($adu[$english])) {
                $english_adu += $adu[$english];
            }
        }
        $locales = array_intersect_key($adu, array_flip($locales));

        return number_format(array_sum($locales) / (array_sum($adu) - $english_adu) * 100, 2);
    }

    /**
     * Return name of the view based on the request parameters
     *
     * @param array $request Array of params extracted from URL
     *
     * @return array Array with name of the file to use, if we need
     *               a template or not and its name
     */
    public static function selectView($request)
    {
        // Default: show list of locales
        $result['file'] = 'listlocales';

        // All URLs with 'action' don't require other values like locale, etc.
        if ($request['action'] != '') {
            switch ($request['action']) {
                case 'activation':
                    $result['file'] = 'activation';
                    break;
                case 'count':
                    $result['file'] = 'countstrings';
                    break;
                case 'coverage':
                    $result['file'] = 'getcoverage';
                    break;
                case 'errors':
                    $result['file'] = 'errors';
                    break;
                case 'listlocales':
                    if ($request['json']) {
                        $result['file'] = 'listlocalesforproject';
                    }
                    break;
                case 'listpages':
                    if ($request['json']) {
                        $result['file'] = 'listpages_api';
                    } else {
                        $result['file'] = 'listpages';
                    }
                    break;
                case 'optin':
                    $result['file'] = 'optin';
                    break;
                case 'snippets':
                    $result['file'] = 'snippets_api';
                    break;
                case 'translate':
                    $result['file'] = 'translatestrings';
                    break;
            }

            return $result;
        }

        if ($request['filename'] != '' && $request['website'] != '') {
            $result['file'] = 'globalstatus';
            if ($request['json']) {
                $result['file'] = 'globalstatus_api';
            }

            return $result;
        }

        if ($request['locale'] != '' &&
            $request['website'] == '' &&
            ($request['serial'] || $request['json'])) {
            $result['file'] = 'export';

            return $result;
        }

        if ($request['locale'] != '' && $request['website'] == '') {
            $result['file'] = 'listsitesforlocale';

            return $result;
        }

        return $result;
    }

    /**
     * Display an error message on the default error template and quit.
     *
     * @param array  $template      Twig object
     * @param string $error_message Error message to display
     *
     */
    public static function displayErrorTemplate($template, $error_message)
    {
        $output = $template->render(
            'error.twig',
            [
                'error_message' => $error_message,
            ]
        );
        die($output);
    }
}
