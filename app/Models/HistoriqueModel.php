<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriqueModel extends Model
{
    protected $table = 'historique';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'client_id',
        'type_operation_id',
        'destinataire_id',
        'autre_operateur_id',
        'numero_destinataire_externe',
        'montant',
        'frais',
        'commission',
        'frais_retrait_inclus',
        'date_operation'
    ];
    protected $returnType = 'array';

    public function getHistoriqueClient($clientId)
    {
        return $this->select('historique.*, type_operation.nom as type_nom, client_dest.numero as destinataire_numero, autre_operateur.nom as autre_operateur_nom')
            ->join('type_operation', 'type_operation.id = historique.type_operation_id')
            ->join('client as client_dest', 'client_dest.id = historique.destinataire_id', 'left')
            ->join('autre_operateur', 'autre_operateur.id = historique.autre_operateur_id', 'left')
            ->where('historique.client_id', $clientId)
            ->orderBy('historique.date_operation', 'DESC')
            ->findAll();
    }
}