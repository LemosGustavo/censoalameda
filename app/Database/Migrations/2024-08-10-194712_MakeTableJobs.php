<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableJob extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name_profession' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'artistic_skills' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'audi_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'audi_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'audi_action' => [
                'type' => 'ENUM',
                'constraint' => ['I', 'U', 'D'],
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('job');
    }

    public function down() {
        $this->forge->dropTable('job');
    }
}
