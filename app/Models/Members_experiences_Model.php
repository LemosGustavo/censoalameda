<?php

namespace App\Models;

class Members_experiences_Model extends MY_Model {
    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members_experiences';
        $this->class_name = 'Members_experiences_Model';
        $this->msg_name = 'Asignación Experiencias';
        $this->id_name = 'id';
        $this->columnas = array('id', 'members_id', 'experiences_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table = 'members_experiences';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['members_id', 'experiences_id'];

    public function getForeignKey() {
        return 'experiences_id';
    }
}
