<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LifeStageSeeder extends Seeder {
    public function run() {
        $data = [
            ['name' => 'Adolescente', 'slug' => 'adolescente', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Joven +18', 'slug' => 'joven-18', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Joven +30', 'slug' => 'joven-30', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Matrimonio/Pareja sin hijos', 'slug' => 'pareja-sin-hijos', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Matrimonio/Pareja con hijos pre y escolares', 'slug' => 'pareja-con-hijos-peques', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Matrimonio/Pareja con hijos adolescentes', 'slug' => 'pareja-con-hijos-adolescentes', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Matrimonio con hijos Jovenes', 'slug' => 'pareja-con-hijos-jovenes', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Soltero/a +40 (Incluye viudos y separados)', 'slug' => 'soltero-40', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Adulto +65', 'slug' => 'adulto-65', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Vivo con mi conyuge pero asisto solo/a a la Alameda', 'slug' => 'conyuge-pero-solo', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
        ];

        $this->db->table('life_stages')->insertBatch($data);
    }
}
