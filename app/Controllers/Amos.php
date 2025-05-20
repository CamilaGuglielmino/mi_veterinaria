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
        $dateString = date('mdy');
        $numeroAleatorio = mt_rand(1000, 9999);
        $id_amo = "$numeroAleatorio.$dateString";
        $reglas = [
            'nombre' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                    'alpha_space' => 'El nombre solo puede contener letras y espacios.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.',
                    'max_length' => 'El nombre no puede superar los 50 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El apellido es obligatorio.',
                    'alpha_space' => 'El apellido solo puede contener letras y espacios.',
                    'min_length' => 'El apellido debe tener al menos 3 caracteres.',
                    'max_length' => 'El apellido no puede superar los 50 caracteres.'
                ]
            ],
            'direccion' => [
                'rules' => 'required|string|min_length[5]|max_length[100]',
                'errors' => [
                    'required' => 'La dirección es obligatoria.',
                    'string' => 'La dirección debe ser un texto válido.',
                    'min_length' => 'La dirección debe tener al menos 5 caracteres.',
                    'max_length' => 'La dirección no puede superar los 100 caracteres.'
                ]
            ],
            'telefono' => [
                'rules' => 'required|regex_match[/^\+?\d{7,15}$/]',
                'errors' => [
                    'required' => 'El teléfono es obligatorio.',
                    'regex_match' => 'Formato de teléfono inválido. Debe contener entre 7 y 15 dígitos, con opcional "+".'
                ]
            ],
        ];

        if (!$this->validate($reglas)) {
            session()->setFlashdata('abrir_modal_amo', true); // Mantiene abierto el modal de amo
            return redirect()->to(base_url('altas'))
                ->withInput()
                ->with('validation', $this->validator);
        } else {
            $data = [
                'id' => $id_amo,
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
    }
    public function mostrar()
    {
        $amoModel = new AmosModel();
        $relacionModel = new VinculosModel();

        $amos = $amoModel->findAll();

        foreach ($amos as &$amo) {
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
        $reglas = [
            'nombre' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                    'alpha_space' => 'El nombre solo puede contener letras y espacios.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.',
                    'max_length' => 'El nombre no puede superar los 50 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El apellido es obligatorio.',
                    'alpha_space' => 'El apellido solo puede contener letras y espacios.',
                    'min_length' => 'El apellido debe tener al menos 3 caracteres.',
                    'max_length' => 'El apellido no puede superar los 50 caracteres.'
                ]
            ],
            'direccion' => [
                'rules' => 'required|string|min_length[5]|max_length[100]',
                'errors' => [
                    'required' => 'La dirección es obligatoria.',
                    'string' => 'La dirección debe ser un texto válido.',
                    'min_length' => 'La dirección debe tener al menos 5 caracteres.',
                    'max_length' => 'La dirección no puede superar los 100 caracteres.'
                ]
            ],
            'telefono' => [
                'rules' => 'required|regex_match[/^\+?\d{7,15}$/]',
                'errors' => [
                    'required' => 'El teléfono es obligatorio.',
                    'regex_match' => 'Formato de teléfono inválido. Debe contener entre 7 y 15 dígitos, con opcional "+".'
                ]
            ],
        ];
        if (!$this->validate($reglas)) {
            return redirect()->to(base_url('modificarAmo'))
                ->withInput()
                ->with('validation', $this->validator);
        } else {

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
}