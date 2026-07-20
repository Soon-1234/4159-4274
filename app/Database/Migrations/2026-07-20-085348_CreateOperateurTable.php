<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOperateurTable extends Migration
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
            'identifiant' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'mot_de_passe' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('identifiant');

        $this->forge->createTable('operateur');
    }

    public function down()
    {
        $this->forge->dropTable('operateur');
    }
}
