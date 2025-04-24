<?php

namespace App\Controllers;

use stdClass;
use App\Models\Job_Model;
use App\Models\Contact_Model;
use App\Models\Members_Model;
use App\Models\Countries_Model;

class Censo extends MY_Controller {
    private $db;
    function __construct() {
        parent::__construct();
        $this->db = \Config\Database::connect();
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
        $members_model = new Members_Model();
        $contact_class = new stdClass();
        $vocation_class = new stdClass();
        $family_class = new stdClass();
        $cristians_class = new stdClass();

        $contact_class->fields = array(
            'email' => array('label' => 'Email', 'type' => 'email', 'placeholder' => 'contacto@alameda.ar', 'maxlength' => '50', 'required' => TRUE),
            'phone' => array('label' => 'Teléfono', 'type' => 'text', 'placeholder' => 'Ingresar teléfono', 'maxlength' => '50', 'required' => TRUE),
            'social_media_drop' => array('label' => '¿En qué redes Sociales estás?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'social_media_id'),
            'other_socialmedia' => array('label' => 'Otra Red Social', 'placeholder' => 'Otra Red Social', 'maxlength' => '100'),
        );

        $vocation_class->fields = array(
            'name_profession' => array('label' => '¿A qué te dedicas?', 'placeholder' => 'Profesión/Oficio/Labor'),
            'artistic_skills' => array('label' => 'Habilidades con las cuales podes servir a tus hermanos', 'type' => 'text', 'placeholder' => 'Habilidades', 'maxlength' => '150'),
            'voluntary_yes_drop' => array('label' => 'Selecciona el área en la que sirves:', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'voluntary_yes_id'),
            'voluntary_no_drop' => array('label' => '¿Te interesaría servir en estas áreas?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'voluntary_no_id',),
        );

        $family_class->fields = array(
            'quantity_sons' => array('label' => '¿Cuántos hijos tienes?', 'type' => 'number', 'placeholder' => 'Número de hijos'),
            'family_drop' => array('label' => '¿Con quién vives?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'family_id'),
        );

        $cristians_class->fields = array(
            'experiences_drop' => array('label' => 'Elige las experiencias completadas', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'experiences_id'),
            'services_drop' => array('label' => '¿Has utilizado alguno de estos servicios', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'services_id'),
            'interests_drop' => array('label' => '¿Cuáles son tus áreas de interés?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'interests_id'),
            'needs_drop' => array('label' => '¿Cuáles son tus necesidades?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'needs_id'),
            'lifestage_drop' => array('label' => '¿Con cuál etapa de vida te identificas?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'life_stage_id'),
        );

        $array_civil_state = $this->get_array('Civil_state_Model', 'name', 'id', ['orderBy' => 'id'], array('' => '-- Seleccionar Estado Civil --'));
        $members_model->set_field_array('civil_state_drop', $array_civil_state);

        $array_gender = $this->get_array('Gender_Model', 'name', 'id', ['orderBy' => 'id'], array('' => '-- Seleccionar Sexo --'));
        $members_model->set_field_array('gender_drop', $array_gender);

        $array_social_media = $this->get_array('Social_media_Model', 'name', 'id', ['orderBy' => 'name']);
        $contact_class->fields['social_media_drop']['array'] = $array_social_media;

        $array_voluntary_yes = $this->get_array('Voluntary_Model', 'name', 'id', ['orderBy' => 'name']);
        $vocation_class->fields['voluntary_yes_drop']['array'] = $array_voluntary_yes;

        $array_voluntary_no = $this->get_array('Voluntary_Model', 'name', 'id', ['orderBy' => 'name']);
        $vocation_class->fields['voluntary_no_drop']['array'] = $array_voluntary_no;

        $array_family_drop = $this->get_array('Family_Model', 'name', 'id', ['orderBy' => 'id']);
        $family_class->fields['family_drop']['array'] = $array_family_drop;

        $array_experiences_drop = $this->get_array('Experiences_Model', 'name', 'id', ['orderBy' => 'id']);
        $cristians_class->fields['experiences_drop']['array'] = $array_experiences_drop;

        $array_services_drop = $this->get_array('Services_Model', 'name', 'id', ['orderBy' => 'name']);
        $cristians_class->fields['services_drop']['array'] = $array_services_drop;

        $array_interests_drop = $this->get_array('Interests_Model', 'name', 'id', ['orderBy' => 'name']);
        $cristians_class->fields['interests_drop']['array'] = $array_interests_drop;

        $array_needs_drop = $this->get_array('Needs_Model', 'name', 'id', ['orderBy' => 'name']);
        $cristians_class->fields['needs_drop']['array'] = $array_needs_drop;

        $array_lifestage_drop = $this->get_array('Life_stages_Model', 'name', 'id', ['orderBy' => 'id']);
        $cristians_class->fields['lifestage_drop']['array'] = $array_lifestage_drop;


        $country_model = new Countries_Model();
        $data['countries'] = $country_model->findAll();
        $data['fields'] = $this->build_fields($members_model->fields);
        $data['fields_contact'] = $this->build_fields($contact_class->fields);
        $data['fields_vocation'] = $this->build_fields($vocation_class->fields);
        $data['fields_family'] = $this->build_fields($family_class->fields);
        $data['fields_cristians'] = $this->build_fields($cristians_class->fields);
        $data['title'] = "Ingresar Usuario";

        return $data;
    }

    public function ajax_save() {

        lm($_POST);
        $job_model = new Job_Model();
        $contact_model = new Contact_Model();
        $members_model = new Members_Model();
        $validation = \Config\Services::validation();

        $validation->setRules(
            array(
                "name" => "Required",
                "lastname" => "Required",
            ),
            array(
                "name" => array(
                    "Required" => "El nombre es requerido"
                ),
                "lastname" => array(
                    "Required" => "El apellido es requerido"
                ),
            )
        );

        if (isset($_POST) && !empty($_POST)) {
            $trans_ok = TRUE;
            $errors = '';
            if (!$validation->withRequest($this->request)->run()) {
                $errors = flashData($validation->getErrors());
                $trans_ok = FALSE;
            } else {

                $trans_ok &= $job_model->create(array(
                    'name_profession' => $this->request->getPost('name_profession'),
                    'artistic_skills' => $this->request->getPost('artistic_skills'),
                ), FALSE);

                $trans_ok &= $members_model->create(array(
                    'name' => $this->request->getPost('name'),
                    'lastname' => $this->request->getPost('lastname'),
                    'birthdate' => $this->get_date_sql($this->request->getPost('birthdate')),
                    'age' => $this->request->getPost('age'),
                    'address' => $this->request->getPost('address'),
                    'address_number' => $this->request->getPost('address_number'),
                    'gender_id' => $this->request->getPost('gender_drop'),
                    'civil_state_id' => $this->request->getPost('civil_state_drop'),
                    // 'path_photo' => $this->request->getPost('path_photo'),
                    'job_id' => $this->request->getPost('job_id'),
                    'localities_id' => $this->request->getPost('localities_id'),
                    'contact_id' => $this->request->getPost('contact_id'),
                    'boss_family' => $this->request->getPost('boss_family'),
                ), FALSE);

                $trans_ok &= $members_model->create(array(
                    'name' => $this->request->getPost('name'),
                    'lastname' => $this->request->getPost('lastname'),

                ), FALSE);
            }

            if ($this->db->transStatus() && $trans_ok) {
                $this->db->transCommit();
                session()->setFlashdata('message', $members_model->get_msg());
                return redirect()->to(base_url('/management/company#company_assign'));
            } else {
                $this->db->transRollback();
                $errors .= $members_model->get_error();
                session()->setFlashdata('error', $errors);
                return redirect()->to(base_url('/management/company#company_assign'));
            }
        }
    }
}
