<?php

$priorities = [
    'file1.lang' => [
        'critical' => ['all'],
        'obsolete' => ['fr'],
    ],
    'file2.lang' => [
        'critical'  => ['fr'],
        'obsolete'  => ['all'],
        'testflag1' => ['all'],
        'testflag2' => ['fr'],
    ],
];

$sites = [
    0 => [
        'reponame1',
        '/private/repo1/',
        'locales/',
        ['en-US', 'fr'],
        ['file1.lang', 'file2.lang'],
        'en-GB',
        '/public/repo1/',
        $priorities,
        'lang',
    ],

    1 => [
        'reponame2',
        '/private/repo2/',
        'l10n/',
        ['en-US', 'fr', 'de'],
        ['file3.lang', 'file4.lang'],
        'en-US',
        '/public/repo2/',
        [],
        'lang',
    ],

    2 => [
        'parsing_test',
        __DIR__ . '/../dotlang/',
        '',
        ['en-US', 'it'],
        ['page.lang'],
        'en-US',
        '/public/repo3/',
        [],
        'lang',
    ],

    3 => [
        'txt_test',
        __DIR__ . '/../txt/',
        '',
        ['en-US', 'it'],
        ['email1.txt', 'email2.txt', 'email3.txt', 'email4.txt', 'email5.txt'],
        'en-US',
        '/public/repo3/',
        [],
        'raw',
    ],
    6 => [
        'snippets',
        __DIR__ . '/../dotlang/',
        '',
        ['en-US', 'fr', 'it'],
        ['page.lang'],
        'en-US',
        '/public/repo6/',
        [],
        'lang',
    ],
];

$langfiles_subsets = [
    'reponame1' => [
        'file1.lang' => ['fr'],
    ],
];

$snippets_locales = ['fr', 'it'];

$mozilla = ['en-US', 'fr', 'it'];
