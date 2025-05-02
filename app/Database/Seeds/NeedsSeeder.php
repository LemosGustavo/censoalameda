<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NeedsSeeder extends Seeder {
    public function run() {
        $data = [
            ['name' => 'Adicciones', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Capacitarme para el servicio', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Crecer en la Palabra', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Crianza', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Desarrollar mi liderazgo', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Descubrir mis dones', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Economía', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Enriquecimiento Matrimonial', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Equilibrio emocional', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Familia', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Identidad sexual', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Legal', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Madurar mi carácter', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Matrimonial', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Oración', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Problemas de salud', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Soledad', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Otro', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
        ];

        $this->db->table('needs')->insertBatch($data);
    }
}
