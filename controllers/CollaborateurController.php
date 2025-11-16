<?php

namespace App\Controllers;

use App\Models\Categorie;
use App\Providers\View;
use App\Models\Collaborateur;
use App\Models\Privilege;
use App\Providers\Validator;
use App\Providers\Auth;

class CollaborateurController
{

    public function __construct()
    {
        Auth::session();
    }

    public function index()
    {
        if (Auth::privilege(2) || Auth::privilege(1)) {
            $collaborateur = new Collaborateur;
            $select = $collaborateur->select('created_at', 'desc');
            $privilege =  new Privilege;
            $selectPrivileges = $privilege->select();
            return View::render("collaborateur/index", ['collaborateurs' => $select, 'privileges' => $selectPrivileges]);
        } else {

            return View::redirect("sites");
        }
    }

    public function create()
    {
        if (Auth::privilege(1)) {

            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return View::render('collaborateur/create', ['privileges' => $privileges]);
        } else {
            return View::redirect("sites");
        }
    }

    public function store($data)
    {

        Auth::privilege(1);

        $validator = new Validator;
        $validator->field('nom', $data['nom'])->required()->min(2)->max(50);
        $validator->field('prenom', $data['prenom'])->required()->min(2)->max(50);
        $validator->field('adresse', $data['adresse'])->required()->min(10)->max(50);
        $validator->field('codePostal', $data['codePostal'])->required()->min(7)->max(10);
        $validator->field('telephone', $data['telephone'])->min(7)->max(20);
        $validator->field('courriel', $data['courriel'])->required()->max(50)->email()->unique('Collaborateur');
        $validator->field('motDePasse', $data['motDePasse'])->required()->min(6)->max(20);
        $validator->field('matricule', $data['matricule'])->min(4)->max(50);
        $validator->field('privilegeId', $data['privilegeId'], 'privilege')->required();

        if ($validator->isSuccess()) {
            $collaborateur = new Collaborateur;
            $data['motDePasse'] = $collaborateur->hashPassword($data['motDePasse']);
            $insert = $collaborateur->insert($data);
            if ($insert) {
                return view::redirect('collaborateurs');
            } else {
                return view::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return view::render('collaborateur/create', ['errors' => $errors, 'privileges' => $privileges, 'collaborateur' => $data]);
        }
    }
}
