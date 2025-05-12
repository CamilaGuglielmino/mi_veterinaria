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

    protected $allowedFields = ['nombre', 'especie', 'raza', 'estado', 'edad', 'fecha_defuncion', 'fecha_modifica'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = 'fecha_alta';
    protected $updatedField = '';


    // Validation
    protected $validationRules = [
        'nombre' => 'required|alpha_space|min_length[3]|max_length[50]',
        'especie' => 'required|alpha|min_length[3]|max_length[30]',
        'raza' => 'permit_empty|alpha_space|max_length[50]',
        'nro_registro' => 'required|numeric|min_length[5]|max_length[15]',
        'edad' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[30]',
        'fecha_defuncion' => 'permit_empty|valid_date[Y-m-d]',
        'fecha_modifica' => 'valid_date[Y-m-d]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre de la mascota es obligatorio.',
            'alpha_space' => 'El nombre solo puede contener letras y espacios.',
            'min_length' => 'Debe tener al menos 3 caracteres.',
            'max_length' => 'No puede superar los 50 caracteres.'
        ],
        'especie' => [
            'required' => 'La especie es obligatoria.',
            'alpha' => 'La especie solo puede contener letras.',
            'min_length' => 'Debe tener al menos 3 caracteres.',
            'max_length' => 'No puede superar los 30 caracteres.'
        ],
        'raza' => [
            'alpha_space' => 'La raza solo puede contener letras y espacios.',
            'max_length' => 'No puede superar los 50 caracteres.'
        ],
        'nro_registro' => [
            'required' => 'El número de registro es obligatorio.',
            'numeric' => 'Debe ser un valor numérico.',
            'min_length' => 'Debe tener al menos 5 dígitos.',
            'max_length' => 'No puede superar los 15 dígitos.'
        ],
        'edad' => [
            'required' => 'La edad es obligatoria.',
            'integer' => 'Debe ser un número entero.',
            'greater_than_equal_to' => 'La edad no puede ser negativa.',
            'less_than_equal_to' => 'La edad no puede superar los 30 años.'
        ],
        'fecha_defuncion' => [
            'valid_date' => 'El formato de la fecha de defunción debe ser YYYY-MM-DD.'
        ],
        'fecha_modifica' => [
            'valid_date' => 'El formato de la fecha de modificación debe ser YYYY-MM-DD.'
        ]
    ];
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
}




