<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'routes/web.php';

if (!isset($_SESSION['journal'])) {
    $_SESSION['journal'] = [];
}

if (isset($_SESSION['user_id'])) {
    $_SESSION['journal'][] = [
        'nom' => $_SESSION['user_nom'],
        'prenom' => $_SESSION['user_prenom'],
        'privilege' => $_SESSION['privilege_id'],
        'ip' => $_SERVER['REMOTE_ADDR'],
        'dateEtHeure' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
        'pageVisite' => $_SERVER['REQUEST_URI'],
        'method' => $_SERVER['REQUEST_METHOD'],
    ];
};
