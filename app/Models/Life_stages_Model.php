<?php

namespace App\Models;

class Life_stages_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'life_stages';
        $this->class_name = 'Life_stages_Model';
        $this->msg_name = 'Etapa de vida';
        $this->id_name = 'id';
        $this->columnas = array('id', 'name', 'slug');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table            = 'life_stages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'slug'];
}
