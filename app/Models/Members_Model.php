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
        $this->columnas = array('id', 'name', 'lastname', 'birthdate', 'age', 'gender_id', 'civil_state_id', 'path_photo', 'job_id', 'localities_id', 'contact_id', 'gronwup_id', 'interestarea_id', 'needs_id', 'boss_family');
        $this->fields = array(
            'name' => array('label' => 'Nombre', 'placeholder' => 'Ingresar Nombre', 'maxlength' => '50', 'required' => TRUE),
            'lastname' => array('label' => 'Apellido', 'placeholder' => 'Ingresar Apellido', 'maxlength' => '50', 'required' => TRUE),
            'birthdate' => array('label' => 'Fecha de Nacimiento', 'type' => 'date', 'placeholder' => 'Ingresar Fecha de Nacimiento', 'datetimepicker' => '', 'required' => TRUE),
            'path_photo' => array('label' => 'Foto', 'type' => 'file', 'placeholder' => 'Ingresar Foto', 'required' => FALSE),
            'boss_family' => array('label' => 'Jefe de Familia', 'type' => 'checkbox', 'placeholder' => 'Jefe de Familia', 'required' => TRUE),
            'gender' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'gender_id', 'required' => TRUE,),
            'civil_state' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'civil_state_id', 'required' => TRUE,),
            'job' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'job_id', 'required' => TRUE,),
            'localities' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'localities_id', 'required' => TRUE,),
            'contact' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'contact_id', 'required' => TRUE,),
            'gronwup' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'gronwup_id', 'required' => TRUE,),
            'interestarea' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'interestarea_id', 'required' => TRUE,),
            'needs' => array('label' => 'Género','input_type' => 'combo', 'id_name' => 'needs_id', 'required' => TRUE,),
            
        );
        $this->requeridos = array();
        $this->default_join = array(
            array('gender', 'gender.id = members.gender_id', '', array('gender.name as gender')),
            array('civil_state', 'civil_state.id = members.civil_state_id', '', array('civil_state.name as civil_state')),
            array('localities', 'localities.id = members.localities_id', '', array('localities.name as localities')),
        );
    }

    protected $table            = 'members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'lastname', 'birthdate', 'age', 'gender_id', 'civil_state_id', 'path_photo', 'job_id', 'localities_id', 'contact_id', 'gronwup_id', 'interestarea_id', 'needs_id', 'boss_family'];
}
