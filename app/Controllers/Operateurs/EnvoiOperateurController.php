<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

class EnvoiOperateurController extends BaseController
{
    public function index()
    {
        $dateDebut = $this->request->getGet('date_debut') ?: date('Y-m-01');
        $dateFin = $this->request->getGet('date_fin') ?: date('Y-m-t');

        $db = \Config\Database::connect();

        $sql = "
            SELECT ao.nom AS operateur,
       SUM(h.montant) AS total_a_envoyer,
       COUNT(h.id) AS nb_transferts
        FROM historique h
        JOIN autre_operateur ao ON ao.id = h.autre_operateur_id
        WHERE h.date_operation >= ? AND h.date_operation <= ?
        GROUP BY ao.nom
        ORDER BY total_a_envoyer DESC
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
