<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperateurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'identifiant'  => 'admin',
            'mot_de_passe' => password_hash('admin1234', PASSWORD_DEFAULT),
        ];

        $this->db->table('operateur')->insert($data);
    }
}
