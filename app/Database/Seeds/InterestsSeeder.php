<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InterestsSeeder extends Seeder {
    public function run() {
        $data = [
            ['name' => 'Tener una relación personal con Jesús', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Arte', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Deporte', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Conocer más la Biblia', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Descubrir mi propósito', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Servir', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Desarrollar hábitos saludables', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Esparcimiento', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Otro', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
        ];

        $this->db->table('interests')->insertBatch($data);
    }
}
