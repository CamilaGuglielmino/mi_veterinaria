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
        $vistas = view('header') . view('altas/altasVeterinario', ['datoVeterinario' => $datoVeterinario]) . view('footer');
        return $vistas;
    }

    public function alta()
    {
        $Veterinario = new VeterinariosModel();

        // Obtener el servicio de validación de CodeIgniter
        $validation = \Config\Services::validation();

        // Verificar validación antes de insertar
        if (!$this->validate($Veterinario->validationRules, $Veterinario->validationMessages)) {
            return view('altas/altasVeterinario', [
                'validation' => $validation,
                'mensaje' => 'Error: Verifique los datos ingresados.'
            ]);
        }

        // Formatear fecha actual
        $fecha = Time::now()->toLocalizedString('yyyy-MM-dd');

        // Datos a insertar
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'especialidad' => $this->request->getPost('especialidad'),
            'telefono' => $this->request->getPost('telefono'),
            'fecha_ingreso' => $fecha,
            'estado' => 1,
        ];

        // Insertar en la base de datos y verificar si fue exitoso
        $resultado = $Veterinario->insert($data);

        // Guardar el mensaje en sesión
        $mensaje = $resultado ? "Veterinario registrado exitosamente." : "Error: No se pudo registrar el veterinario.";
        session()->setFlashdata('mensaje', $mensaje);

        // Retornar la vista con validación y mensaje
        return view('altas/altasVeterinario', [
            'validation' => $validation,
            'mensaje' => session()->getFlashdata('mensaje')
        ]);
    }

    public function obtenerVeterinarios()
    {
        $veterinarioModel = new VeterinariosModel();

        // Definir la variable vacía
        $veterinarios = [];

        // Obtener la lista de veterinarios para el select
        $listaVeterinarios = $veterinarioModel->obtenerLista();

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


        if (!empty($veterinariosId)) {
            // Ejecutar la actualización de fecha de egreso y estado
            $resultado = $veterinarioModel->set([
                'fecha_egreso' => $fecha,
                'estado' => 2
            ])
                ->where('id', $veterinariosId)
                ->update();

            if ($resultado) {
                $mensaje = "Baja del veterinario exitosa.";
            } else {
                $mensaje = "Error: No se pudo actualizar la base de datos.";
            }
        } else {
            $mensaje = "Error: No se recibió un ID válido.";
        }

        return view('header') .
            view('bajas/bajaVeterinario', ['mensaje' => $mensaje, 'listaVeterinarios' => $listaVeterinarios]) .
            view('footer');
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


        if (!empty($veterinarioId)) {
            // Actualizar datos del amo
            $resultado = $veterinarioModel->set([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'especialidad' => $especialidad,
                'telefono' => $telefono,
                'fecha_modifica' => $fecha
            ])
                ->where('id', $veterinarioId)
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
            view('modificaciones/modificarVeterinario', ['mensaje' => $mensaje, 'listaVeterinarios' => $listaVeterinarios]) .
            view('footer');
    }
}