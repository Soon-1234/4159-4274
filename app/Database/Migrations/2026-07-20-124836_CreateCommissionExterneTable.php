<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommissionExterneTable extends Migration
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
            'pourcentage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('commission_externe');
    }

    public function down()
    {
        $this->forge->dropTable('commission_externe');
    }
}
