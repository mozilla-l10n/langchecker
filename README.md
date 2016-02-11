# Langchecker
Code to replicate the langchecker feature on [webdashboard](https://github.com/mozilla-l10n/webdashboard).

To set it up:
* Rename the file ```app/config/settings.inc.php.ini``` as ```app/config/settings.inc.php```.
* Indicate in this file the local paths to the various VCS repositories the application tracks.
* Indicate if the app will be served from the root or from a subfolder.

Then install dependencies (composer install).

See [wiki](https://github.com/mozilla-l10n/langchecker/wiki) for further details.

# License
This software is released under the terms of the [Mozilla Public License v2.0](http://www.mozilla.org/MPL/2.0/).
