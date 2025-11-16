<?php

namespace App\Models;

use App\Models\CRUD;

class Collaborateur extends CRUD
{
    protected $table = 'collaborateur';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'prenom', 'adresse', 'codePostal', 'telephone', 'courriel', 'motDePasse', 'matricule', 'privilegeId'];

    public function hashPassword($motDePasse, $cost = 10)
    {
        $options = [
            'cost' => $cost
        ];

        return password_hash($motDePasse, PASSWORD_BCRYPT, $options);
    }

    public function checkCollaborateur($courriel, $motDePasse)
    {
        $collaborateur = $this->unique('courriel', $courriel);
        if ($collaborateur) {
            if (password_verify($motDePasse, $collaborateur['motDePasse'])) {
                session_regenerate_id();
                $_SESSION['collaborateur_id'] = $collaborateur['id'];
                $_SESSION['collaborateur_name'] = $collaborateur['name'];
                $_SESSION['privilege_id'] = $collaborateur['privilegeId'];
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
