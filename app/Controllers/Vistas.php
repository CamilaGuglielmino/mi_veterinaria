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
    
        $Mascotas = new MascotasModel();
        
        $datoAmo = $Amo->obtenerAmos();
        $datoMascota = $Mascotas->mostrar_mascotas();

       return $vistas = view('header') . view('altas/altas', compact('datoMascota', 'datoAmo')) . view('footer');
        
    }

    public function vistaModificar()
    {
        $Amo = new AmosModel();
        $listaAmos = $Amo->obtenerListaAmos();
        $vistas = view('header') . view('modificaciones/modificarAmo', ['listaAmos' => $listaAmos]) . view('footer');
        return $vistas;
    }



}