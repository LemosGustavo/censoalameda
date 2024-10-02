<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VoluntarySeeder extends Seeder {
    public function run() {
        $data = [
            ['name' => 'Primeras Impresiones', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Intercesión', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
        ];

        $this->db->table('voluntary')->insertBatch($data);
    }
}
