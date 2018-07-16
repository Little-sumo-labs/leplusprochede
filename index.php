<?php

ini_set('display_errors', 1); // Afficher les erreurs à l'écran
error_reporting(E_ALL); // Afficher les erreurs et les avertissements

// Insertion des classes PHP
require 'vendor/autoload.php';

use \App\lePlusProcheDe as leplusprochede;

$infos = [
    ["4", 8, "range", 15, 16, 23, 42],
    [18, 3, -64, -9, -2, 18, 23, -6],
    [-15, -7, -9, -14, -12],
    [-15, -7, -9, -14, -12, 7],
    [12, -15, -7, -9, -14, -12],
    [-10, -10],
    [15, -7, 9, 14, 7, 12],
    [7, 5, 9, 4, 1],
    []
];

foreach ($infos as $info) {
    $leplusprochede = new leplusprochede($info);

    $resultat = $leplusprochede->check_value()
        ->unique()
        ->absolue()
        ->diff()
        ->pos_or_neg();

    echo $resultat->ecart."<br />";
}