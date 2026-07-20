<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class CommissionExterneModel extends Model
{
    protected $table = 'commission_externe';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pourcentage'];
    protected $returnType = 'array';
}
