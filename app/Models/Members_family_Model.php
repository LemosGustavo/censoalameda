<?php

namespace App\Models;

class Members_family_Model extends MY_Model {
    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'members_family';
        $this->class_name = 'Members_family_Model';
        $this->msg_name = 'Asignación Familiares';
        $this->id_name = 'id';
        $this->columnas = array('id', 'members_id', 'interests_id', 'asist_church', 'coexists');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table = 'members_family';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['members_id', 'related_member_id', 'family_id', 'asist_church', 'coexists'];

    public function getForeignKey() {
        return 'family_id';
    }
}
