<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\Operateurs\OperateurModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('operateurs/login');
    }

    public function verifier()
    {
        $identifiant = $this->request->getPost('identifiant');
        $motDePasse = $this->request->getPost('mot_de_passe');

        $model = new OperateurModel();
        $operateur = $model->where('identifiant', $identifiant)->first();

        if (!$operateur || !password_verify($motDePasse, $operateur['mot_de_passe'])) {
            return redirect()->back()->with('erreur', 'Identifiant ou mot de passe incorrect.');
        }

        session()->set([
            'operateur_id' => $operateur['id'],
            'identifiant'  => $operateur['identifiant'],
            'isOperateurLoggedIn' => true,
        ]);

        return redirect()->to('/operateur/prefixes');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/operateur/login');
    }
}
