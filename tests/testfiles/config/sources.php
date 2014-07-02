<?php

$priorities = [
    'file1.lang' => true,
    'file2.lang' => false,
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
        $priorities
    ],

    1 => [
        'reponame2',
        '/private/repo2/',
        'l10n/',
        ['en-US', 'fr', 'de'],
        ['file3.lang', 'file4.lang'],
        'en-US',
        '/public/repo2/',
        []
    ],

    2 => [
        'parsing_test',
        __DIR__ . '/../dotlang/',
        '',
        ['en-US', 'it'],
        ['page.lang'],
        'en-US',
        '/public/repo3/',
        []
    ],
];

$langfiles_subsets = [
    'reponame1' => [
        'file1.lang' => ['fr']
    ],
];
