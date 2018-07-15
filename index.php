<?php

ini_set('display_errors', 1); // Afficher les erreurs à l'écran
error_reporting(E_ALL); // Afficher les erreurs et les avertissements

// Insertion des classes PHP
require 'vendor/autoload.php';

use \App\lePlusProcheDe as leplusprochede;

// Mettre les valeurs dans un tableau en se servant de l’espace comme séparateur
// Bingo?


$infos = ["4", 8, "range", 15, 16, 23, 42];
$infos = [18, 3, -64, -9, -2, 18, 23, -6];

/*
$infos = [-15, -7, -9, -14, -12];
$infos = [-15, -7, -9, -14, -12, 7];
$infos = [12, -15, -7, -9, -14, -12];
$infos = [-10, -10];
$infos = [15, -7, 9, 14, 7, 12];
$infos = [7, 5, 9, 4, 1];
$infos = [];
*/

$leplusprochede = new leplusprochede($infos);

$infos = $leplusprochede->check_value()
    ->unique()
    ->absolue()
    ->diff()
    ->pos_or_neg();

echo $infos->ecart;