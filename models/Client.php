<?php

namespace App\Models;

use App\Models\CRUD;

class Client extends CRUD
{
    protected $table = 'Client';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'prenom', 'adresse', 'codePostal', 'telephone', 'courriel', 'motDePasse'];

    public function hashPassword($password, $cost = 10)
    {
        $options = [
            'cost' => $cost
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function checkclient($courriel, $motDePasse)
    {
        $client = $this->unique('courriel', $courriel);
        if ($client) {
            if (password_verify($motDePasse, $client['motDePasse'])) {
                session_regenerate_id();
                $_SESSION['client_id'] = $client['id'];
                $_SESSION['client_nom'] = $client['nom'];
                $_SESSION['client_prenom'] = $client['prenom'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                return true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }
}
