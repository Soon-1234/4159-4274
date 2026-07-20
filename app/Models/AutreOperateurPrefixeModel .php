<?php

namespace App\Models;

use CodeIgniter\Model;

class AutreOperateurPrefixeModel extends Model
{
    protected $table = 'autre_operateur_prefixe';
    protected $primaryKey = 'id';
    protected $allowedFields = ['autre_operateur_id', 'prefixe'];
    protected $returnType = 'array';
}