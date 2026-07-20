<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaremeFraisSeeder extends Seeder
{
    public function run()
    {
        $retraitId = $this->db->table('type_operation')
            ->select('id')
            ->where('nom', 'RETRAIT')
            ->get()
            ->getRow('id');

        $transfertId = $this->db->table('type_operation')
            ->select('id')
            ->where('nom', 'TRANSFERT')
            ->get()
            ->getRow('id');

        $baremes = [
            [100, 1000, 50],
            [1001, 5000, 100],
            [5001, 10000, 200],
            [10001, 25000, 400],
            [25001, 50000, 800],
            [50001, 250000, 1500],
            [250001, 500000, 2500],
            [500001, 1000000, 1500],
            [1000001, 2000000, 3000],
        ];

        $data = [];

        foreach ([$retraitId, $transfertId] as $typeOperationId) {
            foreach ($baremes as [$min, $max, $frais]) {
                $data[] = [
                    'type_operation_id' => $typeOperationId,
                    'montant_min'       => $min,
                    'montant_max'       => $max,
                    'frais'             => $frais,
                ];
            }
        }

        $this->db->table('bareme_frais')->insertBatch($data);
    }
}
