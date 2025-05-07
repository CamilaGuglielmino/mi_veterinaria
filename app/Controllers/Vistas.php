<?php
namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModel;
use App\Models\VeterinariosModel;


class Vistas extends BaseController
{
    public function index(): string
    {
        $Mascotas = new MascotasModel();
        $datoMascota['dato'] = $Mascotas->mostrar_mascotas();
        $vistas = view('header') . view('altas', $datoMascota) . view('footer');
        return $vistas;
        
    }
    public function vistaAlta()
    { 
        $Mascotas = new MascotasModel();
        $datoMascota['dato'] = $Mascotas->mostrar_mascotas();
        $vistas = view('header') . view('altas', $datoMascota) . view('footer');
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
    public function vistaMostrar()
    { 
        $vistas = view('header') . view('mostrar') . view('footer');
        return $vistas;
    }
}