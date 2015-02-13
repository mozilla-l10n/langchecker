<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\Project as _Project;
use Langchecker\RawManager as _RawManager;

require_once __DIR__ . '/../bootstrap.php';

class RawManager extends atoum\test
{
    public function compareRawFilesDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[3], 'it', 'email1.txt', 'untranslated'],
            [$sites[3], 'it', 'email2.txt', 'ok'],
            [$sites[3], 'it', 'email3.txt', 'missing_locale'],
            [$sites[3], 'it', 'email5.txt', 'missing_reference'],
        ];
    }

    /**
     * @dataProvider compareRawFilesDP
     */
    public function testCompareRawFiles($a, $b, $c, $d)
    {
        $obj = new _RawManager();

        $file_analysis = $obj->compareRawFiles($a, $b, $c);
        $this
            ->string($file_analysis['cmp_result'])
                ->isEqualTo($d);
    }

    public function testOutdatedCompareRawFiles()
    {
        $obj = new _RawManager();
        require_once TEST_FILES . 'config/sources.php';

        $website = $sites[3];
        $filename = 'email4.txt';

        // Make localized file 1 hour older than reference file
        $referencefile = _Project::getLocalFilePath($website, 'en-US', $filename);
        $timestamp = filemtime($referencefile) - 3600;
        touch($referencefile);
        touch(_Project::getLocalFilePath($website, 'it', $filename), $timestamp);

        $file_analysis = $obj->compareRawFiles($website, 'it', $filename);
        $this
            ->string($file_analysis['cmp_result'])
                ->isEqualTo('outdated');
    }
}
