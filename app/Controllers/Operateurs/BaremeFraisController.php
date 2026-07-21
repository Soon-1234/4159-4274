<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\Operateurs\TypeOperationModel;
use App\Models\BaremeFraisModel;

class BaremeFraisController extends BaseController
{
    public function index($typeOperationId)
    {
        $typeModel = new TypeOperationModel();
        $baremeModel = new BaremeFraisModel();

        $type = $typeModel->find($typeOperationId);

        if (!$type) {
            return redirect()->to('/operateur/types-operation')->with('erreur', 'Type d\'opération introuvable.');
        }

        $data['type'] = $type;
        $data['baremes'] = $baremeModel->where('type_operation_id', $typeOperationId)
            ->orderBy('montant_min', 'ASC')
            ->findAll();

        return view('operateurs/bareme_frais', $data);
    }

    public function store($typeOperationId)
    {
        $baremeModel = new BaremeFraisModel();

        $montantMin = $this->request->getPost('montant_min');
        $montantMax = $this->request->getPost('montant_max');
        $frais = $this->request->getPost('frais');

        if (empty($montantMin) || empty($montantMax) || empty($frais)) {
            return redirect()->back()->with('erreur', 'Tous les champs sont obligatoires.');
        }

        if ($montantMin >= $montantMax) {
            return redirect()->back()->with('erreur', 'Le montant min doit être inférieur au montant max.');
        }

        $baremeModel->insert([
            'type_operation_id' => $typeOperationId,
            'montant_min'       => $montantMin,
            'montant_max'       => $montantMax,
            'frais'             => $frais,
        ]);

        return redirect()->to('/operateur/baremes/' . $typeOperationId)->with('succes', 'Tranche ajoutée.');
    }

    public function update($id)
    {
        $baremeModel = new BaremeFraisModel();
        $bareme = $baremeModel->find($id);

        if (!$bareme) {
            return redirect()->back()->with('erreur', 'Tranche introuvable.');
        }

        $frais = $this->request->getPost('frais');

        if (empty($frais)) {
            return redirect()->back()->with('erreur', 'Le frais est obligatoire.');
        }

        $baremeModel->update($id, ['frais' => $frais]);

        return redirect()->to('/operateur/baremes/' . $bareme['type_operation_id'])->with('succes', 'Frais mis à jour.');
    }

    public function delete($id)
    {
        $baremeModel = new BaremeFraisModel();
        $bareme = $baremeModel->find($id);

        if (!$bareme) {
            return redirect()->back()->with('erreur', 'Tranche introuvable.');
        }

        $typeOperationId = $bareme['type_operation_id'];
        $baremeModel->delete($id);

        return redirect()->to('/operateur/baremes/' . $typeOperationId)->with('succes', 'Tranche supprimée.');
    }
}
