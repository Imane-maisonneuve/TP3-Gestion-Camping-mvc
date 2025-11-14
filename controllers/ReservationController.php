<?php

namespace App\Controllers;

use App\Models\Reservation;
use App\Models\Statut;
use App\Models\Site;
use App\Providers\View;
use App\Providers\Validator;

class ReservationController
{


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
        $validator->field('courriel', $data['courriel'])->required()->email()->max(45);

        if ($validator->isSuccess()) {

            $reservation = new Reservation;
            $insert = $reservation->insert($data);
            return View::redirect('reservation/show?courriel=' . $data['courriel']);
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
        $validator = new Validator;
        $validator->field('courriel', $data['courriel'])->required()->email()->max(45);
        if ($validator->isSuccess()) {
            if (isset($data) && $data != null) {
                $reservation = new Reservation;
                $selectListe = $reservation->selectListe('courriel', $data['courriel']);
                if ($selectListe) {
                    $statut = new Statut;
                    $selectStatut = $statut->select();
                    $site = new Site;
                    $selectSite = $site->select();
                    return View::render("reservation/show", ['reservations' => $selectListe, 'statuts' => $selectStatut, 'sites' => $selectSite]);
                } else {
                    return View::render('error', ['msg' => 'Aucune réservation ne correspond à ce courriel!']);
                }
            } else {
                return View::render('error', ['msg' => 'Courriel manquant pour afficher les réservations!']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('reservation/index', ['errors' => $errors, $data]);
        }
    }


    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $reservation = new Reservation;
            $selectId = $reservation->selectId($data['id']);
            if ($selectId) {
                $statut = new Statut;
                $selectStatut = $statut->select();
                $site = new Site;
                $selectSite = $site->selectId($selectId['siteId']);

                return View::render("reservation/edit", ['reservation' => $selectId, 'statuts' => $selectStatut, 'site' => $selectSite]);
            } else {
                return View::render('error', ['msg' => 'Aucune réservation trouvée pour cet identifiant!']);
            }
        } else {
            return View::render('error', ['msg' => 'Identifiant de réservation manquant ou invalide!']);
        }
    }

    public function update($data = [], $get = [])
    {
        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator;
            $validator->field('dateArrivee', $data['dateArrivee'])->validateDate();
            $validator->field('dateDepart', $data['dateDepart'])->validateDate();
            $validator->field('nbrDePersonnes', $data['nbrDePersonnes'])->int()->max(10);
            $validator->field('courriel', $data['courriel'])->required()->email()->max(45);
            $validator->field('statutId', $data['statutId'])->required();

            if ($validator->isSuccess()) {

                $reservation = new Reservation;
                $update = $reservation->update($data, $get['id']);

                if ($update) {
                    View::redirect('reservation/show?courriel=' . $data['courriel']);
                } else {
                    return View::render('error', ['msg' => 'Echec de la mise à jour!']);
                }
            } else {
                $errors = $validator->getErrors();
                $reservation = new Reservation;
                $selectId = $reservation->selectId($data['id']);
                $statut = new Statut;
                $selectStatut = $statut->select();
                $site = new Site;
                $selectSite = $site->selectId($selectId['siteId']);

                return View::render('reservation/edit', ['errors' => $errors, 'statuts' => $selectStatut, 'site' => $selectSite, 'reservation' => $selectId]);
            }
        } else {
            return View::render('error', ['msg' => 'Identifiant de réservation manquant ou invalide!!']);
        }
    }


    public function delete($data)
    {
        $reservation = new Reservation;
        $delete = $reservation->delete($data['id']);
        if ($delete) {
            View::redirect('reservation/show?courriel=' . $data['courriel']);
        } else {
            return View::render('error', ['msg' => 'Echec de la suppression!']);
        }
    }
}
