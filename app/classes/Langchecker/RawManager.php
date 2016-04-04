<?php
namespace Langchecker;

use Cache\Cache;

/**
 * RawManager class
 *
 * This class is used to compare reference and localized "raw" files.
 * Unlike .lang files, we can't parse content in raw files
 * (e.g. text files), so we can only determine their status based on
 * content comparison (through sha1 hashes) and dates.
 *
 *
 * @package Langchecker
 */
class RawManager
{
    /**
     * Compare reference and localized raw file
     *
     * @param array  $website  Website data
     * @param string $locale   Locale to analyze
     * @param string $filename File to analyze
     *
     * @return array Results from comparison
     */
    public static function compareRawFiles($website, $locale, $filename)
    {
        $results = [];

        /* Check if we already analyzed and cached the log for this website.
         * If not, analyze and cache it
         */
        $website_name = Project::getWebsiteName($website);
        $cache_id = "raw_timestamps_{$website_name}";
        if (! $raw_timestamps = Cache::getKey($cache_id)) {
            $raw_timestamps = self::getGitRawTimestamps(Project::getWebsiteLocalRepository($website));
            Cache::setKey($cache_id, $raw_timestamps);
        }

        $reference_locale = Project::getReferenceLocale($website);
        $reference_filename = Project::getLocalFilePath($website, $reference_locale, $filename);
        if (file_exists($reference_filename)) {
            // Store reference file hash and last update date
            $reference_content = sha1_file($reference_filename);
            $results['reference_exists'] = true;
            $results['reference_url'] = Project::getPublicFilePath($website, $reference_locale, $filename);

            if (isset($raw_timestamps[$reference_filename])) {
                $results['reference_lastupdate'] = $raw_timestamps[$reference_filename];
            } else {
                // No data available from git log, use local filestamp
                $results['reference_lastupdate'] = filemtime($reference_filename);
            }
        } else {
            $results['reference_exists'] = false;
            $results['cmp_result'] = 'missing_reference';
        }

        $locale_filename = Project::getLocalFilePath($website, $locale, $filename);
        if (file_exists($locale_filename)) {
            // Store locale file hash and last update date
            $locale_content = sha1_file($locale_filename);
            $results['locale_exists'] = true;
            $results['locale_url'] = Project::getPublicFilePath($website, $locale, $filename);
            if (isset($raw_timestamps[$locale_filename])) {
                $results['locale_lastupdate'] = $raw_timestamps[$locale_filename];
            } else {
                // No data available from git log, use local filestamp
                $results['locale_lastupdate'] = filemtime($locale_filename);
            }
            if ($results['reference_exists']) {
                if ($locale_content == $reference_content) {
                    $results['cmp_result'] = 'untranslated';
                } elseif ($results['reference_lastupdate'] > $results['locale_lastupdate']) {
                    // I check dates only if content is not identical
                    $results['cmp_result'] = 'outdated';
                } else {
                    $results['cmp_result'] = 'ok';
                }
            }
        } else {
            $results['locale_exists'] = false;
            $results['cmp_result'] = 'missing_locale';
        }

        return $results;
    }

    /**
     * Run git log in shell, return an array of files with their last update
     * timestamp
     *
     * @param string $path Path to the Git repository to analyze
     *
     * @return array Files with their last update timestamp
     *
     */
    public static function getGitRawTimestamps($path)
    {
        exec(
            "git --work-tree={$path} --git-dir={$path}.git log --pretty=format:'%cd' --name-only --follow -- */*.txt 2>/dev/null",
            $git_log,
            $return_code
        );

        if (empty($git_log) || $return_code) {
            return [];
        }

        return self::parseGitLog($path, $git_log);
    }

    /**
     * Analyze git log and return an array of files with their last update
     * timestamp
     *
     * Output from the git log command is in the format
     * DATE
     * [list of files, one filename on each line]
     * [empty line]
     *
     * @param string $path    Path to the Git repository to analyze
     * @param string $git_log Git log
     *
     * @return array Files with their last update timestamp
     *
     */
    public static function parseGitLog($path, $git_log)
    {
        $file_timestamps = [];
        for ($i = 0, $lines = count($git_log); $i < $lines; $i++) {
            // First line is the timestamp
            $timestamp = $git_log[$i];

            /* We need an exception to ignore the change of reference locale from
             * en-GB to en-US on Jan 15 2015.
             */
            if ($timestamp == 'Thu Jan 15 13:46:56 2015 +0000') {
                $timestamp = 'Thu Oct 9 17:27:57 2014 +0000';
            }

            // Following lines are filenames, there is at least one
            $current_line = $git_log[++$i];
            while ($current_line != '' && $i < $lines - 1) {
                $file_name = $path . $current_line;
                if (! isset($file_timestamps[$file_name])) {
                    $file_timestamps[$file_name] = (new \DateTime($timestamp))->getTimestamp();
                }
                $current_line = $git_log[++$i];
            }
        }

        return $file_timestamps;
    }
}
