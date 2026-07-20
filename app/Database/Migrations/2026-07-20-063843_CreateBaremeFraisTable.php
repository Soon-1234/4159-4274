<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBaremeFraisTable extends Migration
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
            'type_operation_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'montant_min' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'montant_max' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'frais' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('type_operation_id', 'type_operation', 'id');

        $this->forge->createTable('bareme_frais');
    }

    public function down()
    {
        $this->forge->dropTable('bareme_frais');
    }
}
