<?php

namespace App\Controllers\Clients;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\HistoriqueModel;
use App\Models\BaremeFraisModel;


class OperationController extends BaseController
{
    protected function clientConnecte()
    {
        if (!session()->get('isLoggedIn')) {
            return null;
        }
        $clientModel = new ClientModel();
        return $clientModel->find(session()->get('client_id'));
    }

    //depot
    public function depot()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }
        return view('clients/depot', ['client' => $client]);
    }

    public function depotValider()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $montant = (int) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()->with('erreur', 'Montant invalide');
        }

        $clientModel = new ClientModel();
        $nouveauSolde = $client['solde'] + $montant;
        $clientModel->update($client['id'], ['solde' => $nouveauSolde]);

        $historiqueModel = new HistoriqueModel();
        $historiqueModel->insert([
            'client_id' => $client['id'],
            'type_operation_id' => 1, // DEPOT
            'montant' => $montant,
            'frais' => 0,
            'date_operation' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/client/dashboard')->with('succes', 'Dépôt effectué avec succès');
    }


    //retrait
    public function retrait()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }
        return view('clients/retrait', ['client' => $client]);
    }

    public function retraitValider()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $montant = (int) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()->with('erreur', 'Montant invalide');
        }

        $baremeModel = new BaremeFraisModel();
        $bareme = $baremeModel->getFrais(2, $montant); // 2 = RETRAIT

        if (!$bareme) {
            return redirect()->back()->with('erreur', 'Montant hors des tranches autorisées');
        }

        $frais = $bareme['frais'];
        $total = $montant + $frais;

        if ($client['solde'] < $total) {
            return redirect()->back()->with('erreur', 'Solde insuffisant');
        }

        $clientModel = new ClientModel();
        $nouveauSolde = $client['solde'] - $total;
        $clientModel->update($client['id'], ['solde' => $nouveauSolde]);

        $historiqueModel = new HistoriqueModel();
        $historiqueModel->insert([
            'client_id' => $client['id'],
            'type_operation_id' => 2, // RETRAIT
            'montant' => $montant,
            'frais' => $frais,
            'date_operation' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/client/dashboard')->with('succes', "Retrait effectué : $montant Ar (frais : $frais Ar)");
    }



    //transfert
    public function transfert()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }
        return view('clients/transfert', ['client' => $client]);
    }

    public function transfertValider()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $numeroDestinataire = $this->request->getPost('numero_destinataire');
        $montant = (int) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()->with('erreur', 'Montant invalide');
        }

        $clientModel = new ClientModel();
        $destinataire = $clientModel->where('numero', $numeroDestinataire)->first();

        if (!$destinataire) {
            return redirect()->back()->with('erreur', 'Numéro destinataire introuvable');
        }

        if ($destinataire['id'] == $client['id']) {
            return redirect()->back()->with('erreur', 'Impossible de transférer à vous-même');
        }

        $baremeModel = new BaremeFraisModel();
        $bareme = $baremeModel->getFrais(3, $montant); // 3 = TRANSFERT

        if (!$bareme) {
            return redirect()->back()->with('erreur', 'Montant hors des tranches autorisées');
        }

        $frais = $bareme['frais'];
        $total = $montant + $frais;

        if ($client['solde'] < $total) {
            return redirect()->back()->with('erreur', 'Solde insuffisant');
        }

        // Débiter expéditeur
        $clientModel->update($client['id'], ['solde' => $client['solde'] - $total]);

        // Créditer destinataire
        $clientModel->update($destinataire['id'], ['solde' => $destinataire['solde'] + $montant]);

        $historiqueModel = new HistoriqueModel();
        $historiqueModel->insert([
            'client_id' => $client['id'],
            'type_operation_id' => 3, // TRANSFERT
            'destinataire_id' => $destinataire['id'],
            'montant' => $montant,
            'frais' => $frais,
            'date_operation' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/client/dashboard')->with('succes', "Transfert de $montant Ar effectué (frais : $frais Ar)");
    }



    //historique
    public function historique()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $historiqueModel = new HistoriqueModel();
        $operations = $historiqueModel->getHistoriqueClient($client['id']);

        return view('clients/historique', [
            'client' => $client,
            'operations' => $operations,
        ]);
    }
}