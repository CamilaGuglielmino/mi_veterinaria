<?php

namespace App\Controllers;

use App\Models\MascotasModel;
use CodeIgniter\I18n\Time;


class VinculoVeterinarioMascota extends BaseController
{
    public function alta()
    { {
            $fechaActual = Time::now()->format('d/m/Y H:i:s');
            $dateString = date('mdy'); //Generate a datestring.
            $fecha = Time::now();
            $fechaFormateada = $fecha->toLocalizedString('yyyy-MM-dd');
            $numeroAleatorio = mt_rand(1, 1000);
            $nro_registro= $numeroAleatorio.$dateString;
            $data = [
                'id' => rand(100, 999), // 
                'nombre' => $this->request->getPost('nombre'),
                'especie' => $this->request->getPost('especie'),
                'raza' => $this->request->getPost('raza'),
                'nro_registro' => $nro_registro,
                'edad' => $this->request->getPost('edad'),
                'fecha_alta' => $fechaFormateada,
            ];
            $Mascotas = new MascotasModel();
            $Mascotas->insertar($data);
            $this->session->setFlashdata('success', 'Se creo exitosamente');

            return redirect()->to(base_url('/'));
        }
    }
    public function baja()
    { /* Código para eliminar relaciones */
    }
    public function modificar()
    { /* Código para actualizar registros */
    }
    public function mostrar()
    { 
        $Mascotas = new MascotasModel();
        $datoMascota['dato'] = $Mascotas->mostrar_mascotas();
        $vistas = view('header') . view('altas', $datoMascota) . view('footer');
        return $vistas;
    }
}