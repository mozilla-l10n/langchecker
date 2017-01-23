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
    'firefox/accounts.lang',
    'firefox/android/index.lang',
    'firefox/australis/firefox_tour.lang',
    'firefox/australis/fx36_tour.lang',
    'firefox/channel/index.lang',
    'firefox/desktop/customize.lang',
    'firefox/desktop/fast.lang',
    'firefox/desktop/index.lang',
    'firefox/desktop/tips.lang',
    'firefox/desktop/trust.lang',
    'firefox/developer.lang',
    'firefox/dnt.lang',
    'firefox/family/index.lang',
    'firefox/features.lang',
    'firefox/geolocation.lang',
    'firefox/installer-help.lang',
    'firefox/ios.lang',
    'firefox/new/horizon.lang',
    'firefox/nightly_firstrun.lang',
    'firefox/os/devices.lang',
    'firefox/os/index.lang',
    'firefox/os/tv.lang',
    'firefox/privacy_tour/privacy_tour.lang',
    'firefox/private-browsing.lang',
    'firefox/sendto.lang',
    'firefox/speed.lang',
    'firefox/sync.lang',
    'firefox/tracking-protection-tour.lang',
    'firefox/whatsnew_38.lang',
    'firefox/whatsnew_42.lang',
    'firefox/nightly_whatsnew.lang',
    'foundation/annualreport/2011.lang',
    'foundation/annualreport/2011faq.lang',
    'foundation/annualreport/2012/faq.lang',
    'foundation/annualreport/2012/index.lang',
    'legal/index.lang',
    'lightbeam/lightbeam.lang',
    'main.lang',
    'mozorg/404.lang',
    'mozorg/about.lang',
    'mozorg/about/history-details.lang',
    'mozorg/about/history.lang',
    'mozorg/about/manifesto.lang',
    'mozorg/contribute/index.lang',
    'mozorg/contribute/signup.lang',
    'mozorg/contribute/stories.lang',
    'mozorg/home/index.lang',
    'mozorg/home/index-2016.lang',
    'mozorg/internet-health.lang',
    'mozorg/internet-health/privacy-security.lang',
    'mozorg/mission.lang',
    'mozorg/newsletters.lang',
    'mozorg/plugincheck-redesign.lang',
    'mozorg/products.lang',
    'mozorg/technology.lang',
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
    'download.lang'              => [ 'critical' => ['all'] ],
    'download_button.lang'       => [ 'critical' => ['all'] ],
    'firefox/accounts.lang'      => [ 'critical' => ['all'] ],
    'firefox/android/index.lang' => [
        'critical' => [$fx_android_locales],
        'opt-in'   => ['all'],
    ],
    'firefox/australis/firefox_tour.lang' => [ 'critical' => ['all'] ],
    'firefox/australis/fx36_tour.lang'    => [ 'critical' => ['all'] ],
    'firefox/channel/index.lang'          => [ 'critical' => ['all'] ],
    'firefox/family/index.lang'           => [ 'critical' => ['all'] ],
    'firefox/features.lang'               => [ 'critical' => ['all'] ],
    'firefox/desktop/customize.lang'      => [ 'critical' => ['all'] ],
    'firefox/desktop/fast.lang'           => [ 'critical' => ['all'] ],
    'firefox/desktop/index.lang'          => [ 'critical' => ['all'] ],
    'firefox/desktop/trust.lang'          => [ 'critical' => ['all'] ],
    'firefox/desktop/tips.lang'           => [
        'critical' => ['all'],
        'opt-in'   => ['all'],
    ],
    'firefox/dnt.lang'            => [ 'opt-in' => ['all'] ],
    'firefox/geolocation.lang'    => [ 'opt-in' => ['all'] ],
    'firefox/installer-help.lang' => [ 'critical' => ['all'] ],
    'firefox/ios.lang'            => [
        'critical' => [$ios_locales],
        'opt-in'   => ['all'],
    ],
    'firefox/new/horizon.lang'                => [ 'critical' => ['all'] ],
    'firefox/os/index.lang'                   => [ 'opt-in' => ['all'] ],
    'firefox/privacy_tour/privacy_tour.lang'  => [ 'critical' => ['all'] ],
    'firefox/private-browsing.lang'           => [ 'critical' => ['all'] ],
    'firefox/sendto.lang'                     => [ 'critical' => ['all'] ],
    'firefox/sync.lang'                       => [ 'critical' => ['all'] ],
    'firefox/tracking-protection-tour.lang'   => [ 'critical' => ['all'] ],
    'firefox/whatsnew_38.lang'                => [ 'critical' => ['all'] ],
    'firefox/whatsnew_42.lang'                => [ 'critical' => ['all'] ],
    'firefox/nightly_whatsnew.lang'           => [
        'opt-in'   => [
            'cs', 'de', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
            'fr', 'it', 'ja', 'pl', 'pt-BR', 'pt-PT', 'ru', 'sk', 'sl',
            'uk', 'zh-CN', 'zh-TW',
        ],
    ],
    'foundation/annualreport/2012/index.lang' => [ 'critical' => ['all'] ],
    'legal/index.lang'                        => [ 'critical' => ['all'] ],
    'lightbeam/lightbeam.lang'                => [ 'opt-in' => ['all'] ],
    'main.lang'                               => [ 'critical' => ['all'] ],
    'mozorg/about/manifesto.lang'             => [ 'opt-in' => ['all'] ],
    'mozorg/about/history.lang'               => [ 'opt-in' => ['all'] ],
    'mozorg/about/history-details.lang'       => [ 'opt-in' => ['all'] ],
    'mozorg/contribute/index.lang'            => [
        'critical' => ['all'],
        'opt-in'   => ['all'],
    ],
    'mozorg/contribute/signup.lang'           => [
        'critical' => ['all'],
        'opt-in'   => ['all'],
    ],
    'mozorg/contribute/stories.lang'          => [
        'critical' => ['all'],
        'opt-in'   => ['all'],
    ],
    'mozorg/home/index.lang'                  => [ 'obsolete' => ['all'] ],
    'mozorg/home/index-2016.lang'             => [ 'critical' => ['all'] ],
    'mozorg/internet-health.lang'             => [
       'critical'  => ['de', 'es-ES', 'fr'],
       'opt-in'    => ['all'],
    ],
    'mozorg/internet-health/privacy-security.lang' => [
       'critical'  => ['de', 'es-ES', 'fr'],
       'opt-in'    => ['all'],
    ],
    'mozorg/newsletters.lang'                 => [
        'critical' => $newsletter_locales,
    ],
    'mozorg/plugincheck-redesign.lang' => [ 'critical' => ['all'] ],
    'mozorg/technology.lang'           => [ 'critical' => ['all'] ],
    'tabzilla/tabzilla.lang'           => [ 'obsolete' => ['all'] ],
    'teach/smarton/index.lang'         => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'teach/smarton/security.lang' => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'teach/smarton/surveillance.lang' => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'teach/smarton/tracking.lang' => [
        'critical' => ['de', 'es-ES', 'fr', 'it', 'pl'],
        'opt-in'   => ['all'],
    ],
    'thunderbird/channel.lang' => [
        'opt-in' => $thunderbird_locales,
    ],
    'thunderbird/start/release.lang' => [ 'critical' => ['all'] ],
];

$firefoxhealthreport_lang = ['fhr.lang'];
$lang_flags['about:healthreport'] = [
    'fhr.lang' => [ 'critical' => ['all'] ],
];

$engagement_lang = [
    'ads/ios_ads_nov2015.lang',
    'ads/ios_android_apr2016.lang',
    'ads/ios_android_feb2017.lang',
    'emails/2016/fundraising_email_1.lang',
    'emails/2016/fundraising_email_2.lang',
    'emails/2016/fundraising_email_3.lang',
    'emails/2017/fundraising_thank_you.lang',
    'heartbeat/2016/sep2016.lang',
    'heartbeat/2016/nov2016.lang',
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
    'snippets/2016/apr2016.lang',
    'snippets/2016/apr2016_b.lang',
    'snippets/2016/may2016_a.lang',
    'snippets/2016/may2016_b.lang',
    'snippets/2016/jun2016_berec.lang',
    'snippets/2016/nov2016.lang',
    'snippets/2016/dec2016.lang',
    'snippets/2016/dec2016_eoy_a.lang',
    'snippets/2016/dec2016_eoy_b.lang',
    'snippets/2016/dec2016_eoy_mob.lang',
    'snippets/2016/dec2016_eoy_ty.lang',
    'snippets/2017/jan2017.lang',
    'snippets/2017/feb2017.lang',
    'snippets/2017/feb2017_b.lang',
    'social/2016/fundraising.lang',
    'surveys/survey_hello_fx42.lang',
    'surveys/survey_maker_party_2016.lang',
    'surveys/survey_eoy_heartbeat.lang',
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
    'ads/ios_android_apr2016.lang'     => [ 'critical' => ['all'] ],
    'ads/ios_android_feb2017.lang'     => [ 'critical' => ['all'] ],
    'heartbeat/2016/sep2016.lang'      => [ 'critical' => ['all'] ],
    'heartbeat/2016/nov2016.lang'      => [ 'critical' => ['all'] ],
    'snippets/2016/jan2016.lang'       => [ 'critical' => ['all'] ],
    'snippets/2016/feb2016.lang'       => [ 'critical' => ['all'] ],
    'snippets/2016/mar2016.lang'       => [ 'critical' => ['all'] ],
    'snippets/2016/apr2016.lang'       => [ 'critical' => ['all'] ],
    'snippets/2016/apr2016_b.lang'     => [ 'critical' => ['all'] ],
    'snippets/2016/may2016_a.lang'     => [ 'critical' => ['all'] ],
    'snippets/2016/may2016_b.lang'     => [ 'critical' => ['all'] ],
    'snippets/2016/jun2016_berec.lang' => [
        'critical' => ['de', 'en-GB', 'es-ES', 'fr', 'it'],
    ],
    'snippets/2016/nov2016.lang' => [
        'critical' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2016/dec2016.lang' => [
        'critical' => ['de', 'es', 'fr', 'pt-BR', 'ru'],
    ],
    'snippets/2016/dec2016_eoy_mob.lang' => [ 'critical' => ['all'] ],
    'snippets/2017/jan2017.lang'         => [
        'critical' => ['de'],
    ],
    'snippets/2017/feb2017.lang'         => [
        'critical' => ['de', 'es', 'fr', 'ru'],
    ],
    'snippets/2017/feb2017_b.lang'         => [
        'critical' => ['pt-BR'],
    ],
];

$appstores_lang = [
    'focus_ios/description_release.lang',
    'focus_ios/screenshots_v2_1.lang',
    'focus_ios/whatsnew/focus_2_1.lang',
    'fx_android/description_beta.lang',
    'fx_android/description_release.lang',
    'fx_android/whatsnew/android_44.lang',
    'fx_android/whatsnew/android_45.lang',
    'fx_android/whatsnew/android_46_beta.lang',
    'fx_android/whatsnew/android_46.lang',
    'fx_android/whatsnew/android_47_beta.lang',
    'fx_android/whatsnew/android_47.lang',
    'fx_android/whatsnew/android_48_beta.lang',
    'fx_android/whatsnew/android_48.lang',
    'fx_android/whatsnew/android_49_beta.lang',
    'fx_android/whatsnew/android_49.lang',
    'fx_android/whatsnew/android_50_beta.lang',
    'fx_android/whatsnew/android_50.lang',
    'fx_android/whatsnew/android_51_beta.lang',
    'fx_android/whatsnew/android_51.lang',
    'fx_android/whatsnew/android_52_beta.lang',
    'fx_ios/description_release.lang',
    'fx_ios/screenshots_v3.lang',
    'fx_ios/whatsnew/ios_2_1.lang',
    'fx_ios/whatsnew/ios_4_0.lang',
    'fx_ios/whatsnew/ios_5_0.lang',
    'fx_ios/whatsnew/ios_6_0.lang',
];

$lang_flags['appstores'] = [
    'focus_ios/description_release.lang' => [
        'critical' => [
            'de', 'es-ES', 'fr', 'id', 'it', 'ja', 'pl', 'pt-BR', 'ru', 'zh-CN',
        ],
    ],
    'focus_ios/screenshots_v2_1.lang'       => [ 'critical' => ['all'] ],
    'focus_ios/whatsnew/focus_2_1.lang'     => [ 'critical' => ['all'] ],
    'fx_android/description_release.lang'   => [
        'critical' => [
            'ar', 'de', 'es-ES', 'es-MX', 'fr', 'id',
            'it', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
        ],
    ],
    'fx_android/whatsnew/android_44.lang'      => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_45.lang'      => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_46.lang'      => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_47.lang'      => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_48.lang'      => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_46_beta.lang' => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_47_beta.lang' => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_48_beta.lang' => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_49_beta.lang' => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_50_beta.lang' => [ 'obsolete' => ['all'] ],
    'fx_android/whatsnew/android_51_beta.lang' => [ 'obsolete' => ['all'] ],
    'fx_ios/description_release.lang'          => [
        'critical' => [
            'de', 'es-ES', 'es-MX', 'fr', 'id', 'it',
            'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
        ],
    ],
    'fx_ios/screenshots_v3.lang' => [
        'critical' => [
            'de', 'es-ES', 'es-MX', 'fr', 'id', 'it',
            'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
        ],
    ],
    'fx_ios/whatsnew/ios_2_1.lang' => [ 'obsolete' => ['all'] ],
    'fx_ios/whatsnew/ios_4_0.lang' => [ 'obsolete' => ['all'] ],
    'fx_ios/whatsnew/ios_5_0.lang' => [ 'obsolete' => ['all'] ],
];

$no_active_tag = [
    'download.lang',
    'download_button.lang',
    'esr.lang',
    'main.lang',
    'newsletter.lang',
    'privacy/index.lang',
];

$deadline = [
    'focus_ios/description_release.lang'           => '2017-01-11', // appstores project
    'focus_ios/screenshots_v2_1.lang'              => '2017-01-11', // appstores project
    'focus_ios/whatsnew/focus_2_1.lang'            => '2017-01-11', // appstores project
    'fx_android/description_release.lang'          => '2016-04-30', // appstores project
    'fx_android/whatsnew/android_50.lang'          => '2016-11-14', // appstores project
    'fx_ios/description_release.lang'              => '2016-03-30', // appstores project
    'fx_ios/whatsnew/ios_6_0.lang'                 => '2017-01-06', // appstores project
    'download_button.lang'                         => '2016-04-29',
    'emails/2016/fundraising_email_3.lang'         => '2016-12-27',
    'emails/2017/fundraising_thank_you.lang'       => '2017-01-22',
    'firefox/accounts.lang'                        => '2016-03-15',
    'firefox/channel/index.lang'                   => '2016-12-12',
    'firefox/family/index.lang'                    => '2017-01-30',
    'firefox/features.lang'                        => '2016-10-04',
    'firefox/new/horizon.lang'                     => '2017-01-30',
    'firefox/sync.lang'                            => '2016-04-04',
    'firefox/tracking-protection-tour.lang'        => '2016-02-29',
    'heartbeat/2016/sep2016.lang'                  => '2016-09-12',
    'heartbeat/2016/nov2016.lang'                  => '2016-11-22',
    'legal/index.lang'                             => '2016-02-18',
    'main.lang'                                    => '2016-11-30',
    'mozorg/contribute/signup.lang'                => '2016-06-06',
    'mozorg/home/index-2016.lang'                  => '2017-02-03',
    'mozorg/internet-health.lang'                  => '2017-01-28',
    'mozorg/internet-health/privacy-security.lang' => '2017-01-28',
    'mozorg/newsletters.lang'                      => '2017-02-03',
    'mozorg/plugincheck-redesign.lang'             => '2016-08-01',
    'mozorg/technology.lang'                       => '2016-11-30',
    'ads/ios_android_feb2017.lang'                 => '2017-02-02',
    'snippets/2016/nov2016.lang'                   => '2016-11-05',
    'snippets/2016/dec2016.lang'                   => '2016-12-05',
    'snippets/2016/dec2016_eoy_ty.lang'            => '2017-01-03',
    'snippets/2017/jan2017.lang'                   => '2017-01-06',
    'snippets/2017/feb2017.lang'                   => '2017-02-03',
    'snippets/2017/feb2017_b.lang'                 => '2017-02-03',
    'thunderbird/start/release.lang'               => '2016-08-01',
];

$firefox_os = [
    'af', 'ar', 'bg', 'bn-BD', 'bn-IN', 'ca', 'cs', 'de', 'el',
    'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fa', 'ff', 'fr', 'fy-NL',
    'hi-IN', 'hr', 'hu', 'id', 'it', 'ja', 'ko', 'mk', 'my', 'nl',
    'pl', 'pt-BR', 'ro', 'ru', 'son', 'sq', 'sr', 'sv-SE',
    'ta', 'tl', 'xh', 'zh-CN', 'zh-TW', 'zu',
];

$getinvolved_locales = [
    'af', 'am', 'ar', 'az', 'bg', 'bn-BD', 'cs', 'cy', 'de', 'dsb', 'el',
    'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fa', 'fr',
    'fy-NL', 'he', 'hi-IN', 'hr', 'hsb', 'id', 'it', 'kab', 'ko',
    'lt', 'ms', 'nl', 'nv', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sl',
    'son', 'sq', 'sr', 'sv-SE', 'ta', 'tr', 'uk', 'zh-CN', 'zh-TW',
];

// List of locales supported for the landing page (larger than the App Store)
$ios_landing_page = array_unique(array_merge(
    $ios_locales,
    [
        'af', 'an', 'ar', 'bn-BD', 'bn-IN', 'ca', 'el', 'es-AR',
        'eu', 'fa', 'gl', 'gn', 'hi-IN', 'ka', 'kab', 'kn',
        'lij', 'ml', 'ms', 'my', 'or', 'sq', 'sr',
    ]
));

// List of locales supported for the landing page
$android_landing_page = array_unique(array_merge(
    $fx_android_locales,
    [
        'af', 'ast', 'bg', 'bn-BD', 'fa', 'kab',
    ]
));

$privacy_tour_locales = [
    'ast', 'da', 'de', 'es-AR', 'es-CL', 'es-ES', 'es-MX',  'fi', 'fr',
    'fy-NL', 'he', 'hu', 'it', 'ja', 'ko', 'lv', 'nb-NO', 'nn-NO',
    'pa-IN', 'pl', 'pt-BR', 'rm', 'ru', 'sk', 'sl', 'zh-TW',
];

$engagement_locales = [
    'ar', 'bg', 'cs', 'da', 'de', 'el', 'en-GB', 'es', 'es-ES',
    'es-MX', 'fr', 'fy-NL', 'hi-IN', 'hu', 'id', 'it', 'ja',
    'ko', 'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR',
    'rm', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'tr',
    'zh-CN', 'zh-HK', 'zh-TW',
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

    12 => [
        'appstores',
        $repositories['appstores']['local_path'],
        '',
        // Added: ar, see https://bugzilla.mozilla.org/show_bug.cgi?id=1259200
        array_unique(array_merge($google_play, ['ar'], $apple_store)),
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
        'download.lang'                       => $mozillaorg,
        'download_button.lang'                => $mozillaorg,
        'esr.lang'                            => ['de', 'fr'],
        'firefox/accounts.lang'               => $mozillaorg,
        'firefox/android/index.lang'          => $android_landing_page,
        'firefox/australis/firefox_tour.lang' => $firefox_locales,
        'firefox/australis/fx36_tour.lang'    => $firefox_locales,
        'firefox/channel/index.lang'          => $mozillaorg, // Has Firefox for Android download buttons
        'firefox/desktop/customize.lang'      => $firefox_locales,
        'firefox/desktop/fast.lang'           => $firefox_locales,
        'firefox/desktop/index.lang'          => $firefox_locales,
        'firefox/desktop/tips.lang'           =>
            [
                'af', 'am', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
                'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'ff', 'fr', 'fy-NL',
                'ga-IE', 'gd', 'gl', 'he', 'hi-IN', 'hsb', 'hu', 'id',
                'it', 'ja', 'kab', 'km', 'ko', 'lt', 'ms', 'nl', 'nv', 'pl', 'pt-BR',
                'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr',
                'sv-SE', 'uk', 'uz', 'xh', 'zh-CN', 'zh-TW',
            ],
        'firefox/desktop/trust.lang' => $firefox_locales,
        'firefox/developer.lang'     => $firefox_locales,
        'firefox/dnt.lang'           =>
            [
                'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL', 'fa', 'fi', 'fr',
                'fy-NL', 'hsb', 'it', 'ja', 'kab', 'ko', 'lt', 'nl',
                'pt-BR', 'pt-PT', 'ro', 'ru', 'sk', 'sl',
                'son', 'sq', 'sr', 'sv-SE', 'uk', 'uz', 'zh-CN', 'zh-TW',
            ],
        'firefox/family/index.lang' => $firefox_locales,
        'firefox/features.lang'     => $firefox_locales,
        'firefox/geolocation.lang'  =>
            [
                'af', 'ar', 'as', 'ast', 'az', 'bg', 'bn-BD', 'bn-IN',
                'ca', 'cs', 'cy', 'da', 'de', 'dsb', 'el', 'en-GB',
                'eo', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'et', 'eu',
                'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl',
                'gu-IN', 'he', 'hi-IN', 'hr', 'hsb', 'hu', 'hy-AM',
                'id', 'is', 'it', 'ja', 'ka', 'kab', 'kk', 'kn', 'ko', 'lt',
                'lv', 'mk', 'ml', 'mr', 'nb-NO', 'nl', 'nn-NO', 'oc',
                'pa-IN', 'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru',
                'si', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE', 'ta',
                'te', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
            ],
        'firefox/installer-help.lang'             => $firefox_locales,
        'firefox/ios.lang'                        => $ios_landing_page,
        'firefox/new/horizon.lang'                => $firefox_desktop_android,
        'firefox/nightly_firstrun.lang'           =>
            [
                'ar', 'ast', 'cs', 'de', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'fy-NL', 'gd', 'gl',
                'he', 'hu', 'id', 'it', 'ja', 'kk', 'ko', 'lt',
                'lv', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-PT', 'ru',
                'sk', 'sv-SE', 'th', 'tr', 'uk', 'vi', 'zh-CN',
                'zh-TW',
            ],
        'firefox/nightly_whatsnew.lang'          =>
            [
                'cs', 'de', 'es-ES', 'fr', 'ja', 'pl', 'pt-BR',
            ],
        'firefox/os/devices.lang' => $firefox_os,
        'firefox/os/index.lang'   =>
            [
                'ast', 'cs', 'de', 'en-GB', 'fr', 'it', 'kab', 'ko',
                'pt-BR', 'ru', 'sq', 'uk', 'zh-TW',
            ],
        'firefox/os/tv.lang'                     => array_merge($firefox_os, ['et']),
        'firefox/privacy_tour/privacy_tour.lang' => $privacy_tour_locales,
        'firefox/private-browsing.lang'          => $firefox_locales,
        'firefox/speed.lang'                     => ['pt-BR'],
        'firefox/sync.lang'                      => $mozillaorg,
        'firefox/sendto.lang'                    => $firefox_locales,
        'firefox/tracking-protection-tour.lang'  => $firefox_locales,
        'firefox/whatsnew_38.lang'               => $firefox_locales,
        'firefox/whatsnew_42.lang'               => $firefox_locales,
        'foundation/annualreport/2011.lang'      =>
            [
                'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ja',
                'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR',
                'sq', 'sr', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
            ],
        'foundation/annualreport/2011faq.lang' =>
            [
                'ast', 'cs', 'de', 'el', 'eo', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fr', 'fy-NL', 'is', 'it', 'ja',
                'ko', 'lij', 'ms', 'nl', 'oc', 'pa-IN', 'pl', 'pt-BR',
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
        'legal/index.lang'         => array_merge($firefox_os, ['et']),
        'lightbeam/lightbeam.lang' =>
            [
                'am', 'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
                'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'fr', 'fy-NL',
                'hi-IN', 'hsb', 'it', 'kab', 'ko', 'ja', 'km', 'lt', 'ms', 'nl',
                'nv', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'son', 'sq', 'sr',
                'sv-SE', 'tr', 'uk', 'zh-CN', 'zh-TW',
            ],
        'main.lang'                         => $mozillaorg,
        'mozorg/404.lang'                   => $mozillaorg,
        'mozorg/about.lang'                 => $mozillaorg,
        'mozorg/mission.lang'               => $mozillaorg,
        'mozorg/technology.lang'            => $mozillaorg,
        'mozorg/about/history-details.lang' =>
            [
                'af', 'am', 'bn-BD', 'ca', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL',
                'es-MX', 'eu', 'fa', 'fr', 'gl', 'hsb', 'it', 'ja', 'kab',
                'km', 'ko', 'lt', 'nl', 'nv', 'pa-IN', 'pt-BR', 'pt-PT', 'ro',
                'ru', 'sk', 'son', 'sq', 'sv-SE', 'uk', 'uz',
                'zh-CN', 'zh-TW',
            ],
        'mozorg/about/history.lang' =>
            [
                'af', 'am', 'ar', 'bg', 'bn-BD', 'ca', 'cs', 'cy', 'de', 'dsb',
                'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
                'eu', 'fa', 'fr', 'fy-NL', 'gl', 'hr', 'hsb', 'id',
                'it', 'ja', 'kab', 'km', 'ko', 'lt', 'ms', 'nl', 'pa-IN',
                'nv', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sk',
                'sl', 'son', 'sq', 'sr', 'sv-SE', 'ta', 'tr', 'uk',
                'uz', 'zh-CN', 'zh-TW',
            ],
        'mozorg/about/manifesto.lang' =>
            [
                'af', 'am', 'ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'cy', 'de',
                'dsb', 'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
                'eu', 'fa', 'fi', 'fr', 'fy-NL', 'gd', 'gl',
                'hi-IN', 'hr', 'hsb', 'hu', 'id', 'it', 'ja', 'kab',
                'km', 'ko', 'lt', 'mk', 'ms', 'nl', 'nv', 'pl', 'pt-BR',
                'pt-PT', 'ro', 'ru', 'sk', 'sl', 'son', 'sq', 'sr', 'sv-SE',
                'tr', 'uk', 'uz', 'vi', 'xh', 'zh-CN', 'zh-TW',
            ],
        'mozorg/contribute/index.lang'      => $getinvolved_locales,
        'mozorg/contribute/signup.lang'     => $getinvolved_locales,
        'mozorg/contribute/stories.lang'    => $getinvolved_locales,
        'mozorg/home/index.lang'            => $mozillaorg,
        'mozorg/home/index-2016.lang'       => $mozillaorg,
        'mozorg/internet-health.lang'       =>
            [
                'af', 'cy', 'de', 'es-ES', 'fr', 'kab', 'ko', 'pl', 'pt-BR',
                'sq',
            ],
        'mozorg/internet-health/privacy-security.lang' =>
            [
                'de', 'es-ES', 'fr','sq',
            ],
        'mozorg/newsletters.lang'          => $newsletter_locales,
        'mozorg/plugincheck-redesign.lang' => $mozillaorg,
        'mozorg/products.lang'             => $mozillaorg,
        'privacy/index.lang'               => $firefox_os,
        'privacy/principles.lang'          => $mozillaorg,
        'tabzilla/tabzilla.lang'           => $mozillaorg,
        'teach/smarton/index.lang'         =>
            [
                'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab', 'ko',
                'pl', 'pt-BR', 'ro', 'ru', 'sq', 'sr', 'uk',
                'zh-CN', 'zh-TW',
            ],
        'teach/smarton/security.lang' =>
            [
                'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'kab', 'ja', 'ko',
                'pl', 'pt-BR', 'ro', 'ru', 'sq', 'sr', 'uk',
                'zh-CN', 'zh-TW',
            ],
        'teach/smarton/surveillance.lang' =>
            [
                'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab', 'ko',
                'pl', 'pt-BR', 'ro', 'ru', 'sq', 'sr', 'uk',
                'zh-CN', 'zh-TW',
            ],
        'teach/smarton/tracking.lang' =>
            [
                'az', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'hsb', 'it', 'ja', 'kab',
                'ko', 'pl', 'pt-BR', 'ro', 'ru', 'sq', 'sr', 'uk',
                'zh-CN', 'zh-TW',
            ],
        'thunderbird/channel.lang' =>
            [
                'cy', 'cs', 'de', 'en-GB', 'es-ES', 'fi', 'fr', 'it', 'ja', 'kab', 'ko',
                'lt', 'nl', 'pl', 'pt-BR', 'ru', 'sq', 'uk', 'zh-TW',
            ],
        'thunderbird/features.lang'      => $thunderbird_locales,
        'thunderbird/index.lang'         => $thunderbird_locales,
        'thunderbird/start/release.lang' => $thunderbird_locales,
    ],

    'about:healthreport' =>
    [
        'fhr.lang' => array_diff($firefox_desktop_android, $mozorg_locales),
    ],

    'engagement' =>
    [
        'ads/ios_ads_nov2015.lang'               => ['de', 'fr'],
        'ads/ios_android_apr2016.lang'           => ['de', 'es-ES', 'fr', 'pl'],
        'ads/ios_android_feb2017.lang'           => ['zh-HK', 'zh-TW'],
        'emails/2016/fundraising_email_1.lang'   => ['de', 'es', 'fr', 'it'],
        'emails/2016/fundraising_email_2.lang'   => ['de', 'es', 'fr', 'it'],
        'emails/2016/fundraising_email_3.lang'   => ['de', 'es', 'fr'],
        'emails/2017/fundraising_thank_you.lang' => ['de', 'es', 'fr', 'it'],
        'heartbeat/2016/sep2016.lang'            =>
            [
                'de', 'es-ES', 'es-MX', 'fr', 'hi-IN', 'id', 'it', 'ja',
                'pl', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
            ],
        'heartbeat/2016/nov2016.lang'  =>
            [
                'de', 'es-ES', 'es-MX', 'fr', 'hi-IN', 'id', 'it', 'ja',
                'pl', 'pt-BR', 'ru', 'zh-CN',
            ],
        'snippets/2014/jan2014.lang' =>
            [
                'cs', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'fy-NL', 'hu',
                'id', 'it', 'ja', 'ko', 'nl', 'pl', 'pt-BR', 'ro', 'ru',
                'sk', 'sl', 'sq', 'sr', 'sv-SE', 'tr', 'zh-CN', 'zh-TW',
            ],
        'snippets/2014/apr2014.lang' =>
        [
            'cs', 'da', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'fy-NL',
            'hu', 'id', 'it', 'ja', 'ko', 'nb-NO', 'nl', 'pl', 'pt-BR',
            'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'tr', 'zh-CN',
            'zh-TW',
        ],
        'snippets/2014/may2014.lang' =>
        [
            'cs', 'da', 'de', 'el', 'es-ES', 'es-MX',
            'fr', 'fy-NL', 'hu', 'id', 'it', 'ja', 'ko',
            'nl', 'pl', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sq',
            'sr', 'sv-SE', 'tr', 'zh-CN', 'zh-TW',
        ],
        'snippets/2014/jun2014.lang' => [
            'de', 'el', 'es-ES', 'fr', 'hi-IN', 'hu', 'id',
            'it', 'nl', 'pl', 'pt-BR', 'sr',
        ],
        'snippets/2014/aug2014_a.lang' => ['es-ES'],
        'snippets/2014/aug2014_b.lang' => ['cs'],
        'snippets/2014/aug2014_c.lang' => ['de', 'fr', 'pl', 'nl', 'sl', 'sq', 'zh-TW'],
        'snippets/2014/aug2014_d.lang' => ['el', 'es-MX', 'it', 'ja', 'pt-BR', 'ru', 'tr', 'sv-SE', 'sr'],
        'snippets/2014/sep2014_a.lang' => ['cs', 'de', 'es-ES', 'fr', 'it', 'pl'],
        'snippets/2014/sep2014_b.lang' => ['id', 'ja', 'ko', 'nb-NO', 'nl', 'ru', 'zh-CN'],
        'snippets/2014/sep2014_c.lang' => ['el', 'hi-IN', 'hu'],
        'snippets/2014/sep2014_d.lang' => ['pt-BR'],
        'snippets/2014/sep2014_e.lang' => ['sq'],
        'snippets/2014/nov2014_a.lang' =>
            [
                'da', 'es-MX', 'fy-NL', 'ko', 'nb-NO', 'nn-NO', 'pa-IN',
                'rm', 'sk', 'sl', 'zh-TW',
            ],
        'snippets/2014/nov2014_b.lang'  => ['ja'],
        'snippets/2014/nov2014_c.lang'  => ['es-ES', 'hu'],
        'snippets/2014/nov2014_d.lang'  => ['de', 'fr', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/2014/nov2014_e.lang'  => ['el', 'hi-IN', 'sr'],
        'snippets/2014/dec2014_a.lang'  => ['de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru'],
        'snippets/2014/dec2014_c.lang'  => ['sr'],
        'snippets/2015/jan2015a_b.lang' => ['el', 'hi-IN', 'hu', 'sr'],
        'snippets/2015/jan2015a_c.lang' => ['de', 'es-ES', 'pt-BR'],
        'snippets/2015/jan2015a_d.lang' => ['fr', 'pl'],
        'snippets/2015/jan2015b_a.lang' => ['de', 'es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru'],
        'snippets/2015/jan2015b_b.lang' => ['el', 'hu', 'it', 'ja', 'nl'],
        'snippets/2015/feb2015_a.lang'  => ['de', 'es-ES', 'pt-BR', 'ru'],
        'snippets/2015/feb2015_b.lang'  => ['fr'],
        'snippets/2015/feb2015_c.lang'  => ['id', 'it', 'ja', 'nl'],
        'snippets/2015/feb2015_d.lang'  => ['el', 'hu', 'sr'],
        'snippets/2015/feb2015_e.lang'  => ['pl'],
        'snippets/2015/mar2015_a.lang'  => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/mar2015_b.lang'  => ['el', 'hu', 'id', 'it', 'ja', 'nl', 'pl'],
        'snippets/2015/apr2015.lang'    => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/may2015_a.lang'  => ['de', 'fr', 'ru'],
        'snippets/2015/may2015_b.lang'  => ['es-ES', 'pt-BR'],
        'snippets/2015/spring2015.lang' =>
            [
                'de', 'es-ES', 'fr', 'hu', 'it', 'ja',
                'pl', 'pt-BR', 'ru',
            ],
        'snippets/2015/jun2015_a.lang'        => ['de', 'fr'],
        'snippets/2015/jun2015_b.lang'        => ['ja'],
        'snippets/2015/jun2015_c.lang'        => ['ru'],
        'snippets/2015/jun2015_d.lang'        => ['es', 'pt-BR'],
        'snippets/2015/jul2015_a.lang'        => ['de', 'fr', 'pt-BR'],
        'snippets/2015/jul2015_b.lang'        => ['es', 'ru'],
        'snippets/2015/jul2015_c.lang'        => ['ar'],
        'snippets/2015/aug2015_a.lang'        => ['de', 'fr', 'ru'],
        'snippets/2015/aug2015_b.lang'        => ['es', 'pt-BR'],
        'snippets/2015/aug2015_c.lang'        => ['el', 'id', 'pl'],
        'snippets/2015/aug2015_win10.lang'    => ['de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru'],
        'snippets/2015/sep2015.lang'          => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/sep2015_ios.lang'      => ['de'],
        'snippets/2015/oct2015_a.lang'        => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/oct2015_b.lang'        => ['hu', 'ro'],
        'snippets/2015/oct2015_c.lang'        => ['it', 'pl'],
        'snippets/2015/oct2015_mofo.lang'     => ['de'],
        'snippets/2015/fall2015.lang'         => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/2015/nov2015_eoy_mofo.lang' => ['es', 'fr', 'id', 'it', 'pt-BR'],
        'snippets/2015/nov2015_a.lang'        => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/nov2015_b.lang'        => ['id', 'it', 'pl'],
        'snippets/2015/dec2015_a.lang'        => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2015/dec2015_b.lang'        => ['id'],
        'snippets/2016/jan2016.lang'          => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2016/feb2016.lang'          => ['de', 'es', 'fr', 'ru', 'pt-BR'],
        'snippets/2016/mar2016.lang'          => ['de', 'es', 'fr', 'id', 'ru', 'pt-BR'],
        'snippets/2016/apr2016.lang'          => ['de', 'es', 'fr', 'id', 'ru', 'pt-BR'],
        'snippets/2016/apr2016_b.lang'        => ['pt-BR'],
        'snippets/2016/may2016_a.lang'        => ['es', 'fr', 'ru', 'pt-BR'],
        'snippets/2016/may2016_b.lang'        => ['de'],
        'snippets/2016/jun2016_berec.lang'    => [
            'bg', 'cs', 'de', 'en-GB', 'es-ES', 'fr', 'it',
            'nl', 'ro', 'sv-SE', 'sl',
        ],
        'snippets/2016/nov2016.lang'            => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2016/dec2016.lang'            => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/2016/dec2016_eoy_a.lang'      => ['it', 'pt-BR', 'ru'],
        'snippets/2016/dec2016_eoy_b.lang'      => ['de', 'es', 'fr', 'pl'],
        'snippets/2016/dec2016_eoy_mob.lang'    => ['de', 'es', 'fr', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/2016/dec2016_eoy_ty.lang'     => ['de', 'es', 'fr', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/2017/jan2017.lang'            => ['de'],
        'snippets/2017/feb2017.lang'            => ['de', 'es', 'fr', 'ru'],
        'snippets/2017/feb2017_b.lang'          => ['pt-BR'],
        'social/2016/fundraising.lang'          => ['de', 'en-GB', 'es', 'fr', 'it', 'nl', 'pt-BR'],
        'surveys/survey_hello_fx42.lang'        => array_intersect($engagement_locales, $surveygizmo),
        'surveys/survey_maker_party_2016.lang'  => ['bg', 'cs', 'de', 'es', 'fr', 'it', 'nl', 'pl', 'sl'],
        'surveys/survey_eoy_heartbeat.lang'     => ['de'],
        'tiles/careers.lang'                    => ['de', 'fr'],
        'tiles/suggestedtiles_infographic.lang' => ['de', 'es', 'fr'],
        'tiles/2015/tiles_jul2015.lang'         => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/2015/tiles_aug2015.lang'         => ['de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru'],
        'tiles/2015/tiles_sep2015.lang'         => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/2015/tiles_oct2015.lang'         => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/2015/tiles_nov2015.lang'         => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
        'tiles/2016/tiles_jan2016.lang'         => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
    ],

    'appstores' => [
        'focus_ios/description_release.lang' => $focus_ios_store,
        'focus_ios/screenshots_v2_1.lang'    => [
            'de', 'es-ES', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru', 'zh-CN',
        ],
        'focus_ios/whatsnew/focus_2_1.lang' => $focus_ios_store,
        // Added: ar, see https://bugzilla.mozilla.org/show_bug.cgi?id=1259200
        'fx_android/description_release.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/description_beta.lang'         => $fx_android_store,
        'fx_android/whatsnew/android_44.lang'      => ['fr', 'ja', 'zh-TW'],
        'fx_android/whatsnew/android_45.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/whatsnew/android_46.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/whatsnew/android_47.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/whatsnew/android_48.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/whatsnew/android_49.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/whatsnew/android_50.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/whatsnew/android_51.lang'      => array_merge($fx_android_store, ['ar']),
        'fx_android/whatsnew/android_46_beta.lang' => $fx_android_store,
        'fx_android/whatsnew/android_47_beta.lang' => $fx_android_store,
        'fx_android/whatsnew/android_48_beta.lang' => $fx_android_store,
        'fx_android/whatsnew/android_49_beta.lang' => $fx_android_store,
        'fx_android/whatsnew/android_50_beta.lang' => $fx_android_store,
        'fx_android/whatsnew/android_51_beta.lang' => $fx_android_store,
        'fx_android/whatsnew/android_52_beta.lang' => $fx_android_store,
        'fx_ios/description_release.lang'          => $fx_ios_store,
        'fx_ios/screenshots_v3.lang'               => [
            'de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
        ],
        'fx_ios/whatsnew/ios_2_1.lang' => $fx_ios_store,
        'fx_ios/whatsnew/ios_4_0.lang' => $fx_ios_store,
        'fx_ios/whatsnew/ios_5_0.lang' => $fx_ios_store,
        'fx_ios/whatsnew/ios_6_0.lang' => $fx_ios_store,
    ],
];
