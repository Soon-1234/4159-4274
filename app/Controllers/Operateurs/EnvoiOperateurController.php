<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

class EnvoiOperateurController extends BaseController
{
    public function index()
    {
        $dateDebut = $this->request->getGet('date_debut') ?: date('Y-m-01');
        $dateFin   = $this->request->getGet('date_fin') ?: date('Y-m-t');

        $db = \Config\Database::connect();

        $sql = "
            SELECT ao.nom AS operateur,
                   SUM(h.commission) AS total_commission,
                   COUNT(h.id) AS nb_transferts
            FROM historique h
            JOIN client c ON c.id = h.destinataire_id
            JOIN autre_operateur_prefixe aop ON aop.prefixe = SUBSTR(c.numero, 1, 3)
            JOIN autre_operateur ao ON ao.id = aop.autre_operateur_id
            WHERE h.date_operation >= ?
              AND h.date_operation <= ?
            GROUP BY ao.nom
            ORDER BY total_commission DESC
        ";

        $resultats = $db->query($sql, [
            $dateDebut . ' 00:00:00',
            $dateFin . ' 23:59:59',
        ])->getResultArray();

        $data['resultats'] = $resultats;
        $data['totalGeneral'] = array_sum(array_column($resultats, 'total_commission'));
        $data['dateDebut'] = $dateDebut;
        $data['dateFin'] = $dateFin;

        return view('operateurs/envoi_operateur', $data);
    }
}
