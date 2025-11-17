<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Collaborateur;
use App\Models\Client;
use App\Models\Journal;
use App\Models\Privilege;

class JournalController
{

    public function show()
    {
        $journal = new Journal;
        $select = $journal->select();

        $privilege = new Privilege;

        $privileges = $privilege->select();

        return view::render('journal/show', ['privileges' => $privileges, 'journaux' => $select]);
    }
}
