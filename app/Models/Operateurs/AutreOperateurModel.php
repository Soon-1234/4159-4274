<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class AutreOperateurModel extends Model
{
    protected $table = 'autre_operateur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom'];
    protected $returnType = 'array';
}
