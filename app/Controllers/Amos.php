<?php
namespace App\Controllers;

use App\Models\AmosModel;

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
            $$Amo->insertar($data);
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