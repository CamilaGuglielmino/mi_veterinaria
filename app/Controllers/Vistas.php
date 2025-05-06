<?php
namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModeldel;
use App\Models\VeterinariosModelModel;


class Vistas extends BaseController
{
    public function index(): string
    {
        $vistas = view('header') . view('inicio') . view('footer');
        return $vistas;
    }
    public function vistaAlta()
    { 
        $vistas = view('header') . view('altas') . view('footer');
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