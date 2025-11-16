<?php

namespace App\Controllers;

use App\Models\Site;
use App\Models\Categorie;
use App\Models\Collaborateur;
use App\Models\Reservation;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class SiteController
{
    public function index()
    {
        $site = new Site;
        $select = $site->select('id', 'desc');

        return View::render("site/index", ['sites' => $select, 'ASSET' => ASSET, 'base' => BASE]);
    }

    public function create()
    {
        Auth::session();
        if (Auth::privilege(1)) {
            $categorie = new Categorie;
            $selectCategorie = $categorie->select();

            return View::render("site/create", ['categories' => $selectCategorie]);
        } else {
            return View::render('error', ['msg' => 'Accès non autorisé']);
        }
    }

    public function store($data)
    {
        Auth::session();
        if (Auth::privilege(1)) {
            $validator = new Validator;
            $validator->field('siteNom', $data['siteNom'])->required();
            $validator->field('siteDescription', $data['siteDescription'])->required();
            $validator->field('capacite', $data['capacite'])->int()->bigger(10);
            $validator->field('prix', $data['prix'])->int()->max(10);
            $validator->field('urlImage', $data['urlImage'])->required();
            $validator->field('categorieId', $data['categorieId'])->required();

            if ($validator->isSuccess()) {
                $Site = new Site;
                $insert = $Site->insert($data);
                return View::redirect('sites');
            } else {
                $errors = $validator->getErrors();
                $Site = new Site;
                $categorie = new Categorie;
                $selectId = $categorie->selectId($data['categorieId']);
                $selectCategorie = $categorie->select();

                return View::render('site/create', ['errors' => $errors, 'categorie' => $selectId, 'categories' => $selectCategorie, 'site' => $data]);
            }
        } else {
            return View::render('error', ['msg' => 'Accès non autorisé']);
        }
    }

    public function edit($data = [])
    {
        Auth::session();
        if (isset($data['id']) && $data['id'] != null) {
            $Site = new Site;
            $selectId = $Site->selectId($data['id']);

            if ($selectId) {
                $categorie = new Categorie;
                $selectCategorie = $categorie->select();

                return View::render("site/edit", ['site' => $selectId, 'categories' => $selectCategorie]);
            } else {
                return View::render('error', ['msg' => 'Aucun site trouvée pour cet identifiant!']);
            }
        } else {
            return View::render('error', ['msg' => 'Identifiant de site manquant ou invalide!']);
        }
    }

    public function update($data = [], $get = [])
    {
        Auth::session();
        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator;
            $validator->field('siteNom', $data['siteNom'])->max(20);
            $validator->field('siteDescription', $data['siteDescription'])->max(100);
            $validator->field('capacite', $data['capacite'])->int()->bigger(10);
            $validator->field('prix', $data['prix'])->int();
            $validator->field('urlImage', $data['urlImage']);
            $validator->field('categorieId', $data['categorieId']);
            $validator->field('collaborateurId', $data['collaborateurId']);

            if ($validator->isSuccess()) {

                $Site = new Site;
                $update = $Site->update($data, $get['id']);

                if ($update) {
                    View::redirect('sites');
                } else {
                    return View::render('error', ['msg' => 'Echec de la mise à jour!']);
                }
            } else {
                $errors = $validator->getErrors();
                $Site = new Site;
                $selectId = $Site->selectId($data['id']);
                $categorie = new Categorie;
                $selectCategorie = $categorie->select();

                return View::render('site/edit', ['errors' => $errors, 'site' => $selectId, 'categories' => $selectCategorie]);
            }
        } else {
            return View::render('error', ['msg' => 'Identifiant de site manquant ou invalide!!']);
        }
    }

    public function delete($data)
    {
        if (Auth::session()) {
            $reservation = new Reservation;
            $selectListe = $reservation->selectListe('siteId', $data['id']);
            $count = count($selectListe);

            if ($count > 0) {
                foreach ($selectListe as $selected) {
                    $reservation = new Reservation;
                    $delete = $reservation->delete($selected['id']);
                }
            }

            $Site = new Site;
            $delete = $Site->delete($data['id']);

            if ($delete) {
                View::redirect('sites');
            } else {
                return View::render('error', ['msg' => 'Echec de la suppression!']);
            }
        }
    }
}
