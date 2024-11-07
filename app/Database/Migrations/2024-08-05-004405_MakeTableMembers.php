<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableMembers extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'birthdate' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'age' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'dni' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'address_number' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'gender_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'civil_state_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'path_photo' => [
                'type' => 'VARCHAR',
                'constraint' => '550',
                'null' => true,
            ],
            'job_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'localities_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'contact_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'boss_family' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],
            'quantity_sons' => [
                'type' => 'INT',
                'constraint' => 11,
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
                'type'       => 'ENUM',
                'constraint' => ['I', 'U', 'D'],
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('members');
    }

    public function down() {
        $this->forge->dropTable('members');
    }
}
