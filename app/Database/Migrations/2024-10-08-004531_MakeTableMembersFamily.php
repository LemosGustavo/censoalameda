<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableMembersFamily extends Migration {
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
            'pariente_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'family_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'lives' => [
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

        // Crear tabla
        $this->forge->createTable('members_family');
    }

    public function down() {

        // Eliminar tabla
        $this->forge->dropTable('members_family');
    }
}
