<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableMembers extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'birthdate' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'dni_document' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'gender_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'civil_state_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'path_photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'name_profession' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'artistic_skills' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'country_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'state_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'district_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'localities_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'boss_family' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'quantity_sons' => [
                'type' => 'INT',
                'constraint' => 2,
                'null' => true,
            ],
            'celebracion' => [
                'type' => 'ENUM',
                'constraint' => ['presencial', 'virtual'],
                'null' => true,
            ],
            'name_guia' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'name_group' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'grupo' => [
                'type' => 'ENUM',
                'constraint' => ['si', 'no'],
                'null' => true,
            ],
            'participate_gp' => [
                'type' => 'ENUM',
                'constraint' => ['si', 'no'],
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
        $this->forge->createTable('members');
    }

    public function down() {
        $this->forge->dropTable('members');
    }
}
