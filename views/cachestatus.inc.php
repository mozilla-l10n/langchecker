<h1>Age of cached lang files</h1>
<?php

foreach($sites[$website][4] as $_file) {

    // mozilla europe codes
    if($website == 1) {
        $reflang = 'en';
    } else {
        $reflang = 'en-GB';
    }

    echo '<table class="globallist"><tr><th colspan="2" class="filename">' . $_file . '</th></tr>';
    echo '<tr><th>Locale</th><th>Age</th></tr>';

    // reassign a lang file to a reduced set of locales
    $targetted_locales = (is_array($langfiles_subsets[$sites[$website][0]][$_file])) ? $langfiles_subsets[$sites[$website][0]][$_file] : $sites[$website][3];

    foreach( $targetted_locales as $_lang) {

        $local_file = $sites[$website][5] . '/' . $_lang . '-' . $filename;
        $age = fileAge($local_file);

        // mozilla europe locale codes
        if($website == 1) {;
            $_lang = mozeuLocaleConvert($_lang);
        }

        echo '<tr>';
        echo '<td><a href="./?locale=' . $_lang . '">' . $_lang . '</a></td>';
        echo '<td>' . $age . '</td>';

    }

    echo '</table>';

}

