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

    public function insertar($data)
    {

        $this->db->table('veterinarios')->insertBatch($data);

    }
    public function obtenerVeterinario()
    {
        return $this->findAll();
    }
    public function obtenerV()
{
    return $this->db->table('veterinarios')->select('*');
}

    public function obtener()
{
    return $this->db->table('veterinarios')
        ->select('*') // Obtiene todos los campos de la tabla veterinarios
        ->get()
        ->getResultArray(); // Devuelve los resultados en formato de array
}

    public function obtenerLista()
    {
        return $this->db->table('veterinarios')
            ->select('id, nombre, apellido, especialidad, telefono, fecha_creacion')
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


