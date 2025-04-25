<?php

namespace App\Models;

class Members_interests_Model extends MY_Model {
    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members_interests';
        $this->class_name = 'Members_interests_Model';
        $this->msg_name = 'Asignación Intereses';
        $this->id_name = 'id';
        $this->columnas = array('id', 'members_id', 'interests_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table = 'members_interests';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['members_id', 'interests_id'];

    public function getForeignKey() {
        return 'interests_id';
    }
}
