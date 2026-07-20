<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class OperateurModel extends Model
{
    protected $table = 'operateur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['identifiant', 'mot_de_passe'];
    protected $returnType = 'array';
}
