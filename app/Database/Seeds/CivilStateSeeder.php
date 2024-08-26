<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CivilStateSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Soltero/a', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Casado/a', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'En pareja', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Viudo/a', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Divorciado/a', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Otro', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
        ];

        $this->db->table('civil_state')->insertBatch($data);
    }
}
