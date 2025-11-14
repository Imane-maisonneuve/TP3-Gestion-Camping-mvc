<?php

namespace App\Models;

use App\Models\CRUD;

class Collaborateur extends CRUD
{
    protected $table = 'collaborateur';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'prenom', 'adresse', 'codePostal', 'telephone', 'courriel', 'motDePasse', 'matricule', 'privilegeId'];
}
