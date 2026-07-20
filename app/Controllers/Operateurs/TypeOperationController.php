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
}
