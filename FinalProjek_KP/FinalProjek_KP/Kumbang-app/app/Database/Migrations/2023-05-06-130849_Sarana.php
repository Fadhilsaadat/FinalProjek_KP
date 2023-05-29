<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sarana extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sarana' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_sarana' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);
        $this->forge->addPrimaryKey('id_sarana');
        $this->forge->createTable('sarana');
    }

    public function down()
    {
        $this->forge->dropTable('sarana');
    }
}