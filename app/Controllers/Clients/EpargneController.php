<?php

namespace App\Controllers\Clients;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class EpargneController extends BaseController {
    protected function clientConnecte()
    {
        if (!session()->get('isLoggedIn')) {
            return null;
        }
        $clientModel = new ClientModel();
        return $clientModel->find(session()->get('client_id'));
    }

    public function index()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }
        return view('clients/epargne', ['client' => $client]);
    }

    public function definirPourcentage()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $pourcentage = (int) $this->request->getPost('pourcentage');

        if ($pourcentage < 0 || $pourcentage > 100) {
            return redirect()->back()->with('erreur', 'Le pourcentage doit être entre 0 et 100');
        }

        $clientModel = new ClientModel();
        $clientModel->update($client['id'], ['epargne_pourcentage' => $pourcentage]);

        return redirect()->to('/client/epargne')->with('succes', "Pourcentage d'épargne mis à jour : $pourcentage%");
    }

    public function transfererVersSolde()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $montant = (int) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()->with('erreur', 'Montant invalide');
        }

        if ($client['epargne_solde'] < $montant) {
            return redirect()->back()->with('erreur', 'Solde épargne insuffisant');
        }

        $clientModel = new ClientModel();
        $clientModel->update($client['id'], [
            'solde' => $client['solde'] + $montant,
            'epargne_solde' => $client['epargne_solde'] - $montant,
        ]);

        return redirect()->to('/client/epargne')->with('succes', 'Transfert vers votre solde principal effectué');
    }
}