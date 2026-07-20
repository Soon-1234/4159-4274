<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\PrefixeModel;

class PrefixeController extends BaseController
{
    public function index()
    {
        $model = new PrefixeModel();
        $data['prefixes'] = $model->findAll();

        return view('operateurs/prefixe', $data);
    }

    public function store()
    {
        $model = new PrefixeModel();

        $prefixe = $this->request->getPost('prefixe');

        if (empty($prefixe)) {
            return redirect()->back()->with('erreur', 'Le préfixe est obligatoire.');
        }

        $existe = $model->where('prefixe', $prefixe)->first();
        if ($existe) {
            return redirect()->back()->with('erreur', 'Ce préfixe existe déjà.');
        }

        $model->insert(['prefixe' => $prefixe]);

        return redirect()->to('/operateur/prefixes')->with('succes', 'Préfixe ajouté.');
    }

    public function delete($id)
    {
        $model = new PrefixeModel();
        $model->delete($id);

        return redirect()->to('/operateur/prefixes')->with('succes', 'Préfixe supprimé.');
    }
}