<?php 
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AmosSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'id'=> '1209052024',
                'nombre' => 'Carlos', 
                'apellido' => 'Pérez',
                'direccion' => 'Calle 123, Ciudad', 
                'telefono' => '1122334455', 
                'fecha_alta' => '2023-01-15',
                'fecha_modifica'=>null,
                'estado'=>1,
            ],
            [
                'id'=> '1208152024',
                'nombre' => 'María', 
                'apellido' => 'González',
                'direccion' => 'Avenida Siempre Viva 742', 
                'telefono' => '2233445566', 
                'fecha_alta' => '2023-02-10',
                'fecha_modifica'=>null,
                'estado'=>1,
            ],
            [
                'id'=> '1705122024',
                'nombre' => 'Juan', 
                'apellido' => 'López',
                'direccion' => 'Av. Libertador 500', 
                'telefono' => '3344556677', 
                'fecha_alta' => '2023-03-05',
                'fecha_modifica'=>null,
                'estado'=>1,
            ],   
            [
                'id'=> '1101052025',
                'nombre' => 'Ana',
                'apellido' => 'Rodríguez',
                'direccion' => 'Calle Mendoza 45', 
                'telefono' => '4455667788', 
                'fecha_alta' => '2023-04-20', 
                'fecha_modifica'=>null,
                'estado'=>1,
            ],
            [
                'id'=> '1102052025',
                'nombre' => 'Pedro', 
                'apellido' => 'Castillo',
                'direccion' => 'Av. Corrientes 300', 
                'telefono' => '5566778899', 
                'fecha_alta' => '2023-05-12',
                'fecha_modifica'=>null,
                'estado'=>1,
            ],
        ];
        $this->db->table('amos')->insertBatch($data);
    }
}