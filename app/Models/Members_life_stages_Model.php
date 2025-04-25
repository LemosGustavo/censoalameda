<?php

namespace App\Models;

class Members_life_stages_Model extends MY_Model {
    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members_life_stages';
        $this->class_name = 'Members_life_stages_Model';
        $this->msg_name = 'Asignación Etapas de Vida';
        $this->id_name = 'id';
        $this->columnas = array('id', 'members_id', 'life_stages_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table = 'members_life_stages';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['members_id', 'life_stages_id'];

    public function getForeignKey() {
        return 'life_stages_id';
    }
}
