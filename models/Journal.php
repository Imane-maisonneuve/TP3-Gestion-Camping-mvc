<?php

namespace App\Models;

use App\Models\CRUD;

class Journal extends CRUD
{
    protected $table = 'journal';
    protected $primaryKey = 'id';
    protected $fillable = ['userId', 'nom', 'prenom', 'privilege', 'ip', 'pageVisite', 'method', 'dateEtHeure'];
}
