<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommissionExterneSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('commission_externe')->insert(['pourcentage' => 2.00]);
    }
}
