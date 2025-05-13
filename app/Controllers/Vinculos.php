<?php

namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModel;
use App\Models\VeterinariosModel;
use App\Models\VinculosModel;
use CodeIgniter\I18n\Time;


class Vinculos extends BaseController
{
    public function mostrarM()
    {
        $mascotaModel = new MascotasModel();
        $mascotaId = $this->request->getGet('mascota'); // Capturamos la selección
        $listaMascotas = $mascotaModel->obtenerListaMascotas();

        // Inicializar la consulta
        $query = $mascotaModel->obtenerMascotasConDueños();

        // Filtrar por ID solo si hay una selección válida
        if (!empty($mascotaId) && $mascotaId !== "todos") {
            $query->where('mascotas.nro_registro', $mascotaId);
        }

        // Obtener los resultados
        $mascotas = $query->get()->getResultArray();

        return view('header')
            . view('mostrar/listadoMascotas', ['mascotas' => $mascotas, 'listaMascotas' => $listaMascotas])
            . view('footer');
    }
    public function mostrarA()
    {
        $amoModel = new AmosModel();
        $amoId = $this->request->getGet('amo');
        $listaAmos = $amoModel->obtenerListaAmos();

        // Inicializar la consulta
        $query = $amoModel->obtenerAmo();

        // Filtrar solo si hay una selección válida
        if (!empty($amoId) && $amoId !== "todos") {
            $query->where('amos.id', $amoId);
        }

        // Obtener los resultados
        $amos = $query->get()->getResultArray();

        return view('header')
            . view('mostrar/listadoAmos', ['amos' => $amos, 'listaAmos' => $listaAmos])
            . view('footer');
    }


    public function mostrarV()
    {
        $veterinarioModel = new VeterinariosModel();
        $veterinarioId = $this->request->getGet('veterinario'); // Capturamos la selección
        $listaVeterinarios = $veterinarioModel->obtenerLista();

        // Inicializar la consulta
        $query = $veterinarioModel->obtener();

        // Filtrar solo si hay una selección válida
        if (!empty($veterinarioId)) {
            $query->where('veterinarios.id', $veterinarioId);
        }

        // Obtener los resultados
        $veterinarios = $query->get()->getResultArray();

        return view('header')
            . view('mostrar/listadoVeterinarios', ['veterinarios' => $veterinarios, 'listaVeterinarios' => $listaVeterinarios])
            . view('footer');
    }
    public function alta()
    {
        $vinculoModel = new VinculosModel();
        $Amo = new AmosModel();
        $Mascotas = new MascotasModel();

        $datoAmo = $Amo->obtenerAmos();
        $datoMascota = $Mascotas->mostrar_mascotas();

        $mascotaId = $this->request->getPost('id_mascota');
        $amoId = $this->request->getPost('id_amo');
        $fechaRegistro = Time::now()->toLocalizedString('yyyy-MM-dd HH:mm:ss'); // Guarda la fecha actual

        if (!empty($mascotaId) && !empty($amoId)) {
            // Verificar si ya existe el vínculo
            $existeVinculo = $vinculoModel->where('mascota_id', $mascotaId)
                ->where('amo_id', $amoId)
                ->first();

            if ($existeVinculo) {
                $mensaje = "Error: Este vínculo ya existe.";
            } else {
                // Crear nuevo vínculo si no existe
                $data = [
                    'id_vinculo' => mt_rand(1, 100000),
                    'amo_id' => $amoId,
                    'mascota_id' => $mascotaId,
                    'fecha_inicio' => $fechaRegistro,
                    'estado' => 1,
                ];

                $resultado = $vinculoModel->insertar($data);

                // Verificar si la inserción fue exitosa
                $mensaje = $resultado ? "Vínculo registrado correctamente." : "Error: No se pudo registrar el vínculo.";
            }
        } else {
            $mensaje = "Error: Debe seleccionar un amo y una mascota.";
        }

        return view('header') .
            view('altas/altas', ['mensaje' => $mensaje, 'datoMascota' => $datoMascota, 'datoAmo' => $datoAmo]) .
            view('footer');
    }



}