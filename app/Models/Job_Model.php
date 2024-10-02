<?php

namespace App\Models;

class Job_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'job';
        $this->class_name = 'Job_Model';
        $this->msg_name = 'Profesión';
        $this->id_name = 'id';
        $this->columnas = array('id', 'name_profession', 'artistic_skills');
        $this->fields = array(
            // 'name_profession' => array('label' => '¿A qué te dedicas?', 'placeholder' => 'Profesión/Oficio/Labor'),
            // 'artistic_skills' => array('label' => '¿Habilidades Artísticas?', 'type' => 'text', 'placeholder' => 'Habilidades artísticas', 'maxlength' => '150'),
        );
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table            = 'job';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name_profession', 'artistic_skills'];
}
