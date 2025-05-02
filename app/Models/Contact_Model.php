<?php

namespace App\Models;

class Contact_Model extends MY_Model {

    public function __construct($db = null) {
        parent::__construct();
        (!empty($db)) ? ($this->db = \Config\Database::connect($db, true)) : '';
        $this->table_name = 'contact';
        $this->class_name = 'Contact_Model';
        $this->msg_name = 'Contacto';
        $this->id_name = 'id';
        $this->columnas = array('id', 'email','phone');
        $this->fields = array(
            'email' => array('label' => 'Email', 'type' => 'email', 'placeholder' => 'contacto@alameda.ar', 'maxlength' => '50'),
            'phone' => array('label' => 'Teléfono', 'type' => 'text', 'placeholder' => '[cod.área]+[nro]. Ej: (2613123123)', 'maxlength' => '50', 'required' => TRUE),
        );
        $this->requeridos = array();
        $this->default_join = array();
    }

    protected $table            = 'contact';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email','phone'];
}
