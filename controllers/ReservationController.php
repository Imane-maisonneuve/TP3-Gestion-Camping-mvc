<?php

namespace App\Controllers;

use App\Models\Reservation;
use App\Models\Statut;
use App\Models\Site;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class ReservationController
{
    public function __construct()
    {
        Auth::session();
    }

    public function index()
    {
        return View::render("reservation/index", ['ASSET' => ASSET, 'base' => BASE]);
    }

    public function create($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $site = new Site;
            $selectId = $site->selectId($data['id']);
            if ($selectId) {
                return View::render("reservation/create", ['site' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'Site(id) non trouvé dans la Base de données!']);
            }
        } else {
            return View::render('error', ['msg' => 'Identifiant de site manquant ou invalide!']);
        }
    }

    public function store($data)
    {
        $validator = new Validator;
        $validator->field('dateArrivee', $data['dateArrivee'])->validateDate();
        $validator->field('dateDepart', $data['dateDepart'])->validateDate();
        $validator->field('nbrDePersonnes', $data['nbrDePersonnes'])->int()->max(10);

        if ($validator->isSuccess()) {
            $reservation = new Reservation;
            $insert = $reservation->insert($data);
            return View::redirect('reservation/show?id=' . $data['clientId']);
        } else {
            $errors = $validator->getErrors();
            $reservation = new Reservation;
            $site = new Site;
            $selectId = $site->selectId($data['siteId']);
            return View::render('reservation/create', ['errors' => $errors, 'site' => $selectId, 'reservation' => $data]);
        }
    }

    public function show($data = [])
    {
        if (isset($data) && $data != null) {
            $reservation = new Reservation;
            $selectListe = $reservation->selectListe('clientId', $data['id']);
            $statut = new Statut;
            $selectStatut = $statut->select();
            $site = new Site;
            $selectSite = $site->select();
            return View::render("reservation/show", ['reservations' => $selectListe, 'statuts' => $selectStatut, 'sites' => $selectSite]);
        } else {
            return View::render('error', ['msg' => 'Courriel manquant pour afficher les réservations!']);
        }
    }
}
