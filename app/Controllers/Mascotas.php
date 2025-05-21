<?php

namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModel;
use App\Models\VinculosModel;
use CodeIgniter\I18n\Time;


class Mascotas extends BaseController
{
    public function vistas()
    {
        $vistas = view('header') . view('inicio', ) . view('footer');
        return $vistas;

    }
    public function alta()
    {
        $Amo = new AmosModel();
        $Mascotas = new MascotasModel();
        $datoAmo = $Amo->obtenerAmos();
        $datoMascota = $Mascotas->mostrar_mascotas();
        $fecha = Time::now()->toLocalizedString('yyyy-MM-dd');

        // Generación única de número de registro
        do {
            $dateString = date('y'); // Año en dos dígitos
            $numeroAleatorio = mt_rand(1000, 9999); // Número aleatorio de 4 dígitos
            $nro_registro = $numeroAleatorio . $dateString;
        } while ($Mascotas->where('nro_registro', $nro_registro)->countAllResults() > 0); // Asegurar que no se repita

        // Validaciones
        $reglas = [
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.'
                ]
            ],
            'raza' => [
                'rules' => 'required|regex_match[/^[a-zA-Z\s]+$/]|min_length[3]',
                'errors' => [
                    'required' => 'El campo raza es obligatorio.',
                    'regex_match' => 'La raza solo puede contener letras y espacios.',
                    'min_length' => 'La raza debe tener al menos 3 caracteres.'
                ]
            ],
            'edad' => [
                'rules' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[20]',
                'errors' => [
                    'required' => 'El campo edad es obligatorio.',
                    'integer' => 'La edad debe ser un número entero.',
                    'greater_than_equal_to' => 'La edad debe ser mayor o igual a 0.',
                    'less_than_equal_to' => 'La edad debe ser menor o igual a 20.'
                ]
            ],

        ];

        if (!$this->validate($reglas)) {
            session()->setFlashdata('abrir_modal', true);
            return redirect()->to(base_url('altas'))
                ->withInput()
                ->with('validation', $this->validator);
        } else {
            $data = [
                'nro_registro' => $nro_registro,
                'nombre' => $this->request->getPost('nombre'),
                'especie' => $this->request->getPost('especie'),
                'raza' => $this->request->getPost('raza'),
                'edad' => (int) $this->request->getPost('edad'),
                'fecha_alta' => $fecha,
                'estado' => 1,
                'amo' => 1, // 1 = No tiene amo, 2 = Tiene amo
            ];

            if ($Mascotas->insert($data)) {
                $mensaje = "Mascota registrada exitosamente.";
            } else {
                $mensaje = "Error: No se pudo registrar la mascota.";
            }

            session()->setFlashdata('mensaje', $mensaje);
            session()->setFlashdata('datoMascota', $datoMascota);
            session()->setFlashdata('datoAmo', $datoAmo);

            return redirect()->to(base_url('/altas'));
        }
    }
    public function mostrar()
    {
        $Amo = new AmosModel();
        $amos['dato'] = $Amo->obtenerAmos();
        $Mascotas = new MascotasModel();
        $datoMascota['dato'] = $Mascotas->mostrar_mascotas();
        $vistas = view('header') . view('/mostrar/listadoAmos', ['amos' => $amos]) . view('footer');
        return $vistas;
    }
    public function cargarBajaMascotas()
    {
        $mascotaModel = new MascotasModel();
        $listaMascotas = $mascotaModel->obtenerListaMascotasConDueños();


        return view('header') .
            view('bajas/bajaVinculos', ['listaMascotas' => $listaMascotas]) .
            view('footer');
    }
    public function obtenerMascotas()
    {
        $mascotasModel = new MascotasModel();
        $mascotas = [];
        $listaMascotas = $mascotasModel->obtenerListaMascotasTodo();

        return view('header') .
            view('/mostrar/listadoMascotas', ['listaMascotas' => $listaMascotas, 'mascotas' => $mascotas]) .
            view('footer');
    }
    public function vistaModificar()
    {
        $mascotasModel = new MascotasModel();
        $listaMascostas = $mascotasModel->obtenerListaMascotas();
        $vistas = view('header') .
            view('modificaciones/modificarMascota', ['listaMascostas' => $listaMascostas]) .
            view('footer');
        return $vistas;
    }
    public function modificar()
    {
        $mascotasModel = new MascotasModel();
        $listaMascostas = $mascotasModel->obtenerListaMascotas();

        $mascotaId = $this->request->getPost('mascota_id');
        $nombre = $this->request->getPost('nombre');
        $especie = $this->request->getPost('especie');
        $raza = $this->request->getPost('raza');
        $edad = $this->request->getPost('edad');
        $fecha = Time::now()->toLocalizedString('yyyy-MM-dd');
        $reglas = [
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.'
                ]
            ],
            'raza' => [
                'rules' => 'required|alpha|min_length[3]',
                'errors' => [
                    'required' => 'El campo raza es obligatorio.',
                    'alpha' => 'La raza solo puede contener letras.',
                    'min_length' => 'La raza debe tener al menos 3 caracteres.'
                ]
            ],
            'edad' => [
                'rules' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[20]',
                'errors' => [
                    'required' => 'El campo edad es obligatorio.',
                    'integer' => 'La edad debe ser un número entero.',
                    'greater_than_equal_to' => 'La edad debe ser mayor o igual a 0.',
                    'less_than_equal_to' => 'La edad debe ser menor o igual a 20.'
                ]
            ],

        ];
        if (!$this->validate($reglas)) {
            return redirect()->to(base_url('modificarMascota'))
                ->withInput()
                ->with('validation', $this->validator);
        } else {

            if (!empty($mascotaId)) {

                $resultado = $mascotasModel->set([
                    'nombre' => $nombre,
                    'especie' => $especie,
                    'raza' => $raza,
                    'edad' => $edad,
                    'fecha_modifica' => $fecha
                ])
                    ->where('nro_registro', $mascotaId)
                    ->update();

                if ($resultado) {
                    $mensaje = "Datos de la mascota actualizados correctamente.";
                } else {
                    $mensaje = "Error: No se pudo modificar la información.";
                }
            } else {
                $mensaje = "Error: No se recibió un ID válido.";
            }

            session()->setFlashdata('mensaje', $mensaje);
            session()->setFlashdata('listaMascostas', $listaMascostas);

            return redirect()->to(base_url('/modificarMascota'));
        }
    }
}