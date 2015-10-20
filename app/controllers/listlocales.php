<?php

print $twig->render(
    'listlocales.twig',
    [
        'locales' => $mozilla,
    ]
);
