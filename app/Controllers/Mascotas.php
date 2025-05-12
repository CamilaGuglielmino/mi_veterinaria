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
        
        $dateString = date('mdy'); //Generate a datestring.
        $fecha = Time::now();
        $fechaFormateada = $fecha->toLocalizedString('yyyy-MM-dd');
        $numeroAleatorio = mt_rand(1, 100);
        $nro_registro = $numeroAleatorio . $dateString;
        $data = [
            'nro_registro' => $nro_registro,
            'nombre' => $this->request->getPost('nombre'),
            'especie' => $this->request->getPost('especie'),
            'raza' => $this->request->getPost('raza'),
            'edad' => $this->request->getPost('edad'),
            'fecha_alta' => $fechaFormateada,
        ];
        $Mascotas = new MascotasModel();
        $Mascotas->insertar($data);

        return redirect()->to(base_url('/'));
 
    }
public function bajaMascota()
{
    $relacionModel = new VinculosModel();
    $mascotaModel = new MascotasModel();
    
    $mascotaId = $this->request->getPost('mascota_id');
    $motivo = $this->request->getPost('motivo');
    $fecha = Time::now();
    $fechaFormateada = $fecha->toLocalizedString('yyyy-MM-dd');
    $fecha_fin = $fechaFormateada; 

    if (!empty($mascotaId)) { 
        if ($motivo === 'fallecimiento') {
            $mascotaModel->where('nro_registro', $mascotaId)->
            update( ['fecha_defuncion' => $fecha_fin]);
        }
        $relacionModel->where('mascota_id', $mascotaId)->update(['fecha_fin' => $fecha_fin]);

        $mensaje = "Baja de la mascota registrada exitosamente.";
    } else {
        $mensaje = "Error: No se recibió un ID válido.";
    }

    return view('header') .
           view('bajas/bajaVinculos', ['mensaje' => $mensaje]) .
           view('footer');
}

    public function modificar()
    { /* Código para actualizar registros */
    }

    /**
     * no lo uso
     */
    public function mostrar()
    {
        $Amo = new AmosModel();
        $amos['dato'] = $Amo->obtenerAmos();
        $Mascotas = new MascotasModel();
        $datoMascota['dato'] = $Mascotas->mostrar_mascotas();
        $vistas = view('header') . view('/mostrar/listadoAmos', ['amos'=> $amos]) . view('footer');
        return $vistas;
    }
    public function obtenerMascotas()
    {
        $mascotasModel = new MascotasModel();
        // Definir la variable
        $mascotas = [];
        // Obtener la lista de veterinarios para el select
        $listaMascotas = $mascotasModel->select('nro_registro, nombre')->get()->getResultArray();

        return view('header') .
            view('/mostrar/listadoMascotas', ['listaMascotas' => $listaMascotas, 'mascotas' => $mascotas]) .
            view('footer');
    }
}