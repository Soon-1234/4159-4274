<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\Operateurs\AutreOperateurModel;
use App\Models\Operateurs\AutreOperateurPrefixeModel;
use App\Models\Operateurs\CommissionExterneModel;

class AutreOperateurController extends BaseController
{
    public function index()
    {
        $model = new AutreOperateurModel();
        $data['operateurs'] = $model->findAll();

        $commissionModel = new CommissionExterneModel();
        $data['commission'] = $commissionModel->first();

        return view('operateurs/autre_operateur', $data);
    }

    public function store()
    {
        $model = new AutreOperateurModel();
        $nom = $this->request->getPost('nom');

        if (empty($nom)) {
            return redirect()->back()->with('erreur', 'Le nom est obligatoire.');
        }

        $existe = $model->where('nom', $nom)->first();
        if ($existe) {
            return redirect()->back()->with('erreur', 'Cet opérateur existe déjà.');
        }

        $model->insert(['nom' => $nom]);

        return redirect()->to('/operateur/autres-operateurs')->with('succes', 'Opérateur ajouté.');
    }

    public function delete($id)
    {
        $model = new AutreOperateurModel();
        $model->delete($id);
        // Les préfixes liés seront bloqués par la FK s'il y en a encore (protection normale)

        return redirect()->to('/operateur/autres-operateurs')->with('succes', 'Opérateur supprimé.');
    }

    public function prefixes($operateurId)
    {
        $operateurModel = new AutreOperateurModel();
        $prefixeModel = new AutreOperateurPrefixeModel();

        $operateur = $operateurModel->find($operateurId);

        if (!$operateur) {
            return redirect()->to('/operateur/autres-operateurs')->with('erreur', 'Opérateur introuvable.');
        }

        $data['operateur'] = $operateur;
        $data['prefixes'] = $prefixeModel->where('autre_operateur_id', $operateurId)->findAll();

        return view('operateurs/autre_operateur_prefixe', $data);
    }

    public function storePrefixe($operateurId)
    {
        $prefixeModel = new AutreOperateurPrefixeModel();
        $prefixe = $this->request->getPost('prefixe');

        if (empty($prefixe)) {
            return redirect()->back()->with('erreur', 'Le préfixe est obligatoire.');
        }

        $existe = $prefixeModel->where('prefixe', $prefixe)->first();
        if ($existe) {
            return redirect()->back()->with('erreur', 'Ce préfixe est déjà utilisé (par un opérateur).');
        }

        $prefixeModel->insert([
            'autre_operateur_id' => $operateurId,
            'prefixe' => $prefixe,
        ]);

        return redirect()->to('/operateur/autres-operateurs/prefixes/' . $operateurId)->with('succes', 'Préfixe ajouté.');
    }

    public function deletePrefixe($id)
    {
        $prefixeModel = new AutreOperateurPrefixeModel();
        $prefixe = $prefixeModel->find($id);

        if (!$prefixe) {
            return redirect()->back()->with('erreur', 'Préfixe introuvable.');
        }

        $operateurId = $prefixe['autre_operateur_id'];
        $prefixeModel->delete($id);

        return redirect()->to('/operateur/autres-operateurs/prefixes/' . $operateurId)->with('succes', 'Préfixe supprimé.');
    }

    public function updateCommission()
    {
        $commissionModel = new CommissionExterneModel();
        $pourcentage = $this->request->getPost('pourcentage');

        if ($pourcentage === null || $pourcentage === '') {
            return redirect()->back()->with('erreur', 'Le pourcentage est obligatoire.');
        }

        $commission = $commissionModel->first();

        if ($commission) {
            $commissionModel->update($commission['id'], ['pourcentage' => $pourcentage]);
        } else {
            $commissionModel->insert(['pourcentage' => $pourcentage]);
        }

        return redirect()->to('/operateur/autres-operateurs')->with('succes', 'Commission mise à jour.');
    }
}
