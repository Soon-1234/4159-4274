<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class PromotionModel extends Model
{
    protected $table = 'promotion';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_transfert','promotion' ];
    protected $returnType = 'array';
}
