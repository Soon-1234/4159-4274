<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoriqueTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'client_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'type_operation_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'destinataire_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'montant' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'frais' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'date_operation' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('client_id', 'client', 'id');
        $this->forge->addForeignKey('type_operation_id', 'type_operation', 'id');
        $this->forge->addForeignKey('destinataire_id', 'client', 'id');

        $this->forge->createTable('historique');
    }

    public function down()
    {
        $this->forge->dropTable('historique');
    }
}
