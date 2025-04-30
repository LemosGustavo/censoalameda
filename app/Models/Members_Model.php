<?php

namespace App\Models;

class Members_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members';
        $this->class_name = 'Members_Model';
        $this->msg_name = 'Miembro';
        $this->id_name = 'id';
        $this->columnas = array('id', 'name', 'lastname', 'dni_document', 'address', 'email', 'phone', 'birthdate', 'gender_id', 'civil_state_id', 'path_photo', 'name_profession', 'artistic_skills', 'country_id', 'state_id', 'district_id', 'localities_id', 'boss_family', 'quantity_sons', 'celebracion', 'name_guia', 'name_group', 'grupo', 'participate_gp');
        $this->fields = array(
            'name' => array('label' => 'Nombre', 'placeholder' => 'Nombre', 'maxlength' => '50', 'required' => TRUE),
            'lastname' => array('label' => 'Apellido', 'placeholder' => 'Apellido', 'maxlength' => '50', 'required' => TRUE),
            'dni_document' => array('label' => 'DNI', 'placeholder' => 'DNI', 'type' => 'number', 'maxlength' => '9', 'required' => TRUE),
            'address' => array('label' => 'Dirección', 'placeholder' => 'Dirección', 'maxlength' => '500', 'required' => TRUE),
            'birthdate' => array('label' => 'Fecha de Nacimiento', 'type' => 'datecustom', 'placeholder' => 'Fecha de Nacimiento', 'required' => TRUE),
            'gender_drop' => array('label' => 'Sexo', 'input_type' => 'combo', 'id_name' => 'gender_id', 'required' => TRUE,),
            'civil_state_drop' => array('label' => 'Estado Civil', 'input_type' => 'combo', 'id_name' => 'civil_state_id', 'required' => TRUE,),

        );
        $this->requeridos = array();
        $this->default_join = array(
            array('gender', 'gender.id = members.gender_id', '', array('gender.name as gender_drop')),
            array('civil_state', 'civil_state.id = members.civil_state_id', '', array('civil_state.name as civil_state_drop')),
            // array('localities', 'localities.id = members.localities_id', '', array('localities.name as localities')),
        );
    }

    protected $table            = 'members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'lastname', 'dni_document', 'address', 'email', 'phone', 'birthdate', 'gender_id', 'civil_state_id', 'path_photo', 'name_profession', 'artistic_skills', 'country_id', 'state_id', 'district_id', 'localities_id', 'boss_family', 'quantity_sons', 'celebracion', 'name_guia', 'name_group', 'grupo', 'participate_gp'];
}
