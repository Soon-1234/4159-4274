<?php
namespace App\Controllers\Clients;
use App\Controllers\BaseController;

use App\Models\ClientModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $clientModel = new ClientModel();
        $client = $clientModel->find(session()->get('client_id'));

        return view('clients/dashboard', ['client' => $client]);
    }
}