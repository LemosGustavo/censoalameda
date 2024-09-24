<?php

namespace App\Controllers;

use stdClass;
use App\Models\Gender_Model;
use App\Models\Contact_Model;
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

        helper('form');
        $contact_class = new stdClass();
        $contact_class->fields = array(
            'email' => array('label' => 'Email', 'type' => 'email', 'placeholder' => 'Ingresar correo electrónico', 'maxlength' => '50', 'required' => TRUE),
            'phone' => array('label' => 'Teléfono', 'type' => 'text', 'placeholder' => 'Ingresar teléfono', 'maxlength' => '50', 'required' => TRUE),
            'social_media_drop' => array('label' => 'Redes Sociales', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'social_media_id'),
            'other_socialmedia' => array('label' => 'Otra Red Social', 'placeholder' => 'Otra Red Social', 'maxlength' => '100'),
        );

        $civil_state = $civil_state_model->findAll();
        // lm($civil_state);
        $array_civil_state = $this->get_array('Civil_state_Model', 'name', 'id', ['orderBy' => 'id'], array('' => '-- Seleccionar Estado Civil --'));
        $members_model->set_field_array('civil_state_drop', $array_civil_state);

        $array_gender = $this->get_array('Gender_Model', 'name', 'id', ['orderBy' => 'id'], array('' => '-- Seleccionar Género --'));
        $members_model->set_field_array('gender_drop', $array_gender);

        $array_social_media = $this->get_array('Social_media_Model', 'name', 'id', ['orderBy' => 'name']);
        $contact_class->fields['social_media_drop']['array'] = $array_social_media;


        // lm($members_model->fields);
        $country_model = new Countries_Model();
        $data['countries'] = $country_model->findAll();
        $data['fields'] = $this->build_fields($members_model->fields);
        $data['fields_contact'] = $this->build_fields($contact_class->fields);
        $data['title'] = "Ingresar Usuario";
        // $data['txt_btn'] = "create";

        // $data = [];
        return $data;
    }
}
