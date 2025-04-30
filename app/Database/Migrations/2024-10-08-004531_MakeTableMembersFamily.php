<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableMembersFamily extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'members_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'related_member_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'family_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'asist_church' => [
                'type' => 'ENUM',
                'constraint' => ['si', 'no'],
                'null' => true,
            ],
            'coexists' => [
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

        // Crear tabla
        $this->forge->createTable('members_family');
    }

    public function down() {

        // Eliminar tabla
        $this->forge->dropTable('members_family');
    }
}
