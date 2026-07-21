<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

class GainController extends BaseController
{
    public function index()
    {
        $dateDebut = $this->request->getVar('date_debut') ?? date('Y-m-d', strtotime('-1 month'));
        $dateFin = $this->request->getVar('date_fin') ?? date('Y-m-d');

        $db = \Config\Database::connect();

        $gainsParTypeQuery = "
        SELECT 
            type_operation.nom as nom, 
            COUNT(*) as nb_operations, 
            COALESCE(SUM(historique.frais), 0) as total_frais
        FROM historique
        JOIN type_operation ON historique.type_operation_id = type_operation.id
        WHERE historique.date_operation BETWEEN ? AND ?
          AND historique.frais > 0
        GROUP BY type_operation.id
        ORDER BY type_operation.nom ASC
    ";

        $gainsParType = $db->query($gainsParTypeQuery, [$dateDebut . ' 00:00:00', $dateFin . ' 23:59:59'])->getResultArray();

        $totalGainsNous = 0;
        foreach ($gainsParType as $row) {
            $totalGainsNous += $row['total_frais'];
        }

        $commissionsExternesQuery = "
      SELECT 
    ao.nom AS operateur,
    COUNT(*) as nb_transferts,
    COALESCE(SUM(h.commission), 0) as total_commission
    FROM historique h
    JOIN autre_operateur ao ON ao.id = h.autre_operateur_id
    WHERE h.date_operation BETWEEN ? AND ?
    AND h.commission > 0
    GROUP BY ao.id
    ORDER BY ao.nom ASC
    ";

        try {
            $resultats = $db->query($commissionsExternesQuery, [$dateDebut . ' 00:00:00', $dateFin . ' 23:59:59'])->getResultArray();
        } catch (\Exception $e) {
            log_message('error', "Erreur dans la requête commissions: " . $e->getMessage());
            $resultats = [];
        }

        $totalCommission = 0;
        $totalGeneral = 0;
        foreach ($resultats as $row) {
            $val = floatval($row['total_commission']);
            $totalCommission += $val;
            $totalGeneral += $val;
        }

        return view('operateurs/gain', [
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'gainsParType' => $gainsParType,
            'totalGainsNous' => $totalGainsNous,
            'resultats' => $resultats,
            'totalCommission' => $totalCommission,
            'totalGeneral' => $totalGeneral
        ]);
    }
}
