<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\Project as _Project;

require_once __DIR__ . '/../bootstrap.php';

class Project extends atoum\test
{
    public function getReferenceLocaleDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'en-GB'],
            [$sites[1], 'en-US'],
        ];
    }

    /**
     * @dataProvider getReferenceLocaleDP
     */
    public function testGetReferenceLocale($a, $b)
    {
        $obj = new _Project();
        $this
            ->string($obj->getReferenceLocale($a))
                ->isEqualTo($b);
    }

    public function getSupportedLocalesDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], '', ['en-US', 'fr']],
            [$sites[0], 'file1.lang', ['fr']],
            [$sites[0], 'file2.lang', ['en-US', 'fr']],
            [$sites[1], 'missing.lang', ['de', 'en-US', 'fr']],
            [$sites[1], 'file3.lang', ['de', 'en-US', 'fr']],
        ];
    }

    /**
     * @dataProvider getSupportedLocalesDP
     */
    public function testGetSupportedLocales($a, $b, $c)
    {
        $obj = new _Project();
        $this
            ->array($obj->getSupportedLocales($a, $b))
                ->isEqualTo($c);
    }

    public function isObsoleteFileDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'file1.lang', 'all', false],
            [$sites[0], 'file1.lang', 'fr', true],
            [$sites[0], 'file2.lang', 'en-US', true],
            [$sites[0], 'file2.lang', 'all', true],
        ];
    }

    /**
     * @dataProvider isObsoleteFileDP
     */
    public function testIsObsoleteFile($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->boolean($obj->isObsoleteFile($a, $b, $c))
                ->isEqualTo($d);
    }

    public function isExcludedErrorCheckDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'tags', false],
            [$sites[0], 'foo', false],
            [$sites[2], 'tags', true],
        ];
    }

    /**
     * @dataProvider isExcludedErrorCheckDP
     */
    public function testIsExcludedErrorCheck($a, $b, $c)
    {
        $obj = new _Project();
        $this
            ->boolean($obj->isExcludedErrorCheck($a, $b))
                ->isEqualTo($c);
    }

    public function getFileFlagsDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'file1.lang', 'en-US', []],
            [$sites[0], 'file2.lang', 'en-US', ['obsolete', 'testflag1']],
            [$sites[0], 'file2.lang', 'fr', ['obsolete', 'testflag1', 'testflag2']],
            [$sites[1], 'file3.lang', 'en-US', []],
        ];
    }

    /**
     * @dataProvider getFileFlagsDP
     */
    public function testGetFileFlags($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->array($obj->getFileFlags($a, $b, $c))
                ->isEqualTo($d);
    }

    public function getFilePriorityDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'file1.lang', 'en-US', 3],
            [$sites[0], 'file1.lang', 'fr', 1],
            [$sites[0], 'file2.lang', 'en-US', 2],
            [$sites[0], 'file2.lang', 'de', 2],
            [$sites[0], 'file2.lang', 'fr', 3],
            [$sites[1], 'file3.lang', 'en-US', 2],
            [$sites[1], 'file4.lang', 'en-US', 1],
            [$sites[1], 'file6.lang', 'fr', 4],
            [$sites[1], 'file6.lang', 'en-US', 5],
        ];
    }

    /**
     * @dataProvider getFilePriorityDP
     */
    public function testGetFilePriorityDP($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->integer($obj->getFilePriority($a, $b, $c))
                ->isEqualTo($d);
    }

    public function getFileDeadlineDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'file1.lang', 'fr', '2017-01-30'],
            [$sites[0], 'file2.lang', 'fr', ''],
            [$sites[1], 'file3.lang', 'fr', '2017-01-30'],
            [$sites[1], 'file4.lang', 'fr', '2017-01-30'],
            [$sites[1], 'file4.lang', 'de', ''],
            [$sites[1], 'file5.lang', 'de', '2017-01-30'],
            [$sites[1], 'file5.lang', 'fr', '2017-02-15'],
            [$sites[1], 'file6.lang', 'de', '2017-01-30'],
            [$sites[1], 'file6.lang', 'fr', '2017-02-15'],
        ];
    }

    /**
     * @dataProvider getFileDeadlineDP
     */
    public function testGetFileDeadline($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->string($obj->getFileDeadline($a, $b, $c))
                ->isEqualTo($d);
    }

    public function isSupportedLocaleDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'de', '', false],
            [$sites[1], 'de', '', true],
            [$sites[0], 'de', 'file1.lang', false],
            [$sites[0], 'fr', 'file1.lang', true],
            [$sites[0], 'fr', 'file2.lang', true],
        ];
    }

    /**
     * @dataProvider isSupportedLocaleDP
     */
    public function testIsSupportedLocale($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->boolean($obj->isSupportedLocale($a, $b, $c))
                ->isEqualTo($d);
    }

    public function getWebsiteNameDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'reponame1'],
            [$sites[1], 'reponame2'],
        ];
    }

    /**
     * @dataProvider getWebsiteNameDP
     */
    public function testGetWebsiteName($a, $b)
    {
        $obj = new _Project();
        $this
            ->string($obj->getWebsiteName($a))
                ->isEqualTo($b);
    }

    public function getWebsiteFilesDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], true, ['file1.lang', 'file2.lang']],
            [$sites[1], true, ['file3.lang', 'file4.lang', 'file5.lang', 'file6.lang']],
            [
                $sites[1],
                false,
                [
                    'file3.lang' => [
                        'deadline' => '2017-01-30',
                        'priority' => 2,
                    ],
                    'file4.lang' => [
                        'deadline' => [
                            '2017-01-30' => ['fr'],
                        ],
                    ],
                    'file5.lang' => [
                        'deadline' => [
                            '2017-01-30' => ['de'],
                            '2017-02-15' => ['all'],
                        ],
                    ],
                    'file6.lang' => [
                        'deadline' => [
                            '2017-02-15' => ['all'],
                            '2017-01-30' => ['de'],
                        ],
                        'priority' => [
                            5 => ['all'],
                            4 => ['fr'],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider getWebsiteFilesDP
     */
    public function testGetWebsiteFiles($a, $b, $c)
    {
        $obj = new _Project();
        $this
            ->array($obj->getWebsiteFiles($a, $b))
                ->isEqualTo($c);
    }

    public function getLocalFilePathDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'fr', 'test.lang', '/private/repo1/locales/fr/test.lang'],
            [$sites[1], 'de', 'file1.lang', '/private/repo2/l10n/de/file1.lang'],
            [$sites[1], '', '', '/private/repo2/l10n/'],
        ];
    }

    /**
     * @dataProvider getLocalFilePathDP
     */
    public function testLocalGetFilePath($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->string($obj->getLocalFilePath($a, $b, $c))
                ->isEqualTo($d);
    }

    public function getPublicFilePathDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'fr', 'test.lang', '/public/repo1/locales/fr/test.lang'],
            [$sites[1], 'de', 'file1.lang', '/public/repo2/l10n/de/file1.lang'],
        ];
    }

    /**
     * @dataProvider getPublicFilePathDP
     */
    public function testPublicGetFilePath($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->string($obj->getPublicFilePath($a, $b, $c))
                ->isEqualTo($d);
    }

    public function getPontoonEditLinkDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'fr', 'test.lang', ['fr'], 'https://pontoon.mozilla.org/fr/pontoontest1/test.lang'],
            [$sites[1], 'de', 'file1.lang', ['fr'], ''],
        ];
    }

    /**
     * @dataProvider getPontoonEditLinkDP
     */
    public function testGetPontoonEditLinkDP($a, $b, $c, $d, $e)
    {
        $obj = new _Project();
        $this
            ->string($obj->getPontoonEditLink($a, $b, $c, $d))
                ->isEqualTo($e);
    }

    public function getPublicRepoPathDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'fr', '/public/repo1/locales/fr/'],
            [$sites[1], 'de', '/public/repo2/l10n/de/'],
        ];
    }

    /**
     * @dataProvider getPublicRepoPathDP
     */
    public function testPublicGetRepoPath($a, $b, $c)
    {
        $obj = new _Project();
        $this
            ->string($obj->getPublicRepoPath($a, $b))
                ->isEqualTo($c);
    }

    public function testGetWebsitesByDataType()
    {
        require_once TEST_FILES . 'config/sources.php';

        $obj = new _Project();
        $this
            ->integer(count($obj->getWebsitesByDataType($sites, 'lang')))
                ->isEqualTo(4);

        $this
            ->integer(count($obj->getWebsitesByDataType($sites, 'raw')))
                ->isEqualTo(1);
    }

    public function getWebsiteDataTypeDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], 'lang'],
            [$sites[3], 'raw'],
        ];
    }

    /**
     * @dataProvider getWebsiteDataTypeDP
     */
    public function testGetWebsiteDataType($a, $b)
    {
        $obj = new _Project();
        $this
            ->string($obj->getWebsiteDataType($a))
                ->isEqualTo($b);
    }

    public function getWebsiteLocalRepositoryDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], '/private/repo1/'],
            [$sites[1], '/private/repo2/'],
        ];
    }

    /**
     * @dataProvider getWebsiteLocalRepositoryDP
     */
    public function testGetWebsiteLocalRepository($a, $b)
    {
        $obj = new _Project();
        $this
            ->string($obj->getWebsiteLocalRepository($a))
                ->isEqualTo($b);
    }

    public function getWebsiteErrorExclusionListDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [$sites[0], []],
            [$sites[2], ['tags']],
        ];
    }

    /**
     * @dataProvider getWebsiteErrorExclusionListDP
     */
    public function testGetWebsiteErrorExclusionList($a, $b)
    {
        $obj = new _Project();
        $this
            ->array($obj->getWebsiteErrorExclusionList($a))
                ->isEqualTo($b);
    }

    public function getLocalizedURLDP()
    {
        return [
            [
                ['url' => 'https://www-dev.allizom.org/%LOCALE%/firefox'],
                'it',
                'txt',
                'https://www-dev.allizom.org/it/firefox',
            ],
            [
                ['url' => 'https://www-dev.allizom.org/%LOCALE%/firefox'],
                'it',
                'html',
                '<a href=\'https://www-dev.allizom.org/it/firefox\' class=\'table_small_link\'>view</a>',
            ],
            [
                ['url' => 'https://www.allizom.org/firefox'],
                'it',
                'txt',
                'https://www.allizom.org/firefox',
            ],
            [
                ['url' => 'https://www.mozilla.org/%LOCALE%/firefox'],
                '',
                'txt',
                'https://www.mozilla.org/firefox',
            ],
            [
                [],
                '',
                'txt',
                '-',
            ],
        ];
    }

    /**
     * @dataProvider getLocalizedURLDP
     */
    public function testGetLocalizedURL($a, $b, $c, $d)
    {
        $obj = new _Project();
        $this
            ->string($obj->getLocalizedURL($a, $b, $c))
                ->isEqualTo($d);
    }

    public function getUserBaseCoverageDP()
    {
        $adu = [
            'en-US'     => '10000',
            'fr'        => '2000',
            'it'        => '1000',
            'es-AR'     => '250',
            'es-ES'     => '250',
            'en-GB'     => '500',
            'ja'        => '250',
            'ja-JP-mac' => '250',
        ];

        return [
            [['it'], $adu, '25.00'],
            [['fr'], $adu, '50.00'],
            [['es'], $adu, '11.11'],
            [['es-ES'], $adu, '6.25'],
            [['it', 'fr'], $adu, '75.00'],
        ];
    }

    /**
     * @dataProvider getUserBaseCoverageDP
     */
    public function testgetUserBaseCoverage($a, $b, $c)
    {
        $obj = new _Project();
        $this
            ->string($obj->getUserBaseCoverage($a, $b))
                ->isEqualTo($c);
    }

    public function selectViewDP()
    {
        return [
            [
                [
                    'action'   => 'activation',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'activation',
                ],
            ],
            [
                [
                    'action'   => 'count',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'countstrings',
                ],
            ],
            [
                [
                    'action'   => 'count',
                    'filename' => '',
                    'json'     => true,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'countstrings',
                ],
            ],
            [
                [
                    'action'   => 'coverage',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'getcoverage',
                ],
            ],
            [
                [
                    'action'   => 'errors',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'errors',
                ],
            ],
            [
                [
                    'action'   => 'listlocales',
                    'filename' => '',
                    'json'     => true,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'listlocalesforproject',
                ],
            ],
            [
                [
                    'action'   => 'listlocales',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'listlocales',
                ],
            ],
            [
                [
                    'action'   => 'listpages',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',                ],
                [
                    'file' => 'listpages',
                ],
            ],
            [
                [
                    'action'   => 'listpages',
                    'filename' => '',
                    'json'     => true,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',                ],
                [
                    'file' => 'listpages_api',
                ],
            ],
            [
                [
                    'action'   => 'optin',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',                ],
                [
                    'file' => 'optin',
                ],
            ],
            [
                [
                    'action'   => 'snippets',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => 'it',
                    'serial'   => false,
                    'website'  => '',                ],
                [
                    'file' => 'snippets_api',
                ],
            ],
            [
                [
                    'action'   => 'translate',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'translatestrings',
                ],
            ],
            [
                [
                    'action'   => 'translate',
                    'filename' => '',
                    'json'     => true,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'translatestrings',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => 'test.lang',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '0',
                ],
                [
                    'file' => 'globalstatus',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => 'test.lang',
                    'json'     => false,
                    'locale'   => 'it',
                    'serial'   => false,
                    'website'  => '0',
                ],
                [
                    'file' => 'globalstatus',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => 'test.lang',
                    'json'     => true,
                    'locale'   => 'it',
                    'serial'   => false,
                    'website'  => '0',
                ],
                [
                    'file' => 'globalstatus_api',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => 'test.lang',
                    'json'     => true,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '0',
                ],
                [
                    'file' => 'globalstatus_api',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => 'it',
                    'serial'   => true,
                    'website'  => '',
                ],
                [
                    'file' => 'export',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => '',
                    'json'     => true,
                    'locale'   => 'it',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'export',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => true,
                    'website'  => '',
                ],
                [
                    'file' => 'listlocales',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => 'it',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'listsitesforlocale',
                ],
            ],
            [
                [
                    'action'   => '',
                    'filename' => '',
                    'json'     => false,
                    'locale'   => '',
                    'serial'   => false,
                    'website'  => '',
                ],
                [
                    'file' => 'listlocales',
                ],
            ],
        ];
    }

    /**
     * @dataProvider selectViewDP
     */
    public function testSelectView($a, $b)
    {
        $obj = new _Project();
        $this
            ->array($obj->selectView($a))
                ->isEqualTo($b);
    }
}
