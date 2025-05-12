<?php 
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VeterinariosSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'id'=>811223,
                'nombre' => 'Fernando',
                'Apellido' => 'Paez', 
                'especialidad' => 'Cirugía', 
                'telefono' => '6677889900', 
                'fecha_creacion' => '2022-01-01', 
                'fecha_egreso' => null,
                'fecha_modifica'=>null,
            ],
            [
                'id'=>869959,
                'nombre' => 'Sofía', 
                'Apellido' => 'Lopéz', 
                'especialidad' => 'Dermatología', 
                'telefono' => 'Oncología', 
                'fecha_creacion' => '2022-05-10', 
                'fecha_egreso' => null,
                'fecha_modifica'=>null,
            ],
            [
                'id'=>862300,
                'nombre' => 'Javier', 
                'Apellido' => 'Sosa', 
                'especialidad' => 'Cardiología', 
                'telefono' => '8899001122', 
                'fecha_creacion' => '2022-07-15', 
                'fecha_egreso' => null,
                'fecha_modifica'=>null,
            ],
            [
                'id'=>862369,
                'nombre' => 'Dra. Camila', 
                'Apellido' => 'Gómez', 
                'especialidad' => 'Fisioterapia', 
                'telefono' => '9900112233', 
                'fecha_creacion' => '2022-10-01', 
                'fecha_egreso' => null,
                'fecha_modifica'=>null,
            ],
            [
                'id'=>862359,
                'nombre' => 'Roberto', 
                'Apellido' => 'Lucero', 
                'especialidad' => 'Traumatología veterinaria', 
                'telefono' => '0011223344', 
                'fecha_creacion' => '2023-02-20', 
                'fecha_egreso' => null,
                'fecha_modifica'=>null,
            ],
        ];
        $this->db->table('veterinarios')->insertBatch($data);
    }
}