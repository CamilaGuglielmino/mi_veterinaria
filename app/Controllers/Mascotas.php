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

        // Generar un número único de registro
        $dateString = date('mdy'); //Generate a datestring.  
        $numeroAleatorio = mt_rand(1, 100); 
        $nro_registro = $numeroAleatorio . $dateString;


        $data = [
            'nro_registro' => $nro_registro,
            'nombre' => $this->request->getPost('nombre'),
            'especie' => $this->request->getPost('especie'),
            'raza' => $this->request->getPost('raza'),
            'edad' => $this->request->getPost('edad'),
            'fecha_alta' => $fecha,
            'estado' => 1,
        ];

        $resultado = $Mascotas->insertar($data);
        

        if ($resultado) {
            $mensaje = "Mascota registrada exitosamente.";
        } else {
            $mensaje = "Error: No se pudo registrar la mascota.";
        }

        return view('header') .
            view('altas/altas',['datoMascota' => $datoMascota, 'datoAmo'=>$datoAmo, 'mensaje'=>$mensaje]) .
            view('footer');
    }
    public function bajaMascota()
    {
        $relacionModel = new VinculosModel();
        $mascotaModel = new MascotasModel();
        $listaMascotas = $mascotaModel->obtenerListaMascotas();

        $mascotaId = $this->request->getPost('mascota_id');
        $motivo = $this->request->getPost('motivo');
        $fecha = Time::now()->toLocalizedString('yyyy-MM-dd');

        if (!empty($mascotaId)) {
            if ($motivo === 'fallecimiento') {
                // Actualizar fecha de defunción y estado a 2
                $resultadoMascota = $mascotaModel->set([
                    'fecha_defuncion' => $fecha,
                    'estado' => 2
                ])
                    ->where('nro_registro', $mascotaId)
                    ->update();
            } elseif ($motivo === 'venta') {
                // Registrar la baja de la relación y actualizar estado de la mascota
                $resultadoRelacion = $relacionModel->set(['fecha_fin' => $fecha])
                    ->where('mascota_id', $mascotaId)
                    ->update();

                $resultadoEstado = $mascotaModel->set(['estado' => 2])
                    ->where('nro_registro', $mascotaId)
                    ->update();
            }

            if (($motivo === 'fallecimiento' && $resultadoMascota) || ($motivo === 'venta' && $resultadoRelacion && $resultadoEstado)) {
                $mensaje = "Baja de la mascota registrada exitosamente.";
            } else {
                $mensaje = "Error: No se pudo actualizar la base de datos.";
            }
        } else {
            $mensaje = "Error: No se recibió un ID válido.";
        }

        return view('header') .
            view('bajas/bajaVinculos', ['mensaje' => $mensaje, 'listaMascotas' => $listaMascotas]) .
            view('footer');
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
        $listaMascotas = $mascotaModel->obtenerListaMascotas();
        $mascotas = $mascotaModel->obtenerMascotasConDueños();

        return view('header') .
            view('bajas/bajaVinculos', ['mascotas' => $mascotas, 'listaMascotas' => $listaMascotas]) .
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

        return view('header') .
            view('modificaciones/modificarMascota', ['mensaje' => $mensaje, 'listaMascostas' => $listaMascostas]) .
            view('footer');
    }
}