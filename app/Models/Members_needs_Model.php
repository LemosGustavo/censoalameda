<?php

namespace App\Models;

class Members_needs_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members_needs';
        $this->class_name = 'Members_needs_Model';
        $this->msg_name = 'Asignación Necesidades';
        $this->id_name = 'id';
        $this->columnas = array('id', 'members_id', 'needs_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table = 'members_needs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['members_id', 'needs_id'];

    public function getForeignKey() {
        return 'needs_id';
    }
}
