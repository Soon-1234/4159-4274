<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrefixeTable extends Migration
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
            'prefixe' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('prefixe');

        $this->forge->createTable('prefixe');
    }

    public function down()
    {
        $this->forge->dropTable('prefixe');
    }
}
