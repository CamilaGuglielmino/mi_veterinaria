<?php

namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModel;
use App\Models\VeterinariosModel;


class Vinculos extends BaseController
{
    public function mostrarM()
    {
        $mascotaModel = new MascotasModel();
        $mascotaId = $this->request->getGet('mascota'); // Capturamos la selección
        $listaMascotas = $mascotaModel->select('nro_registro, nombre')->get()->getResultArray();

        $query = $mascotaModel->select('mascotas.*, GROUP_CONCAT(amos.nombre SEPARATOR ", ") AS amos')
            ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.mascota_id', 'left') // Relación mascota-amo
            ->join('amos', 'amo_mascota.amo_id = amos.id', 'left') // Relación amo
            ->groupBy('mascotas.nro_registro');
        // Filtramos si hay una selección válida
        if (!empty($mascotaId) && $mascotaId !== "todos") {
            $query->where('mascotas.nro_registro', $mascotaId);
        }

        // Si no se seleccionó nada, la tabla debe ocultarse
        $mascotas = (!empty($mascotaId)) ? $query->get()->getResultArray() : [];

        return view('header') .
            view('mostrar/listadoMascotas', ['mascotas' => $mascotas, 'listaMascotas' => $listaMascotas]) .
            view('footer');

    }
    public function mostrarA()
    {
        $amoModel = new AmosModel();
        $amoId = $this->request->getGet('amo'); // Capturamos la selección
        $listaAmos = $amoModel->select('id, nombre, apellido')->get()->getResultArray();

        $query = $amoModel->select('amos.*, GROUP_CONCAT(mascotas.nombre SEPARATOR ", ") AS mascotas')
            ->join('amo_mascota', 'amos.id = amo_mascota.amo_id', 'left') // Cambio aquí
            ->join('mascotas', 'amo_mascota.mascota_id = mascotas.nro_registro', 'left') // Cambio aquí
            ->groupBy('amos.id');
        // Filtramos si hay una selección válida
        if (!empty($amoId) && $amoId !== "todos") {
            $query->where('amos.id', $amoId);
        }

        // Si no se seleccionó nada, la tabla debe ocultarse
        $amos = (!empty($amoId)) ? $query->get()->getResultArray() : [];

        return view('header') .
            view('mostrar/listadoAmos', ['amos' => $amos, 'listaAmos' => $listaAmos]) .
            view('footer');
    }

    public function mostrarV()
    {
        $veterinarioModel = new VeterinariosModel();
        $veterinarioId = $this->request->getGet('veterinario'); // Capturamos la selección
        $listaVeterinarios = $veterinarioModel->select('id, nombre, apellido')->get()->getResultArray();


        // Construimos la consulta base
        $query = $veterinarioModel->select('veterinarios.*, GROUP_CONCAT(mascotas.nombre SEPARATOR ", ") AS mascotas_atendidas')
            ->join('vinculo', 'veterinarios.id = vinculo.veterinario_id', 'left')
            ->join('mascotas', 'vinculo.mascota_id = mascotas.nro_registro', 'left')
            ->groupBy('veterinarios.id');

        // Filtramos si hay una selección válida
        if (!empty($veterinarioId) && $veterinarioId !== "todos") {
            $query->where('veterinarios.id', $veterinarioId);
        }

        // Si no se seleccionó nada, la tabla debe ocultarse
        $veterinarios = (!empty($veterinarioId)) ? $query->get()->getResultArray() : [];

        return view('header') .
            view('mostrar/listadoVeterinarios', ['veterinarios' => $veterinarios, 'listaVeterinarios' => $listaVeterinarios]) .
            view('footer');
    }



}