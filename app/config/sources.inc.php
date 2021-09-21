<?php

$no_active_tag = [];

$engagement_locales = [
    'de', 'es-ES', 'es', 'fr', 'it', 'ja', 'pl', 'pt-BR',
];

/*
    For each file it's possibile to specify the following fields:
    * deadline: if the deadline is the same for all locales, assign the deadline
      as a string in ISO format (YYYY-MM-DD):

      'deadline' => '2016-04-29',

      If deadline needs to change based on the locale, you can use a
      multidimensional array, where each deadline is associated to a list of
      locales. 'all' can be used to indicate that deadline applies to all
      supported locales. Example, deadline only for two locales:

      'deadline' => [
          '2016-04-25' => ['de', 'fr'],
      ],

      Different deadlines:

      'deadline' => [
          '2016-04-25' => ['de', 'fr'],
          '2016-01-05' => ['all'],
      ],

    * priority: priorities are numeric values assigned to files. 1 is the
      highest priority, 5 is the lowest.

      If the priority is the same for all locales, simply assign it like this:

      priority => 1,

      If priority needs to change based on the locale, you can use a
      multidimensional array, where each priority is associated to a
      list of locales. 'all' can be used to indicate that priority applies to
      all supported locales. Example:

      'priority' => [
          1 => ['de', 'fr'],
          2 => ['all'],
      ],

      If not specified, the default priority defined in the project will be
      used.

    * flags: a multidimensional array. For each key (tag), there's an array
      of locales for which the tag is valid. 'all' can be used to
      indicate that tag applies to all other supported locales, e.g.

      'flags' => [
          'opt-in' => ['all'],
      ],
*/

// Default priority is 1
$engagement_lang = [
    'emails/2016/fundraising_email_1.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it'],
    ],
    'emails/2016/fundraising_email_2.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it'],
    ],
    'emails/2016/fundraising_email_3.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/advo-autoresponder.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/buyers_guide_2.lang' => [
        'supported_locales' => ['es'],
    ],
    'emails/2017/copyright_call.lang' => [
        'supported_locales' => ['de', 'fr', 'es', 'pl'],
    ],
    'emails/2017/copyright_call_IMCO.lang' => [
        'supported_locales' => ['de'],
    ],
    'emails/2017/copyright.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/copyright_sept.lang' => [
        'supported_locales' => [
            'de', 'fr', 'it', 'pl',
        ],
    ],
    'emails/2017/copyright_summer.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2017/data_privacy_day.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/fundraising_email_1.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_2.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_4_a.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_email_4_b.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2017/fundraising_mitchell.lang' => [
        'supported_locales' => ['de', 'fr', 'pt-BR'],
    ],
    'emails/2017/fundraising_moco.lang' => [
        'supported_locales' => ['de'],
    ],
    'emails/2017/fundraising_oct.lang' => [
        'supported_locales' => ['de'],
    ],
    'emails/2017/fundraising_thank_you.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it'],
    ],
    'emails/2017/ihr_email_a.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/iot_results_a.lang' => [
        'supported_locales' => ['es'],
    ],
    'emails/2017/iot_results_b.lang' => [
        'supported_locales' => ['de', 'fr', 'pt-BR'],
    ],
    'emails/2017/iot_survey.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2017/mozfest_call.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2017/paperstorm.lang' => [
        'supported_locales' => ['de', 'es-ES', 'fr', 'it'],
    ],
    'emails/2017/results_graphics.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/survey_results.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2017/template.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'it', 'pl'],
    ],
    'emails/2017/welcome-message.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/cambridge_analytica.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/clear_history.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/cloudpets.lang' => [
        'supported_locales' => ['de'],
    ],
    'emails/2018/copyright_sept_vote.lang' => [
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'emails/2018/copyright_sept_vote_v2.lang' => [
        'supported_locales' => [
            'de', 'fr', 'pl',
        ],
    ],
    'emails/2018/copyright_stage_2.lang' => [
        'supported_locales' => [
            'de', 'fr', 'it',
        ],
    ],
    'emails/2018/copyright_win.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/cross_site_tracking_petition.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/cross_site_tracking_petition_kicker.lang' => [
        'supported_locales' => ['es', 'pt-BR'],
    ],
    'emails/2018/donor_mid_year_update.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/donor_survey_march.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/donor_update_feb.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/facebook_2fa.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_giving_tuesday.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_july.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_may.lang' => [
        'supported_locales' => ['de', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_misinfo.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_mitchell.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_oct.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/fundraising_sept.lang' => [
        'supported_locales' => ['de', 'fr', 'pl'],
    ],
    'emails/2018/fundraising_surman.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2018/fundraising_thank_you.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2018/fundraising_valentines_day.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/ihr_launch.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2018/zuckerberg_eu.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl'],
    ],
    'emails/2018/zuckerberg_eu_hearing.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/ad_API.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/ai_survey.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/ai_survey_oct.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/ai_survey_results.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/amazon_privacy_policy.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pl', 'pt-BR'],
    ],
    'emails/2019/apple_privacy.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/apple_privacy_kicker.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fb_2fa_win.lang' => [
        'supported_locales' => ['de', 'fr', 'pl'],
    ],
    'emails/2019/fb_employees_support.lang' => [
        'supported_locales' => ['fr'],
    ],
    'emails/2019/fb_open_letter.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fb_open_letter_response.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fundraising_eoy_ashley.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_eoy_mark.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_eoy_mitchell.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_giving_tuesday.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_june.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/fundraising_nov_fx.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/fundraising_sept.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2019/guardian_reportback.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/misinfo_survey.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/misinfo_survey_global.lang' => [
        'supported_locales' => ['pt-BR'],
    ],
    'emails/2019/ad_transparency_latam.lang' => [
        'supported_locales' => ['es', 'pt-BR'],
    ],
    'emails/2019/voice_assistants.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2019/yt_regrets.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2019/yt_regrets_site.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2020/donor_expired_card.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/fb_groups.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2020/fundraising_june.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/how_can_we_help.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2020/nextdoor.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/pni_video_apps.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/stophateforprofit.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2020/stophateforprofit_action_day.lang' => [
        'supported_locales' => ['de', 'es', 'fr', 'pt-BR'],
    ],
    'emails/2020/ring_win.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_e2e.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_email.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_report_back.lang' => [
        'supported_locales' => ['de', 'es', 'fr'],
    ],
    'emails/2020/zoom_victory.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2021/shfp_vote.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'emails/2021/slack.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2021/slack_shareprogress.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
    'other/2021/slack_typeform.lang' => [
        'supported_locales' => ['de', 'fr'],
    ],
];
