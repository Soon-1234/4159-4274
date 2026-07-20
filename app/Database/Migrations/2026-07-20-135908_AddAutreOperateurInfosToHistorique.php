<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAutreOperateurInfosToHistorique extends Migration
{
    public function up()
    {
        $this->forge->addColumn('historique', [
            'autre_operateur_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'destinataire_id',
            ],
            'numero_destinataire_externe' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => true,
                'after'      => 'autre_operateur_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('historique', ['autre_operateur_id', 'numero_destinataire_externe']);
    }
}