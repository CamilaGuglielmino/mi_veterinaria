<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VinculosSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'id_vinculo'=>784525,
                'amo_id' => 1101052025, 
                'mascota_id' => 33042925, 
                'fecha_inicio' => '2023-06-01', 
                'fecha_fin' => null, 
                'motivo' => null,
                'estado' => 1,

            ],
            [
                'id_vinculo'=>784520,
                'amo_id' => 1705122024, 
                'mascota_id' => 56051025, 
                'fecha_inicio' => '2023-06-10', 
                'fecha_fin' => null, 
                'motivo' => null,
                'estado' => 1,

            ],
            [
                'id_vinculo'=>784530,
                'amo_id' => 1209052024, 
                'mascota_id' => 84041125, 
                'fecha_inicio' => '2023-07-01', 
                'fecha_fin' => null, 
                'motivo' => null,
                'estado' => 1,

            ],
            [
                'id_vinculo'=>784540,
                'amo_id' => 1208152024, 
                'mascota_id' => 33042925, 
                'fecha_inicio' => '2023-07-15', 
                'fecha_fin' => null, 
                'motivo' => null,
                'estado' => 1,

            ],
            [
                'id_vinculo'=>784560,
                'amo_id' => 1209052024, 
                'mascota_id' => 56051025, 
                'fecha_inicio' => '2023-08-05', 
                'fecha_fin' => null, 
                'motivo' => null,
                'estado' => 1,

            ],
        ];
        $this->db->table('amo_mascota')->insertBatch($data);
    }
}
