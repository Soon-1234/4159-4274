<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCommissionToHistoriqueTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('historique', [
            'commission' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'frais',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('historique', 'commission');
    }
}
