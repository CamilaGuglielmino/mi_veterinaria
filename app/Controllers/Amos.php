<?php
namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\VinculosModel;
use CodeIgniter\I18n\Time;

class Amos extends BaseController
{
    public function alta()
    {
        $fechaActual = Time::now()->format('d/m/Y H:i:s');

        $reglas = [
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo apellido es obligatorio.',
                    'min_length' => 'El apellido debe tener al menos 3 caracteres.'
                ]
            ],
            'direccion' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'El campo dirección es obligatorio.',
                    'min_length' => 'La dirección debe tener al menos 4 caracteres.'
                ]
            ],
            'telefono' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'El campo teléfono es obligatorio.',
                    'min_length' => 'El teléfono debe tener al menos 10 caracteres.'
                ]
            ],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->to(base_url('altas')) // Esta es tu vista con el modal incluido
                ->withInput()
                ->with('validation', $this->validator)
                ->with('abrir_modal', 'amoModal');
        }


        $data = [
            'id' => rand(100, 999),
            'nombre' => ucfirst(trim($this->request->getPost('nombre'))),
            'apellido' => ucfirst(trim($this->request->getPost('apellido'))),
            'direccion' => ucfirst(trim($this->request->getPost('direccion'))),
            'telefono' => $this->request->getPost('telefono'),
            'fecha_alta' => $fechaActual,
        ];

        $Amo = new AmosModel();
        $Amo->insertar($data);

        return redirect()->to(base_url('altas'))->with('mensaje', 'Amo registrado exitosamente.');
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
        // Enviar datos con Flashdata antes de redirigir
        session()->setFlashdata('mensaje', $mensaje);
        session()->setFlashdata('listaAmos', $listaAmos);

        return redirect()->to(base_url('/modificarAmo'));

    }
}