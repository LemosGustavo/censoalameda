<?php

namespace App\Controllers;

use stdClass;
use App\Models\Members_Model;
use App\Models\Countries_Model;
use App\Models\Members_family_Model;

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
        $members_family_model = new Members_family_Model();
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
            "quantity_sons" => "permit_empty|numeric",
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
            $localities = $this->request->getPost('locality');
            $address = $this->request->getPost('address');

            // Guardar miembro
            $member_data = [
                'name' => $this->request->getPost('name'),
                'lastname' => $this->request->getPost('lastname'),
                'birthdate' => $birthdate,
                'dni_document' => $this->request->getPost('dni_document'),
                'address' => $address,
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'gender_id' => $this->request->getPost('gender_drop'),
                'civil_state_id' => $this->request->getPost('civil_state_drop'),
                'path_photo' => $this->request->getPost('path_photo'),
                'localities_id' => $localities,
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

            // Guardar hijos como miembros relacionados
            $quantity_sons = $this->request->getPost('quantity_sons');
            if ($quantity_sons > 0) {
                for ($i = 1; $i <= $quantity_sons; $i++) {
                    $child_name = $this->request->getPost("name_$i");
                    $child_lastname = $this->request->getPost("surname_$i");
                    $child_birthdate = $this->request->getPost("birthdate_$i");
                    $child_dni = $this->request->getPost("dni_$i");
                    $child_church = $this->request->getPost("church_$i");

                    if (!empty($child_name) && !empty($child_lastname)) {
                        // Crear miembro para el hijo
                        $child_data = [
                            'name' => $child_name,
                            'lastname' => $child_lastname,
                            'birthdate' => $child_birthdate,
                            'dni_document' => $child_dni,
                            'address' => $address,
                            'localities_id' => $localities,
                            'gender_id' => 1, // Por defecto, se puede modificar según necesidad
                            'civil_state_id' => 1, // Por defecto, se puede modificar según necesidad
                        ];
                        $child_id = $members_model->insert($child_data);

                        // Crear relación familiar
                        $family_relation = [
                            'members_id' => $member_id,
                            'related_member_id' => $child_id,
                            'family_id' => 7, // ID de "Hijo/s" en la tabla family
                        ];
                        $members_family_model->insert($family_relation);
                    }
                }
            }

            $relations = [
                'App\Models\Members_social_media_Model' => 'social_media_drop',
                'App\Models\Members_experiences_Model' => 'experiences_drop',
                'App\Models\Members_services_Model' => 'services_drop',
                'App\Models\Members_interests_Model' => 'interests_drop',
                'App\Models\Members_needs_Model' => 'needs_drop',
                'App\Models\Members_life_stages_Model' => 'lifestage_drop',
                'App\Models\Members_voluntary_Model' => 'voluntary_no_drop',
                'App\Models\Members_family_Model' => 'family_drop',
            ];

            foreach ($relations as $model_name => $post_field) {
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

    public function preview() {
        $data = $this->prepare_preview_data();
        session()->set('censo_preview_data', $data);
        return $this->load_template('censo/censo_preview', ['title' => 'Revisión de Datos']);
    }

    public function confirm_save() {
        log_message('info', 'Iniciando confirm_save');
        $data = session()->get('censo_preview_data');
        
        if (!$data) {
            log_message('error', 'No hay datos en la sesión para guardar');
            return redirect()->to(base_url(''))->with('error', 'No hay datos para guardar');
        }

        log_message('info', 'Datos obtenidos de la sesión: ' . json_encode($data));

        $members_model = new Members_Model();
        $members_family_model = new Members_family_Model();
        $validation = \Config\Services::validation();

        // Manejar la subida de la foto
        $file = $this->request->getFile('profile_photo');
        $path_photo = '';
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(APPPATH . 'Uploads', $newName);
            $path_photo = $newName;
            log_message('info', 'Ruta de la imagen guardada: ' . $path_photo);
        }

        // Convertir la fecha al formato correcto
        $birthdate = \DateTime::createFromFormat('d/m/Y', $data['birthdate']);
        if ($birthdate) {
            $data['birthdate'] = $birthdate->format('Y-m-d');
        }

        // Obtener los IDs de ubicación
        $countries_model = new \App\Models\Countries_Model();
        $states_model = new \App\Models\States_Model();
        $districts_model = new \App\Models\Districts_Model();
        $localities_model = new \App\Models\Localities_Model();

        $country_record = $countries_model->where('name', $data['country'])->first();
        $state_record = $states_model->where('name', $data['state'])->first();
        $district_record = $districts_model->where('name', $data['district'])->first();
        $locality_record = $localities_model->where('name', $data['locality'])->first();

        // Configurar las reglas de validación
        $validation->setRules([
            "name" => "required|min_length[3]|max_length[50]",
            "lastname" => "required|min_length[3]|max_length[50]",
            "birthdate" => "required|valid_date",
            "gender_drop" => "required|numeric",
            "civil_state_drop" => "required|numeric",
            "dni_document" => "required|numeric|min_length[7]|max_length[8]",
            "name_profession" => "required|min_length[3]|max_length[100]",
            "artistic_skills" => "max_length[150]",
            "quantity_sons" => "permit_empty|numeric",
            "name_guia" => "permit_empty|min_length[3]|max_length[100]",
            "name_group" => "permit_empty|min_length[3]|max_length[100]"
        ]);

        // Crear un array con los datos para validar
        $validation_data = [
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'birthdate' => $data['birthdate'],
            'gender_drop' => $data['gender_drop'],
            'civil_state_drop' => $data['civil_state_drop'],
            'dni_document' => $data['dni_document'],
            'name_profession' => $data['name_profession'],
            'artistic_skills' => $data['artistic_skills'],
            'quantity_sons' => $data['quantity_sons'],
            'name_guia' => $data['name_guia'],
            'name_group' => $data['name_group']
        ];

        // Validar los datos
        if (!$validation->run($validation_data)) {
            log_message('error', 'Error de validación: ' . json_encode($validation->getErrors()));
            return redirect()->to(base_url(''))->with('error', 'Error en la validación de datos');
        }

        $this->db->transStart();
        log_message('info', 'Iniciando transacción de base de datos');

        try {
            // Guardar miembro
            $member_data = [
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                'birthdate' => $data['birthdate'],
                'dni_document' => $data['dni_document'],
                'address' => $data['address'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'gender_id' => $data['gender_drop'],
                'civil_state_id' => $data['civil_state_drop'],
                'path_photo' => $path_photo,
                'localities_id' => $locality_record ? $locality_record->id : null,
                'name_profession' => $data['name_profession'],
                'artistic_skills' => $data['artistic_skills'],
                'boss_family' => ($data['jefe'] === 'si') ? 1 : 0,
                'quantity_sons' => $data['quantity_sons'],
                'celebracion' => $data['celebracion'],
                'grupo' => $data['grupo'],
                'participate_gp' => $data['participate_gp'],
                'name_guia' => $data['name_guia'],
                'name_group' => $data['name_group'],
                'audi_user' => session()->get('id'),
                'audi_date' => date('Y-m-d H:i:s'),
                'audi_action' => 'I'
            ];

            log_message('info', 'Intentando insertar miembro con datos: ' . json_encode($member_data));
            $member_id = $members_model->insert($member_data);
            log_message('info', 'Miembro insertado con ID: ' . $member_id);

            // Guardar hijos como miembros relacionados
            if (isset($data['children']) && !empty($data['children'])) {
                foreach ($data['children'] as $index => $child) {
                    // Crear miembro para el hijo
                    $child_data = [
                        'name' => $child['name'],
                        'lastname' => $child['lastname'],
                        'birthdate' => $child['birthdate'],
                        'dni_document' => $child['dni'],
                        'address' => $data['address'],
                        'localities_id' => $locality_record ? $locality_record->id : null,
                        'gender_id' => 1, // Por defecto, se puede modificar según necesidad
                        'civil_state_id' => 1, // Por defecto, se puede modificar según necesidad
                    ];
                    $child_id = $members_model->insert($child_data);

                    // Crear relación familiar
                    $family_relation = [
                        'members_id' => $member_id,
                        'related_member_id' => $child_id,
                        'family_id' => 7, // ID de "Hijo/s" en la tabla family
                        'asist_church' => $child['church'] ? 'si' : 'no',
                        'coexists' => $this->request->getPost("coexists_" . ($index + 1)) ?? 'no'
                    ];
                    $members_family_model->insert($family_relation);
                }
            }

            // Guardar relaciones
            $relations = [
                'App\Models\Members_social_media_Model' => 'social_media_drop',
                'App\Models\Members_experiences_Model' => 'experiences_drop',
                'App\Models\Members_services_Model' => 'services_drop',
                'App\Models\Members_interests_Model' => 'interests_drop',
                'App\Models\Members_needs_Model' => 'needs_drop',
                'App\Models\Members_life_stages_Model' => 'lifestage_drop',
                'App\Models\Members_family_Model' => 'family_drop',
            ];

            foreach ($relations as $model_name => $post_field) {
                if (isset($data[$post_field]) && !empty($data[$post_field])) {
                    $model = new $model_name();
                    $foreign_key = $model->getForeignKey();

                    if ($model_name === 'App\Models\Members_social_media_Model' && !empty($data['other_socialmedia'])) {
                        $model->insert([
                            'members_id' => $member_id,
                            'other_socialmedia' => $data['other_socialmedia']
                        ]);
                    }

                    foreach ($data[$post_field] as $item_id) {
                        $model->insert([
                            'members_id' => $member_id,
                            $foreign_key => $item_id
                        ]);
                    }
                }
            }

            // Guardar datos de voluntariado
            $voluntary_model = new \App\Models\Members_voluntary_Model();
            if ($data['voluntario'] === 'si') {
                foreach ($data['voluntary_yes_drop'] as $voluntary_id) {
                    $voluntary_model->insert([
                        'members_id' => $member_id,
                        'voluntary_id' => $voluntary_id,
                        'service' => 1
                    ]);
                }
            } else {
                foreach ($data['voluntary_no_drop'] as $voluntary_id) {
                    $voluntary_model->insert([
                        'members_id' => $member_id,
                        'voluntary_id' => $voluntary_id,
                        'service' => 0
                    ]);
                }
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === FALSE) {
                throw new \Exception('Error al guardar los datos');
            }

            log_message('info', 'Transacción completada exitosamente');
            session()->remove('censo_preview_data');
            
            // Redirigir a la vista de éxito
            return $this->load_template('censo/censo_success', ['title' => 'Datos Guardados']);

        } catch (\Exception $e) {
            log_message('error', 'Error en confirm_save: ' . $e->getMessage());
            $this->db->transRollback();
            return redirect()->to(base_url(''))->with('error', 'Error al guardar los datos: ' . $e->getMessage());
        }
    }

    private function prepare_preview_data() {
        $request = service('request');
        $data = [];
        lm($request->getPost());
        try {
            // Manejar la subida de la foto - solo guardar el nombre temporal
            $file = $request->getFile('profile_photo');
            $path_photo = '';
            
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $path_photo = $file->getName();
                log_message('info', 'Nombre temporal de la imagen: ' . $path_photo);
            }

            // Datos personales
            $data['name'] = $request->getPost('name') ?? '';
            $data['lastname'] = $request->getPost('lastname') ?? '';
            $data['birthdate'] = $request->getPost('birthdate') ?? '';
            $data['gender'] = $this->get_label_from_id('Gender_Model', $request->getPost('gender_drop'));
            $data['civil_state'] = $this->get_label_from_id('Civil_state_Model', $request->getPost('civil_state_drop'));
            $data['dni_document'] = $request->getPost('dni_document') ?? '';
            $data['path_photo'] = $path_photo;

            // Contacto
            $data['email'] = $request->getPost('email') ?? '';
            $data['phone'] = $request->getPost('phone') ?? '';
            $data['social_media'] = $this->get_labels_from_ids('Social_media_Model', $request->getPost('social_media_drop') ?? []);
            if ($request->getPost('other_socialmedia')) {
                $data['social_media'][] = $request->getPost('other_socialmedia');
            }

            // Residencia
            $data['country'] = $this->get_label_from_id('Countries_Model', $request->getPost('country'));
            $data['state'] = $this->get_label_from_id('States_Model', $request->getPost('state'));
            $data['district'] = $this->get_label_from_id('Districts_Model', $request->getPost('district'));
            $data['locality'] = $this->get_label_from_id('Localities_Model', $request->getPost('locality'));
            $data['address'] = $request->getPost('address') ?? '';

            // Vocación
            $data['name_profession'] = $request->getPost('name_profession') ?? '';
            $data['artistic_skills'] = $request->getPost('artistic_skills') ?? '';
            $data['voluntario'] = $request->getPost('voluntario') ?? 'no';
            
            // Manejar áreas de voluntariado según si es voluntario o no
            if ($data['voluntario'] === 'si') {
                $data['voluntary_areas'] = $this->get_labels_from_ids('Voluntary_Model', $request->getPost('voluntary_yes_drop') ?? []);
                $data['voluntary_yes_drop'] = $request->getPost('voluntary_yes_drop') ?? [];
                $data['voluntary_no_drop'] = [];
            } else {
                $data['voluntary_areas'] = $this->get_labels_from_ids('Voluntary_Model', $request->getPost('voluntary_no_drop') ?? []);
                $data['voluntary_no_drop'] = $request->getPost('voluntary_no_drop') ?? [];
                $data['voluntary_yes_drop'] = [];
            }

            // Familia
            $data['family'] = $this->get_labels_from_ids('Family_Model', $request->getPost('family_drop') ?? []);
            $data['jefe'] = $request->getPost('jefe') ?? 'no';
            $data['quantity_sons'] = $request->getPost('quantity_sons') ?? 0;
            
            // Hijos
            $data['children'] = [];
            if ($request->getPost('quantity_sons') > 0) {
                for ($i = 1; $i <= $request->getPost('quantity_sons'); $i++) {
                    if ($request->getPost("name_$i")) {
                        $data['children'][] = [
                            'name' => $request->getPost("name_$i") ?? '',
                            'lastname' => $request->getPost("surname_$i") ?? '',
                            'birthdate' => $request->getPost("birthdate_$i") ?? '',
                            'dni' => $request->getPost("dni_$i") ?? '',
                            'church' => $request->getPost("church_$i") === 'si'
                        ];
                    }
                }
            }

            // Crecimiento Cristiano
            $data['experiences'] = $this->get_labels_from_ids('Experiences_Model', $request->getPost('experiences_drop') ?? []);
            $data['services'] = $this->get_labels_from_ids('Services_Model', $request->getPost('services_drop') ?? []);
            $data['interests'] = $this->get_labels_from_ids('Interests_Model', $request->getPost('interests_drop') ?? []);
            $data['needs'] = $this->get_labels_from_ids('Needs_Model', $request->getPost('needs_drop') ?? []);
            $data['life_stage'] = $this->get_labels_from_ids('Life_stages_Model', $request->getPost('lifestage_drop') ?? []);

            // Mantener los IDs originales para el guardado
            $data['gender_drop'] = $request->getPost('gender_drop');
            $data['civil_state_drop'] = $request->getPost('civil_state_drop');
            $data['social_media_drop'] = $request->getPost('social_media_drop') ?? [];
            $data['voluntary_no_drop'] = $request->getPost('voluntary_no_drop') ?? [];
            $data['family_drop'] = $request->getPost('family_drop') ?? [];
            $data['experiences_drop'] = $request->getPost('experiences_drop') ?? [];
            $data['services_drop'] = $request->getPost('services_drop') ?? [];
            $data['interests_drop'] = $request->getPost('interests_drop') ?? [];
            $data['needs_drop'] = $request->getPost('needs_drop') ?? [];
            $data['lifestage_drop'] = $request->getPost('lifestage_drop');
            $data['celebracion'] = $request->getPost('celebracion') ?? '';
            $data['grupo'] = $request->getPost('grupo') ?? 'no';
            $data['name_guia'] = $request->getPost('name_guia') ?? '';
            $data['name_group'] = $request->getPost('name_group') ?? '';
            $data['participate_gp'] = $request->getPost('participate_gp') ?? 'no';

            lm($data);

            return $data;
        } catch (\Exception $e) {
            log_message('error', 'Error en prepare_preview_data: ' . $e->getMessage());
            throw $e;
        }
    }

    private function get_label_from_id($model_name, $id) {
        if (empty($id)) return '';
        $model = model($model_name);
        
        // Determinar el campo de búsqueda según el modelo
        $search_field = 'id';
        if ($model_name === 'States_Model') {
            $search_field = 'api_states_id';
        } elseif ($model_name === 'Districts_Model') {
            $search_field = 'api_districts_id';
        } elseif ($model_name === 'Localities_Model') {
            $search_field = 'api_localities_id';
        }
        
        $record = $model->where($search_field, $id)->first();
        
        if (is_array($record)) {
            return $record['name'] ?? '';
        }
        return $record ? $record->name : '';
    }

    private function get_labels_from_ids($model_name, $ids) {
        if (empty($ids)) return [];
        $model = model($model_name);
        $labels = [];
        foreach ($ids as $id) {
            $record = $model->find($id);
            if (is_array($record)) {
                if (isset($record['name'])) {
                    $labels[] = $record['name'];
                }
            } else if ($record) {
                $labels[] = $record->name;
            }
        }
        return $labels;
    }
}
