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
            ['nom' => 'Telma'],
        ]);

        // Récupération des IDs générés
        $orangeId = $this->db->table('autre_operateur')->where('nom', 'Orange')->get()->getRow('id');
        $telmaId  = $this->db->table('autre_operateur')->where('nom', 'Telma')->get()->getRow('id');

        // Insertion des préfixes rattachés
        $this->db->table('autre_operateur_prefixe')->insertBatch([
            ['autre_operateur_id' => $orangeId, 'prefixe' => '032'],
            ['autre_operateur_id' => $telmaId,  'prefixe' => '034'],
            ['autre_operateur_id' => $telmaId,  'prefixe' => '038'],
        ]);
    }
}
