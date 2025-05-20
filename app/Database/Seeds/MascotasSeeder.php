<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MascotasSeeder extends Seeder {
    public function run() {
        $data = [
            [ 
                'nro_registro' => '22051025', 
                'nombre' => 'Firulais', 
                'especie' => 'Perro', 
                'raza' => 'Labrador', 
                'estado'=>1,
                'edad' => 3, 
                'fecha_alta' => '2023-06-01', 
                'fecha_defuncion' => '',
                'fecha_fin'=>'', 
                'fecha_modifica'=> '',
                'amo'=>'',
                'id_amo'=>''
            ],
            [
                'nro_registro' => '56051025', 
                'nombre' => 'Michi', 
                'especie' => 'Gato', 
                'raza' => 'Siames', 
                'estado'=>1,
                'edad' => 2, 
                'fecha_alta' => '2023-06-10', 
                 'fecha_defuncion' => '',
                'fecha_fin'=>'', 
                'fecha_modifica'=> '',
                'amo'=>'',
                'id_amo'=>''
            ],
            [
                'nro_registro' => '84041125', 
                'nombre' => 'Nemo', 
                'especie' => 'Pez', 
                'raza' => 'Payaso', 
                'estado'=>1,
                'edad' => 1, 
                'fecha_alta' => '2023-07-01', 
                 'fecha_defuncion' => '',
                'fecha_fin'=>'', 
                'fecha_modifica'=> '',
                'amo'=>'',
                'id_amo'=>''
            ],
            [
                'nro_registro' => '77040225', 
                'nombre' => 'Rocky', 
                'especie' => 'Perro', 
                'raza' => 'Pitbull',  
                'estado'=>1,
                'edad' => 5, 
                'fecha_alta' => '2023-07-15', 
                'fecha_defuncion' => '',
                'fecha_fin'=>'', 
                'fecha_modifica'=> '',
                'amo'=>'',
                'id_amo'=>''
            ],
            [
                'nro_registro' => '33042925', 
                'nombre' => 'Luna', 
                'especie' => 'Gato', 
                'raza' => 'Persa', 
                'estado'=>1,
                'edad' => 4, 
                'fecha_alta' => '2023-08-05', 
                'fecha_defuncion' => '',
                'fecha_fin'=>'', 
                'fecha_modifica'=> '',
                'amo'=>'',
                'id_amo'=>''
            ],
        ];
        $this->db->table('mascotas')->insertBatch($data);
    }
}