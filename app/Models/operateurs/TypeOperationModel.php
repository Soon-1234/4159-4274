<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class TypeOperationModel extends Model
{
    protected $table = 'type_operation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom'];
    protected $returnType = 'array';
}
