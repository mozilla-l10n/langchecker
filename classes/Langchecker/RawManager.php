<?php
namespace Langchecker;

/*
 * RawManager class
 *
 * This class is used to compare reference and localized "raw" files.
 * Unlike .lang files, we can't parse content in raw files
 * (e.g. text files), so we can only determine their status based on
 * content comparison (through sha1 hashes) and dates.
 *
 * @package Langchecker
 */
class RawManager
{
    /*
     * Compare reference and localized raw file
     *
     * @param   array   $website   Website data
     * @param   string  $locale    Locale to analyze
     * @param   string  $filename  File to analyze
     * @return  array              Results from comparison
     */
    public static function compareRawFiles($website, $locale, $filename)
    {
        $results = [];

        // Store reference file hash and last update date
        $reference_locale = Project::getReferenceLocale($website);
        $reference_filename = Project::getLocalFilePath($website, $reference_locale, $filename);
        if (file_exists($reference_filename)) {
            $reference_content = sha1_file($reference_filename);
            $results['reference_exists'] = true;
            $results['reference_url'] = Project::getPublicFilePath($website, $reference_locale, $filename);
            $results['reference_lastupdate'] = Utils::getSVNCommitTimestamp($reference_filename);
        } else {
            $results['reference_exists'] = false;
            $results['cmp_result'] = 'missing_reference';
        }

        // Generate locale file hash and last update date
        $locale_filename = Project::getLocalFilePath($website, $locale, $filename);
        if (file_exists($locale_filename)) {
            $locale_content = sha1_file($locale_filename);
            $results['locale_exists'] = true;
            $results['locale_url'] = Project::getPublicFilePath($website, $locale, $filename);
            $results['locale_lastupdate'] = Utils::getSVNCommitTimestamp($locale_filename);

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
}
