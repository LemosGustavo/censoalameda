<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GenderSeeder extends Seeder {
    public function run() {
        $data = [
            ['name' => 'Hombre', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Mujer', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
        ];
        $this->db->table('gender')->insertBatch($data);
    }
}
