<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Collaborateur;


class AuthController
{

    public function create()
    {
        return View::render('auth/create');
    }

    public function show($data)
    {
        $validator = new Validator;
        $validator->field('courriel', $data['courriel'])->required()->max(50)->email();
        $validator->field('motDePasse', $data['motDePasse'])->min(6)->max(20);

        if ($validator->isSuccess()) {

            $collaborateur = new Collaborateur;
            $checkcollaborateur = $collaborateur->checkCollaborateur($data['courriel'], $data['motDePasse']);
            if ($checkcollaborateur) {
                return View::redirect('sites');
            } else {
                $errors['message'] = "Veuillez vérifier vos identifiants";
                return view::render('auth/create', ['errors' => $errors, 'collaborateur' => $data]);
            }
        } else {
            $errors = $validator->getErrors();
            return view::render('auth/create', ['errors' => $errors, 'collaborateur' => $data]);
        }
    }
    public function delete()
    {
        session_destroy();
        return View::redirect('login');
    }
}
