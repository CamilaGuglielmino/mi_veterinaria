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

    public function mostrar()
    {
        $amoModel = new AmosModel();
        $relacionModel = new VinculosModel();

        $amos = $amoModel->findAll();

        foreach ($amos as &$amo) {
            // Buscar todas las mascotas asociadas a este amo
            $mascotas = $relacionModel->where('amo_id', $amo['id'])->findAll();
            $amo['mascotas'] = !empty($mascotas) ? array_column($mascotas, 'nombre_mascota') : [];
        }

        return view('listadoAmos', ['amos' => $amos]);

    }
    public function obtenerAmos()
    {
        $amoModel = new AmosModel();
        // Definir la variable
        $amos = [];
        // Obtener la lista de veterinarios para el select
        $listaAmos = $amoModel->obtenerListaAmos();

        return view('header') .
            view('/mostrar/listadoAmos', ['listaAmos' => $listaAmos, 'amos' => $amos]) .
            view('footer');
    }
    public function modificar()
    {
        $amoModel = new AmosModel();
        $listaAmos = $amoModel->obtenerListaAmos();

        $amoId = $this->request->getPost('amo_id');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $telefono = $this->request->getPost('telefono');
        $direccion = $this->request->getPost('direccion');
        $fecha = Time::now()->toLocalizedString('yyyy-MM-dd');


        if (!empty($amoId)) {
            // Actualizar datos del amo
            $resultado = $amoModel->set([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'fecha_modifica' => $fecha

            ])
                ->where('id', $amoId)
                ->update();

            // Verificar si se actualizó correctamente
            if ($resultado) {
                $mensaje = "Datos del amo actualizados correctamente.";
            } else {
                $mensaje = "Error: No se pudo modificar la información.";
            }
        } else {
            $mensaje = "Error: No se recibió un ID válido.";
        }

        return view('header') .
            view('modificaciones/modificarAmo', ['mensaje' => $mensaje, 'listaAmos' => $listaAmos]) .
            view('footer');
    }
}