<?php

namespace App\Controllers\Clients;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\HistoriqueModel;
use App\Models\BaremeFraisModel;

use App\Models\Operateurs\AutreOperateurModel;
use App\Models\Operateurs\AutreOperateurPrefixeModel;
use App\Models\Operateurs\CommissionExterneModel;
use App\Models\Operateurs\PromotionModel;

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

        $prefixeExterneModel = new AutreOperateurPrefixeModel();
        $prefixesExternes = array_column($prefixeExterneModel->findAll(), 'prefixe');

        return view('clients/transfert', [
            'client' => $client,
            'prefixesExternes' => $prefixesExternes,
        ]);
    }

    public function transfertValider()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $numeroDestinataire = trim($this->request->getPost('numero_destinataire'));
        $montant = (int) $this->request->getPost('montant');
        $inclureFraisRetrait = (bool) $this->request->getPost('inclure_frais_retrait');

        if (!preg_match('/^[0-9]{10}$/', $numeroDestinataire)) {
            return redirect()->back()->with('erreur', 'Numéro destinataire invalide (10 chiffres requis)');
        }

        if ($montant <= 0) {
            return redirect()->back()->with('erreur', 'Montant invalide');
        }

        if ($numeroDestinataire === $client['numero']) {
            return redirect()->back()->with('erreur', 'Impossible de transférer à vous-même');
        }

        $autreOperateur = $this->detecterAutreOperateur($numeroDestinataire);

        if ($autreOperateur) {
            return $this->transfertVersAutreOperateur($client, $numeroDestinataire, $montant, $autreOperateur);
        }

        // --- à partir d'ici, logique interne inchangée (destinataire local, bareme, frais_retrait_inclus) ---
        $clientModel = new ClientModel();
        $destinataire = $clientModel->where('numero', $numeroDestinataire)->first();

        if (!$destinataire) {
            return redirect()->back()->with('erreur', 'Numéro destinataire introuvable');
        }

        $baremeModel = new BaremeFraisModel();
        $baremeTransfert = $baremeModel->getFrais(3, $montant);

        if (!$baremeTransfert) {
            return redirect()->back()->with('erreur', 'Montant hors des tranches autorisées');
        }

        $fraisTransfert = $baremeTransfert['frais'] ;
        $fraisRetrait = 0;
        $promotion = $fraisTransfert ? (float) $fraisTransfert['pourcentage'] : 0;

        if($promotion == 1){
            $fraisTransfert =  $fraisTransfert + $promotion;
        }

        if ($inclureFraisRetrait) {
            $baremeRetrait = $baremeModel->getFrais(2, $montant);
            if ($baremeRetrait) {
                $fraisRetrait = $baremeRetrait['frais'];
            }
        }

        $totalDebit = $montant + $fraisTransfert + $fraisRetrait;
        $montantCredit = $montant + $fraisRetrait;

        if ($client['solde'] < $totalDebit) {
            return redirect()->back()->with('erreur', 'Solde insuffisant');
        }

        $clientModel->update($client['id'], ['solde' => $client['solde'] - $totalDebit]);
        $clientModel->update($destinataire['id'], ['solde' => $destinataire['solde'] + $montantCredit]);

        $historiqueModel = new HistoriqueModel();
        $historiqueModel->insert([
            'client_id' => $client['id'],
            'type_operation_id' => 3,
            'destinataire_id' => $destinataire['id'],
            'montant' => $montant,
            'frais' => $fraisTransfert,
            'frais_retrait_inclus' => $fraisRetrait,
            'date_operation' => date('Y-m-d H:i:s'),
        ]);

        $message = "Transfert de $montant Ar effectué (frais : $fraisTransfert Ar)";
        if ($fraisRetrait > 0) {
            $message .= " — frais de retrait inclus : $fraisRetrait Ar";
        }

        return redirect()->to('/client/dashboard')->with('succes', $message);
    }

    protected function transfertVersAutreOperateur($client, $numeroDestinataire, $montant, $autreOperateur)
    {
        $baremeModel = new BaremeFraisModel();
        $baremeTransfert = $baremeModel->getFrais(3, $montant);

        if (!$baremeTransfert) {
            return redirect()->back()->with('erreur', 'Montant hors des tranches autorisées');
        }

        $fraisTransfert = $baremeTransfert['frais'];

        $commissionModel = new CommissionExterneModel();
        $commissionLigne = $commissionModel->first();
        $pourcentage = $commissionLigne ? (float) $commissionLigne['pourcentage'] : 0;
        $commission = (int) round($montant * $pourcentage / 100);

        $totalDebit = $montant + $fraisTransfert + $commission;

        if ($client['solde'] < $totalDebit) {
            return redirect()->back()->with('erreur', 'Solde insuffisant');
        }

        $clientModel = new ClientModel();
        $clientModel->update($client['id'], ['solde' => $client['solde'] - $totalDebit]);

        $historiqueModel = new HistoriqueModel();
        $historiqueModel->insert([
            'client_id' => $client['id'],
            'type_operation_id' => 3,
            'destinataire_id' => null,
            'autre_operateur_id' => $autreOperateur['id'],
            'numero_destinataire_externe' => $numeroDestinataire,
            'montant' => $montant,
            'frais' => $fraisTransfert,
            'commission' => $commission,
            'frais_retrait_inclus' => 0,
            'date_operation' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/client/dashboard')
            ->with('succes', "Transfert de $montant Ar vers {$autreOperateur['nom']} effectué (frais : $fraisTransfert Ar, commission : $commission Ar)");
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

    public function envoiMultiple()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }
        return view('clients/envoi_multiple', ['client' => $client]);
    }


    //envoi multiple
    public function envoiMultipleValider()
    {
        $client = $this->clientConnecte();
        if (!$client) {
            return redirect()->to('/');
        }

        $numeros = $this->request->getPost('numeros') ?? [];
        $montantTotal = (int) $this->request->getPost('montant_total');

        $numeros = array_values(array_filter($numeros, fn($n) => trim($n) !== ''));
        $nombreDestinataires = count($numeros);

        if ($nombreDestinataires < 2) {
            return redirect()->back()->with('erreur', 'Ajoutez au moins 2 destinataires');
        }

        if (count($numeros) !== count(array_unique($numeros))) {
            return redirect()->back()->with('erreur', 'Un même numéro ne peut pas être ajouté plusieurs fois');
        }

        if ($montantTotal <= 0) {
            return redirect()->back()->with('erreur', 'Montant invalide');
        }

        $clientModel = new ClientModel();
        $baremeModel = new BaremeFraisModel();

        $part = intdiv($montantTotal, $nombreDestinataires);
        $reste = $montantTotal % $nombreDestinataires;

        $destinatairesValides = [];
        $totalDebit = 0;

        foreach ($numeros as $index => $numero) {
            if ($numero === $client['numero']) {
                return redirect()->back()->with('erreur', 'Impossible de vous inclure comme destinataire');
            }

            $destinataire = $clientModel->where('numero', $numero)->first();
            if (!$destinataire) {
                return redirect()->back()->with('erreur', "Numéro introuvable : $numero");
            }

            $montantPart = $part + ($index === $nombreDestinataires - 1 ? $reste : 0);

            $bareme = $baremeModel->getFrais(3, $montantPart);
            if (!$bareme) {
                return redirect()->back()->with('erreur', "Montant hors tranche pour $numero ($montantPart Ar)");
            }

            $frais = $bareme['frais'];
            $totalDebit += $montantPart + $frais;

            $destinatairesValides[] = [
                'destinataire' => $destinataire,
                'montant' => $montantPart,
                'frais' => $frais,
            ];
        }

        if ($client['solde'] < $totalDebit) {
            return redirect()->back()->with('erreur', 'Solde insuffisant pour cet envoi multiple');
        }

        $clientModel->update($client['id'], ['solde' => $client['solde'] - $totalDebit]);

        $historiqueModel = new HistoriqueModel();

        foreach ($destinatairesValides as $ligne) {
            $dest = $ligne['destinataire'];
            $clientModel->update($dest['id'], ['solde' => $dest['solde'] + $ligne['montant']]);

            $historiqueModel->insert([
                'client_id' => $client['id'],
                'type_operation_id' => 3,
                'destinataire_id' => $dest['id'],
                'montant' => $ligne['montant'],
                'frais' => $ligne['frais'],
                'frais_retrait_inclus' => 0,
                'date_operation' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/client/dashboard')->with('succes', "Envoi multiple effectué vers $nombreDestinataires destinataires");
    }

    protected function detecterAutreOperateur($numero)
    {
        $prefixe = substr($numero, 0, 3);
        $prefixeModel = new AutreOperateurPrefixeModel();
        $trouve = $prefixeModel->where('prefixe', $prefixe)->first();

        if (!$trouve) {
            return null;
        }

        $operateurModel = new AutreOperateurModel();
        return $operateurModel->find($trouve['autre_operateur_id']);
    }

     public function getPromotion()
    {
        $PromotionModel = new PromotionModel();
        $promotion = $this->request->getPost('promotion');

        $promotion = $PromotionModel->first();

        if ($promotion) {
            $PromotionModel->update($promotion['id'], ['promotion' => $promotion]);
        } else {
            $PromotionModel->insert(['promotion' => $promotion]);
        }

        return redirect()->to('/operateur/autres-operateurs')->with('succes', 'promotion mise à jour.');
    }
}