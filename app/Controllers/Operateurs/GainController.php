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
            p.nom_operateur as operateur,
            COUNT(*) as nb_transferts,
            COALESCE(SUM(h.commission_due), 0) as total_commission
        FROM historique h
        LEFT JOIN autre_operateur_prefixe p ON h.prefixe_destinataire = p.code_prefixe
        WHERE h.date_operation BETWEEN ? AND ?
          AND p.nom_operateur IS NOT NULL
          AND h.commission_due > 0
        GROUP BY p.id
        ORDER BY p.nom_operateur ASC
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
