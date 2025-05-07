<?php

namespace App\Models;

use CodeIgniter\Model;
class AmosModel extends Model{
    protected $table      = 'amos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'apellido', 'direccion', 'telefono', 'fecha_modifica'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'date';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function insertar($data)
    {

        $this->db->table('amos')->insertBatch($data);

    }
    public function obtenerAmos()
    {
        return $this->findAll();
    }

}


