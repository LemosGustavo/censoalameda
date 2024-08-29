<?php

namespace App\Controllers;

use App\Models\Civil_state_Model;
use CodeIgniter\Model;
use App\Models\Members_Model;

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

        $civil_state = $civil_state_model->findAll();
        lm($civil_state);

        $data = [];
        return $data;
    }
}
