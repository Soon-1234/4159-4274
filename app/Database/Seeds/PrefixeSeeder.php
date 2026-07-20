<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['prefixe' => '034'],
            ['prefixe' => '038'],
        ];

        $this->db->table('prefixe')->insertBatch($data);
    }
}
