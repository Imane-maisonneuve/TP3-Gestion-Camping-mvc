<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'routes/web.php';


$_SESSION['journaux'][] = [
    'Nom' => $_SESSION['collaborateur_nom'],
    'Prenom' => $_SESSION['collaborateur_prenom'],
    'ip' => $_SERVER['REMOTE_ADDR'],
    'dateEtHeure' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
    'pageVisite' => $_SERVER['REQUEST_URI'],
    'method' => $_SERVER['REQUEST_METHOD'],
];;
