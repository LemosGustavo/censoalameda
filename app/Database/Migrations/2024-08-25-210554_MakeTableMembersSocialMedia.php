<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableMembersSocialMedia extends Migration
{
    public function up()
    {
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
                'null' => true,
            ],
            'social_media_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'other_socialmedia' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('members_social_media');
    }

    public function down()
    {
        $this->forge->dropTable('members_social_media');
    }
}
