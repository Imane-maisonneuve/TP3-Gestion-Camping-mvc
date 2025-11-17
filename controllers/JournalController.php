<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Collaborateur;
use App\Models\Client;


class JournalController
{

    public function create()
    {
        return view::render('journal/create');
    }
}
