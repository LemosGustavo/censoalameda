<?php

namespace App\Controllers;

use stdClass;
use App\Models\Members_Model;
use App\Models\Countries_Model;

class Censo extends MY_Controller {
    private $db;
    function __construct() {
        parent::__construct();
        $this->db = \Config\Database::connect();
        helper('date');
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
                throw new \CodeIgniter\Exceptions\PageNotFoundException($dashboard);
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

        // lm($_POST);
        // exit();
        $members_model = new Members_Model();
        $validation = \Config\Services::validation();

        $validation->setRules([
            "name" => "required|min_length[3]|max_length[50]",
            "lastname" => "required|min_length[3]|max_length[50]",
            "birthdate" => "required|valid_date",
            "gender_drop" => "required|numeric",
            "civil_state_drop" => "required|numeric",
            "dni_document" => "required|numeric|min_length[7]|max_length[8]",
            // "phone" => "required|min_length[8]|max_length[20]",
            // "address" => "required|min_length[5]|max_length[100]",
            // "email" => "required|valid_email|max_length[100]",
            "country" => "required|numeric",
            "state" => "required|numeric",
            "district" => "required|numeric",
            "locality" => "required|numeric",
            "name_profession" => "required|min_length[3]|max_length[100]",
            "artistic_skills" => "max_length[150]",
            "quantity_sons" => "numeric",
            "name_guia" => "permit_empty|min_length[3]|max_length[100]",
            "name_group" => "permit_empty|min_length[3]|max_length[100]"
        ], [
            "name" => [
                "required" => "El nombre es requerido",
                "min_length" => "El nombre debe tener al menos 3 caracteres",
                "max_length" => "El nombre no puede exceder los 50 caracteres"
            ],
            "lastname" => [
                "required" => "El apellido es requerido",
                "min_length" => "El apellido debe tener al menos 3 caracteres",
                "max_length" => "El apellido no puede exceder los 50 caracteres"
            ],
            "birthdate" => [
                "required" => "La fecha de nacimiento es requerida",
                "valid_date" => "La fecha de nacimiento no es válida"
            ],
            "gender_drop" => [
                "required" => "El género es requerido",
                "numeric" => "El género seleccionado no es válido"
            ],
            "civil_state_drop" => [
                "required" => "El estado civil es requerido",
                "numeric" => "El estado civil seleccionado no es válido"
            ],
            "dni_document" => [
                "required" => "El DNI es requerido",
                "numeric" => "El DNI debe contener solo números",
                "min_length" => "El DNI debe tener al menos 7 dígitos",
                "max_length" => "El DNI no puede exceder los 8 dígitos"
            ],
            "phone" => [
                "required" => "El teléfono es requerido",
                "min_length" => "El teléfono debe tener al menos 8 dígitos",
                "max_length" => "El teléfono no puede exceder los 20 caracteres"
            ],
            "address" => [
                "required" => "La dirección es requerida",
                "min_length" => "La dirección debe tener al menos 5 caracteres",
                "max_length" => "La dirección no puede exceder los 100 caracteres"
            ],
            // "email" => [
            //     "required" => "El email es requerido",
            //     "valid_email" => "El email no es válido",
            //     "max_length" => "El email no puede exceder los 100 caracteres"
            // ],
            "country" => [
                "required" => "El país es requerido",
                "numeric" => "El país seleccionado no es válido"
            ],
            "state" => [
                "required" => "La provincia es requerida",
                "numeric" => "La provincia seleccionada no es válida"
            ],
            "district" => [
                "required" => "El departamento es requerido",
                "numeric" => "El departamento seleccionado no es válido"
            ],
            "locality" => [
                "required" => "La localidad es requerida",
                "numeric" => "La localidad seleccionada no es válida"
            ],
            "name_profession" => [
                "required" => "La profesión es requerida",
                "min_length" => "La profesión debe tener al menos 3 caracteres",
                "max_length" => "La profesión no puede exceder los 100 caracteres"
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors()
            ]);
        }

        $this->db->transStart();

        try {
            // Convertir fecha de nacimiento y calcular edad
            $birthdate = $this->get_date_sql($this->request->getPost('birthdate'));

            // Guardar miembro
            $member_data = [
                'name' => $this->request->getPost('name'),
                'lastname' => $this->request->getPost('lastname'),
                'birthdate' => $birthdate,
                'dni_document' => $this->request->getPost('dni_document'),
                'address' => $this->request->getPost('address'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'gender_id' => $this->request->getPost('gender_drop'),
                'civil_state_id' => $this->request->getPost('civil_state_drop'),
                'path_photo' => $this->request->getPost('path_photo'),
                'localities_id' => $this->request->getPost('locality'),
                'name_profession' => $this->request->getPost('name_profession'),
                'artistic_skills' => $this->request->getPost('artistic_skills'),
                'boss_family' => ($this->request->getPost('jefe') === 'si') ? 1 : 0,
                'quantity_sons' => $this->request->getPost('quantity_sons'),
                'celebracion' => $this->request->getPost('celebracion'),
                'name_guia' => $this->request->getPost('name_guia'),
                'name_group' => $this->request->getPost('name_group'),
                'audi_user' => session()->get('id'),
                'audi_date' => date('Y-m-d H:i:s'),
                'audi_action' => 'I'
            ];
            $member_id = $members_model->insert($member_data);

            $relations = [
                'App\Models\Members_social_media_Model' => 'social_media_drop',
                'App\Models\Members_experiences_Model' => 'experiences_drop',
                'App\Models\Members_services_Model' => 'services_drop',
                'App\Models\Members_interests_Model' => 'interests_drop',
                'App\Models\Members_needs_Model' => 'needs_drop',
                'App\Models\Members_life_stages_Model' => 'lifestage_drop',
                'App\Models\Members_voluntary_Model' => 'voluntary_no_drop',
                // 'App\Models\Members_enjoys_Model' => 'voluntary_no_drop',
                'App\Models\Members_family_Model' => 'family_drop',
            ];


            foreach ($relations as $model_name => $post_field) {
                // lm($relations);
                // lm($model_name);
                // lm($post_field);
                if ($items = $this->request->getPost($post_field)) {
                    $model = new $model_name();
                    $foreign_key = $model->getForeignKey();

                    // Si es la tabla de redes sociales y hay un valor en other_socialmedia
                    if ($model_name === 'App\Models\Members_social_media_Model' && $this->request->getPost('other_socialmedia')) {
                        // Primero insertamos la red social personalizada
                        $model->insert([
                            'members_id' => $member_id,
                            'other_socialmedia' => $this->request->getPost('other_socialmedia')
                        ]);
                    }

                    // Luego insertamos las redes sociales seleccionadas
                    foreach ($items as $item_id) {
                        $model->insert([
                            'members_id' => $member_id,
                            $foreign_key => $item_id
                        ]);
                    }
                }
            }

            // // Guardar información de hijos como miembros
            // if ($this->request->getPost('hijo') === 'si') {
            //     $i = 1;
            //     while ($this->request->getPost('name_' . $i)) {
            //         $son_data = [
            //             'name' => $this->request->getPost('name_' . $i),
            //             'lastname' => $this->request->getPost('surname_' . $i),
            //             'dni' => $this->request->getPost('dni_' . $i),
            //             'is_son' => 1,
            //             'parent_id' => $member_id,
            //             'audi_user' => session()->get('id'),
            //             'audi_date' => date('Y-m-d H:i:s'),
            //             'audi_action' => 'I'
            //         ];
            //         $members_model->insert($son_data);
            //         $i++;
            //     }
            // }

            $this->db->transComplete();

            if ($this->db->transStatus() === FALSE) {
                throw new \Exception('Error al guardar los datos');
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Datos guardados correctamente',
                'member_id' => $member_id
            ]);
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al guardar los datos: ' . $e->getMessage()
            ]);
        }
    }
}
