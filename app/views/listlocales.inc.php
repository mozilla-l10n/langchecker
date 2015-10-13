<?php
namespace Langchecker;

echo "<h1>Choose your locale:</h1>\n";
echo "<ul id='locales'>\n";

foreach ($mozilla as $current_locale) {
    echo "<li><a href='./?locale={$current_locale}'>{$current_locale}</a></li>\n";
}

echo "</ul>\n";
