<?php

namespace App\Models;

use App\Models\CRUD;

class Reservation extends CRUD
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $fillable = ['dateArrivee', 'dateDepart', 'nbrDePersonnes', 'clientId', 'siteId', 'statutId'];
}
