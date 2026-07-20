<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class HistoriqueModel extends Model
{
    protected $table = 'historique';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'type_operation_id', 'destinataire_id', 'montant', 'frais', 'date_operation'];
    protected $returnType = 'array';
}
