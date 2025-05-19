<?php
namespace App\Models;
use CodeIgniter\Model;
class VinculosModel extends Model
{
    protected $table = 'amo_mascota';
    protected $primaryKey = 'id_vinculo';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['amo_id', 'mascota_id', 'fecha_inicio', 'fecha_defuncion','fecha_fin', 'motivo', 'estado'];
    protected $useTimestamps = false;
    protected $dateFormat = 'date'; // Cambiado a un formato válido
    protected $createdField = '';
    protected $updatedField = '';
   
    public function insertar($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

   
}