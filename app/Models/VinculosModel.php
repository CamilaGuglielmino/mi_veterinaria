<?php
namespace App\Models;
use CodeIgniter\Model;
class VinculosModel extends Model
{
    protected $table = 'amo_mascota';
    protected $primaryKey = 'id_vinculo';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['amo_id', 'mascotas_id', 'fecha_inicio', 'fecha_fin', 'motivo', 'estado'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime'; // Cambiado a un formato válido
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    protected $validationRules = [
        'amo_id' => 'required|integer|greater_than[0]',
        'mascotas_id' => 'required|integer|greater_than[0]',
        'fecha_inicio' => 'required|valid_date[Y-m-d H:i:s]',
        'fecha_fin' => 'permit_empty|valid_date[Y-m-d H:i:s]|greater_than_equal_to[fecha_inicio]',
        'motivo' => 'permit_empty|string|max_length[255]',
        'estado' => 'required|in_list[activo,inactivo,finalizado]'
    ];

    protected $validationMessages = [
        'amo_id' => [
            'required' => 'El ID del amo es obligatorio.',
            'integer' => 'Debe ser un número entero.',
            'greater_than' => 'Debe ser mayor que 0.'
        ],
        'mascotas_id' => [
            'required' => 'El ID de la mascota es obligatorio.',
            'integer' => 'Debe ser un número entero.',
            'greater_than' => 'Debe ser mayor que 0.'
        ],
        'fecha_inicio' => [
            'required' => 'La fecha de inicio es obligatoria.',
            'valid_date' => 'El formato debe ser YYYY-MM-DD HH:MM:SS.'
        ],
        'fecha_fin' => [
            'valid_date' => 'El formato debe ser YYYY-MM-DD HH:MM:SS.',
            'greater_than_equal_to' => 'La fecha de fin no puede ser anterior a la fecha de inicio.'
        ],
        'motivo' => [
            'string' => 'El motivo debe ser un texto válido.',
            'max_length' => 'El motivo no puede superar los 255 caracteres.'
        ],
        'estado' => [
            'required' => 'El estado es obligatorio.',
            'in_list' => 'Debe ser uno de los siguientes valores: activo, inactivo, finalizado.'
        ]
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Método para insertar datos en la tabla vínculos
    public function insertar($data)
    {
        return $this->db->table($this->table)->insertBatch($data);
    }

    // Método para obtener información completa de vínculos, mascotas y amos

    public function obtenerVinculos()
    {

    }
}