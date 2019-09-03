<?php

// This is to avoid a warning in shell mode
if (! isset($_SERVER['SERVER_NAME'])) {
    $_SERVER['SERVER_NAME'] = '';
}

// Real data is in adi.inc.php, not under VCS
if (is_file(__DIR__ . '/adi.inc.php')) {
    include __DIR__ . '/adi.inc.php';
} else {
    // Fake data to not break the app outside of production
    include __DIR__ . '/fake_adi.inc.php';
}

// Make sure there is an array available to avoid further checks
if (! isset($override_local)) {
    $override_local = [];
}

$repo_local_path = function ($id, $folder) use ($local_storage, $override_local) {
    return isset($override_local[$id]) ?
        $override_local[$id] :
        "{$local_storage}{$folder}/";
};

/*
    List of supported repositories. Structure of the array
    ID (website name)
    |
    |__ local_path  = Path to the local repository (must end with slash)
    |__ public_path = Path used to create links to individual files
    |__ repository  = URL of the repository (for cloning)
    |__ vcs         = Type of VCS (git, svn)
*/
$repositories = [
    'www.mozilla.org' => [
        'local_path'  => $repo_local_path('www.mozilla.org', 'mozilla_org'),
        'public_path' => 'https://github.com/mozilla-l10n/www.mozilla.org/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/www.mozilla.org',
        'vcs'         => 'git',
    ],
    'engagement' => [
        'local_path'  => $repo_local_path('engagement', 'engagement-l10n'),
        'public_path' => 'https://github.com/mozilla-l10n/engagement-l10n/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/engagement-l10n',
        'vcs'         => 'git',
    ],
    'appstores' => [
        'local_path'  => $repo_local_path('appstores', 'appstores'),
        'public_path' => 'https://github.com/mozilla-l10n/appstores/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/appstores',
        'vcs'         => 'git',
    ],
];

/*
    Array structure for single website:
    [
       0 name,
       1 path to local repo,
       2 folder containing locale files,
       3 array of supported locale,
       4 array of supported file and associated data,
       5 reference locale,
       6 url to public repo,
       7 default priority,
       8 type of files (lang, raw),
       9 project name on Pontoon,
       10 array of excluded error checks (tags)
    ]
*/

$sites =
[
    0 => [
        'www.mozilla.org',
        $repositories['www.mozilla.org']['local_path'],
        '',
        $mozillaorg,
        $mozillaorg_lang,
        'en-US', // source locale
        $repositories['www.mozilla.org']['public_path'],
        3,
        'lang',
        'mozillaorg',
        [],
    ],
    6 => [
        'engagement',
        $repositories['engagement']['local_path'],
        '',
        $engagement_locales,
        $engagement_lang,
        'en-US', // source locale
        $repositories['engagement']['public_path'],
        1,
        'lang',
        'engagement',
        ['tags'],
    ],
];
