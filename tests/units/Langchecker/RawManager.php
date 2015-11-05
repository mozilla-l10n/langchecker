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

    public function parseGitLogDP()
    {
        return [
            [
                'test/repo/zh-TW/templates/mozorg/emails/addons.txt',
                1446649744,
            ],
            [
                'test/repo/it/templates/mozorg/contribute-2015/writing_txt_users.txt',
                1444454862,
            ],
            [
                'test/repo/en-US/templates/mozorg/emails/infos.txt',
                1439381409,
            ],
            [
                'test/repo/en-US/templates/mozorg/contribute-2015/l10n_tools.txt',
                1412875677,
            ],
        ];
    }

    /**
     * @dataProvider parseGitLogDP
     */
    public function testparseGitLog($a, $b)
    {
        $obj = new _RawManager();
        $git_log = file(TEST_FILES . 'misc/git_log.txt', FILE_IGNORE_NEW_LINES);
        $timestamps = $obj->parseGitLog('test/repo/', $git_log);

        $this
            ->integer($timestamps[$a])
                ->isEqualTo($b);
    }
}
