<?php
namespace App\Controllers;

use App\Models\VeterinariosModel;
use CodeIgniter\I18n\Time;

class Veterinarios extends BaseController
{
    public function alta()
    {
        $fechaActual = Time::now()->format('d/m/Y H:i:s');
        
        $data = [
            'id' => rand(100, 999), // 
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'especialidad' => $this->request->getPost('especialidad'),
            'telefono' => $this->request->getPost('telefono'),
            'fecha_alta' => $fechaActual,
        ];
        $Veterinario = new VeterinariosModel();
        $Veterinario->insertar($data);
        return redirect()->to(base_url('/'));
    }
    public function baja()
    { /* Código para eliminar relaciones */
    }
    public function modificar()
    { /* Código para actualizar registros */
    }
    public function mostrar()
    { 
        $Mascotas = new VeterinariosModel();
        $data['dato'] = $Mascotas->mostrar_veterinarios();
        $vistas = view('header') . view('mostrar', $data) . view('footer');
        return $vistas;
    }
}