<?php

// This is to avoid a warning in shell mode
if (! isset($_SERVER['SERVER_NAME'])) {
    $_SERVER['SERVER_NAME'] = '';
}

$settings_file = __DIR__ . '/settings.inc.php';
if (! file_exists($settings_file)) {
    die('File app/config/settings.inc.php is missing. Please check your configuration.');
} else {
    require $settings_file;
    if (! isset($local_storage)) {
        die('$local_storage is missing in your configuration file. Please update app/config/settings.inc.php');
    }
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
    'start.mozilla.org' => [
        'local_path'  => $repo_local_path('start.mozilla.org', 'fx36start-l10n'),
        'public_path' => 'https://github.com/mozilla-l10n/fx36start-l10n/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/fx36start-l10n',
        'vcs'         => 'git',
    ],
    'about:healthreport' => [
        'local_path'  => $repo_local_path('about:healthreport', 'fhr-l10n'),
        'public_path' => 'https://github.com/mozilla-l10n/fhr-l10n/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/fhr-l10n',
        'vcs'         => 'git',
    ],
    'engagement' => [
        'local_path'  => $repo_local_path('engagement', 'engagement-l10n'),
        'public_path' => 'https://github.com/mozilla-l10n/engagement-l10n/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/engagement-l10n',
        'vcs'         => 'git',
    ],
    'add-ons' => [
        'local_path'  => $repo_local_path('add-ons', 'addons-l10n'),
        'public_path' => 'https://github.com/mozilla-l10n/addons-l10n/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/addons-l10n',
        'vcs'         => 'git',
    ],
    'firefoxos-marketing' => [
        'local_path'  => $repo_local_path('firefoxos-marketing', 'fxosmarketing-l10n'),
        'public_path' => 'https://github.com/mozilla-l10n/fxosmarketing-l10n/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/fxosmarketing-l10n',
        'vcs'         => 'git',
    ],
    'contribute-autoreplies' => [
        'local_path'  => $repo_local_path('www.mozilla.org', 'mozilla_org'),
        'public_path' => 'https://github.com/mozilla-l10n/www.mozilla.org/tree/master/',
        'repository'  => 'https://github.com/mozilla-l10n/www.mozilla.org',
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
    Flags are defined for each website later in the file. For each file in
    a website it's possible to specify flags, and for which locales these flags
    are valid.
    Currently we're using flags to tag files as critical, obsolete and opt-in.

    If a file is not listed, it's assumed to be non critical for all locales.
    If a flag is valid for all locales, set it to ['all']. If it's not,
    set the flag to the array of locales.

    Example (a file critical for French but opt-in for all other locales):
    $lang_flags['website_name'] = [
        'file.lang' => [
            'critical' => ['fr'],
            'opt-in'   => ['all'],
        ],
    ];
*/
$lang_flags = [];

$mozillaorg_lang = [
    'download.lang',
    'download_button.lang',
    'esr.lang',
    'firefox/android/index.lang',
    'firefox/australis/firefox_tour.lang',
    'firefox/australis/fx36_tour.lang',
    'firefox/channel.lang',
    'firefox/choose.lang',
    'firefox/desktop/customize.lang',
    'firefox/desktop/fast.lang',
    'firefox/desktop/index.lang',
    'firefox/desktop/tips.lang',
    'firefox/desktop/trust.lang',
    'firefox/developer.lang',
    'firefox/dnt.lang',
    'firefox/family/index.lang',
    'firefox/geolocation.lang',
    'firefox/hello.lang',
    'firefox/hello-2016.lang',
    'firefox/includes/mwc_2015_schedule.lang',
    'firefox/installer-help.lang',
    'firefox/ios.lang',
    'firefox/new.lang',
    'firefox/nightly_firstrun.lang',
    'firefox/os/devices.lang',
    'firefox/os/faq.lang',
    'firefox/os/index-new.lang',
    'firefox/os/index.lang',
    'firefox/os/tv.lang',
    'firefox/pocket.lang',
    'firefox/privacy_tour/privacy_tour.lang',
    'firefox/private-browsing.lang',
    'firefox/sendto.lang',
    'firefox/speed.lang',
    'firefox/sync.lang',
    'firefox/tracking-protection-tour.lang',
    'firefox/whatsnew_38.lang',
    'firefox/whatsnew_42.lang',
    'firefox/win10-welcome.lang',
    'foundation/annualreport/2011.lang',
    'foundation/annualreport/2011faq.lang',
    'foundation/annualreport/2012/faq.lang',
    'foundation/annualreport/2012/index.lang',
    'legal/index.lang',
    'lightbeam/lightbeam.lang',
    'main.lang',
    'mobile.lang',
    'mozorg/404.lang',
    'mozorg/about.lang',
    'mozorg/about/history-details.lang',
    'mozorg/about/history.lang',
    'mozorg/about/leadership.lang',
    'mozorg/about/manifesto.lang',
    'mozorg/contribute.lang',
    'mozorg/contribute/friends.lang',
    'mozorg/contribute/index.lang',
    'mozorg/contribute/stories.lang',
    'mozorg/home/index.lang',
    'mozorg/mission.lang',
    'mozorg/newsletters.lang',
    'mozorg/plugincheck.lang',
    'mozorg/products.lang',
    'newsletter.lang',
    'privacy/index.lang',
    'privacy/principles.lang',
    'tabzilla/tabzilla.lang',
    'teach/smarton/index.lang',
    'teach/smarton/security.lang',
    'teach/smarton/surveillance.lang',
    'teach/smarton/tracking.lang',
    'thunderbird/channel.lang',
    'thunderbird/features.lang',
    'thunderbird/index.lang',
    'thunderbird/start/release.lang',
];

$lang_flags['www.mozilla.org'] = [
    'download.lang'                           => [ 'critical' => ['all'] ],
    'download_button.lang'                    => [ 'critical' => ['all'] ],
    'firefox/android/index.lang'              => [
        'critical' => [$android_locales],
        'opt-in'   => ['all'],
    ],
    'firefox/australis/firefox_tour.lang'     => [ 'critical' => ['all'] ],
    'firefox/australis/fx36_tour.lang'        => [ 'critical' => ['all'] ],
    'firefox/channel.lang'                    => [ 'critical' => ['all'] ],
    'firefox/choose.lang'                     => [ 'critical' => ['all'] ],
    'firefox/family/index.lang'               => [ 'critical' => ['all'] ],
    'firefox/desktop/customize.lang'          => [ 'critical' => ['all'] ],
    'firefox/desktop/fast.lang'               => [ 'critical' => ['all'] ],
    'firefox/desktop/index.lang'              => [ 'critical' => ['all'] ],
    'firefox/desktop/trust.lang'              => [ 'critical' => ['all'] ],
    'firefox/desktop/tips.lang'               => [
        'critical' => ['all'],
        'opt-in'   => ['all'],
    ],
    'firefox/dnt.lang'                        => [ 'opt-in'   => ['all'] ],
    'firefox/geolocation.lang'                => [ 'opt-in'   => ['all'] ],
    'firefox/hello.lang'                      => [ 'obsolete' => ['all'] ],
    'firefox/hello-2016.lang'                 => [ 'critical' => ['all'] ],
    'firefox/installer-help.lang'             => [ 'critical' => ['all'] ],
    'firefox/ios.lang'                        => [
        'critical' => [$apple_store_target],
        'opt-in'   => ['all'],
    ],
    'firefox/new.lang'                        => [ 'critical' => ['all'] ],
    'firefox/os/faq.lang'                     => [ 'obsolete' => ['all'] ],
    'firefox/os/index-new.lang'               => [ 'obsolete' => ['all'] ],
    'firefox/os/index.lang'                   => [ 'opt-in'   => ['all'] ],
    'firefox/pocket.lang'                     => [ 'critical' => ['all'] ],
    'firefox/privacy_tour/privacy_tour.lang'  => [ 'critical' => ['all'] ],
    'firefox/private-browsing.lang'           => [ 'critical' => ['all'] ],
    'firefox/sendto.lang'                     => [ 'critical' => ['all'] ],
    'firefox/sync.lang'                       => [ 'critical' => ['all'] ],
    'firefox/tracking-protection-tour.lang'   => [ 'critical' => ['all'] ],
    'firefox/whatsnew_38.lang'                => [ 'critical' => ['all'] ],
    'firefox/whatsnew_42.lang'                => [ 'critical' => ['all'] ],
    'firefox/win10-welcome.lang'              => [ 'critical' => ['all'] ],
    'foundation/annualreport/2012/index.lang' => [ 'critical' => ['all'] ],
    'legal/index.lang'                        => [ 'critical' => ['all'] ],
    'lightbeam/lightbeam.lang'                => [ 'opt-in'   => ['all'] ],
    'main.lang'                               => [ 'critical' => ['all'] ],
    'mobile.lang'                             => [ 'critical' => ['all'] ],
    'mozorg/about/leadership.lang'            => [ 'opt-in'   => ['all'] ],
    'mozorg/about/manifesto.lang'             => [ 'opt-in'   => ['all'] ],
    'mozorg/about/history.lang'               => [ 'opt-in'   => ['all'] ],
    'mozorg/about/history-details.lang'       => [ 'opt-in'   => ['all'] ],
    'mozorg/contribute.lang'                  => [ 'obsolete' => ['all'] ],
    'mozorg/contribute/friends.lang'          => [
        'critical' => ['es-ES', 'pt-BR'],
    ],
    'mozorg/contribute/index.lang'            => [
        'critical' => ['all'],
        'opt-in'   => ['all'],
    ],
    'mozorg/contribute/stories.lang'          => [
        'critical' => ['all'],
        'opt-in'   => ['all'],
    ],
    'mozorg/home/index.lang'                  => [ 'critical' => ['all'] ],
    'mozorg/newsletters.lang'                 => [
        'critical' => $newsletter_locales,
    ],
    'mozorg/plugincheck.lang'                 => [ 'critical' => ['all'] ],
    'tabzilla/tabzilla.lang'                  => [ 'obsolete' => ['all'] ],
    'teach/smarton/index.lang'                => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'teach/smarton/security.lang'             => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'teach/smarton/surveillance.lang'         => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'teach/smarton/tracking.lang'             => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'thunderbird/channel.lang'                => [
        'opt-in' => $thunderbird_locales,
    ],
    'thunderbird/start/release.lang'          => [ 'critical' => ['all'] ],
];

$startpage36_lang = ['fx36start.lang'];
$lang_flags['start.mozilla.org'] = [
    'fx36start.lang' => [ 'critical' => ['all'] ],
];

$firefoxhealthreport_lang = ['fhr.lang'];
$lang_flags['about:healthreport'] = [
    'fhr.lang' => [ 'critical' => ['all'] ],
];

$engagement_lang = [
    'ios/ios_ads_nov2015.lang',
    'snippets/2014/jan2014.lang',
    'snippets/2014/apr2014.lang',
    'snippets/2014/may2014.lang',
    'snippets/2014/jun2014.lang',
    'snippets/2014/aug2014_a.lang',
    'snippets/2014/aug2014_b.lang',
    'snippets/2014/aug2014_c.lang',
    'snippets/2014/aug2014_d.lang',
    'snippets/2014/sep2014_a.lang',
    'snippets/2014/sep2014_b.lang',
    'snippets/2014/sep2014_c.lang',
    'snippets/2014/sep2014_d.lang',
    'snippets/2014/sep2014_e.lang',
    'snippets/2014/nov2014_a.lang',
    'snippets/2014/nov2014_b.lang',
    'snippets/2014/nov2014_c.lang',
    'snippets/2014/nov2014_d.lang',
    'snippets/2014/nov2014_e.lang',
    'snippets/2014/dec2014_a.lang',
    'snippets/2014/dec2014_c.lang',
    'snippets/2015/jan2015a_a.lang',
    'snippets/2015/jan2015a_b.lang',
    'snippets/2015/jan2015a_c.lang',
    'snippets/2015/jan2015a_d.lang',
    'snippets/2015/jan2015b_a.lang',
    'snippets/2015/jan2015b_b.lang',
    'snippets/2015/feb2015_a.lang',
    'snippets/2015/feb2015_b.lang',
    'snippets/2015/feb2015_c.lang',
    'snippets/2015/feb2015_d.lang',
    'snippets/2015/feb2015_e.lang',
    'snippets/2015/mar2015_a.lang',
    'snippets/2015/mar2015_b.lang',
    'snippets/2015/apr2015.lang',
    'snippets/2015/may2015_a.lang',
    'snippets/2015/may2015_b.lang',
    'snippets/2015/spring2015.lang',
    'snippets/2015/jun2015_a.lang',
    'snippets/2015/jun2015_b.lang',
    'snippets/2015/jun2015_c.lang',
    'snippets/2015/jun2015_d.lang',
    'snippets/2015/jul2015_a.lang',
    'snippets/2015/jul2015_b.lang',
    'snippets/2015/jul2015_c.lang',
    'snippets/2015/aug2015_a.lang',
    'snippets/2015/aug2015_b.lang',
    'snippets/2015/aug2015_c.lang',
    'snippets/2015/aug2015_win10.lang',
    'snippets/2015/sep2015.lang',
    'snippets/2015/sep2015_ios.lang',
    'snippets/2015/oct2015_a.lang',
    'snippets/2015/oct2015_b.lang',
    'snippets/2015/oct2015_c.lang',
    'snippets/2015/oct2015_mofo.lang',
    'snippets/2015/fall2015.lang',
    'snippets/2015/nov2015_eoy_mofo.lang',
    'snippets/2015/nov2015_a.lang',
    'snippets/2015/nov2015_b.lang',
    'snippets/2015/dec2015_a.lang',
    'snippets/2015/dec2015_b.lang',
    'snippets/2016/jan2016.lang',
    'snippets/2016/feb2016.lang',
    'snippets/2016/mar2016.lang',
    'surveys/survey_hello_fx42.lang',
    'tiles/careers.lang',
    'tiles/suggestedtiles_infographic.lang',
    'tiles/2015/tiles_jul2015.lang',
    'tiles/2015/tiles_aug2015.lang',
    'tiles/2015/tiles_sep2015.lang',
    'tiles/2015/tiles_oct2015.lang',
    'tiles/2015/tiles_nov2015.lang',
    'tiles/2016/tiles_jan2016.lang',
];
$lang_flags['engagement'] = [
    'ios/ios_ads_nov2015.lang'            => [ 'critical' => ['all'] ],
    'snippets/2015/fall2015.lang'         => [ 'critical' => ['all'] ],
    'snippets/2015/nov2015_eoy_mofo.lang' => [ 'critical' => ['all'] ],
    'snippets/2015/nov2015_a.lang'        => [ 'critical' => ['all'] ],
    'snippets/2015/nov2015_b.lang'        => [ 'critical' => ['all'] ],
    'snippets/2015/dec2015_a.lang'        => [ 'critical' => ['all'] ],
    'snippets/2015/dec2015_b.lang'        => [ 'critical' => ['all'] ],
    'snippets/2016/jan2016.lang'          => [ 'critical' => ['all'] ],
    'snippets/2016/feb2016.lang'          => [ 'critical' => ['all'] ],
    'snippets/2016/mar2016.lang'          => [ 'critical' => ['all'] ],
    'tiles/careers.lang'                  => [ 'critical' => ['de', 'fr'] ],
    'tiles/2015/tiles_oct2015.lang'       => [ 'critical' => ['all'] ],
    'tiles/2015/tiles_nov2015.lang'       => [ 'critical' => ['all'] ],
    'tiles/2016/tiles_jan2016.lang'       => [ 'critical' => ['all'] ],
];

$addons_lang = [
    'homefeeds.lang',
    'privacycoach.lang',
    'worldcup.lang',
];
$lang_flags['add-ons'] = [];

$fxos_marketing_lang = [
    'marketplace/marketplace_l10n_feed.lang',
    'screenshots/screenshots_2_0.lang',
    'screenshots/screenshots_2_0_b.lang',
    'screenshots/screenshots_dolphin.lang',
    'screenshots/screenshots.lang',
    'screenshots/screenshots_tarako.lang',
    'slogans/firefoxos.lang',
    'slogans/marketplacebadge.lang',
];
$lang_flags['firefoxos-marketing'] = [];

$appstores_lang = [
    'description_beta_page.lang',
    'apple_description_release.lang',
    'android_42_release.lang',
    'whatsnew/whatsnew_android_44.lang',
];

$lang_flags['appstores'] = [
    'apple_description_release.lang' => [
        'critical' => ['de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru', 'zh-CN'],
    ],
    'android_42_release.lang' => [
        'critical' => ['de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru', 'zh-CN'],
    ],
];

$getinvolved_autoreplies = [
    'templates/mozorg/contribute-2015/activism.txt',
    'templates/mozorg/contribute-2015/coding_addons.txt',
    'templates/mozorg/contribute-2015/coding_cloud.txt',
    'templates/mozorg/contribute-2015/coding_firefox.txt',
    'templates/mozorg/contribute-2015/coding_firefoxos.txt',
    'templates/mozorg/contribute-2015/coding_marketplace.txt',
    'templates/mozorg/contribute-2015/coding_webcompat.txt',
    'templates/mozorg/contribute-2015/coding_webdev.txt',
    'templates/mozorg/contribute-2015/dontknow.txt',
    'templates/mozorg/contribute-2015/education_fellowships.txt',
    'templates/mozorg/contribute-2015/education_hive.txt',
    'templates/mozorg/contribute-2015/education_sciencelab.txt',
    'templates/mozorg/contribute-2015/education_webmaker.txt',
    'templates/mozorg/contribute-2015/generic_template.txt',
    'templates/mozorg/contribute-2015/l10n_product.txt',
    'templates/mozorg/contribute-2015/l10n_tools.txt',
    'templates/mozorg/contribute-2015/l10n_web.txt',
    'templates/mozorg/contribute-2015/qa_addons.txt',
    'templates/mozorg/contribute-2015/qa_general.txt',
    'templates/mozorg/contribute-2015/qa_marketplace.txt',
    'templates/mozorg/contribute-2015/qa_webcompat.txt',
    'templates/mozorg/contribute-2015/sumo_sumo.txt',
    'templates/mozorg/contribute-2015/sumo_webcompat.txt',
    'templates/mozorg/contribute-2015/writing_addons.txt',
    'templates/mozorg/contribute-2015/writing_journalism.txt',
    'templates/mozorg/contribute-2015/writing_marketplace.txt',
    'templates/mozorg/contribute-2015/writing_social.txt',
    'templates/mozorg/contribute-2015/writing_txt_devs.txt',
    'templates/mozorg/contribute-2015/writing_txt_users.txt',
];

$lang_flags['contribute-autoreplies'] = [
    'templates/mozorg/contribute-2015/activism.txt'              => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_addons.txt'         => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_cloud.txt'          => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_firefox.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_firefoxos.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_marketplace.txt'    => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_webcompat.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/coding_webdev.txt'         => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/dontknow.txt'              => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_fellowships.txt' => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_hive.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_sciencelab.txt'  => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/education_webmaker.txt'    => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/generic_template.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/l10n_product.txt'          => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/l10n_tools.txt'            => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/l10n_web.txt'              => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_addons.txt'             => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_general.txt'            => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_marketplace.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/qa_webcompat.txt'          => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/sumo_sumo.txt'             => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/sumo_webcompat.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_addons.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_journalism.txt'    => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_marketplace.txt'   => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_social.txt'        => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_txt_devs.txt'      => [ 'optional' => ['all'] ],
    'templates/mozorg/contribute-2015/writing_txt_users.txt'     => [ 'optional' => ['all'] ],
];

$no_active_tag = [
    'download.lang',
    'download_button.lang',
    'esr.lang',
    'firefox/includes/mwc_2015_schedule.lang',
    'main.lang',
    'mobile.lang',
    'newsletter.lang',
    'privacy/index.lang',
];

$deadline = [
    'description_beta_page.lang'             => '2015-09-30', // appstores project
    'apple_description_release.lang'         => '2016-03-30', // appstores project
    'android_42_release.lang'                => '2016-03-08', // appstores project
    'download_button.lang'                   => '2015-06-01',
    'firefox/android/index.lang'             => '2015-11-02',
    'firefox/channel.lang'                   => '2015-11-02',
    'firefox/choose.lang'                    => '2015-11-02',
    'firefox/desktop/customize.lang'         => '2015-11-02',
    'firefox/desktop/fast.lang'              => '2015-11-02',
    'firefox/desktop/index.lang'             => '2015-11-02',
    'firefox/desktop/tips.lang'              => '2015-11-02',
    'firefox/desktop/trust.lang'             => '2015-11-02',
    'firefox/developer.lang'                 => '2015-11-18',
    'firefox/family/index.lang'              => '2015-11-03',
    'firefox/hello-2016.lang'                => '2016-03-07',
    'firefox/ios.lang'                       => '2015-11-03',
    'firefox/new.lang'                       => '2015-11-18',
    'firefox/pocket.lang'                    => '2015-06-01',
    'firefox/private-browsing.lang'          => '2015-11-02',
    'firefox/sendto.lang'                    => '2015-06-01',
    'firefox/sync.lang'                      => '2015-06-01',
    'firefox/tracking-protection-tour.lang'  => '2016-02-29',
    'firefox/whatsnew_42.lang'               => '2015-11-02',
    'firefox/win10-welcome.lang'             => '2016-01-25',
    'ios/ios_ads_nov2015.lang'               => '2015-11-18',
    'legal/index.lang'                       => '2016-02-18',
    'main.lang'                              => '2015-11-02',
    'mozorg/about.lang'                      => '2015-03-26',
    'mozorg/contribute/index.lang'           => '2015-08-10',
    'mozorg/contribute/stories.lang'         => '2015-08-10',
    'mozorg/home/index.lang'                 => '2015-11-30',
    'mozorg/plugincheck.lang'                => '2015-08-24',
    'snippets/2015/fall2015.lang'            => '2015-11-02',
    'snippets/2015/nov2015_eoy_mofo.lang'    => '2015-11-02',
    'snippets/2015/nov2015_a.lang'           => '2015-11-14',
    'snippets/2015/nov2015_b.lang'           => '2015-11-14',
    'snippets/2015/dec2015_a.lang'           => '2015-12-14',
    'snippets/2015/dec2015_b.lang'           => '2015-12-14',
    'snippets/2016/jan2016.lang'             => '2016-01-14',
    'snippets/2016/feb2016.lang'             => '2016-02-15',
    'snippets/2016/mar2016.lang'             => '2016-03-01',
    'privacy/principles.lang'                => '2015-09-15',
    'surveys/survey_hello_fx42.lang'         => '2015-09-11',
    'teach/smarton/index.lang'               => '2015-12-31',
    'teach/smarton/security.lang'            => '2015-11-17',
    'teach/smarton/surveillance.lang'        => '2015-12-31',
    'teach/smarton/tracking.lang'            => '2015-11-02',
    'tiles/2015/tiles_sep2015.lang'          => '2015-09-10',
    'tiles/2015/tiles_oct2015.lang'          => '2015-10-11',
    'tiles/2015/tiles_nov2015.lang'          => '2015-11-02',
    'tiles/2016/tiles_jan2016.lang'          => '2016-01-14',
    'thunderbird/start/release.lang'         => '2015-01-31',
];

// List of locales
$addons_locales = [
    'cs', 'de', 'es-ES', 'es-MX', 'fr', 'hu', 'id', 'it', 'ja', 'pl',
    'pt-BR', 'ru', 'sq', 'zh-TW',
];

$firefox_os = [
    'af', 'ar', 'bg', 'bm', 'bn-BD', 'bn-IN', 'ca' , 'cs',
    'de', 'ee', 'el', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
    'fa', 'ff', 'fr', 'fy-NL', 'ha', 'hi-IN', 'hr', 'hu',
    'id', 'ig', 'it', 'ja', 'ko', 'ln', 'mg', 'mk', 'my', 'nl',
    'pl', 'pt-BR', 'ro', 'ru', 'son', 'sq', 'sr', 'sv-SE',
    'sw', 'ta', 'tl', 'tn', 'wo', 'xh', 'yo', 'zh-CN',
    'zh-TW', 'zu',
];

/*
    We have some extra locales on some pages, but they're not shipping and we
    don't want to ask them to translate 600 strings.
*/
$firefox_os_consumer = array_merge($firefox_os, ['et', 'uk']);
$firefox_os_legal = array_merge($firefox_os, ['et']);
$firefox_os_tv = array_merge($firefox_os, ['et']);

$fxos_marketing = [
    'af', 'ar', 'bg', 'bm', 'bn-IN', 'bn-BD', 'ca', 'cs', 'de',
    'ee', 'el', 'es-ES', 'ff', 'fr', 'ha', 'hi-IN', 'hr', 'hu',
    'ig', 'it', 'ja', 'ko', 'ln', 'mg', 'mk', 'my', 'pl', 'pt-BR',
    'ro', 'son', 'sr', 'sr-Latn', 'sv-SE', 'sw', 'ta', 'tl', 'tn',
    'tr', 'wo', 'xh', 'yo', 'zh-CN', 'zh-TW', 'zu',
];

$marketplacebadge_locales = [
    'af', 'ar', 'bg', 'bm', 'bn-BD', 'bn-IN', 'ca', 'cs', 'de',
    'ee', 'el', 'es-ES', 'ff', 'fr', 'ha', 'hi-IN', 'hr',
    'hu', 'ig', 'it', 'ja', 'ln', 'mg', 'my', 'nl', 'pl', 'pt-BR',
    'ro', 'ru', 'sk', 'son', 'sr', 'sr-Latn', 'sv-SE', 'sw',
    'ta', 'tl', 'tn', 'tr', 'wo', 'xh', 'yo', 'zu',
];

$slogans_locales = [
    'af', 'ar', 'bg', 'bm', 'bn-IN', 'ca', 'cs', 'de', 'ee', 'el',
    'es-ES', 'ff', 'fr', 'ha', 'hi-IN', 'hr', 'hu', 'ig', 'it',
    'ja', 'ko', 'ln', 'mg', 'mk', 'my', 'pl', 'pt-BR', 'ro', 'son', 'sr',
    'sr-Latn', 'sv-SE', 'sw', 'ta', 'tl', 'tn', 'wo', 'xh',
    'yo', 'zh-CN', 'zh-TW', 'zu',
];

$getinvolved_locales = [
    'ar', 'az', 'bg', 'bn-BD', 'cs', 'cy', 'de', 'dsb', 'el',
    'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fa', 'fr',
    'fy-NL', 'he', 'hi-IN', 'hr', 'hsb', 'id', 'it', 'ko', 'lt',
    'ms', 'nl', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sl', 'son',
    'sq', 'sr', 'sv-SE', 'ta', 'tr', 'uk', 'zh-CN', 'zh-TW',
];

// List of locales supported for the landing page (larger than the App Store)
$ios_landing_page = array_unique(array_merge(
    $apple_store_target,
    [
        'af', 'an', 'bn-BD', 'ca', 'en-GB', 'es-AR', 'eu',
        'gn', 'hi-IN', 'hu', 'ka', 'kn', 'lij', 'sq', 'sr',
    ]
));

// List of locales supported for the landing page
$android_landing_page = array_unique(array_merge(
    $android_locales,
    [
        'af', 'bn-BD', 'cak', 'fa', 'sat', 'tsz',
    ]
));

$mwc_locales = [
    'ca', 'cs', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'hu', 'it',
    'ja', 'ko', 'pl', 'pt-BR', 'ro', 'sr', 'zh-CN', 'zh-TW',
];

$privacy_tour_locales = [
    'ast', 'da', 'de', 'es-AR', 'es-CL', 'es-ES', 'es-MX',  'fi', 'fr',
    'fy-NL', 'he', 'hu', 'it', 'ja', 'ko', 'lv', 'nb-NO', 'nn-NO',
    'pa-IN', 'pl', 'pt-BR', 'rm', 'ru', 'sk', 'sl', 'zh-TW',
];

$startpage36 = [
    'af', 'ar', 'as', 'ast', 'be', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs',
    'cy', 'da', 'de', 'el', 'en-GB', 'eo', 'es-AR', 'es-ES', 'es-MX',
    'et', 'eu', 'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'gu-IN',
    'he', 'hi-IN', 'hr', 'hu', 'id', 'is', 'it', 'ja', 'kk', 'kn', 'ko',
    'lt', 'lv', 'mk', 'ml', 'mr', 'nb-NO', 'nl', 'nn-NO',
    'or', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'si', 'sk',
    'sl', 'sq', 'sr', 'sv-SE', 'ta', 'te', 'th', 'tr', 'uk',
    'vi', 'zh-CN', 'zh-TW',
];

$engagement_locales = [
    'ar', 'ast', 'bn-BD', 'cs', 'da', 'de', 'el', 'es', 'es-AR',
    'es-CL', 'es-ES', 'es-MX', 'fi', 'fr', 'fy-NL', 'he', 'hi-IN',
    'hr', 'hu', 'id', 'it', 'ja', 'ko', 'lv', 'mk', 'nb-NO', 'nl',
    'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'rm', 'ro', 'ru', 'sk', 'sl',
    'sq', 'sr', 'sv-SE', 'tr', 'vi', 'zh-CN', 'zh-TW',
];

/*
    Array structure for single website:
    [
       0 name,
       1 path to local repo,
       2 folder containing locale files,
       3 array of supported locale,
       4 array of supported file names,
       5 reference locale,
       6 url to public repo,
       7 array of flags,
       8 type of files (lang, raw)
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
        $lang_flags['www.mozilla.org'],
        'lang',
    ],

    1 => [
        'start.mozilla.org',
        $repositories['start.mozilla.org']['local_path'],
        '',
        $startpage36,
        $startpage36_lang,
        'en-US', // source locale
        $repositories['start.mozilla.org']['public_path'],
        $lang_flags['start.mozilla.org'],
        'lang',
    ],

    4 => [
        'about:healthreport',
        $repositories['about:healthreport']['local_path'],
        '',
        $firefox_desktop_android,
        $firefoxhealthreport_lang,
        'en-US', // source locale
        $repositories['about:healthreport']['public_path'],
        $lang_flags['about:healthreport'],
        'lang',
    ],

    6 => [
        'engagement',
        $repositories['engagement']['local_path'],
        '',
        $engagement_locales,
        $engagement_lang,
        'en-US', // source locale
        $repositories['engagement']['public_path'],
        $lang_flags['engagement'],
        'lang',
    ],

    7 => [
        'add-ons',
        $repositories['add-ons']['local_path'],
        '',
        $addons_locales,
        $addons_lang,
        'en-US', // source locale
        $repositories['add-ons']['public_path'],
        $lang_flags['add-ons'],
        'lang',
    ],

    9 => [
        'firefoxos-marketing',
        $repositories['firefoxos-marketing']['local_path'],
        '',
        $fxos_marketing,
        $fxos_marketing_lang,
        'en-US', // source locale
        $repositories['firefoxos-marketing']['public_path'],
        $lang_flags['firefoxos-marketing'],
        'lang',
    ],

    11 => [
        'contribute-autoreplies',
        $repositories['contribute-autoreplies']['local_path'],
        '',
        $getinvolved_locales,
        $getinvolved_autoreplies,
        'en-US', // source locale
        $repositories['contribute-autoreplies']['public_path'],
        $lang_flags['contribute-autoreplies'],
        'raw',
    ],

    12 => [
        'appstores',
        $repositories['appstores']['local_path'],
        '',
        array_unique(array_merge($google_play_target, $apple_store_target)),
        $appstores_lang,
        'en-US', // source locale
        $repositories['appstores']['public_path'],
        $lang_flags['appstores'],
        'lang',
    ],
];

$langfiles_subsets = [
    'www.mozilla.org' =>
    [
        'download.lang'                         => $mozillaorg,
        'download_button.lang'                  => $mozillaorg,
        'esr.lang'                              => ['de', 'fr'],
        'firefox/android/index.lang'            => $android_landing_page,
        'firefox/australis/firefox_tour.lang'   => $firefox_locales,
        'firefox/australis/fx36_tour.lang'      => $firefox_locales,
        'firefox/channel.lang'                  => $mozillaorg, // Has Firefox for Android download buttons
        'firefox/choose.lang'                   => $firefox_locales,
        'firefox/desktop/customize.lang'        => $firefox_locales,
        'firefox/desktop/fast.lang'             => $firefox_locales,
        'firefox/desktop/index.lang'            => $firefox_locales,
        'firefox/desktop/tips.lang'             =>
            [
                'af', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
                'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'ff', 'fr', 'fy-NL',
                'ga-IE', 'gd', 'gl', 'he', 'hi-IN', 'hsb', 'hu', 'id',
                'it', 'ja', 'km', 'ko', 'lt', 'ms', 'nl', 'pl', 'pt-BR',
                'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr',
                'sv-SE', 'uk', 'uz', 'xh', 'zh-CN', 'zh-TW',
            ],
        'firefox/desktop/trust.lang'            => $firefox_locales,
        'firefox/developer.lang'                => $firefox_locales,
        'firefox/dnt.lang'                      =>
            [
                'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL', 'fa', 'fr',
                'fy-NL', 'hsb', 'it', 'ja', 'ko', 'lt', 'nl',
                'pt-BR', 'pt-PT', 'ro', 'ru', 'sat', 'sk', 'sl',
                'son', 'sq', 'sv-SE', 'uk', 'uz', 'zh-CN', 'zh-TW',
            ],
        'firefox/family/index.lang'             => $firefox_locales,
        'firefox/geolocation.lang'              =>
            [
                'af', 'ar', 'as', 'ast', 'az', 'be', 'bg', 'bn-BD', 'bn-IN',
                'ca', 'cs', 'cy', 'da', 'de', 'dsb', 'el', 'en-GB',
                'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'et', 'eu',
                'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl',
                'gu-IN', 'he', 'hi-IN', 'hr', 'hsb', 'hu', 'hy-AM',
                'id', 'is', 'it', 'ja', 'ka', 'kk', 'kn', 'ko', 'lt',
                'lv', 'mk', 'ml', 'mr', 'nb-NO', 'nl', 'nn-NO', 'oc',
                'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sat',
                'si', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'ta',
                'te', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
            ],
        'firefox/includes/mwc_2015_schedule.lang' => $mwc_locales,
        'firefox/hello.lang'                      => $firefox_locales,
        'firefox/hello-2016.lang'                 => $firefox_locales,
        'firefox/installer-help.lang'             => $firefox_locales,
        'firefox/ios.lang'                        => $ios_landing_page,
        'firefox/new.lang'                        => $firefox_desktop_android,
        'firefox/nightly_firstrun.lang'           =>
            [
                'ar', 'ast', 'cs', 'de', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'fy-NL', 'gd', 'gl',
                'he', 'hu', 'id', 'it', 'ja', 'kk', 'ko', 'lt',
                'lv', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-PT', 'ru',
                'sk', 'sv-SE', 'th', 'tr', 'uk', 'vi', 'zh-CN',
                'zh-TW',
            ],
        'firefox/os/devices.lang'                => $firefox_os,
        'firefox/os/faq.lang'                    => $firefox_os,
        'firefox/os/index.lang'                  =>
            [
                'cs', 'de', 'en-GB', 'fr', 'it', 'pt-BR', 'ru', 'uk',
            ],
        'firefox/os/index-new.lang'              => $firefox_os_consumer,
        'firefox/os/tv.lang'                     => $firefox_os_tv,
        'firefox/pocket.lang'                    =>
            [
                'de', 'es-ES', 'fr', 'ja', 'ru',
            ],
        'firefox/privacy_tour/privacy_tour.lang' => $privacy_tour_locales,
        'firefox/private-browsing.lang'          => $firefox_locales,
        'firefox/speed.lang'                     => ['pt-BR'],
        'firefox/sync.lang'                      => $mozillaorg,
        'firefox/sendto.lang'                    => $firefox_locales,
        'firefox/tracking-protection-tour.lang'  => $firefox_locales,
        'firefox/whatsnew_38.lang'               => $firefox_locales,
        'firefox/whatsnew_42.lang'               => $firefox_locales,
        'firefox/win10-welcome.lang'             => $firefox_locales,
        'foundation/annualreport/2011.lang'      =>
            [
                'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
                'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR',
                'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
            ],
        'foundation/annualreport/2011faq.lang'  =>
            [
                'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ko',
                'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR',
                'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
            ],
        'foundation/annualreport/2012/index.lang' =>
            [
                'ar', 'ast', 'de', 'el', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ja',
                'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
                'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN',
                'zh-TW',
            ],
        'foundation/annualreport/2012/faq.lang' =>
            [
                'ar', 'ast', 'de', 'el', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ja',
                'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl',
                'pt-BR', 'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
            ],
        'legal/index.lang'                      => $firefox_os_legal,
        'lightbeam/lightbeam.lang'              =>
            [
                'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
                'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'fr', 'fy-NL',
                'hi-IN', 'hsb', 'it', 'ko', 'ja', 'km', 'lt', 'ms', 'nl',
                'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sat', 'son', 'sq',
                'sv-SE', 'tr', 'uk', 'zh-CN', 'zh-TW',
            ],
        'main.lang'                             => $mozillaorg,
        'mobile.lang'                           =>
            [
                'be', 'ca', 'cs', 'da', 'de', 'es-AR', 'es-ES',
                'et', 'eu', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl',
                'he', 'hu', 'id', 'it', 'ja', 'ko', 'lt', 'nb-NO',
                'nl', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru',
                'sk', 'sl', 'sq', 'sr', 'th', 'tr', 'zh-CN', 'zh-TW',
            ],
        'mozorg/404.lang'                       => $mozillaorg,
        'mozorg/about.lang'                     => $mozillaorg,
        'mozorg/home/index.lang'                =>
            array_diff($mozillaorg, ['ja']),
        'mozorg/mission.lang'                   => $mozillaorg,
        'mozorg/about/history-details.lang'     =>
            [
                'ca', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL', 'es-MX',
                'eu', 'fa', 'fr', 'gl', 'hsb', 'it', 'km', 'ko', 'lt',
                'pa-IN', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sat', 'sk',
                'son', 'sq', 'sv-SE', 'uk', 'uz', 'zh-CN', 'zh-TW',
            ],
        'mozorg/about/history.lang'             =>
            [
                'af', 'ar', 'bg', 'ca', 'cs', 'cy', 'de', 'dsb', 'el',
                'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'eu', 'fa',
                'fr', 'fy-NL', 'gl', 'hr', 'hsb', 'id', 'it', 'km', 'ko',
                'lt', 'ms', 'nl', 'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'ro',
                'ru', 'sat', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE',
                'ta', 'tr', 'uk', 'uz', 'zh-CN', 'zh-TW',
            ],
        'mozorg/about/leadership.lang'          =>
            [
                'af', 'cs', 'de', 'dsb', 'en-GB', 'es-CL', 'fa', 'fr',
                'hsb', 'it', 'ko', 'lt', 'pt-BR', 'pt-PT', 'ro', 'ru',
                'sk', 'sl', 'sq', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
            ],
        'mozorg/about/manifesto.lang'           =>
            [
                'af', 'ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'cy', 'de',
                'dsb', 'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
                'eu', 'fa', 'fi', 'fr', 'fy-NL', 'gd', 'gl',
                'hi-IN', 'hr', 'hsb', 'hu', 'id', 'it', 'ja',
                'km', 'ko', 'lt', 'mk', 'ms', 'nl', 'pl', 'pt-BR', 'pt-PT',
                'ro', 'ru', 'sat', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE',
                'tr', 'uk', 'uz', 'vi', 'xh', 'zh-CN', 'zh-TW',
            ],
        'mozorg/contribute.lang'                => $getinvolved_locales,
        'mozorg/contribute/friends.lang'        => ['cs', 'de', 'es-ES', 'fr', 'pt-BR'],
        'mozorg/contribute/index.lang'          => $getinvolved_locales,
        'mozorg/contribute/stories.lang'        => $getinvolved_locales,
        'mozorg/newsletters.lang'               => $newsletter_locales,
        'mozorg/plugincheck.lang'               => $mozillaorg,
        'mozorg/products.lang'                  => $mozillaorg,
        'privacy/index.lang'                    => $firefox_os,
        'privacy/principles.lang'               => $mozillaorg,
        'tabzilla/tabzilla.lang'                => $mozillaorg,
        'teach/smarton/index.lang'              =>
            [
                'az', 'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'it', 'pl', 'pt-BR',
                'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
            ],
        'teach/smarton/security.lang'           =>
            [
                'az', 'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'it', 'pl', 'pt-BR',
                'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
            ],
        'teach/smarton/surveillance.lang'       =>
            [
                'az', 'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'it', 'pl', 'pt-BR',
                'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
            ],
        'teach/smarton/tracking.lang'           =>
            [
                'az', 'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'it', 'pl', 'pt-BR',
                'ro', 'ru', 'sq', 'sr', 'uk', 'zh-CN', 'zh-TW',
            ],
        'thunderbird/channel.lang'              =>
            [
                'cs', 'de', 'en-GB', 'fr', 'it', 'lt', 'pt-BR',
                'ru', 'uk', 'zh-TW',
            ],
        'thunderbird/features.lang'             => $thunderbird_locales,
        'thunderbird/index.lang'                => $thunderbird_locales,
        'thunderbird/start/release.lang'        => $thunderbird_locales,
    ],

    'start.mozilla.org' => [
        'fx36start.lang' => $startpage36,
    ],

    'about:healthreport' =>
    [
        'fhr.lang' => $firefox_desktop_android,
    ],

    'engagement' =>
    [
        'ios/ios_ads_nov2015.lang'              => ['de', 'fr'],
        'snippets/2014/jan2014.lang'            =>
            [
                'cs', 'de', 'el', 'es-CL', 'es-ES', 'es-MX', 'fr',
                'fy-NL', 'hu', 'id', 'it', 'ja', 'ko', 'nl', 'pl',
                'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr',
                'sv-SE', 'tr', 'vi', 'zh-CN', 'zh-TW',
            ],
        'snippets/2014/apr2014.lang'            =>
        [
            'cs', 'da', 'de', 'el', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'hu', 'id', 'it', 'ja', 'ko', 'mk',
            'nb-NO', 'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk',
            'sl', 'sq', 'sr', 'sv-SE', 'tr', 'zh-CN', 'zh-TW',
        ],
        'snippets/2014/may2014.lang'            =>
        [
            'cs', 'da', 'de', 'el', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'hu', 'id', 'it', 'ja', 'ko', 'mk',
            'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq',
            'sr', 'sv-SE', 'tr', 'zh-CN', 'zh-TW',
        ],
        'snippets/2014/jun2014.lang'            => ['de', 'el', 'es-ES', 'fr', 'hi-IN', 'hu', 'id', 'it', 'nl', 'pl', 'pt-BR', 'sr'],
        'snippets/2014/aug2014_a.lang'          => ['es-ES'],
        'snippets/2014/aug2014_b.lang'          => ['bn-BD', 'cs', 'hr', 'mk'],
        'snippets/2014/aug2014_c.lang'          => ['de', 'fr', 'pl', 'nl', 'sl', 'sq', 'zh-TW'],
        'snippets/2014/aug2014_d.lang'          => ['el', 'es-CL', 'es-MX', 'it', 'ja', 'pt-BR', 'ru', 'tr', 'sv-SE', 'sr'],
        'snippets/2014/sep2014_a.lang'          => ['cs', 'de', 'es-ES', 'fr', 'it', 'pl'],
        'snippets/2014/sep2014_b.lang'          => ['id', 'ja', 'ko', 'nb-NO', 'nl', 'ru', 'zh-CN'],
        'snippets/2014/sep2014_c.lang'          => ['bn-BD', 'el', 'hi-IN', 'hu'],
        'snippets/2014/sep2014_d.lang'          => ['pt-BR'],
        'snippets/2014/sep2014_e.lang'          => ['sq'],
        'snippets/2014/nov2014_a.lang'          =>
            [
                'ast', 'da', 'es-AR', 'es-CL', 'es-MX', 'fi', 'fy-NL',
                'he', 'ko', 'lv', 'nb-NO', 'nn-NO', 'pa-IN', 'rm', 'sk',
                'sl', 'zh-TW',
            ],
        'snippets/2014/nov2014_b.lang'          => ['ja'],
        'snippets/2014/nov2014_c.lang'          => ['es-ES', 'hu'],
        'snippets/2014/nov2014_d.lang'          => ['de', 'fr', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/2014/nov2014_e.lang'          => ['el', 'hi-IN', 'mk', 'sr'],
        'snippets/2014/dec2014_a.lang'          => ['de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru'],
        'snippets/2014/dec2014_c.lang'          => ['sr'],
        'snippets/2015/jan2015a_a.lang'         => ['hr'],
        'snippets/2015/jan2015a_b.lang'         => ['el', 'hi-IN', 'hu', 'mk', 'sr'],
        'snippets/2015/jan2015a_c.lang'         => ['de', 'es-ES', 'pt-BR'],
        'snippets/2015/jan2015a_d.lang'         => ['fr', 'pl'],
        'snippets/2015/jan2015b_a.lang'         => ['de', 'es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru'],
        'snippets/2015/jan2015b_b.lang'         => ['el', 'hu', 'it', 'ja', 'nl'],
        'snippets/2015/feb2015_a.lang'          => ['de', 'es-ES', 'pt-BR', 'ru'],
        'snippets/2015/feb2015_b.lang'          => ['fr'],
        'snippets/2015/feb2015_c.lang'          => ['id', 'it', 'ja', 'nl'],
        'snippets/2015/feb2015_d.lang'          => ['el', 'hu', 'sr'],
        'snippets/2015/feb2015_e.lang'          => ['pl'],
        'snippets/2015/mar2015_a.lang'          => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/mar2015_b.lang'          => ['el', 'hu', 'id', 'it', 'ja', 'nl', 'pl'],
        'snippets/2015/apr2015.lang'            => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/may2015_a.lang'          => ['de', 'fr', 'ru'],
        'snippets/2015/may2015_b.lang'          => ['es-ES', 'pt-BR'],
        'snippets/2015/spring2015.lang'         =>
            [
                'de', 'es-ES', 'fr', 'hu', 'it', 'ja',
                'pl', 'pt-BR', 'ru',
            ],
        'snippets/2015/jun2015_a.lang'          => ['de', 'fr'],
        'snippets/2015/jun2015_b.lang'          => ['ja'],
        'snippets/2015/jun2015_c.lang'          => ['ru'],
        'snippets/2015/jun2015_d.lang'          => ['es', 'pt-BR'],
        'snippets/2015/jul2015_a.lang'          => ['de', 'fr', 'pt-BR'],
        'snippets/2015/jul2015_b.lang'          => ['es', 'ru'],
        'snippets/2015/jul2015_c.lang'          => ['ar'],
        'snippets/2015/aug2015_a.lang'          => ['de', 'fr', 'ru'],
        'snippets/2015/aug2015_b.lang'          => ['es', 'pt-BR'],
        'snippets/2015/aug2015_c.lang'          => ['el', 'id', 'pl'],
        'snippets/2015/aug2015_win10.lang'      => ['de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru'],
        'snippets/2015/sep2015.lang'            => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/sep2015_ios.lang'        => ['de'],
        'snippets/2015/oct2015_a.lang'          => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/oct2015_b.lang'          => ['hu', 'ro'],
        'snippets/2015/oct2015_c.lang'          => ['it', 'pl'],
        'snippets/2015/oct2015_mofo.lang'       => ['de'],
        'snippets/2015/fall2015.lang'           => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/2015/nov2015_eoy_mofo.lang'   => ['es', 'fr', 'id', 'it', 'pt-BR'],
        'snippets/2015/nov2015_a.lang'          => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/nov2015_b.lang'          => ['id', 'it', 'pl'],
        'snippets/2015/dec2015_a.lang'          => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/dec2015_b.lang'          => ['id'],
        'snippets/2016/jan2016.lang'            => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2016/feb2016.lang'            => ['de', 'es', 'fr', 'ru', 'pt-BR'],
        'snippets/2016/mar2016.lang'            => ['de', 'es', 'fr', 'id', 'ru', 'pt-BR'],
        'surveys/survey_hello_fx42.lang'        => array_intersect($engagement_locales, $surveygizmo),
        'tiles/careers.lang'                    => ['de', 'fr'],
        'tiles/suggestedtiles_infographic.lang' => ['de', 'es', 'fr'],
        'tiles/2015/tiles_jul2015.lang'         => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/2015/tiles_aug2015.lang'         => ['de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru'],
        'tiles/2015/tiles_sep2015.lang'         => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/2015/tiles_oct2015.lang'         => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/2015/tiles_nov2015.lang'         => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
        'tiles/2016/tiles_jan2016.lang'         => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
    ],

    'add-ons' => [
        'homefeeds.lang'    => ['de', 'es-ES', 'fr', 'id', 'it', 'ja', 'ko', 'pt-BR'],
        'privacycoach.lang' => $addons_locales,
        'worldcup.lang'     => ['de', 'es-ES', 'fr', 'id', 'it', 'ja', 'ko', 'pt-BR'],
    ],

    'appstores' => [
        'description_beta_page.lang'        => $google_play_target,
        'apple_description_release.lang'    => $apple_store_target,
        'android_42_release.lang'           => $google_play_target, // yeah, marketing...
        'whatsnew/whatsnew_android_44.lang' => ['fr', 'zh-TW'],
    ],

    'firefoxos-marketing' => [
        'marketplace/marketplace_l10n_feed.lang' =>
            [
                'bg', 'bn-BD', 'cs', 'de', 'el', 'es-ES', 'fr',
                'hr', 'hu', 'it', 'ja', 'mk', 'pl', 'pt-BR',
                'ru', 'sr', 'sr-Latn', 'tr', 'zh-CN',
            ],
        'screenshots/screenshots_2_0.lang' =>
            [
                'af', 'cs', 'de', 'es-ES', 'ja', 'pt-BR',
                'xh', 'zu',
            ],
        'screenshots/screenshots_2_0_b.lang' =>
            [
                'ar', 'ee', 'ff', 'fr', 'ha', 'ig', 'sw',
                'wo', 'yo',
            ],
        'screenshots/screenshots_dolphin.lang' => ['bn-BD', 'bn-IN', 'hi-IN', 'ta'],
        'screenshots/screenshots.lang'         =>
            [
                'cs', 'de', 'el', 'es-ES', 'fr', 'hr', 'hu', 'it',
                'mk', 'pl', 'pt-BR', 'ro', 'ru', 'sr',
            ],
        'screenshots/screenshots_tarako.lang' => ['hi-IN', 'ru', 'ta'],
        'slogans/firefoxos.lang'              => $slogans_locales,
        'slogans/marketplacebadge.lang'       => $marketplacebadge_locales,
    ],
];
