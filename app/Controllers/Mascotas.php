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
        $dateString = date('mdy');
        $numeroAleatorio = mt_rand(1000, 9999);
        $nro_registro = $numeroAleatorio . $dateString;


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
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'El campo edad es obligatorio.',
                    'integer' => 'La edad debe ser un número entero.'
                ]
            ],
        ];

        if (!$this->validate($reglas)) {
            session()->setFlashdata('abrir_modal', true); // Guarda la variable temporalmente en la sesión
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
                'amo' => 1, // 1 no tiene amo - 2 sí tiene amo

            ];


            if ($Mascotas->insertar($data)) {
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
    public function bajaMascota()
    {
        $relacion = new VinculosModel();
        $mascota = new MascotasModel();

        // Obtener datos
        $mascotaId = $this->request->getPost('mascota_id');
        $motivo = $this->request->getPost('motivo');
        $fecha = Time::now()->toDateString();

        // Validar existencia en la base de datos
        $mascotaExiste = $mascota->where('nro_registro', $mascotaId)->first();
        $relacionExiste = $relacion->where('mascota_id', $mascotaId)->first();

        if (!$mascotaExiste || !$relacionExiste) {
            session()->setFlashdata('mensaje', "Error: La mascota o su vínculo no existen en la base de datos.");
            return redirect()->to('/bajas');
        }

        // Preparar datos para actualización
        $data = ($motivo === 'fallecimiento') ?
            ['fecha_defuncion' => $fecha, 'estado' => 2] :
            ['fecha_fin' => $fecha, 'estado' => 2];

        $dato = ($motivo === 'fallecimiento') ?
            ['fecha_defuncion' => $fecha, 'motivo' => $motivo, 'estado' => 2] :
            ['fecha_fin' => $fecha, 'motivo' => $motivo, 'estado' => 2];

        // Ejecutar actualización con `set()` para evitar problemas con NULL
        $mascota->set($data)->where('nro_registro', $mascotaId)->update();
        $relacion->set($dato)->where('mascota_id', $mascotaId)->update();

        // Validar filas afectadas
        $mascotaAfectada = $mascota->affectedRows();
        $relacionAfectada = $relacion->affectedRows();

        if ($mascotaAfectada > 0 && $relacionAfectada > 0) {
            session()->setFlashdata('mensaje', "Baja de la mascota registrada exitosamente.");
        } else {
            session()->setFlashdata('mensaje', "Error: No se realizó ninguna actualización.");
        }

        return redirect()->to('/bajas');
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
        $listaMascotas = $mascotasModel->obtenerListaMascotas();

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


        if (!empty($mascotaId)) {
            // Actualizar datos del amo
            $resultado = $mascotasModel->set([
                'nombre' => $nombre,
                'especie' => $especie,
                'raza' => $raza,
                'edad' => $edad,
                'fecha_modifica' => $fecha
            ])
                ->where('nro_registro', $mascotaId)
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

        session()->setFlashdata('mensaje', $mensaje);
        session()->setFlashdata('listaMascostas', $listaMascostas);

        return redirect()->to(base_url('/modificarMascota'));
    }
}