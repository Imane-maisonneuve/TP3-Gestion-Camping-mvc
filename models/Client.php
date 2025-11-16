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
}
