<?php

namespace App\Controllers;

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
        Auth::privilege(1);
    }
    public function create()
    {
        $privilege = new Privilege;
        $privileges = $privilege->select('privilege');
        return View::render('collaboratteur/create', ['privileges' => $privileges]);
    }

    public function store($data)
    {
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->min(2)->max(50);
        $validator->field('prenom', $data['prenom'])->min(2)->max(50);
        $validator->field('adresse', $data['adresse'])->min(10)->max(50);
        $validator->field('codePostal', $data['codePostal'])->min(7)->max(10);
        $validator->field('telephone', $data['telephone'])->min(7)->max(20);
        $validator->field('courriel', $data['courriel'])->required()->max(50)->email()->unique('Collaboratteur');
        $validator->field('motDePasse', $data['motDePasse'])->min(6)->max(20);
        $validator->field('matricule', $data['matricule'])->min(4)->max(50);
        $validator->field('privilegeId', $data['privilegeId'], 'privilege')->required()->int();

        if ($validator->isSuccess()) {
            $collaboratteur = new Collaborateur;
            $data['motDePasse'] = $collaboratteur->hashPassword($data['motDePasse']);
            $insert = $collaboratteur->insert($data);
            if ($insert) {
                return view::redirect('login');
            } else {
                return view::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return view::render('collaboratteur/create', ['errors' => $errors, 'privileges' => $privileges, 'collaboratteur' => $data]);
        }
    }
}
