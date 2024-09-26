<?php

namespace App\Controllers;

use App\Models\States_Model;
use App\Models\Districts_Model;
use App\Models\Localities_Model;

class Location extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    public function get_states_by_country($country_id) {
        $state_model = new States_Model();
        $states = $state_model->where('countries_id', $country_id)->orderBy('name')->findAll();
        return $this->response->setJSON($states);
    }

    public function get_districts_by_state($state_id) {
        $district_model = new Districts_Model();
        $districts = $district_model->where('api_states_id', $state_id)->orderBy('name')->findAll();
        return $this->response->setJSON($districts);
    }

    public function get_localities_by_district($district_id) {
        $locality_model = new Localities_Model();
        $localities = $locality_model->where('api_districts_id', $district_id)->orderBy('name')->findAll();
        return $this->response->setJSON($localities);
    }
}
