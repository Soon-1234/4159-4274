<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpargneToClientTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('client', [
            'epargne_solde' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'solde',
            ],
            'epargne_pourcentage' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 0,
                'after'      => 'epargne_solde',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('client', ['epargne_solde', 'epargne_pourcentage']);
    }
}