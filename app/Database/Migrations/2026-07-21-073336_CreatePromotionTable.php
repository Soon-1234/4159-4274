<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromotionTable extends Migration
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
            'id_transfert' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'promotion' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('promotion');
    }

    public function down()
    {
        $this->forge->dropTable('promotion');
    }
}
