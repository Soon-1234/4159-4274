<?php

namespace App\Models;

class CommissionExterneModel extends Model
{
    protected $table = 'commission_externe';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pourcentage'];
    protected $returnType = 'array';

    public function getPourcentage()
    {
        $ligne = $this->orderBy('id', 'DESC')->first();
        return $ligne ? (float) $ligne['pourcentage'] : 0;
    }
}

?>