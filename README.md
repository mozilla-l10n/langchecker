# Langchecker

Code to replicate the langchecker feature on [webdashboard]. See the [Wiki] for further details.

## Installation

System requirements:
* PHP 5.6 or later.
* HTTP server (Apache, nginx, internal PHP server).

Setup:
* Rename or copy the file `app/config/settings.inc.php.ini` as `app/config/settings.inc.php`, then:
    * Specify in `$local_storage` the local path to the folder that will be used to store all repositories.
    * Specify if the app will be served from the root or from a subfolder by customizing `$webroot_folder`.
* Install [Composer] (PHP dependency manager), either locally or globally, then install the dependencies by running `php composer.phar install` from the project's root folder.
* Make sure that the `/cache` folder is writable by the user running PHP.

## Usage

You need to run the update script at least once to clone all the repositories.

```
./app/scripts/update_sources
```

On a production server you want to schedule this script as a cronjob.

# License

This software is released under the terms of the [Mozilla Public License v2.0].

[Composer]: https://getcomposer.org/download/
[webdashboard]: https://github.com/mozilla-l10n/webdashboard
[Wiki]: https://github.com/mozilla-l10n/langchecker/wiki
[Mozilla Public License v2.0]: http://www.mozilla.org/MPL/2.0/
