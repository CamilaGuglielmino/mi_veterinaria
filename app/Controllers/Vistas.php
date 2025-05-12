<?php
namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModel;
use App\Models\VeterinariosModel;


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
    public function vistaBaja()
    {
        $vistas = view('header') . view('bajas') . view('footer');
        return $vistas;
    }
    public function vistaModificar()
    {
        $vistas = view('header') . view('modificaciones') . view('footer');
        return $vistas;
    }
    
}