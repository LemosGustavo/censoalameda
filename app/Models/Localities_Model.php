<?php

namespace App\Models;

class Localities_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'localities';
        $this->class_name = 'Localities_Model';
        $this->msg_name = 'Localidades';
        $this->id_name = 'id';
        $this->columnas = array('id', 'name', 'api_localities_id', 'api_districts_id');
        $this->fields = array();
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table            = 'localities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'api_localities_id', 'api_districts_id'];
}
