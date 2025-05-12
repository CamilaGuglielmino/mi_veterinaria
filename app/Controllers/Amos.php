<?php
namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\VinculosModel;
use CodeIgniter\I18n\Time;

class Amos extends BaseController
{
    public function alta()
    { {
            $fechaActual = Time::now()->format('d/m/Y H:i:s');

            $data = [
                'id' => rand(100, 999), // 
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'fecha_alta' => $fechaActual,
            ];
            $Amo = new AmosModel();
            $Amo->insertar($data);

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
    {   $amoModel = new AmosModel();
        $relacionModel = new VinculosModel();

        $amos = $amoModel->findAll();

        foreach ($amos as &$amo) {
            // Buscar todas las mascotas asociadas a este amo
            $mascotas = $relacionModel->where('amo_id', $amo['id'])->findAll();
            $amo['mascotas'] = !empty($mascotas) ? array_column($mascotas, 'nombre_mascota') : [];
        }

        return view('listadoAmos', ['amos' => $amos]);

    }
}