<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatesSeeder extends Seeder {
    public function run() {
        $data = [

            ['name' => 'Ciudad Autónoma de Buenos Aires', 'api_states_id' => '02', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Neuquén', 'api_states_id' => '58', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'San Luis', 'api_states_id' => '74', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Santa Fe', 'api_states_id' => '82', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'La Rioja', 'api_states_id' => '46', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Catamarca', 'api_states_id' => '10', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Tucumán', 'api_states_id' => '90', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Chaco', 'api_states_id' => '22', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Formosa', 'api_states_id' => '34', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Santa Cruz', 'api_states_id' => '78', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Chubut', 'api_states_id' => '26', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Mendoza', 'api_states_id' => '50', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Entre Ríos', 'api_states_id' => '30', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'San Juan', 'api_states_id' => '70', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Jujuy', 'api_states_id' => '38', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Santiago del Estero', 'api_states_id' => '86', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Río Negro', 'api_states_id' => '62', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Corrientes', 'api_states_id' => '18', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Misiones', 'api_states_id' => '54', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Salta', 'api_states_id' => '66', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Córdoba', 'api_states_id' => '14', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Buenos Aires', 'api_states_id' => '06', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'La Pampa', 'api_states_id' => '42', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],
            ['name' => 'Tierra del Fuego, Antártida e Islas del Atlántico Sur', 'api_states_id' => '94', 'countries_id' => '13', 'audi_user' => 1, 'audi_date' => date('Y-m-d H:i:s'), 'audi_action' => 'I'],

        ];
        $this->db->table('states')->insertBatch($data);
    }
}
