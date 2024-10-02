<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableMembersVoluntary extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'members_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'voluntary_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'service' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => true,
                'default' => 0, // Indica que no está sirviendo por defecto
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

        // Clave primaria
        $this->forge->addKey('id', true);

        // // Opcional: Claves foráneas si aplican
        // $this->forge->addForeignKey('members_id', 'members', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('voluntary_id', 'voluntary', 'id', 'CASCADE', 'CASCADE');

        // Crear tabla
        $this->forge->createTable('members_voluntary');
    }

    public function down() {
        // // Quitar claves foráneas antes de eliminar la tabla
        // $this->forge->dropForeignKey('members_voluntary', 'members_voluntary_members_id_foreign');
        // $this->forge->dropForeignKey('members_voluntary', 'members_voluntary_voluntary_id_foreign');

        // Eliminar tabla
        $this->forge->dropTable('members_voluntary');
    }
}
