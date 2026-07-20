<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class ClientController extends BaseController
{
    public function index()
    {
        $model = new ClientModel();
        $recherche = $this->request->getGet('numero');

        if (!empty($recherche)) {
            $model->like('numero', $recherche);
        }

        $data['clients'] = $model->orderBy('id', 'DESC')->findAll();
        $data['recherche'] = $recherche;

        return view('operateurs/client', $data);
    }
}
