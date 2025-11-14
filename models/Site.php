<?php

namespace App\Models;

use App\Models\CRUD;

class Site extends CRUD
{
    protected $table = 'site';
    protected $primaryKey = 'id';
}
