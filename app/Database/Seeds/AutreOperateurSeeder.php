<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AutreOperateurSeeder extends Seeder
{
    public function run()
    {
        // Insertion des opérateurs
        $this->db->table('autre_operateur')->insertBatch([
            ['nom' => 'Orange'],
        ]);

        // Récupération des IDs générés
        $orangeId = $this->db->table('autre_operateur')->where('nom', 'Orange')->get()->getRow('id');
        // Insertion des préfixes rattachés
        $this->db->table('autre_operateur_prefixe')->insertBatch([
            ['autre_operateur_id' => $orangeId, 'prefixe' => '032'],
        ]);
    }
}
