<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('operateurs/dashboard');
    }
}
