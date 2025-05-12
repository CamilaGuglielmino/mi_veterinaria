<?php
namespace App\Controllers;

use App\Models\VeterinariosModel;
use CodeIgniter\I18n\Time;

class Veterinarios extends BaseController
{
    public function vista()
    {
        $veterinario = new VeterinariosModel();
        $datoVeterinario = $veterinario->obtenerVeterinario();
        $vistas = view('header') . view('altasVeterinario', ['datoVeterinario' => $datoVeterinario]) . view('footer');
        return $vistas;
    }

    public function alta()
    {
        $Veterinario = new VeterinariosModel();

        if ($this->validate($Veterinario->validationRules, $Veterinario->validationMessages)) {
            $fecha = Time::now();
            $fechaFormateada = $fecha->toLocalizedString('yyyy-MM-dd');

            $data = [
                'id' => rand(100, 999),
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'especialidad' => $this->request->getPost('especialidad'),
                'telefono' => $this->request->getPost('telefono'),
                'fecha_ingreso' => $fechaFormateada,
            ];

            $Veterinario->insertar($data);
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }
    public function baja()
    { /* Código para eliminar relaciones */
    }
    public function modificar()
    { /* Código para actualizar registros */
    }
    public function mostrar()
    {
        $veterinarioModel = new VeterinariosModel();
       // $relacionModel = new RelacionVeterinarioMascotaModel();

        $veterinarios = $veterinarioModel->findAll();

        foreach ($veterinarios as &$veterinario) {
            // Buscar todas las mascotas atendidas por este veterinario
           // $mascotas = $relacionModel->where('veterinario_id', $veterinario['id'])->findAll();
            $veterinario['mascotas'] = !empty($mascotas) ? array_column($mascotas, 'nombre_mascota') : [];
        }

        return view('listadoVeterinarios', ['veterinarios' => $veterinarios]);

    }
    public function obtenerVeterinarios()
{
    $veterinarioModel = new VeterinariosModel();
    
    // Definir la variable vacía
    $veterinarios = []; 

    // Obtener la lista de veterinarios para el select
    $listaVeterinarios = $veterinarioModel->select('id, nombre, apellido')->get()->getResultArray();
    
    return view('header') .
           view('/mostrar/listadoVeterinarios', ['listaVeterinarios' => $listaVeterinarios, 'veterinarios' => $veterinarios]) .
           view('footer');
}
}