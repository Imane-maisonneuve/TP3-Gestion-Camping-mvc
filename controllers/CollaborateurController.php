<?php

namespace App\Controllers;

use App\Models\Categorie;
use App\Providers\View;
use App\Models\Collaborateur;
use App\Models\Privilege;
use App\Providers\Validator;
use App\Providers\Auth;
// use FPDF\FPDF;
use \Fpdf\Fpdf;

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
            return View::render('error', ['msg' => 'Accès non autorisé']);
        }
    }

    public function create()
    {
        if (Auth::privilege(1)) {

            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return View::render('collaborateur/create', ['privileges' => $privileges]);
        } else {
            return View::render('error', ['msg' => 'Accès non autorisé']);
        }
    }

    public function store($data)
    {

        if (Auth::privilege(1)) {

            $validator = new Validator;
            $validator->field('nom', $data['nom'])->required()->min(2)->max(50);
            $validator->field('prenom', $data['prenom'])->required()->min(2)->max(50);
            $validator->field('adresse', $data['adresse'])->required()->min(10)->max(50);
            $validator->field('codePostal', $data['codePostal'])->required()->max(7);
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
                    // Pdf
                    $this->generatePdf();
                    // pdf
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
        } else {
            return View::redirect("sites");
        }
    }
    private function generatePdf()
    {
        // Récupérer tous les collaborateurs
        $collaborateur = new Collaborateur;
        $collaborateurs = $collaborateur->select();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Liste des collaborateurs', 0, 1, 'C');
        $pdf->Ln(5);

        // Entêtes
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30, 10, 'Nom', 1);
        $pdf->Cell(30, 10, 'Prenom', 1);
        $pdf->Cell(50, 10, 'Email', 1);
        $pdf->Cell(30, 10, 'Telephone', 1);
        $pdf->Cell(40, 10, 'Matricule', 1);
        $pdf->Cell(60, 10, 'Date de creation', 1);
        $pdf->Ln();

        // Données
        $pdf->SetFont('Arial', '', 12);
        foreach ($collaborateurs as $c) {
            $pdf->Cell(30, 10, $c['nom'], 1);
            $pdf->Cell(30, 10, $c['prenom'], 1);
            $pdf->Cell(50, 10, $c['courriel'], 1);
            $pdf->Cell(30, 10, $c['telephone'], 1);
            $pdf->Cell(40, 10, $c['matricule'], 1);
            $pdf->Cell(60, 10, $c['created_at'], 1);
            $pdf->Ln();
        }
        // Enregistrer à la racine
        $pdf->Output('F', __DIR__ . '/../zpdf/collaborateurs.pdf');
    }
}
