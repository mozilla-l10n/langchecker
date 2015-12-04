<?php

$public_repo1  = 'https://github.com/mozilla-l10n/www.mozilla.org';
$public_repo2  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/fx36start/';
$public_repo3  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/surveys/';
$public_repo4  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/marketing/';
$public_repo5  = 'https://github.com/mozilla-l10n/fhr-l10n/tree/master/';
$public_repo6  = 'https://svn.mozilla.org/projects/granary/slogans/';
$public_repo7  = 'https://github.com/mozilla-l10n/engagement-l10n/tree/master/';
$public_repo8  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/add-ons/';
$public_repo9  = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxupdater/';
$public_repo10 = 'https://svn.mozilla.org/projects/l10n-misc/trunk/firefoxos-marketing/';
$public_repo11 = ''; // Free to use for new projects, was originally used for Tiles
$public_repo12 = 'https://github.com/mozilla-l10n/appstores/tree/master/';

// This is to avoid a warning in shell mode
if (! isset($_SERVER['SERVER_NAME'])) {
    $_SERVER['SERVER_NAME'] = '';
}

$settings_file = __DIR__ . '/settings.inc.php';
if (! file_exists($settings_file)) {
    die('File app/config/settings.inc.php is missing. Please check your configuration.');
}
require $settings_file;

// Real data is in adi.inc.php, not under VCS
if (is_file(__DIR__ . '/adi.inc.php')) {
    include __DIR__ . '/adi.inc.php';
} else {
    // Fake data to not break the app outside of production
    include __DIR__ . '/fake_adi.inc.php';
}

/*
If a file is not listed in $lang_flags, it's assumed to be non critical for all
locales.
If a flag is valid for all locales, set it to ['all']. If it's not, set the flag
to the array of locales.
*/
$lang_flags = [];

$mozillaorg_lang = [
    'download.lang',
    'download_button.lang',
    'esr.lang',
    'euballot.lang',
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
    'firefox/includes/mwc_2014_schedule.lang',
    'firefox/includes/mwc_2015_schedule.lang',
    'firefox/installer-help.lang',
    'firefox/ios.lang',
    'firefox/new.lang',
    'firefox/nightly_firstrun.lang',
    'firefox/os/devices.lang',
    'firefox/os/faq.lang',
    'firefox/os/index-new.lang',
    'firefox/os/tv.lang',
    'firefox/partners/index.lang',
    'firefox/pocket.lang',
    'firefox/privacy_tour/privacy_tour.lang',
    'firefox/private-browsing.lang',
    'firefox/push.lang',
    'firefox/sendto.lang',
    'firefox/speed.lang',
    'firefox/sync.lang',
    'firefox/tiles.lang',
    'firefox/tracking-protection-tour.lang',
    'firefox/update.lang',
    'firefox/whatsnew.lang',
    'firefox/whatsnew_38.lang',
    'firefox/whatsnew_42.lang',
    'firefox/whatsnew-fx37.lang',
    'firefox/win10-welcome.lang',
    'firefoxflicks.lang',
    'firefoxlive.lang',
    'firefoxos/firefoxos.lang',
    'firefoxtesting.lang',
    'foundation/annualreport/2011.lang',
    'foundation/annualreport/2011faq.lang',
    'foundation/annualreport/2012/faq.lang',
    'foundation/annualreport/2012/index.lang',
    'foundationsection.lang',
    'legal/index.lang',
    'lightbeam/lightbeam.lang',
    'main.lang',
    'marketplace/marketplace.lang',
    'marketplace/partners.lang',
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
    'mozspaces.lang',
    'mwc2014_promos.lang',
    'newsletter/ios.lang',
    'newsletter.lang',
    'privacy/index.lang',
    'privacy/principles.lang',
    'privacy/privacy-day.lang',
    'snippets.lang',
    'tabzilla/tabzilla.lang',
    'teach/smarton/index.lang',
    'teach/smarton/security.lang',
    'teach/smarton/surveillance.lang',
    'teach/smarton/tracking.lang',
    'thunderbird/features.lang',
    'thunderbird/index.lang',
    'thunderbird/start/release.lang',
    'upgradedialog.lang',
    'upgradepromos.lang',
];

$lang_flags['www.mozilla.org'] = [
    'download.lang'                           => [ 'critical' => ['all'] ],
    'download_button.lang'                    => [ 'critical' => ['all'] ],
    'euballot.lang'                           => [ 'obsolete' => ['all'] ],
    'firefox/android/index.lang'              => [
        'critical' => ['all'],
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
    'firefox/hello.lang'                      => [ 'critical' => ['all'] ],
    'firefox/installer-help.lang'             => [ 'critical' => ['all'] ],
    'firefox/ios.lang'                        => [ 'critical' => ['all'] ],
    'firefox/new.lang'                        => [ 'critical' => ['all'] ],
    'firefox/os/devices.lang'                 => [ 'critical' => ['all'] ],
    'firefox/os/index-new.lang'               => [ 'critical' => ['all'] ],
    'firefox/pocket.lang'                     => [ 'critical' => ['all'] ],
    'firefox/privacy_tour/privacy_tour.lang'  => [ 'critical' => ['all'] ],
    'firefox/private-browsing.lang'           => [ 'critical' => ['all'] ],
    'firefox/sendto.lang'                     => [ 'critical' => ['all'] ],
    'firefox/sync.lang'                       => [ 'critical' => ['all'] ],
    'firefox/tiles.lang'                      => [ 'critical' => ['all'] ],
    'firefox/tracking-protection-tour.lang'   => [ 'critical' => ['all'] ],
    'firefox/update.lang'                     => [ 'obsolete' => ['all'] ],
    'firefox/whatsnew.lang'                   => [ 'obsolete' => ['all'] ],
    'firefox/whatsnew_38.lang'                => [ 'critical' => ['all'] ],
    'firefox/whatsnew_42.lang'                => [ 'critical' => ['all'] ],
    'firefox/whatsnew-fx37.lang'              => [ 'critical' => ['all'] ],
    'firefox/win10-welcome.lang'              => [ 'critical' => ['all'] ],
    'firefoxflicks.lang'                      => [ 'obsolete' => ['all'] ],
    'firefoxlive.lang'                        => [ 'obsolete' => ['all'] ],
    'firefoxos/firefoxos.lang'                => [ 'critical' => ['all'] ],
    'firefoxtesting.lang'                     => [ 'obsolete' => ['all'] ],
    'foundationsection.lang'                  => [ 'obsolete' => ['all'] ],
    'foundation/annualreport/2012/index.lang' => [ 'critical' => ['all'] ],
    'legal/index.lang'                        => [ 'critical' => ['all'] ],
    'lightbeam/lightbeam.lang'                => [ 'opt-in'   => ['all'] ],
    'main.lang'                               => [ 'critical' => ['all'] ],
    'marketplace/marketplace.lang'            => [ 'critical' => ['all'] ],
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
    'mozspaces.lang'                          => [ 'obsolete' => ['all'] ],
    'newsletter/ios.lang'                     => [
        'critical' => $newsletter_locales,
    ],
    'privacy/privacy-day.lang'                => [ 'opt-in'   => ['all'] ],
    'snippets.lang'                           => [ 'obsolete' => ['all'] ],
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
    'thunderbird/start/release.lang'          => [ 'critical' => ['all'] ],
    'upgradedialog.lang'                      => [ 'critical' => ['all'] ],
];

$startpage36_lang = ['fx36start.lang'];
$lang_flags['start.mozilla.org'] = [
    'fx36start.lang'                          => [ 'critical' => ['all'] ],
];

$surveys_lang = [
    'getinvolved_march2014.lang',
    'survey_hello_fx42.lang',
    'survey1.lang',
    'survey2.lang',
    'survey3.lang',
    'survey4.lang',
    'survey5.lang',
];

$firefoxhealthreport_lang = ['fhr.lang'];
$lang_flags['about:healthreport'] = [
    'fhr.lang' => [ 'critical' => ['all'] ],
];

$slogans_lang = ['firefoxos.lang', 'marketplacebadge.lang'];
$lang_flags['slogans'] = [
    'firefoxos.lang'        => [ 'critical' => ['all'] ],
    'marketplacebadge.lang' => [ 'critical' => ['all'] ],
];

$engagement_lang = [
    'ios/ios_ads_nov2015.lang',
    'snippets/aug2014_a.lang',
    'snippets/aug2014_b.lang',
    'snippets/aug2014_c.lang',
    'snippets/aug2014_d.lang',
    'snippets/sep2014_a.lang',
    'snippets/sep2014_b.lang',
    'snippets/sep2014_c.lang',
    'snippets/sep2014_d.lang',
    'snippets/sep2014_e.lang',
    'snippets/nov2014_a.lang',
    'snippets/nov2014_b.lang',
    'snippets/nov2014_c.lang',
    'snippets/nov2014_d.lang',
    'snippets/nov2014_e.lang',
    'snippets/dec2014_a.lang',
    'snippets/dec2014_c.lang',
    'snippets/jan2015a_a.lang',
    'snippets/jan2015a_b.lang',
    'snippets/jan2015a_c.lang',
    'snippets/jan2015a_d.lang',
    'snippets/jan2015b_a.lang',
    'snippets/jan2015b_b.lang',
    'snippets/feb2015_a.lang',
    'snippets/feb2015_b.lang',
    'snippets/feb2015_c.lang',
    'snippets/feb2015_d.lang',
    'snippets/feb2015_e.lang',
    'snippets/mar2015_a.lang',
    'snippets/mar2015_b.lang',
    'snippets/apr2015.lang',
    'snippets/may2015_a.lang',
    'snippets/may2015_b.lang',
    'snippets/spring2015.lang',
    'snippets/jun2015_a.lang',
    'snippets/jun2015_b.lang',
    'snippets/jun2015_c.lang',
    'snippets/jun2015_d.lang',
    'snippets/jul2015_a.lang',
    'snippets/jul2015_b.lang',
    'snippets/jul2015_c.lang',
    'snippets/aug2015_a.lang',
    'snippets/aug2015_b.lang',
    'snippets/aug2015_c.lang',
    'snippets/aug2015_win10.lang',
    'snippets/sep2015.lang',
    'snippets/sep2015_ios.lang',
    'snippets/oct2015_a.lang',
    'snippets/oct2015_b.lang',
    'snippets/oct2015_c.lang',
    'snippets/oct2015_mofo.lang',
    'snippets/fall2015.lang',
    'snippets/nov2015_eoy_mofo.lang',
    'snippets/nov2015_a.lang',
    'snippets/nov2015_b.lang',
    'snippets/dec2015_a.lang',
    'snippets/dec2015_b.lang',
    'tiles/careers.lang',
    'tiles/suggestedtiles_infographic.lang',
    'tiles/tiles.lang',
    'tiles/tiles_jul2015.lang',
    'tiles/tiles_aug2015.lang',
    'tiles/tiles_sep2015.lang',
    'tiles/tiles_oct2015.lang',
    'tiles/tiles_nov2015.lang',
];
$lang_flags['engagement'] = [
    'ios/ios_ads_nov2015.lang'       => [ 'critical' => ['all'] ],
    'snippets/oct2015_a.lang'        => [ 'critical' => ['all'] ],
    'snippets/oct2015_b.lang'        => [ 'critical' => ['all'] ],
    'snippets/oct2015_c.lang'        => [ 'critical' => ['all'] ],
    'snippets/oct2015_mofo.lang'     => [ 'critical' => ['all'] ],
    'snippets/fall2015.lang'         => [ 'critical' => ['all'] ],
    'snippets/nov2015_eoy_mofo.lang' => [ 'critical' => ['all'] ],
    'snippets/nov2015_a.lang'        => [ 'critical' => ['all'] ],
    'snippets/nov2015_b.lang'        => [ 'critical' => ['all'] ],
    'snippets/dec2015_a.lang'        => [ 'critical' => ['all'] ],
    'snippets/dec2015_b.lang'        => [ 'critical' => ['all'] ],
    'tiles/careers.lang'             => [ 'critical' => ['de', 'fr'] ],
    'tiles/tiles.lang'               => [ 'critical' => ['all'] ],
    'tiles/tiles_oct2015.lang'       => [ 'critical' => ['all'] ],
    'tiles/tiles_nov2015.lang'       => [ 'critical' => ['all'] ],
];

$addons_lang = ['privacycoach.lang'];
$lang_flags['add-ons'] = [
    // 'worldcup.lang' => [ 'critical' => ['all'] ],
];

$firefox_updater_lang = ['updater.lang'];
$lang_flags['firefox-updater'] = [
    'updater.lang' => [ 'critical' => ['all'] ],
];

$fxos_marketing_lang = [
    'marketplace_l10n_feed.lang',
    'screenshots_2_0.lang',
    'screenshots_2_0_b.lang',
    'screenshots_dolphin.lang',
    'screenshots.lang',
    'screenshots_tarako.lang',
];
$lang_flags['firefoxos-marketing'] = [];

$appstores_lang = [
    'description_page.lang',
    'description_beta_page.lang',
    'apple_description_release.lang',
    'android_42_release.lang',
];

$lang_flags['appstores'] = [
    'description_page.lang'          => [ 'critical' => ['de', 'fr'] ],
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
    'euballot.lang',
    'firefox/includes/mwc_2014_schedule.lang',
    'firefox/includes/mwc_2015_schedule.lang',
    'firefoxflicks.lang',
    'firefoxlive.lang',
    'firefoxtesting.lang',
    'foundationsection.lang',
    'main.lang',
    'marketplace/marketplace.lang',
    'marketplace/partners.lang',
    'mobile.lang',
    'mozspaces.lang',
    'mwc2014_promos.lang',
    'newsletter.lang',
    'privacy/index.lang',
    'snippets.lang',
    'upgradepromos.lang',
];

$deadline = [
    'description_page.lang'                  => '2014-11-09', // appstores project
    'description_beta_page.lang'             => '2015-09-30', // appstores project
    'apple_description_release.lang'         => '2015-11-10', // appstores project
    'android_42_release.lang'                => '2015-10-30', // appstores project
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
    'firefox/hello.lang'                     => '2015-09-22',
    'firefox/ios.lang'                       => '2015-11-03',
    'firefox/new.lang'                       => '2015-11-18',
    'firefox/os/faq.lang'                    => '2015-09-15',
    'firefox/os/index-new.lang'              => '2015-04-09',
    'firefox/partners/index.lang'            => '2015-03-01',
    'firefox/pocket.lang'                    => '2015-06-01',
    'firefox/private-browsing.lang'          => '2015-11-02',
    'firefox/push.lang'                      => '2015-11-18',
    'firefox/sendto.lang'                    => '2015-06-01',
    'firefox/sync.lang'                      => '2015-06-01',
    'firefox/tiles.lang'                     => '2015-09-11',
    'firefox/tracking-protection-tour.lang'  => '2015-11-02',
    'firefox/whatsnew_42.lang'               => '2015-11-02',
    'firefox/win10-welcome.lang'             => '2015-08-10',
    'ios/ios_ads_nov2015.lang'               => '2015-11-18',
    'legal/index.lang'                       => '2015-02-23',
    'main.lang'                              => '2015-11-02',
    'mozorg/about.lang'                      => '2015-03-26',
    'mozorg/contribute/index.lang'           => '2015-08-10',
    'mozorg/contribute/stories.lang'         => '2015-08-10',
    'mozorg/home/index.lang'                 => '2015-11-30',
    'mozorg/plugincheck.lang'                => '2015-08-24',
    'newsletter/ios.lang'                    => '2015-03-12',
    'snippets/oct2015_a.lang'                => '2015-10-11',
    'snippets/oct2015_b.lang'                => '2015-10-11',
    'snippets/oct2015_c.lang'                => '2015-10-11',
    'snippets/oct2015_mofo.lang'             => '2015-10-11',
    'snippets/fall2015.lang'                 => '2015-11-02',
    'snippets/nov2015_eoy_mofo.lang'         => '2015-11-02',
    'snippets/nov2015_a.lang'                => '2015-11-14',
    'snippets/nov2015_b.lang'                => '2015-11-14',
    'snippets/dec2015_a.lang'                => '2015-12-14',
    'snippets/dec2015_b.lang'                => '2015-12-14',
    'privacy/principles.lang'                => '2015-09-15',
    'survey_hello_fx42.lang'                 => '2015-09-11',
    'tabzilla/tabzilla.lang'                 => '2014-10-31',
    'teach/smarton/index.lang'               => '2015-11-02',
    'teach/smarton/security.lang'            => '2015-11-17',
    'teach/smarton/surveillance.lang'        => '2015-12-17',
    'teach/smarton/tracking.lang'            => '2015-11-02',
    'tiles/tiles_sep2015.lang'               => '2015-09-10',
    'tiles/tiles_oct2015.lang'               => '2015-10-11',
    'tiles/tiles_nov2015.lang'               => '2015-11-02',
    'thunderbird/start/release.lang'         => '2015-01-31',
];

// List of locales

$addons_locales = [
    'cs', 'de', 'es-ES', 'es-MX', 'fr', 'hu', 'id', 'it', 'ja', 'pl',
    'pt-BR', 'ru', 'sq', 'zh-TW',
];

// Source: http://hg.mozilla.org/releases/mozilla-release/raw-file/c13c3b4992cf/mobile/android/locales/maemo-locales
// Added: af, az, dsb, fa, hsb (requested), sat
$android_locales = [
    'af', 'an', 'as', 'az', 'be', 'bn-IN', 'br', 'ca', 'cak',
    'cs', 'cy', 'da', 'de', 'dsb', 'en-GB', 'eo', 'es-AR', 'es-ES',
    'es-MX', 'et', 'eu', 'fa', 'fi', 'ff', 'fr', 'fy-NL', 'ga-IE',
    'gd', 'gl' ,'gu-IN', 'hi-IN', 'hsb', 'hu', 'hy-AM', 'id',
    'is', 'it', 'ja', 'kk', 'kn', 'ko', 'lt', 'lv', 'ml',
    'mr', 'ms', 'my', 'nb-NO', 'nl', 'or', 'pa-IN', 'pl', 'pt-BR',
    'pt-PT', 'ro', 'ru', 'sat', 'sq', 'sk', 'sl', 'sv-SE',
    'ta', 'te', 'tsz', 'th', 'tr', 'uk', 'zh-CN', 'zh-TW',
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

/* We have some extra locales on some pages, but they're not shipping and we
 * don't want to ask them to translate 600 strings.
 */
$firefox_os_consumer = array_merge($firefox_os, ['et', 'uk']);
$firefox_os_legal = array_merge($firefox_os, ['et']);
$firefox_os_tv = array_merge($firefox_os, ['et']);

$firefox_updater_locales = [
    'ar', 'cs', 'de', 'el', 'es-ES', 'fi', 'fr', 'hu', 'id', 'it', 'ja',
    'nl', 'pl', 'pt-BR', 'pt-PT', 'ru', 'sl', 'sv-SE', 'th', 'tr', 'vi',
    'zh-CN', 'zh-TW',
];

$fxos_marketing = [
    'af', 'bg', 'bn-BD', 'cs', 'de', 'ee', 'el', 'es-ES', 'ff',
    'fr', 'ha', 'hi-IN', 'hr', 'hu', 'ig', 'it', 'ja', 'ln', 'mk',
    'pl', 'pt-BR', 'ro', 'ru', 'sr', 'sr-Latn', 'sw', 'ta',
    'tr', 'wo', 'xh', 'yo', 'zh-CN', 'zu',
];

$getinvolved_locales = [
    'ar', 'az', 'bg', 'bn-BD', 'cs', 'cy', 'de', 'dsb', 'el',
    'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX', 'fa', 'fr',
    'fy-NL', 'he', 'hi-IN', 'hr', 'hsb', 'id', 'it', 'ko', 'lt',
    'ms', 'nl', 'pl', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sl', 'son',
    'sq', 'sr', 'sv-SE', 'ta', 'tr', 'uk', 'zh-CN', 'zh-TW',
];

// List provided by Release-drivers, needs access to a Google Play publishing account
$google_play_locales = [
    'af', 'ar', 'be', 'bg', 'cs', 'ca', 'da', 'de', 'el', 'en-GB',
    'es-MX', 'es-ES', 'et', 'fa', 'fi', 'fr', 'hi-IN', 'hu', 'hr',
    'id', 'it', 'he', 'ja', 'ko', 'lt', 'lv', 'ms', 'nl', 'nb-NO',
    'pl', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sk', 'sl', 'sr',
    'sv-SE', 'sw', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW', 'zu',
];

// Locales that we do support and that Google Play supports too
$google_play_target = array_intersect($android_locales, $google_play_locales);

$apple_store_target = [
    'da', 'de', 'en-US', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'ko',
    'nb-NO', 'nl', 'pt-BR', 'pt-PT', 'ru', 'sv-SE', 'tr', 'zh-CN', 'zh-TW',
];

$marketing = [
    'de', 'es-ES', 'fr', 'it', 'id', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW',
];

$marketplacebadge_locales = [
    'af', 'ar', 'bg', 'bm', 'bn-BD', 'bn-IN', 'ca', 'cs', 'de',
    'ee', 'el', 'es-ES', 'ff', 'fr', 'ha', 'hi-IN', 'hr',
    'hu', 'ig', 'it', 'ja', 'ln', 'mg', 'my', 'nl', 'pl', 'pt-BR',
    'ro', 'ru', 'sk', 'son', 'sr', 'sr-Latn', 'sv-SE', 'sw',
    'ta', 'tl', 'tn', 'tr', 'wo', 'xh', 'yo', 'zu',
];

$mwc_locales = [
    'ca', 'cs', 'de', 'el', 'es-ES', 'es-MX', 'fr', 'hu', 'it',
    'ja', 'ko', 'pl', 'pt-BR', 'ro', 'sr', 'zh-CN', 'zh-TW',
];

$privacy_tour_locales = [
    'ast', 'da', 'de', 'es-AR', 'es-CL', 'es-ES', 'es-MX',  'fi', 'fr',
    'fy-NL', 'he', 'hu', 'it', 'ja', 'ko', 'lv', 'nb-NO', 'nn-NO',
    'pa-IN', 'pl', 'pt-BR', 'rm', 'ru', 'sk', 'sl', 'zh-TW',
];

$slogans_locales = [
    'af', 'ar', 'bg', 'bm', 'bn-IN', 'ca', 'cs', 'de', 'ee', 'el',
    'es-ES', 'ff', 'fr', 'ha', 'hi-IN', 'hr', 'hu', 'ig', 'it',
    'ja', 'ko', 'ln', 'mg', 'my', 'pl', 'pt-BR', 'ro', 'son', 'sr',
    'sr-Latn', 'sv-SE', 'sw', 'ta', 'tl', 'tn', 'wo', 'xh',
    'yo', 'zh-CN', 'zh-TW', 'zu',
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

$engagement_locales = array_merge(['es'], $firefox_locales);

/*
 * Thundebird locales on Release channel
 * Source: http://hg.mozilla.org/releases/comm-release/raw-file/tip/mail/locales/shipped-locales
 * Opt-in locale: az
 */
$thunderbird_release = [
    'ar', 'ast', 'az', 'be', 'bg', 'bn-BD', 'br', 'ca', 'cs', 'cy',
    'da', 'de', 'dsb', 'el', 'en-GB', 'es-AR', 'es-ES', 'et',
    'eu', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gd', 'gl', 'he', 'hr',
    'hsb', 'hu', 'hy-AM', 'id', 'is', 'it', 'ja', 'ko', 'lt',
    'nb-NO', 'nl', 'nn-NO', 'pa-IN', 'pl', 'pt-BR', 'pt-PT',
    'rm', 'ro', 'ru', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE',
    'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
];

/* Array structure for single website
*
*   [
*       0 name,
*       1 path to local repo,
*       2 folder containing locale files,
*       3 array of supported locale,
*       4 array of supported file names,
*       5 reference locale,
*       6 url to public repo,
*       7 array of flags,
*       8 type of files (lang, raw)
*   ]
*
*/

$sites =
[
    0 => [
        'www.mozilla.org',
        $repo1,
        '',
        $mozillaorg,
        $mozillaorg_lang,
        'en-US', // source locale
        $public_repo1 . '/tree/master/',
        $lang_flags['www.mozilla.org'],
        'lang',
    ],

    1 => [
        'start.mozilla.org',
        $repo2,
        'locale/',
        $startpage36,
        $startpage36_lang,
        'en-US', // source locale
        $public_repo2,
        $lang_flags['start.mozilla.org'],
        'lang',
    ],

    2 => [
        'surveys',
        $repo3,
        '',
        $mozillaorg,
        $surveys_lang,
        'en-US', // source locale
        $public_repo3,
        [],
        'lang',
    ],

    3 => [
        'marketing',
        $repo4,
        '',
        $marketing,
        ['julyevent.lang'],
        'en-US', // source locale
        $public_repo4,
        [],
        'lang',
    ],

    4 => [
        'about:healthreport',
        $repo5,
        '',
        $firefox_desktop_android,
        $firefoxhealthreport_lang,
        'en-US', // source locale
        $public_repo5,
        $lang_flags['about:healthreport'],
        'lang',
    ],

    5 => [
        'slogans',
        $repo6,
        '',
        $slogans_locales,
        $slogans_lang,
        'en-US', // source locale
        $public_repo6,
        $lang_flags['slogans'],
        'lang',
    ],

    6 => [
        'engagement',
        $repo7,
        '',
        $engagement_locales,
        $engagement_lang,
        'en-US', // source locale
        $public_repo7,
        $lang_flags['engagement'],
        'lang',
    ],

    7 => [
        'add-ons',
        $repo8,
        '',
        $addons_locales,
        $addons_lang,
        'en-US', // source locale
        $public_repo8,
        $lang_flags['add-ons'],
        'lang',
    ],

    8 => [
        'firefox-updater',
        $repo9,
        '',
        $firefox_updater_locales,
        $firefox_updater_lang,
        'en-US', // source locale
        $public_repo9,
        $lang_flags['firefox-updater'],
        'lang',
    ],

    9 => [
        'firefoxos-marketing',
        $repo10,
        '',
        $fxos_marketing,
        $fxos_marketing_lang,
        'en-US', // source locale
        $public_repo10,
        $lang_flags['firefoxos-marketing'],
        'lang',
    ],

    11 => [
        'contribute-autoreplies',
        $repo1,
        '',
        $getinvolved_locales,
        $getinvolved_autoreplies,
        'en-US', // source locale
        $public_repo1 . '/tree/master/',
        $lang_flags['contribute-autoreplies'],
        'raw',
    ],

    12 => [
        'appstores',
        $repo12,
        '',
        $google_play_target,
        $appstores_lang,
        'en-US', // source locale
        $public_repo12,
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
        'euballot.lang'                         =>
            [
                'bg', 'cs', 'da', 'de', 'el', 'en-GB', 'es-ES', 'et',
                'fi', 'fr', 'hr', 'hu', 'it', 'lt', 'lv', 'nb-NO',
                'nl', 'pl', 'pt-PT', 'ro', 'sk', 'sl', 'sv-SE',
            ],
        'firefox/android/index.lang'            => $android_locales,
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
                'pt-BR', 'pt-PT', 'ro', 'sat', 'sk', 'sl', 'son', 'sq',
                'sv-SE', 'uk', 'uz', 'zh-CN', 'zh-TW',
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
        'firefox/includes/mwc_2014_schedule.lang' => $mwc_locales,
        'firefox/includes/mwc_2015_schedule.lang' => $mwc_locales,
        'firefox/hello.lang'                      => $firefox_locales,
        'firefox/installer-help.lang'             => $firefox_locales,
        'firefox/ios.lang'                        => $firefox_locales,
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
        'firefox/os/index-new.lang'              => $firefox_os_consumer,
        'firefox/os/tv.lang'                     => $firefox_os_tv,
        'firefox/partners/index.lang'            => $firefox_os,
        'firefox/pocket.lang'                    =>
            [
                'de', 'es-ES', 'fr', 'ja', 'ru',
            ],
        'firefox/privacy_tour/privacy_tour.lang' => $privacy_tour_locales,
        'firefox/private-browsing.lang'          => $firefox_locales,
        'firefox/push.lang'                      => $firefox_locales,
        'firefox/speed.lang'                     => ['pt-BR'],
        'firefox/sync.lang'                      => $mozillaorg,
        'firefox/sendto.lang'                    => $firefox_locales,
        'firefox/tracking-protection-tour.lang'  => $firefox_locales,
        'firefox/tiles.lang'                     => $firefox_locales,
        'firefox/update.lang'                    => $firefox_locales,
        'firefox/whatsnew.lang'                  => $firefox_locales,
        'firefox/whatsnew_38.lang'               => $firefox_locales,
        'firefox/whatsnew_42.lang'               => $firefox_locales,
        'firefox/win10-welcome.lang'             => $firefox_locales,
        'firefox/whatsnew-fx37.lang'             => ['de', 'en-GB', 'es-ES', 'es-MX', 'fr', 'id', 'pt-BR'],
        'firefoxflicks.lang'                     =>
            [
                'ar', 'bg', 'de', 'es-ES', 'fa', 'fr', 'gl', 'hu',
                'id', 'it', 'ja', 'pl', 'sl', 'sq', 'tr', 'zh-CN',
                'zh-TW',
            ],
        'firefoxlive.lang'                      =>
            [
                'ar', 'de', 'es-ES', 'fa', 'fr', 'gl', 'hr', 'hu',
                'ko', 'pl', 'pt-BR', 'rm', 'ro', 'ru', 'sk', 'sl',
                'sq', 'tr', 'zh-CN', 'zh-TW',
            ],
        'firefoxos/firefoxos.lang'              =>
            [
                'es-AR', 'es-ES', 'fr', 'fy-NL', 'nl', 'pl', 'pt-BR',
            ],
        'firefoxtesting.lang'                   => $mozillaorg,
        'foundation/annualreport/2011.lang'     =>
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
        'foundationsection.lang'                =>
            [
                'cs', 'de', 'es-ES', 'fr', 'gl', 'hu', 'id', 'it',
                'nl', 'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW',
            ],
        'legal/index.lang'                      => $firefox_os_legal,
        'lightbeam/lightbeam.lang'              =>
            [
                'ca', 'cs', 'cy', 'de', 'dsb', 'el', 'en-GB', 'es-AR',
                'es-CL', 'es-ES', 'es-MX', 'eu', 'fa', 'fr', 'fy-NL',
                'hi-IN', 'hsb', 'it', 'ko', 'ja', 'km', 'lt', 'ms', 'nl',
                'pl', 'pt-BR', 'pt-PT', 'ro', 'sat', 'son', 'sq', 'sv-SE',
                'tr', 'uk', 'zh-CN', 'zh-TW',
            ],
        'main.lang'                             => $mozillaorg,
        'marketplace/marketplace.lang'          => ['fr', 'es-ES', 'pl', 'pt-BR'],
        'marketplace/partners.lang'             => ['fr', 'es-ES', 'pt-BR'],
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
        'mozorg/home/index.lang'                => $mozillaorg,
        'mozorg/mission.lang'                   => $mozillaorg,
        'mozorg/about/history-details.lang'     =>
            [
                'ca', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-CL', 'es-MX',
                'eu', 'fa', 'fr', 'gl', 'hsb', 'it', 'km', 'ko', 'lt',
                'pa-IN', 'pt-BR', 'pt-PT', 'ro', 'sat', 'sk', 'son', 'sq',
                'sv-SE', 'uk', 'uz', 'zh-CN', 'zh-TW',
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
                'af', 'cs', 'de', 'dsb', 'en-GB', 'es-CL', 'fa',
                'hsb', 'it', 'ko', 'pt-BR', 'pt-PT', 'ro', 'sk',
                'sl', 'sq', 'sv-SE', 'uk', 'zh-CN', 'zh-TW',
            ],
        'mozorg/about/manifesto.lang'           =>
            [
                'af', 'ar', 'ast', 'bg', 'bs', 'ca', 'cs', 'cy', 'de',
                'dsb', 'el', 'en-GB', 'es-AR', 'es-CL', 'es-ES', 'es-MX',
                'eu', 'fa', 'fi', 'fr', 'fur', 'fy-NL', 'gd', 'gl',
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
        'mozspaces.lang'                        => ['de', 'fr'],
        'mwc2014_promos.lang'                   => $mwc_locales,
        'newsletter/ios.lang'                   => $newsletter_locales,
        'privacy/index.lang'                    => $firefox_os,
        'privacy/principles.lang'               => $mozillaorg,
        'privacy/privacy-day.lang'              =>
            [
                'ca', 'cs', 'cy', 'de', 'dsb', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'es-MX', 'fa', 'fr', 'fy-NL', 'hsb', 'id', 'it',
                'ja', 'ko', 'lt', 'nl', 'pt-BR', 'ro', 'ru', 'son', 'sq',
                'sv-SE', 'uk', 'zh-CN', 'zh-TW',
            ],
        'snippets.lang'                         => $mozillaorg,
        'tabzilla/tabzilla.lang'                => $mozillaorg,
        'teach/smarton/index.lang'              =>
            [
                'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'fa', 'fr', 'it', 'pl', 'ro', 'sq',
                'zh-CN', 'zh-TW',
            ],
        'teach/smarton/security.lang'           =>
            [
                'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'fa', 'fr', 'it', 'pl', 'ro', 'sq',
                'zh-CN', 'zh-TW',
            ],
        'teach/smarton/surveillance.lang'       =>
            [
                'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'fa', 'fr', 'it', 'pl', 'ro', 'sq',
                'zh-CN', 'zh-TW',
            ],
        'teach/smarton/tracking.lang'           =>
            [
                'cs', 'cy', 'de', 'en-GB', 'es-AR', 'es-CL',
                'es-ES', 'fa', 'fr', 'it', 'pl', 'ro', 'sq',
                'zh-CN', 'zh-TW',
            ],
        'thunderbird/features.lang'             => $thunderbird_release,
        'thunderbird/index.lang'                => $thunderbird_release,
        'thunderbird/start/release.lang'        => $thunderbird_release,
        'upgradedialog.lang'                    => $startpage36,
        'upgradepromos.lang'                    =>
            ['de', 'es-ES', 'fr', 'it', 'pl', 'ru', 'pt-BR'],
    ],

    'start.mozilla.org' => ['fx36start.lang' => $startpage36],

    'about:healthreport' =>
    [
        'fhr.lang' => $firefox_desktop_android,
    ],

    'surveys' =>
    [
        'survey1.lang'               => ['de', 'es-ES', 'es-MX', 'fr', 'id', 'it', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN'],
        'survey2.lang'               => ['de', 'es-ES', 'fr',  'it', 'pl', 'pt-BR', 'ru'],
        'survey3.lang'               => ['de', 'es-ES', 'fr', 'it', 'ja', 'ko', 'pl', 'pt-BR', 'ru', 'zh-CN', 'zh-TW'],
        'survey4.lang'               => ['de', 'es-AR', 'es-ES', 'es-MX', 'fr', 'id', 'ja', 'pl', 'pt-BR', 'ru', 'tr', 'vi', 'zh-CN'],
        'survey5.lang'               => ['de', 'fr', 'pl'],
        'getinvolved_march2014.lang' => ['es-ES', 'id', 'pt-BR', 'zh-CN'],
        'survey_hello_fx42.lang'     => array_intersect($firefox_locales, $surveygizmo),
    ],

    'marketing' => ['julyevent.lang' => ['de', 'es-ES', 'fr', 'it', 'id', 'ja', 'pt-BR', 'ru', 'zh-CN', 'zh-TW']],

    'slogans' => [
        'firefoxos.lang'        => $slogans_locales,
        'marketplacebadge.lang' => $marketplacebadge_locales,
    ],

    'engagement' =>
    [
        'ios/ios_ads_nov2015.lang'              => ['de', 'fr'],
        'snippets/jun2014.lang'                 => ['de', 'el', 'es-ES', 'fr', 'hi-IN', 'hu', 'id', 'it', 'nl', 'pl', 'pt-BR', 'sr'],
        'snippets/aug2014_a.lang'               => ['es-ES'],
        'snippets/aug2014_b.lang'               => ['bn-BD', 'cs', 'hr', 'mk'],
        'snippets/aug2014_c.lang'               => ['de', 'fr', 'pl', 'nl', 'sl', 'sq', 'zh-TW'],
        'snippets/aug2014_d.lang'               => ['el', 'es-CL', 'es-MX', 'it', 'ja', 'pt-BR', 'ru', 'tr', 'sv-SE', 'sr'],
        'snippets/sep2014_a.lang'               => ['cs', 'de', 'es-ES', 'fr', 'it', 'pl'],
        'snippets/sep2014_b.lang'               => ['id', 'ja', 'ko', 'nb-NO', 'nl', 'ru', 'zh-CN'],
        'snippets/sep2014_c.lang'               => ['bn-BD', 'el', 'hi-IN', 'hu'],
        'snippets/sep2014_d.lang'               => ['pt-BR'],
        'snippets/sep2014_e.lang'               => ['sq'],
        'snippets/nov2014_a.lang'               =>
            [
                'ast', 'da', 'es-AR', 'es-CL', 'es-MX', 'fi', 'fy-NL',
                'he', 'ko', 'lv', 'nb-NO', 'nn-NO', 'pa-IN', 'rm', 'sk',
                'sl', 'zh-TW',
            ],
        'snippets/nov2014_b.lang'               => ['ja'],
        'snippets/nov2014_c.lang'               => ['es-ES', 'hu'],
        'snippets/nov2014_d.lang'               => ['de', 'fr', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/nov2014_e.lang'               => ['el', 'hi-IN', 'mk', 'sr'],
        'snippets/dec2014_a.lang'               => ['de', 'es-ES', 'fr', 'id', 'pt-BR', 'ru'],
        'snippets/dec2014_c.lang'               => ['sr'],
        'snippets/jan2015a_a.lang'              => ['hr'],
        'snippets/jan2015a_b.lang'              => ['el', 'hi-IN', 'hu', 'mk', 'sr'],
        'snippets/jan2015a_c.lang'              => ['de', 'es-ES', 'pt-BR'],
        'snippets/jan2015a_d.lang'              => ['fr', 'pl'],
        'snippets/jan2015b_a.lang'              => ['de', 'es-ES', 'fr', 'id', 'pl', 'pt-BR', 'ru'],
        'snippets/jan2015b_b.lang'              => ['el', 'hu', 'it', 'ja', 'nl'],
        'snippets/feb2015_a.lang'               => ['de', 'es-ES', 'pt-BR', 'ru'],
        'snippets/feb2015_b.lang'               => ['fr'],
        'snippets/feb2015_c.lang'               => ['id', 'it', 'ja', 'nl'],
        'snippets/feb2015_d.lang'               => ['el', 'hu', 'sr'],
        'snippets/feb2015_e.lang'               => ['pl'],
        'snippets/mar2015_a.lang'               => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
        'snippets/mar2015_b.lang'               => ['el', 'hu', 'id', 'it', 'ja', 'nl', 'pl'],
        'snippets/apr2015.lang'                 => ['de', 'es-ES', 'fr', 'pt-BR', 'ru'],
        'snippets/may2015_a.lang'               => ['de', 'fr', 'ru'],
        'snippets/may2015_b.lang'               => ['es-ES', 'pt-BR'],
        'snippets/spring2015.lang'              =>
            [
                'de', 'es-ES', 'fr', 'hu', 'it', 'ja',
                'pl', 'pt-BR', 'ru',
            ],
        'snippets/jun2015_a.lang'               => ['de', 'fr'],
        'snippets/jun2015_b.lang'               => ['ja'],
        'snippets/jun2015_c.lang'               => ['ru'],
        'snippets/jun2015_d.lang'               => ['es', 'pt-BR'],
        'snippets/jul2015_a.lang'               => ['de', 'fr', 'pt-BR'],
        'snippets/jul2015_b.lang'               => ['es', 'ru'],
        'snippets/jul2015_c.lang'               => ['ar'],
        'snippets/aug2015_a.lang'               => ['de', 'fr', 'ru'],
        'snippets/aug2015_b.lang'               => ['es', 'pt-BR'],
        'snippets/aug2015_c.lang'               => ['el', 'id', 'pl'],
        'snippets/aug2015_win10.lang'           => ['de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru'],
        'snippets/sep2015.lang'                 => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/sep2015_ios.lang'             => ['de'],
        'snippets/oct2015_a.lang'               => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/oct2015_b.lang'               => ['hu', 'ro'],
        'snippets/oct2015_c.lang'               => ['it', 'pl'],
        'snippets/oct2015_mofo.lang'            => ['de'],
        'snippets/fall2015.lang'                => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
        'snippets/nov2015_eoy_mofo.lang'        => ['es', 'fr', 'id', 'it', 'pt-BR'],
        'snippets/nov2015_a.lang'               => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/nov2015_b.lang'               => ['id', 'it', 'pl'],
        'snippets/dec2015_a.lang'               => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'snippets/dec2015_b.lang'               => ['id'],
        'tiles/careers.lang'                    => ['de', 'fr'],
        'tiles/suggestedtiles_infographic.lang' => ['de', 'es', 'fr'],
        'tiles/tiles.lang'                      => $firefox_locales,
        'tiles/tiles_jul2015.lang'              => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/tiles_aug2015.lang'              => ['de', 'es', 'fr', 'hu', 'it', 'ja', 'pl', 'pt-BR', 'ru'],
        'tiles/tiles_sep2015.lang'              => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/tiles_oct2015.lang'              => ['de', 'es', 'fr', 'pt-BR', 'ru'],
        'tiles/tiles_nov2015.lang'              => ['de', 'es', 'fr', 'id', 'it', 'pl', 'pt-BR', 'ru'],
    ],

    'add-ons' => [
        'privacycoach.lang' => $addons_locales,
    ],

    'firefox-updater' => [
        'updater.lang' => $firefox_updater_locales,
    ],

    'appstores' => [
        'description_page.lang'          => $google_play_target,
        'description_beta_page.lang'     => $google_play_target,
        'apple_description_release.lang' => $apple_store_target,
        'android_42_release.lang'        => $google_play_target, // yeah, marketing...
    ],

    'firefoxos-marketing' => [
        'marketplace_l10n_feed.lang' =>
            [
                'bg', 'bn-BD', 'cs', 'de', 'el', 'es-ES', 'fr',
                'hr', 'hu', 'it', 'ja', 'mk', 'pl', 'pt-BR',
                'ru', 'sr', 'sr-Latn', 'tr', 'zh-CN',
            ],
        'screenshots_2_0.lang' =>
            [
                'af', 'cs', 'de', 'es-ES', 'ja', 'pt-BR',
                'xh', 'zu',
            ],
        'screenshots_2_0_b.lang' =>
            [
                'ar', 'ee', 'ff', 'fr', 'ha', 'ig', 'sw',
                'wo', 'yo',
            ],
        'screenshots_dolphin.lang' => ['bn-BD', 'bn-IN', 'hi-IN', 'ta'],
        'screenshots.lang'         =>
            [
                'cs', 'de', 'el', 'es-ES', 'fr', 'hr', 'hu', 'it',
                'mk', 'pl', 'pt-BR', 'ro', 'ru', 'sr',
            ],
        'screenshots_tarako.lang' => ['hi-IN', 'ru', 'ta'],
    ],
];
