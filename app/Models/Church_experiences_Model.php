<?php

namespace App\Models;

class Church_experiences_Model extends MY_Model {

    protected $table            = 'church_experiences';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [];

}
