<?php

namespace App\Models;

use App\Models\CRUD;

class Client extends CRUD
{
    protected $table = 'Client';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'prenom', 'adresse', 'codePostal', 'telephone', 'courriel', 'motDePasse'];
}
