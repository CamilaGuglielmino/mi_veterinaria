<?php

namespace App\Controllers;

use App\Models\MascotasModel;

use App\Models\VinculosModel;
use CodeIgniter\I18n\Time;

class Vinculos extends BaseController{
    public function mostrar(){
        $mascota = new MascotasModel();
        $relacionModel = new VinculosModel();

        $mascotas = $mascota->findAll();

        foreach ($mascotas as &$mascota) {
            // Buscar amos de la mascota
            $amos = $relacionModel->where('mascota_id', $mascota['id'])->findAll();

            $mascota['amos'] = !empty($amos) ? array_column($amos, 'nombre_amo') : ['Sin historial'];
        }

        return view('mascotas/index', ['mascotas' => $mascotas]);
    }

}