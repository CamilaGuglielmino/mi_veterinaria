<?php

namespace App\Models;

use CodeIgniter\Model;
class VeterinariosModel extends Model
{
    protected $table = 'veterinarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'apellido', 'especialidad', 'telefono','fecha_creacion', 'fecha_egreso', 'fecha_modifica', 'estado'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    /* Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = 'fecha_alta';
    protected $updatedField = '';
*/

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function insertar($data)
    {

        $this->db->table('veterinarios')->insertBatch($data);

    }
    public function obtenerVeterinario()
    {
        return $this->findAll();
    }
    public function obtener()
    {
        return $this->db->table('veterinarios')
            ->select('veterinarios.*, GROUP_CONCAT(mascotas.nombre SEPARATOR ", ") AS mascotas_atendidas')
            ->join('vinculo', 'veterinarios.id = vinculo.veterinario_id', 'left')
            ->join('mascotas', 'vinculo.mascota_id = mascotas.nro_registro', 'left')
            ->groupBy('veterinarios.id');
    }

    public function obtenerLista()
    {
        return $this->db->table('veterinarios')
            ->select('id, nombre, apellido, especialidad, telefono')
            ->where('estado !=', 2) // Filtra los veterinarios activos
            ->get()
            ->getResultArray();
    }
    public function obtenerListaTodo()
    {
        return $this->db->table('veterinarios')
            ->select('id, nombre, apellido, especialidad, telefono')
            ->get()
            ->getResultArray();
    }
}


