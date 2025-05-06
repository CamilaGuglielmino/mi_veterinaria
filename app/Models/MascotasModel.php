<?php

namespace App\Models;

use CodeIgniter\Model;
class MascotasModel extends Model{
    protected $table      = 'mascotas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre', 'especie', 'raza', 'nro_registro', 'edad', 'fecha_defuncion'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';


    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    
    public function insertar($data)
    {

        $this->db->table('mascotas')->insertBatch($data);

    }
    public function mostrar_mascotas()
    {
        $Noticias = $this->db->table('mascotas');
        return $Noticias->get()->getResultArray();

    }
    
    public function ordenar()
    {
        $noticias = $this->db->table('mascoatas');
        $noticias->orderBy('fecha_publicacion', 'DESC'); // Ordenar por 'fecha_publicacion' en orden descendente
        $query = $noticias->get(); // Obtener los resultados de la consulta
        $noticias = $query->getResultArray(); // Convertir los resultados en un array asociativo

        return $noticias;

    }

}




