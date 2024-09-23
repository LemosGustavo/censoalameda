<?php

namespace App\Models;

class Districts_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'districts';
        $this->class_name = 'Districts_Model';
        $this->msg_name = 'Departamentos';
        $this->id_name = 'id';
        $this->columnas = array('id', 'name', 'api_districts_id', 'api_states_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table            = 'districts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['name', 'api_districts_id', 'api_states_id'];
}
