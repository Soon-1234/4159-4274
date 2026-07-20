<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAutreOperateurPrefixeTable extends Migration
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
            'autre_operateur_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'prefixe' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('prefixe');
        $this->forge->addForeignKey('autre_operateur_id', 'autre_operateur', 'id');

        $this->forge->createTable('autre_operateur_prefixe');
    }

    public function down()
    {
        $this->forge->dropTable('autre_operateur_prefixe');
    }
}
