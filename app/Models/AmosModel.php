<?php
namespace App\Models;
use CodeIgniter\Model;
class AmosModel extends Model
{
    protected $table = 'amos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nombre', 'apellido', 'direccion', 'telefono', 'fecha_modifica', 'estado', 'mascota_actual'];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    // Datesprotected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = 'fecha_alta';
    protected $updatedField = '';
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    public function insertar($data)
    {
        $this->db->table('amos')->insertBatch($data);
    }
    public function obtenerAmos()
    {
        $Amos = $this->db->table('amos');
        return $Amos->get()->getResultArray();
    }
    public function obtenertodo()
    {
        return $this->findAll();
    }
  public function obtenerAmo()
{
    return $this->db->table('amos')
        ->select('amos.*, 
                  GROUP_CONCAT(DISTINCT mascotas.nombre ORDER BY amo_mascota.fecha_inicio SEPARATOR ", ") AS historial_mascotas,
                  GROUP_CONCAT(DISTINCT amo_mascota.fecha_inicio ORDER BY amo_mascota.fecha_inicio SEPARATOR ", ") AS historial_fecha_inicio,
                  GROUP_CONCAT(DISTINCT amo_mascota.fecha_fin ORDER BY amo_mascota.fecha_inicio SEPARATOR ", ") AS historial_fecha_baja,
                  GROUP_CONCAT(DISTINCT amo_mascota.motivo ORDER BY amo_mascota.fecha_inicio SEPARATOR ", ") AS historial_motivo,
                  mascota_actual.nombre AS nombre_mascota_actual')
        ->join('amo_mascota', 'amos.id = amo_mascota.amo_id', 'left')
        ->join('mascotas', 'amo_mascota.mascota_id = mascotas.nro_registro', 'left')
        ->join('mascotas AS mascota_actual', 'amos.mascota_actual = mascota_actual.nro_registro', 'left')
        ->groupBy('amos.id');
}

    public function obtenerListaAmos()
    {
        return $this->db->table('amos')
            ->select('id, nombre, apellido, direccion, telefono, mascota_actual')
            ->get()
            ->getResultArray();
    }



}