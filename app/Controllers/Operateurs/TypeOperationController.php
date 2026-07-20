<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\Operateurs\TypeOperationModel;

class TypeOperationController extends BaseController
{
    public function index()
    {
        $model = new TypeOperationModel();
        $data['types'] = $model->findAll();

        return view('operateurs/type_operation', $data);
    }

    public function store()
    {
        $model = new TypeOperationModel();
        $nom = $this->request->getPost('nom');

        if (empty($nom)) {
            return redirect()->back()->with('erreur', 'Le nom est obligatoire.');
        }

        $existe = $model->where('nom', $nom)->first();
        if ($existe) {
            return redirect()->back()->with('erreur', 'Ce type existe déjà.');
        }

        $model->insert(['nom' => strtoupper($nom)]);

        return redirect()->to('/operateur/types-operation')->with('succes', 'Type ajouté.');
    }

    public function edit($id)
    {
        $model = new TypeOperationModel();
        $data['type'] = $model->find($id);

        if (!$data['type']) {
            return redirect()->to('/operateur/types-operation')->with('erreur', 'Type introuvable.');
        }

        return view('operateurs/type_operation_edit', $data);
    }

    public function update($id)
    {
        $model = new TypeOperationModel();
        $nom = $this->request->getPost('nom');

        if (empty($nom)) {
            return redirect()->back()->with('erreur', 'Le nom est obligatoire.');
        }

        $model->update($id, ['nom' => strtoupper($nom)]);

        return redirect()->to('/operateur/types-operation')->with('succes', 'Type modifié.');
    }

    public function delete($id)
    {
        $model = new TypeOperationModel();
        $model->delete($id);

        return redirect()->to('/operateur/types-operation')->with('succes', 'Type supprimé.');
    }
}
