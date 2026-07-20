<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeOperationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nom' => 'DEPOT'],
            ['nom' => 'RETRAIT'],
            ['nom' => 'TRANSFERT'],
        ];

        $this->db->table('type_operation')->insertBatch($data);
    }
}
