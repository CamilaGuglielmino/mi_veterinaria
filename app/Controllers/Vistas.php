<?php
namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModel;
use App\Models\VeterinariosModel;
use App\Models\VinculosModel;


class Vistas extends BaseController
{
    public function index(): string
    {
        $vistas = view('header') . view('inicio', ) . view('footer');
        return $vistas;

    }
    public function vistaAlta()
    {
        $Amo = new AmosModel();
        $datoAmo['dato'] = $Amo->obtenerAmos();
        $Mascotas = new MascotasModel();
        $datoMascota['dato'] = $Mascotas->mostrar_mascotas();
        $vistas = view('header') . view('altas', ['datoMascota' => $datoMascota, 'datoAmo'=> $datoAmo]) . view('footer');
        return $vistas;
    }
  
    public function vistaModificar()
    {
        $vistas = view('header') . view('modificaciones') . view('footer');
        return $vistas;
    }
    public function cargarBajaMascotas()
{
    $mascotaModel = new MascotasModel();
    $relacionModel = new VinculosModel();

    // Obtener todas las mascotas con su ID y nombre para el select
    $listaMascotas = $mascotaModel->select('nro_registro, nombre, especie')->get()->getResultArray();

    // Obtener la información de relación Amo-Mascota
    $query = $mascotaModel->select('mascotas.*, GROUP_CONCAT(amos.nombre SEPARATOR ", ") AS amos')
        ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.mascota_id', 'left')
        ->join('amos', 'amo_mascota.amo_id = amos.id', 'left')
        ->groupBy('mascotas.nro_registro');

    $mascotas = $query->get()->getResultArray();

    return view('header') .
           view('bajas/bajaVinculos', ['mascotas' => $mascotas, 'listaMascotas' => $listaMascotas]) .
           view('footer');
}

    
}