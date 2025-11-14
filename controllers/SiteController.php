<?php

namespace App\Controllers;

use App\Models\Site;
use App\Providers\View;

class SiteController
{

    public function index()
    {
        $site = new Site;
        $select = $site->select();

        return View::render("site/index", ['sites' => $select, 'ASSET' => ASSET, 'base' => BASE]);
    }
}
