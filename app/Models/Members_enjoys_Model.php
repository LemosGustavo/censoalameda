<?php

namespace App\Models;

class Members_enjoys_Model extends MY_Model {
    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members_enjoys';
        $this->class_name = 'Members_enjoys_Model';
        $this->msg_name = 'Asignación gustos';
        $this->id_name = 'id';
        $this->columnas = array('id', 'members_id', 'enjoys_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table = 'members_enjoys';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['members_id', 'enjoys_id'];

    public function getForeignKey() {
        return 'enjoys_id';
    }
}
