<?php

namespace App\Models;

class States_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'states';
        $this->class_name = 'States_Model';
        $this->msg_name = 'Provincia';
        $this->id_name = 'id';
        $this->columnas = array('id', 'name', 'api_states_id', 'countries_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table            = 'states';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'api_states_id', 'countries_id'];
}
