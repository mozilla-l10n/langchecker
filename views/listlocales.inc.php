
<h1>Choose your locale:</h1>
<style>

ul#locales {
    -moz-column-count: 6;
    width: 80%;
}
</style>
<?php

echo '<ul id="locales">';

foreach ($mozilla as $_lang) {
    echo '<li><a href="./?locale=' . $_lang . '">' . $_lang . '</a></li>';
}

echo '</ul>';
