<?php

namespace App\Models;

class Gender_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'gender';
        $this->class_name = 'Gender_Model';
        $this->msg_name = 'Sexo';
        $this->id_name = 'id';
        $this->columnas = array('id', 'name');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table            = 'gender';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];
}
