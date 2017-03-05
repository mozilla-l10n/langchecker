<?php

$mozilla = ['en-US', 'fr', 'it'];
$slogans_locales = ['fr', 'it'];

$repo0_langfiles = [
    'file1.lang' => [
        'supported_locales' => ['fr'],
        'deadline'          => '2017-01-30',
        'flags'             => [
            'obsolete' => ['fr'],
        ],
        'priority' => [
            1 => ['fr'],
        ],
    ],
    'file2.lang' => [
        'flags' => [
            'obsolete'  => ['all'],
            'testflag1' => ['all'],
            'testflag2' => ['fr'],
        ],
        'priority' => [
            3 => ['fr'],
            2 => ['all'],
        ],
    ],
];

$repo1_langfiles = [
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
];

$repo2_langfiles = [
    'page.lang' => [],
];

$repo3_langfiles = [
    'email1.txt' => [],
    'email2.txt' => [],
    'email3.txt' => [],
    'email4.txt' => [],
    'email5.txt' => [],
];

$repo6_langfiles = [
    'page.lang' => [],
];

$sites = [
    0 => [
        'reponame1',
        '/private/repo1/',
        'locales/',
        ['en-US', 'fr'],
        $repo0_langfiles,
        'en-GB',
        '/public/repo1/',
        3,
        'lang',
    ],

    1 => [
        'reponame2',
        '/private/repo2/',
        'l10n/',
        ['en-US', 'fr', 'de'],
        $repo1_langfiles,
        'en-US',
        '/public/repo2/',
        1,
        'lang',
    ],

    2 => [
        'parsing_test',
        __DIR__ . '/../dotlang/',
        '',
        ['en-US', 'it'],
        $repo2_langfiles,
        'en-US',
        '/public/repo3/',
        1,
        'lang',
    ],

    3 => [
        'txt_test',
        __DIR__ . '/../txt/',
        '',
        ['en-US', 'it'],
        $repo3_langfiles,
        'en-US',
        '/public/repo3/',
        1,
        'raw',
    ],

    6 => [
        'snippets',
        __DIR__ . '/../dotlang/',
        '',
        ['en-US', 'fr', 'it'],
        $repo6_langfiles,
        'en-US',
        '/public/repo6/',
        1,
        'lang',
    ],
];
