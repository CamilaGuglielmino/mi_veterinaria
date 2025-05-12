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
    protected $allowedFields = ['nombre', 'apellido', 'direccion', 'telefono', 'fecha_modifica', 'estado'];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    // Datesprotected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = 'fecha_alta';
    protected $updatedField = '';
    protected $validationRules = [
        'nombre' => 'required|alpha_space|min_length[3]|max_length[50]',
        'apellido' => 'required|alpha_space|min_length[3]|max_length[50]',
        'direccion' => 'required|string|min_length[5]|max_length[100]',
        'telefono' => 'required|regex_match[/^\+?\d{7,15}$/]',
        'fecha_modifica' => 'valid_date[Y-m-d]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre es obligatorio.',
            'alpha_space' => 'El nombre solo puede contener letras y espacios.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
            'max_length' => 'El nombre no puede superar los 50 caracteres.'
        ],
        'apellido' => [
            'required' => 'El apellido es obligatorio.',
            'alpha_space' => 'El apellido solo puede contener letras y espacios.',
            'min_length' => 'El apellido debe tener al menos 3 caracteres.',
            'max_length' => 'El apellido no puede superar los 50 caracteres.'
        ],
        'direccion' => [
            'required' => 'La dirección es obligatoria.',
            'string' => 'La dirección debe ser un texto válido.',
            'min_length' => 'La dirección debe tener al menos 5 caracteres.',
            'max_length' => 'La dirección no puede superar los 100 caracteres.'
        ],
        'telefono' => [
            'required' => 'El teléfono es obligatorio.',
            'regex_match' => 'Formato de teléfono inválido. Debe contener entre 7 y 15 dígitos, con opcional "+".'
        ],
        'fecha_modifica' => [
            'valid_date' => 'El formato de la fecha debe ser YYYY-MM-DD.'
        ]
    ];
    protected $skipValidation = false;
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