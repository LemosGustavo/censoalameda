<?php

namespace App\Controllers;

use stdClass;
use App\Models\Members_Model;
use App\Models\Countries_Model;
use App\Models\Members_family_Model;
use App\Models\Civil_state_Model;
use App\Models\Gender_Model;

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
            'email' => array('label' => 'Email', 'type' => 'email', 'placeholder' => 'contacto@alameda.ar', 'maxlength' => '50', 'required' => FALSE),
            'phone' => array('label' => 'Teléfono', 'type' => 'text', 'placeholder' => '[cod.área]+[nro]. Ej: (2613123123)', 'maxlength' => '50', 'required' => TRUE),
            'social_media_drop' => array('label' => '¿En qué redes Sociales estás?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'social_media_id'),
            'other_socialmedia' => array('label' => 'Otra Red Social', 'placeholder' => 'Otra Red Social', 'maxlength' => '100'),
        );

        $vocation_class->fields = array(
            'name_profession' => array('label' => '¿A qué te dedicas?', 'placeholder' => 'Profesión/Oficio/Labor', 'required' => TRUE),
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
            'services_drop' => array('label' => '¿Has utilizado alguno de estos servicios', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'services_id', 'required' => TRUE),
            'interests_drop' => array('label' => '¿Cuáles son tus áreas de interés?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'interests_id', 'required' => TRUE),
            'needs_drop' => array('label' => '¿Cuáles son tus necesidades?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'needs_id', 'required' => TRUE),
            'lifestage_drop' => array('label' => '¿Con cuál etapa de vida te identificas?', 'type' => 'multiple', 'input_type' => 'combo', 'id_name' => 'life_stage_id', 'required' => TRUE),
        );

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
        
        $gender_model = new Gender_Model();
        
        $civil_state_model = new Civil_state_Model();
        
        $data['countries'] = $country_model->findAll();
        $data['genders'] = $gender_model->findAll();
        $data['civil_states'] = $civil_state_model->findAll();
        $data['fields'] = $this->build_fields($members_model->fields);
        $data['fields_contact'] = $this->build_fields($contact_class->fields);
        $data['fields_vocation'] = $this->build_fields($vocation_class->fields);
        $data['fields_family'] = $this->build_fields($family_class->fields);
        $data['fields_cristians'] = $this->build_fields($cristians_class->fields);
        $data['title'] = "Ingresar Usuario";

        return $data;
    }

    public function preview() {
        // Agregar nonce para CSP
        $nonce = bin2hex(random_bytes(16));
        session()->set('csp_nonce', $nonce);
        
        $data = $this->prepare_preview_data();
        session()->set('censo_preview_data', $data);
        
        return $this->load_template('censo/censo_preview', [
            'title' => 'Revisión de Datos',
            'csp_nonce' => $nonce
        ]);
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
        $path_photo = '';

        if (!empty($data['photo_base64'])) {
            $newName = uniqid() . '.jpg';
            $filePath = APPPATH . 'Uploads/' . $newName;
            file_put_contents($filePath, base64_decode($data['photo_base64']));
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
                'country_id' => $country_record ? $country_record->id : null,
                'state_id' => $state_record ? $state_record->id : null,
                'district_id' => $district_record ? $district_record->id : null,
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
                        'coexists' => $child['coexists'] ? 'si' : 'no'
                    ];
                    $members_family_model->insert($family_relation);
                }
            }

            // Guardar cónyuge como miembro relacionado
            if (isset($data['conyuge']) && !empty($data['conyuge'])) {
                // Crear miembro para el cónyuge
                $conyuge_data = [
                    'name' => $data['conyuge']['name'],
                    'lastname' => $data['conyuge']['lastname'],
                    'birthdate' => $data['conyuge']['birthdate'],
                    'dni_document' => $data['conyuge']['dni'],
                    'address' => $data['address'],
                    'localities_id' => $locality_record ? $locality_record->id : null,
                    'gender_id' => 1, // Por defecto, se puede modificar según necesidad
                    'civil_state_id' => 1, // Por defecto, se puede modificar según necesidad
                ];
                $conyuge_id = $members_model->insert($conyuge_data);

                // Crear relación familiar
                $family_relation = [
                    'members_id' => $member_id,
                    'related_member_id' => $conyuge_id,
                    'family_id' => 5, // ID de "Cónyuge" en la tabla family
                    'asist_church' => $data['conyuge']['church'] ? 'si' : 'no',
                    'coexists' => 'si' // Por defecto, el cónyuge convive
                ];
                $members_family_model->insert($family_relation);
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
        try {
            // Manejar la subida de la foto - guardar el contenido en base64
            $file = $request->getFile('profile_photo');
            $path_photo = '';
            $photo_base64 = '';

            log_message('info', 'Iniciando procesamiento de imagen');
            log_message('info', 'File recibido: ' . ($file ? 'sí' : 'no'));
            
            if ($file) {
                log_message('info', 'Nombre del archivo: ' . $file->getName());
                log_message('info', 'Tamaño del archivo: ' . $file->getSize() . ' bytes');
                log_message('info', 'Tipo MIME: ' . $file->getMimeType());
                log_message('info', 'Es válido: ' . ($file->isValid() ? 'sí' : 'no'));
                log_message('info', 'Se ha movido: ' . ($file->hasMoved() ? 'sí' : 'no'));
                log_message('info', 'Ruta temporal: ' . $file->getTempName());
                
                // Verificar si el archivo temporal existe
                if (file_exists($file->getTempName())) {
                    log_message('info', 'El archivo temporal existe y es legible');
                    $fileContent = file_get_contents($file->getTempName());
                    if ($fileContent !== false) {
                        log_message('info', 'Contenido del archivo leído correctamente');
                        $photo_base64 = base64_encode($fileContent);
                        log_message('info', 'Imagen codificada en base64 - Tamaño: ' . strlen($photo_base64) . ' bytes');
                    } else {
                        log_message('error', 'No se pudo leer el contenido del archivo temporal');
                    }
                } else {
                    log_message('error', 'El archivo temporal no existe');
                }
            }

            // Datos personales
            $data['name'] = $request->getPost('name') ?? '';
            $data['lastname'] = $request->getPost('lastname') ?? '';
            $data['birthdate'] = $request->getPost('birthdate') ?? '';
            $data['gender'] = $this->get_label_from_id('Gender_Model', $request->getPost('gender_drop'));
            $data['civil_state'] = $this->get_label_from_id('Civil_state_Model', $request->getPost('civil_state_drop'));
            $data['dni_document'] = $request->getPost('dni_document') ?? '';
            $data['path_photo'] = $file ? $file->getName() : '';
            $data['photo_base64'] = $photo_base64;

            log_message('info', 'Datos preparados - path_photo: ' . $data['path_photo']);
            log_message('info', 'Datos preparados - photo_base64: ' . (empty($data['photo_base64']) ? 'vacío' : 'contenido presente'));
            log_message('info', 'Datos preparados - Tamaño de photo_base64: ' . strlen($data['photo_base64']) . ' bytes');

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

            // Cónyuge
            if ($request->getPost('name_conyuge')) {
                $data['conyuge'] = [
                    'name' => $request->getPost('name_conyuge') ?? '',
                    'lastname' => $request->getPost('surname_conyuge') ?? '',
                    'birthdate' => $request->getPost('birthdate_conyuge') ?? '',
                    'dni' => $request->getPost('dni_conyuge') ?? '',
                    'church' => $request->getPost('church_conyuge') === 'si'
                ];
            }

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
                            'church' => $request->getPost("church_$i") === 'si',
                            'coexists' => $request->getPost("coexists_$i") === 'si'
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
            $data['celebracion'] = $request->getPost('celebracion') ?? NULL;
            $data['grupo'] = $request->getPost('grupo') ?? 'no';
            $data['name_guia'] = $request->getPost('name_guia') ?? NULL;
            $data['name_group'] = $request->getPost('name_group') ?? NULL;
            $data['participate_gp'] = $request->getPost('participate_gp') ?? 'no';

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

    public function search() {
        return $this->load_template('censo/censo_search', ['title' => 'Buscar Registro']);
    }

    public function search_by_dni() {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Método no permitido']);
        }

        $dni = $this->request->getJSON()->dni;
        lm($this->request->getJSON());
        $members_model = new Members_Model();
        $member = $members_model->where('dni_document', $dni)->first();

        return $this->response->setJSON([
            'found' => $member !== null,
            'member' => [
                'dni' => $member ? $member->dni_document : null,
                'name' => $member ? $member->name : null,
                'lastname' => $member ? $member->lastname : null,
                'birthdate' => $member ? $member->birthdate : null
            ],
            'is_head_of_household' => $member ? ($member->boss_family == 1) : false
        ]);
    }

    public function search_by_personal_data() {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Método no permitido']);
        }

        $data = $this->request->getJSON();
        $members_model = new Members_Model();
        
        $member = $members_model->where('name', $data->name)
                               ->where('lastname', $data->lastname)
                               ->where('birthdate', $data->birthdate)
                               ->first();

        return $this->response->setJSON([
            'found' => $member !== null,
            'member' => [
                'dni' => $member ? $member->dni_document : null,
                'name' => $member ? $member->name : null,
                'lastname' => $member ? $member->lastname : null,
                'birthdate' => $member ? $member->birthdate : null
            ],
            'is_head_of_household' => $member ? ($member->boss_family == 1) : false
        ]);
    }

    public function edit($id) {
        $members_model = new Members_Model();
        $member = $members_model->find($id);

        if (!$member) {
            return redirect()->to('/censo/search')->with('error', 'Registro no encontrado');
        }

        $data = $this->censo_home();
        $data['member'] = $member;
        $data['title'] = 'Editar Registro';
        $data['is_edit'] = true;

        // Verificar si se debe gestionar convivientes
        $manage_household = $this->request->getGet('manage_household');
        $has_spouse = $this->request->getGet('spouse');
        $has_children = $this->request->getGet('children');

        if ($manage_household) {
            $data['manage_household'] = true;
            $data['has_spouse'] = $has_spouse === 'true';
            $data['has_children'] = $has_children === 'true';
        }

        return $this->load_template('censo/censo_home', $data);
    }

    public function search_conviviente() {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Método no permitido']);
        }

        $data = $this->request->getJSON();
        $members_model = new Members_Model();
        
        $member = $members_model->where('name', $data->name)
                               ->where('lastname', $data->lastname)
                               ->where('birthdate', $data->birthdate)
                               ->first();

        return $this->response->setJSON([
            'found' => $member !== null,
            'member' => $member
        ]);
    }

    private function prepare_edit_data($member) {
        $data = [];
        try {
            // Datos personales básicos
            $data['member'] = $member;
            $data['is_edit'] = true;
            
            // Obtener datos relacionados
            $members_family_model = new Members_family_Model();
            $data['family_relations'] = $members_family_model->where('members_id', $member->id)->findAll();
            
            // Obtener datos de modelos relacionados
            $data = array_merge($data, $this->censo_home());
            
            // Cargar datos de redes sociales
            $social_media_model = new \App\Models\Members_social_media_Model();
            $data['social_media'] = $social_media_model->where('members_id', $member->id)->findAll();
            
            // Cargar datos de experiencias
            $experiences_model = new \App\Models\Members_experiences_Model();
            $data['experiences'] = $experiences_model->where('members_id', $member->id)->findAll();
            
            // Cargar datos de servicios
            $services_model = new \App\Models\Members_services_Model();
            $data['services'] = $services_model->where('members_id', $member->id)->findAll();
            
            // Cargar datos de intereses
            $interests_model = new \App\Models\Members_interests_Model();
            $data['interests'] = $interests_model->where('members_id', $member->id)->findAll();
            
            // Cargar datos de necesidades
            $needs_model = new \App\Models\Members_needs_Model();
            $data['needs'] = $needs_model->where('members_id', $member->id)->findAll();
            
            // Cargar datos de etapas de vida
            $life_stages_model = new \App\Models\Members_life_stages_Model();
            $data['life_stages'] = $life_stages_model->where('members_id', $member->id)->findAll();
            
            // Cargar datos de voluntariado
            $voluntary_model = new \App\Models\Members_voluntary_Model();
            $data['voluntary'] = $voluntary_model->where('members_id', $member->id)->findAll();
            
            // Preparar arrays de IDs para los selectores múltiples
            $data['selected_social_media'] = array_column($data['social_media'], 'social_media_id');
            $data['selected_experiences'] = array_column($data['experiences'], 'experiences_id');
            $data['selected_services'] = array_column($data['services'], 'services_id');
            $data['selected_interests'] = array_column($data['interests'], 'interests_id');
            $data['selected_needs'] = array_column($data['needs'], 'needs_id');
            $data['selected_life_stages'] = array_column($data['life_stages'], 'life_stage_id');
            
            // Preparar datos de voluntariado
            $data['voluntario'] = 'no';
            $data['selected_voluntary_yes'] = [];
            $data['selected_voluntary_no'] = [];
            
            foreach ($data['voluntary'] as $vol) {
                // Verificar si $vol es un array o un objeto
                $service = is_array($vol) ? $vol['service'] : $vol->service;
                $voluntary_id = is_array($vol) ? $vol['voluntary_id'] : $vol->voluntary_id;
                
                if ($service == 1) {
                    $data['voluntario'] = 'si';
                    $data['selected_voluntary_yes'][] = $voluntary_id;
                } else {
                    $data['selected_voluntary_no'][] = $voluntary_id;
                }
            }

            // Asegurar que la propiedad voluntario esté disponible en el objeto member
            $data['member']->voluntario = $data['voluntario'];
            
            return $data;
        } catch (\Exception $e) {
            log_message('error', 'Error en prepare_edit_data: ' . $e->getMessage());
            throw $e;
        }
    }

    public function prepare_edit() {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Método no permitido']);
        }

        $data = $this->request->getJSON();
        $members_model = new Members_Model();
        
        // Limpiar datos anteriores de la sesión
        session()->remove('censo_edit_data');
        
        if (isset($data->dni)) {
            $member = $members_model->where('dni_document', $data->dni)->first();
        } else {
            $member = $members_model->where('name', $data->name)
                                  ->where('lastname', $data->lastname)
                                  ->where('birthdate', $data->birthdate)
                                  ->first();
        }

        if (!$member) {
            return $this->response->setJSON(['success' => false, 'message' => 'Miembro no encontrado']);
        }

        try {
            $edit_data = $this->prepare_edit_data($member);
            // Asegurarse de que el ID del miembro esté incluido
            $edit_data['member_id'] = $member->id;
            session()->set('censo_edit_data', $edit_data);
            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            log_message('error', 'Error preparando datos de edición: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Error preparando datos de edición']);
        }
    }

    public function edit_form() {
        $edit_data = session()->get('censo_edit_data');
        
        if (!$edit_data) {
            lm('No hay datos para editar');
            return redirect()->to('/censo/search')->with('error', 'No hay datos para editar');
        }

        // Verificar que los datos correspondan al miembro correcto
        if (!isset($edit_data['member_id']) || !isset($edit_data['member'])) {
            session()->remove('censo_edit_data');
            lm('Datos de edición inválidos');
            return redirect()->to('/censo/search')->with('error', 'Datos de edición inválidos');
        }

        return $this->load_template('censo/censo_edit', [
            'title' => 'Editar Registro',
            'data' => $edit_data
        ]);
    }

    public function update($id = null) {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Método no permitido']);
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Obtener datos del formulario
            $formData = $this->request->getPost();
            
            // Actualizar datos básicos del miembro
            $memberModel = new Members_Model();
            $memberData = [
                'name' => $formData['name'],
                'last_name' => $formData['last_name'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'address' => $formData['address'],
                'birth_date' => $formData['birth_date'],
                'gender' => $formData['gender'],
                'marital_status' => $formData['marital_status'],
                'occupation' => $formData['occupation'],
                'education_level' => $formData['education_level'],
                'income_level' => $formData['income_level'],
                'health_condition' => $formData['health_condition'],
                'disability' => $formData['disability'],
                'ethnicity' => $formData['ethnicity'],
                'religion' => $formData['religion'],
                'languages' => $formData['languages'],
                'migration_status' => $formData['migration_status'],
                'vulnerability_factors' => $formData['vulnerability_factors'],
                'notes' => $formData['notes']
            ];
            
            $memberModel->update($id, $memberData);

            // Actualizar relaciones familiares
            $familyModel = new Members_family_Model();
            $familyModel->where('members_id', $id)->delete();
            if (!empty($formData['family_relations'])) {
                foreach ($formData['family_relations'] as $relation) {
                    $familyModel->insert([
                        'members_id' => $id,
                        'relation_type' => $relation['relation_type'],
                        'relation_name' => $relation['relation_name'],
                        'relation_age' => $relation['relation_age']
                    ]);
                }
            }

            // Actualizar redes sociales
            $socialMediaModel = new \App\Models\Members_social_media_Model();
            $socialMediaModel->where('members_id', $id)->delete();
            if (!empty($formData['social_media'])) {
                foreach ($formData['social_media'] as $socialMediaId) {
                    $socialMediaModel->insert([
                        'members_id' => $id,
                        'social_media_id' => $socialMediaId
                    ]);
                }
            }

            // Actualizar experiencias
            $experiencesModel = new \App\Models\Members_experiences_Model();
            $experiencesModel->where('members_id', $id)->delete();
            if (!empty($formData['experiences'])) {
                foreach ($formData['experiences'] as $experienceId) {
                    $experiencesModel->insert([
                        'members_id' => $id,
                        'experiences_id' => $experienceId
                    ]);
                }
            }

            // Actualizar servicios
            $servicesModel = new \App\Models\Members_services_Model();
            $servicesModel->where('members_id', $id)->delete();
            if (!empty($formData['services'])) {
                foreach ($formData['services'] as $serviceId) {
                    $servicesModel->insert([
                        'members_id' => $id,
                        'services_id' => $serviceId
                    ]);
                }
            }

            // Actualizar intereses
            $interestsModel = new \App\Models\Members_interests_Model();
            $interestsModel->where('members_id', $id)->delete();
            if (!empty($formData['interests'])) {
                foreach ($formData['interests'] as $interestId) {
                    $interestsModel->insert([
                        'members_id' => $id,
                        'interests_id' => $interestId
                    ]);
                }
            }

            // Actualizar necesidades
            $needsModel = new \App\Models\Members_needs_Model();
            $needsModel->where('members_id', $id)->delete();
            if (!empty($formData['needs'])) {
                foreach ($formData['needs'] as $needId) {
                    $needsModel->insert([
                        'members_id' => $id,
                        'needs_id' => $needId
                    ]);
                }
            }

            // Actualizar etapas de vida
            $lifeStagesModel = new \App\Models\Members_life_stages_Model();
            $lifeStagesModel->where('members_id', $id)->delete();
            if (!empty($formData['life_stages'])) {
                foreach ($formData['life_stages'] as $stageId) {
                    $lifeStagesModel->insert([
                        'members_id' => $id,
                        'life_stage_id' => $stageId
                    ]);
                }
            }

            // Actualizar voluntariado
            $voluntaryModel = new \App\Models\Members_voluntary_Model();
            $voluntaryModel->where('members_id', $id)->delete();
            if ($formData['voluntario'] === 'si' && !empty($formData['voluntary_yes'])) {
                foreach ($formData['voluntary_yes'] as $voluntaryId) {
                    $voluntaryModel->insert([
                        'members_id' => $id,
                        'voluntary_id' => $voluntaryId,
                        'service' => 1
                    ]);
                }
            } elseif ($formData['voluntario'] === 'no' && !empty($formData['voluntary_no'])) {
                foreach ($formData['voluntary_no'] as $voluntaryId) {
                    $voluntaryModel->insert([
                        'members_id' => $id,
                        'voluntary_id' => $voluntaryId,
                        'service' => 0
                    ]);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Error al actualizar los datos');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Datos actualizados correctamente'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error en update: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al actualizar los datos: ' . $e->getMessage()
            ]);
        }
    }
}
