<?php
namespace App\Controllers\Clients;

use App\Controllers\BaseController;

use App\Models\ClientModel;
use App\Models\PrefixeModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('clients/login');
    }

    public function verifier()
    {
        $numero = $this->request->getPost('numero');

        $prefixeModel = new PrefixeModel();
        $clientModel = new ClientModel();

        $prefixe = substr($numero, 0, 3);
        $prefixeValide = $prefixeModel->where('prefixe', $prefixe)->first();

        if (!$prefixeValide) {
            return redirect()->back()->with('erreur', 'Numéro invalide, préfixe non reconnu');
        }

        $client = $clientModel->where('numero', $numero)->first();

        if (!$client) {
            $clientModel->insert(['numero' => $numero, 'solde' => 0]);
            $client = $clientModel->where('numero', $numero)->first();
        }

        session()->set([
            'client_id' => $client['id'],
            'numero' => $client['numero'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/client/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}