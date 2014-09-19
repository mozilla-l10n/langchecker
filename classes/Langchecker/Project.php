<?php
namespace Langchecker;

/*
 * Project class
 *
 * Get data from the project: list of supported locales, file paths, etc.
 *
 * @package Langchecker
 */
class Project
{
    /*
     * Return reference locale for website
     *
     * @param   array  $website Website data
     * @return  string          Reference locale
     */
    public static function getReferenceLocale($website)
    {
        if (isset($website[5])) {
            return $website[5];
        }

        return 'en-US';
    }

    /*
     * Return supported locales for website
     *
     * @param   array   $website            Website data
     * @param   string  $filename           File name, default empty
     * @param   array   $langfiles_subsets  Array of supported locales for specific file, default empty
     * @return  array                       Supported locales
     */
    public static function getSupportedLocales($website, $filename = '', $langfiles_subsets = [])
    {
        $website_name = $website[0];
        if ($filename == '' ||
            ! isset($langfiles_subsets[$website_name])) {
            return $website[3];
        }

        if (isset($langfiles_subsets[$website_name][$filename])) {
            if (is_array($langfiles_subsets[$website_name][$filename])) {
                return $langfiles_subsets[$website_name][$filename];
            }
        }

        return $website[3];
    }

    /*
     * Check if locale is supported for website
     *
     * @param   array    $website            Website data
     * @param   string   $locale             Requested locale
     * @param   string   $filename           File name, default empty
     * @param   array    $langfiles_subsets  Array of supported locales for specific file, default empty
     * @return  boolean                      True if locale is supported
     */
    public static function isSupportedLocale($website, $locale, $filename = '', $langfiles_subsets = [])
    {
        return in_array($locale,
                        self::getSupportedLocales($website, $filename, $langfiles_subsets));
    }

    /*
     * Check if file is marked as critical
     *
     * @param   array    $website   Website data
     * @param   string   $filename  File name
     * @param   string   $locale    Locale
     * @return  boolean             True if file is marked as critical
     */
    public static function isCriticalFile($website, $filename, $locale)
    {
        if (isset($website[7][$filename])) {
            $flags = $website[7][$filename];
            if (isset($flags['critical'])) {
                if (in_array($locale, $flags['critical']) ||
                    in_array('all', $flags['critical'])) {
                    return true;
                }
            }
        }

        return false;
    }

    /*
     * Return a list of flags associated to the file
     *
     * @param   array    $website   Website data
     * @param   string   $filename  File name
     * @param   string   $locale    Locale
     * @return  array               Array of flags for this file+locale
     */
    public static function getFileFlags($website, $filename, $locale)
    {
        $file_flags = [];
        if (isset($website[7][$filename])) {
            $flags = $website[7][$filename];
            if (is_array($flags)) {
                foreach ($flags as $flag => $locales) {
                    if ($flag != 'critical' &&
                        (in_array($locale, $locales) ||
                         in_array('all', $locales))) {
                            $file_flags[] = $flag;
                    }
                }
            }
            sort($file_flags);
        }

        return $file_flags;
    }

    /*
     * Return website's name
     *
     * @param   array   $website  Website data
     * @return  string            Website name
     */
    public static function getWebsiteName($website)
    {
        return $website[0];
    }

    /*
     * Return list of files managed for website
     *
     * @param   array  $website  Website data
     * @return  array            Array of managed files, sorted alphabetically
     */
    public static function getWebsiteFiles($website)
    {
        $file_list = $website[4];
        asort($file_list);

        return $file_list;
    }

    /*
     * Return full local path to filename
     *
     * @param   array   $website   Website data
     * @param   string  $locale    Requested locale
     * @param   string  $filename  File name
     * @return  string             Path to file
     */
    public static function getLocalFilePath($website, $locale, $filename)
    {
        return $website[1] . $website[2] . $locale . '/' . $filename;
    }

    /*
     * Return full public path to filename
     *
     * @param   array   $website   Website data
     * @param   string  $locale    Requested locale
     * @param   string  $filename  File name
     * @return  string             Path to file
     */
    public static function getPublicFilePath($website, $locale, $filename)
    {
        return $website[6] . $website[2] . $locale . '/' . $filename;
    }

    /*
     * Return website path repo
     *
     * @param   array   $website  Website data
     * @param   string  $locale   Requested locale
     * @return  string            Path to file
     */
    public static function getPublicRepoPath($website, $locale)
    {
        return $website[6] . $website[2] . $locale . '/';
    }

    /*
     * Return user base coverage for list of locales
     *
     * @param   array   $locales  Array of locales
     * @return  string            Percent value of our coverage for the user base
     */
    public static function getUserBaseCoverage($locales, $adu)
    {
        if (isset($adu['ja']) && isset($adu['ja-JP-mac'])) {
            // Japanese has 2 builds
            $adu['ja'] = $adu['ja'] + $adu['ja-JP-mac'];
            unset($adu['ja-JP-mac']);
        }

        $englishes = ['en-GB', 'en-US', 'en-ZA'];
        $english_adu = 0;
        foreach ($englishes as $english) {
            if (isset($adu[$english])) {
                $english_adu += $adu[$english];
            }
        }
        $locales = array_intersect_key($adu, array_flip($locales));

        return number_format(array_sum($locales) / (array_sum($adu) - $english_adu) *100, 2);
    }

    /*
     * Return name of the view based on the request parameters
     *
     * @param   array   $request  Array of params extracted from URL
     * @return  array             Array with name of the file to use, if we need a template or not and its name
     */
    public static function selectView($request)
    {
        // Default: use template called 'template', show list of locales
        $result['template'] = 'template';
        $result['file'] = 'listlocales';

        // All URLs with 'action' don't require other values like locale, etc.
        if ($request['action'] != '') {
            switch ($request['action']) {
                case 'activation':
                    $result['file'] = 'activation';
                    break;
                case 'api':
                    $result['file'] = 'json';
                    $result['template'] = '';
                    break;
                case 'count':
                    $result['file'] = 'countstrings';
                    if ($request['json']) {
                        $result['template'] = '';
                    }
                    break;
                case 'coverage':
                    $result['file'] = 'getcoverage';
                    $result['template'] = '';
                    break;
                case 'errors':
                    $result['file'] = 'errors';
                    break;
                case 'listlocales':
                    if ($request['json']) {
                        $result['file'] = 'listlocalesforproject';
                        $result['template'] = '';
                    }
                    break;
                case 'listpages':
                    $result['file'] = 'listpages';
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
                $result['template'] = '';
            }

            return $result;
        }

        if ($request['locale'] != '' &&
            $request['website'] == ''  &&
            ($request['serial'] || $request['json'])) {
            $result['file'] = 'export';
            $result['template'] = '';

            return $result;
        }

        if ($request['locale'] != '' && $request['website'] == '') {
            $result['file'] = 'listsitesforlocale';

            return $result;
        }

        return $result;
    }
}
