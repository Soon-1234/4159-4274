<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

class GainController extends BaseController
{
    public function index()
    {
        $dateDebut = $this->request->getGet('date_debut') ?: date('Y-m-01');
        $dateFin   = $this->request->getGet('date_fin') ?: date('Y-m-t');

        $db = \Config\Database::connect();

        // Gains "nous" (frais) par type d'opération
        $gainsParType = $db->table('historique h')
            ->select('t.nom, SUM(h.frais) as total_frais, COUNT(h.id) as nb_operations')
            ->join('type_operation t', 't.id = h.type_operation_id')
            ->where('h.date_operation >=', $dateDebut . ' 00:00:00')
            ->where('h.date_operation <=', $dateFin . ' 23:59:59')
            ->groupBy('t.nom')
            ->get()
            ->getResultArray();

        $totalGainsNous = array_sum(array_column($gainsParType, 'total_frais'));

        // Total reversé aux autres opérateurs (commission)
        $totalCommission = $db->table('historique')
            ->selectSum('commission')
            ->where('date_operation >=', $dateDebut . ' 00:00:00')
            ->where('date_operation <=', $dateFin . ' 23:59:59')
            ->get()
            ->getRow('commission') ?? 0;

        $data['gainsParType'] = $gainsParType;
        $data['totalGainsNous'] = $totalGainsNous;
        $data['totalCommission'] = $totalCommission ?: 0;
        $data['dateDebut'] = $dateDebut;
        $data['dateFin'] = $dateFin;

        return view('operateurs/gain', $data);
    }
}
