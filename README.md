Langchecker
===========

Code to replicate the langchecker feature on [webdashboard](https://github.com/pascalchevrel/webdashboard).

To set it up, rename the file ```config/settings.inc.php.ini``` as ```config/settings.inc.php```, and indicate in this file the local paths to the various SVN repositories the application tracks.

Then install dependencies (composer install).

## Available URLs

```
/
```
Display a list of supported locales.

```
/?action=activation
```
Display files complete and ready to be activated.

```
/?action=api&file=FILEID```
```
Display a list of strings available in *FILEID*. For each string is available a link to a JSON record of all available translations. Add ```&callback=FUNCTION``` to use a callback function.

```
/?action=count
```
Display number of untranslated strings for each locale. Add ```&json``` to get data in JSON format.

```
/?action=coverage&LOCALES_ARRAY
```
Percentage of the l10n user base covered by requested locales. Example URL: ```?action=coverage&locales[]=it&locales[]=fr``` to get the coverage of French and Italian.

```
/?action=errors
```
Display errors for all supported files.

```
?action=listlocales&website=SITEID&file=FILEID&json
```
List of supported locale for a specific *FILEID* in JSON format.

```
?action=listlocales&project=PROJECTID&json
```
List of supported locale for a specific *PROJECTID* in JSON format. Available projects: locamotion, marketplacebadge, slogans, snippets, snippets_main.

```
/?action=listpages
```
List of supported websites and pages.

```
/?action=translated&file=FILEID
```
Display a page with all available translations of *FILEID*.

```
/?locale=LOCALEID
```
Display status of locale with code *LOCALEID*. Add ```&json``` to get data in JSON format.

```
/?website=SITEID&file=FILEID&locale=all
```
Display global status of *FILEID*. Add ```&json``` to get data in JSON format.

## lang_update syntax

```
./scripts/lang_update mozorg/home.lang 0 all
```
One file, all locales. 2nd and 3rd parameters are optional for mozilla.org, element 0 in $sites.

```
./scripts/lang_update mozorg/home.lang 0 fr
```
One file, one locale (French in this case).

```
./scripts/lang_update all 0 fr
```
All files, one locale (French in this case).

```
./scripts/lang_update all 0 all
```
All files, all locales.

```
./scripts/lang_update all 0 all locamotion
./scripts/lang_update all 0 cy locamotion
./scripts/lang_update mozorg/home.lang 0 cy locamotion
```
Import files for all or one specific locale (cy in this case) from Pootle.

## .lang format

Example .lang file format:

```
## active ##    // optional, only valid at the beginning of the file
## tag_name ##  // optional tags after the activation status

## NOTE: file description // optional

## TAG: tag_name // optional, used to bind a string to a tag
# Comment  // optional
;String in english
translated string


;Another string
another translated string


```