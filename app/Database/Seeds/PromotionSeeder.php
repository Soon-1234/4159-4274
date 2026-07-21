<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromotionSeeder extends Seeder
{
     public function run()
    {
        $this->db->table('promotion')->insert(['promotion' => 2.00]);
    }
}
