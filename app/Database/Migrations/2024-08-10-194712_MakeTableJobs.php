<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeTableJobs extends Migration
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
            'profession' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'last_job' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'artistic_skill' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
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
        $this->forge->createTable('jobs');
    }

    public function down()
    {
        $this->forge->dropTable('jobs');
    }
}
