<?php

namespace App\Controllers;

use App\Models\MascotasModel;
use CodeIgniter\Events\Events;
use CodeIgniter\I18n\Time;


class Mascotas extends BaseController
{
    public function alta()
    { {
            $fechaActual = Time::now()->format('d/m/Y H:i:s');
            $dateString = date('mdy'); //Generate a datestring.
            $numeroAleatorio = mt_rand(1, 100);
            $nro_registro= $numeroAleatorio.$dateString;
            $data = [
                'id' => rand(100, 999), // 
                'nombre' => $this->request->getPost('nombre'),
                'especie' => $this->request->getPost('especie'),
                'raza' => $this->request->getPost('raza'),
                'nro_registro' => $nro_registro,
                'edad' => $this->request->getPost('edad'),
                'fecha_alta' => $fechaActual,
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
    { /* Código para listar información */
    }
}