<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PopulationDBSeeder extends Seeder {
    public function run() {
        $this->call('CountriesSeeder');
        $this->call('StatesSeeder');
        $this->call('DistrictsSeeder');
        $this->call('LocalitiesSeeder');
        $this->call('CivilStateSeeder');
        $this->call('GenderSeeder');
        $this->call('SocialMediaSeeder');
        $this->call('VoluntarySeeder');
        $this->call('FamilySeeder');
    }
}
