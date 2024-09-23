<?php

namespace App\Controllers;

use App\Models\Gender_Model;
use App\Models\Members_Model;
use App\Models\Countries_Model;
use App\Models\Civil_state_Model;

class Censo extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    public function dashboard(String $dashboard = "home", String $view = '') {
        if (!is_file(APPPATH . 'Views/censo/censo_' . $dashboard . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($dashboard);
        }

        switch ($dashboard) {
            case 'home':
                $view = 'censo/censo_home';
                $data = $this->censo_home();
                break;
            default:
                $view = '';
                break;
        }
        return $this->load_template($view, $data);
    }

    private function censo_home() {
        helper('form');
        $validation = \Config\Services::validation();
        $members_model = new Members_Model();
        $civil_state_model = new Civil_state_Model();
        $gender_model = new Gender_Model();

        $civil_state = $civil_state_model->findAll();
        // lm($civil_state);
        $array_civil_state = $this->get_array('Civil_state_Model', 'name', 'id', ['orderBy' => 'id'], array('' => '-- Seleccionar Estado Civil --'));
        $members_model->set_field_array('civil_state_drop', $array_civil_state);

        $array_gender = $this->get_array('Gender_Model', 'name', 'id', ['orderBy' => 'id'], array('' => '-- Seleccionar Género --'));
        $members_model->set_field_array('gender_drop', $array_gender);

        
        // lm($members_model->fields);
        $country_model = new Countries_Model();
        $data['countries'] = $country_model->findAll();
        $data['fields'] = $this->build_fields($members_model->fields);
        $data['title'] = "Ingresar Usuario";
        // $data['txt_btn'] = "create";

        // $data = [];
        return $data;
    }
}
