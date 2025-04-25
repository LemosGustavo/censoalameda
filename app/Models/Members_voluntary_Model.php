<?php

namespace App\Models;

class Members_voluntary_Model extends MY_Model {
    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members_voluntary';
        $this->class_name = 'Members_voluntary_Model';
        $this->msg_name = 'Asignación Voluntariado';
        $this->id_name = 'id';
        $this->columnas = array('id', 'members_id', 'voluntary_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table = 'members_voluntary';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['members_id', 'voluntary_id'];

    public function getForeignKey() {
        return 'voluntary_id';
    }
}
