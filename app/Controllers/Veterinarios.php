<?php
namespace App\Controllers;

use App\Models\VeterinariosModel;
use CodeIgniter\I18n\Time;
use DateTime;

class Veterinarios extends BaseController
{
    public function vista()
    {
        $veterinario = new VeterinariosModel();
        $datoVeterinario = $veterinario->obtenerVeterinario();
        $vistas = view('header') . view('altas/altasVeterinario', ['datoVeterinario' => $datoVeterinario]) . view('footer');
        return $vistas;
    }
    public function alta()
    {
        // Formatear fecha actual
        $fecha = Time::now()->toLocalizedString('yyyy-MM-dd');

        $reglas = [
            'nombre' => [
                'rules' => 'required|regex_match[/^[\p{L} ]+$/u]|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El nombre es obligatorio.',
                    'regex_match' => 'El nombre solo puede contener letras, espacios y caracteres acentuados.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.',
                    'max_length' => 'El nombre no puede superar los 50 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|regex_match[/^[\p{L} ]+$/u]|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El apellido es obligatorio.',
                    'regex_match' => 'El apellido solo puede contener letras, espacios y caracteres acentuados.',
                    'min_length' => 'El apellido debe tener al menos 3 caracteres.',
                    'max_length' => 'El apellido no puede superar los 50 caracteres.'
                ]
            ],
            'telefono' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'El campo teléfono es obligatorio.',
                    'min_length' => 'El teléfono debe tener al menos 10 caracteres.'
                ]
            ],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->to(base_url('altasVeterinario'))
                ->withInput()
                ->with('validation', $this->validator);
        }

        
        $data = [
            'id' => mt_rand(1, 999),
            'nombre' => ucfirst(trim($this->request->getPost('nombre'))),
            'apellido' => ucfirst(trim($this->request->getPost('apellido'))),
            'especialidad' => $this->request->getPost('especialidad'),
            'telefono' => $this->request->getPost('telefono'),
            'fecha_creacion' => $fecha,
            'estado' => 1,
        ];

       
        $Veterinario = new VeterinariosModel();
        $Veterinario->insert($data);

        
        return redirect()->to(base_url('altasVeterinario'))->with('mensaje', 'Veterinario registrado exitosamente.');

    }
    public function obtenerVeterinarios()
    {
        $veterinarioModel = new VeterinariosModel();

        // Definir la variable vacía
        $veterinarios = [];

        // Obtener la lista de veterinarios para el select
        $listaVeterinarios = $veterinarioModel->obtenerListaTodo();

        return view('header') .
            view('/mostrar/listadoVeterinarios', ['listaVeterinarios' => $listaVeterinarios, 'veterinarios' => $veterinarios]) .
            view('footer');
    }
    public function cargarBajaVeterinarios()
    {
        $veterinarioModel = new VeterinariosModel();
        $listaVeterinarios = $veterinarioModel->obtenerLista();
        $veterinario = $veterinarioModel->obtener();

        return view('header') .
            view('bajas/bajaVeterinario', ['veterinario' => $veterinario, 'listaVeterinarios' => $listaVeterinarios]) .
            view('footer');
    }
    public function bajaVeterinarios()
    {
        $veterinarioModel = new VeterinariosModel();
        $listaVeterinarios = $veterinarioModel->obtenerLista();

        $veterinariosId = $this->request->getPost('veterinario_id');
        $fecha = $this->request->getPost('fecha_fin');

        // Definir reglas de validación en el controlador
        $reglas = [
            'fecha_fin' => [ // Coincide con el nombre en el POST
                'rules' => 'required',
                'errors' => [
                    'required' => 'La fecha de baja es obligatoria.'
                ]
            ]
        ];

        // Validar primero con CodeIgniter
        if (!$this->validate($reglas)) {
            session()->setFlashdata('mensaje', 'Error: La fecha de baja es obligatoria.');
            return redirect()->to(base_url('/bajasVeterinarios'))
                ->withInput()
                ->with('validation', $this->validator);
        }

        // Validación manual con método personalizado
        if (!$this->validarFechaBaja($fecha, $veterinariosId, $veterinarioModel)) {
            session()->setFlashdata('mensaje', 'Error: La fecha de baja debe ser posterior a la fecha de alta.');
            return redirect()->to(base_url('/bajasVeterinarios'))
                ->withInput();
        }

        if (!empty($veterinariosId)) {
            // Ejecutar la actualización de fecha de egreso y estado
            $resultado = $veterinarioModel->set([
                'fecha_egreso' => $fecha,
                'estado' => 2
            ])
                ->where('id', $veterinariosId)
                ->update();

            $mensaje = $resultado ? "Baja del veterinario exitosa." : "Error: No se pudo actualizar la base de datos.";
        } else {
            $mensaje = "Error: No se recibió un ID válido.";
        }

        session()->setFlashdata('listaVeterinarios', $listaVeterinarios);
        session()->setFlashdata('mensaje', $mensaje);
        return redirect()->to(base_url('/bajasVeterinarios'));
    }
    public function vistaModificar()
    {
        $veterinarioModel = new VeterinariosModel();
        $listaVeterinarios = $veterinarioModel->obtenerLista();

        $vistas = view('header') .
            view('modificaciones/modificarVeterinario', ['listaVeterinarios' => $listaVeterinarios]) .
            view('footer');
        return $vistas;
    }
    public function modificar()
    {
        $veterinarioModel = new VeterinariosModel();
        $listaVeterinarios = $veterinarioModel->obtenerLista();


        $veterinarioId = $this->request->getPost('veterinario_id');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $especialidad = $this->request->getPost('especialidad');
        $telefono = $this->request->getPost('telefono');
        $fecha = Time::now()->toLocalizedString('yyyy-MM-dd');
        $reglas = [
            'nombre' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El nombre es obligatorio.',
                    'alpha_space' => 'El nombre solo puede contener letras y espacios.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.',
                    'max_length' => 'El nombre no puede superar los 50 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El apellido es obligatorio.',
                    'alpha_space' => 'El apellido solo puede contener letras y espacios.',
                    'min_length' => 'El apellido debe tener al menos 3 caracteres.',
                    'max_length' => 'El apellido no puede superar los 50 caracteres.'
                ]
            ],
            'telefono' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'El campo teléfono es obligatorio.',
                    'min_length' => 'El teléfono debe tener al menos 10 caracteres.'
                ]
            ],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->to(base_url('modificarVeterinario'))
                ->withInput()
                ->with('validation', $this->validator);
        } else {
            if (!empty($veterinarioId)) {
                
                $resultado = $veterinarioModel->set([
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'especialidad' => $especialidad,
                    'telefono' => $telefono,
                    'fecha_modifica' => $fecha
                ])
                    ->where('id', $veterinarioId)
                    ->update();

                if ($resultado) {
                    $mensaje = "Datos del Veterinario actualizados correctamente.";
                } else {
                    $mensaje = "Error: No se pudo modificar la información.";
                }
            } else {
                $mensaje = "Error: No se recibió un ID válido.";
            }

            session()->setFlashdata('mensaje', $mensaje);
            session()->setFlashdata('listaVeterinarios', $listaVeterinarios);

            return redirect()->to(base_url('/modificarVeterinario'));
        }



    }
    public function validarFechaBaja($fecha, $veterinarioId, $veterinarioModel)
    {
        $veterinario = $veterinarioModel->where('id', $veterinarioId)->first();

        if (!$veterinario) {
            return false; // Mascota no encontrada
        }

        $fechaAlta = new DateTime($veterinario['fecha_creacion']);
        $fechaBajaObj = new DateTime($fecha);

        return $fechaBajaObj > $fechaAlta;
    }
}