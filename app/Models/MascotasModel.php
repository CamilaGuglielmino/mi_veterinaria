<?php

namespace App\Models;

use CodeIgniter\Model;
class MascotasModel extends Model
{
    protected $table = 'mascotas';
    protected $primaryKey = 'nro_registro';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'especie', 'raza', 'estado', 'edad', 'fecha_defuncion', 'fecha_fin', 'fecha_modifica', 'amo', 'id_amo'];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = 'fecha_alta';
    protected $updatedField = '';
    protected $skipValidation = false;
    protected $cleanValidationRules = true;


    public function insertar($data)
    {

        $this->db->table('mascotas')->insertBatch($data);

    }

    public function mostrar_mascotas()
    {
        $Mascotas = $this->db->table('mascotas');
        return $Mascotas->get()->getResultArray();

    }
    public function obtenerMascotas()
    {
        return $this->findAll();
    }

    public function ordenar()
    {
        $noticias = $this->db->table('mascoatas');
        $noticias->orderBy('fecha_publicacion', 'DESC'); // Ordenar por 'fecha_publicacion' en orden descendente
        $query = $noticias->get(); // Obtener los resultados de la consulta
        $noticias = $query->getResultArray(); // Convertir los resultados en un array asociativo

        return $noticias;

    }

    public function obtenerMascotasConDueños()
    {
        return $this->db->table('mascotas')
            ->select('mascotas.*, GROUP_CONCAT(amos.nombre SEPARATOR ", ") AS amos')
            ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.mascota_id', 'left')
            ->join('amos', 'amo_mascota.amo_id = amos.id', 'left')
            ->groupBy('mascotas.nro_registro');
    }
    public function obtenerMascotasConDueñosMotvio()
    {
        return $this->db->table('mascotas')
            ->select('mascotas.*, 
                  GROUP_CONCAT(amos.nombre SEPARATOR ", ") AS amos,
                  amo_mascota.motivo,
                  amo_mascota.fecha_fin AS fecha_fin_amo,
                  mascotas.fecha_defuncion,
                  mascotas.fecha_fin AS fecha_fin_mascota')
            ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.mascota_id', 'left')
            ->join('amos', 'amo_mascota.amo_id = amos.id', 'left')
            ->groupBy('mascotas.nro_registro');
    }
    public function obtenerListaMascotas()
    {
        return $this->db->table('mascotas')
            ->select('nro_registro, nombre, especie, raza, edad')
            ->where('estado !=', 2) // Filtra las mascotas activas
            ->where('amo !=', 2) // Filtra solo las mascotas que tienen amo
            ->get()
            ->getResultArray();
    }
    public function obtenerListaMascotasConDueños()
    {
        return $this->db->table('mascotas')
            ->select('mascotas.nro_registro, mascotas.nombre, GROUP_CONCAT(amos.nombre SEPARATOR ", ") AS amos, amo_mascota.id_vinculo, amo_mascota.fecha_inicio')
            ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.mascota_id', 'inner')
            ->join('amos', 'amo_mascota.amo_id = amos.id', 'inner')
            ->where('mascotas.estado !=', 2) // Excluir mascotas dadas de baja
            ->groupBy('mascotas.nro_registro, amo_mascota.id_vinculo')
            ->get()
            ->getResultArray();
    }
    public function obtenerListaMascotasTodo()
    {
        return $this->db->table('mascotas')
            ->select('nro_registro, nombre, especie, raza, edad')

            ->get()
            ->getResultArray();
    }
   public function obtenerMascotasConAmo()
{
    return $this->db->table('mascotas')
        ->select('mascotas.*, amos.nombre AS amo_nombre, amos.apellido AS amo_apellido, GROUP_CONCAT(CONCAT(amo_hist.nombre, " ", amo_hist.apellido) SEPARATOR ", ") AS historial_amos')
        ->join('amos', 'mascotas.id_amo = amos.id', 'left') // Amo actual
        ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.mascota_id', 'left') // Historial de amos
        ->join('amos AS amo_hist', 'amo_mascota.amo_id = amo_hist.id', 'left') // Traer nombres y apellidos de los amos históricos
        ->groupBy('mascotas.nro_registro'); // Agrupar por mascota para concatenar los amos anteriores
}









}




