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
        $listaMascotas = $mascotaModel->obtenerListaMascotasTodo();

        // Inicializar la consulta
        $query = $mascotaModel->obtenerMascotasConDueñosMotvio();

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
        $listaVeterinarios = $veterinarioModel->obtenerListaTodo();

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
        $fechaRegistro = Time::now()->toLocalizedString('yyyy-MM-dd HH:mm:ss');

        // Buscar la mascota
        $mascota = $Mascotas->find($mascotaId);

        // Validación de IDs
        if (!$Amo->find($amoId) || !$mascota) {
            session()->setFlashdata('error_message', 'Error: Amo o mascota inválidos.');
            return redirect()->to(base_url('/altas'));
        }

        // Verificar si ya existe el vínculo
        $existeVinculo = $vinculoModel->where('mascota_id', $mascotaId)
            ->where('amo_id', $amoId)
            ->first();

        if ($existeVinculo) {
            session()->setFlashdata('mensaje', 'Error: Este vínculo ya existe.');
        } else {
            // Crear nuevo vínculo
            $data = [
                'id_vinculo' => mt_rand(100, 1000),
                'amo_id' => $amoId,
                'mascota_id' => $mascotaId,
                'fecha_inicio' => $fechaRegistro,
                'estado' => 1,
            ];

            // actualizar datos
            if ($mascota) {
                $datoActualizar = [
                    'amo' => 2, // Valor 2- tiene amo
                    'id_amo' => $amoId
                ];

                // Insertar vínculo y actualizar mascota
                if ($vinculoModel->insertar($data) && $Mascotas->update($mascotaId, $datoActualizar)) {
                    session()->setFlashdata('mensaje', 'Vínculo registrado y mascota actualizada correctamente.');
                } else {
                    session()->setFlashdata('mensaje', 'Error: No se pudo registrar el vínculo o actualizar la mascota.');
                }
            } else {
                session()->setFlashdata('mensaje', 'Error: No se pudo encontrar la mascota para actualizar.');
            }
        }

        // Guardar datos en la sesión
        session()->set([
            'datoMascota' => $datoMascota,
            'datoAmo' => $datoAmo
        ]);

        return redirect()->to(base_url('/altas'));
    }

    public function bajaMascota()
    {
        $relacion = new VinculosModel();
        $mascota = new MascotasModel();

        // Obtener datos correctamente
        $mascotaId = $this->request->getPost('mascota_id');
        $vinculoId = $this->request->getPost('vinculo_id');
        $motivo = $this->request->getPost('motivo');
        $fechaBaja = $this->request->getPost('fecha_baja');

        // Validar existencia en la base de datos
        $mascotaExiste = $mascota->where('nro_registro', $mascotaId)->first();
        $vinculoExiste = $relacion->where('id_vinculo', $vinculoId)->first();

        $vinculo = $relacion->find($vinculoId);
      
        if (!$mascotaExiste) {
            session()->setFlashdata('mensaje', "Error: La mascota seleccionada no existe.");
            return redirect()->to('/bajas');
        }

        if (!$vinculoExiste) {
            session()->setFlashdata('mensaje', "Error: El vínculo seleccionado no existe.");
            return redirect()->to('/bajas');
        }

        if ($motivo === 'fallecimiento') {
            // Actualizar mascota columna por columna pero en una sola ejecución
            $mascota->set('estado', 2)
                ->set('fecha_defuncion', $fechaBaja)
                ->set('amo', 1)
                ->set('id_amo', 0)
                ->where('nro_registro', $mascotaId)
                ->update();
            // Actualizar vínculo columna por columna en una sola ejecución
            $relacion->set('fecha_defuncion', $fechaBaja)
                ->set('motivo', $motivo)
                ->set('estado', 2)
                ->where('id_vinculo', $vinculoId)
                ->update();
        } elseif ($motivo === 'venta') {
            // Actualizar mascota columna por columna pero en una sola ejecución
            $mascota->set('estado', 2)
                ->set('fecha_fin', $fechaBaja)
                ->set('amo', 1)
                ->set('id_amo', 0)
                ->where('nro_registro', $mascotaId)
                ->update();

            // Actualizar vínculo columna por columna en una sola ejecución
            $relacion->set('fecha_fin', $fechaBaja)
                ->set('motivo', $motivo)
                ->set('estado', 2)
                ->where('id_vinculo', $vinculoId)
                ->update();

        } else {
            session()->setFlashdata('mensaje', "Error: No se realizó ninguna actualización.");
            return redirect()->to(base_url('/bajas'));
        }

        session()->setFlashdata('mensaje', "Baja de la mascota registrada exitosamente.");
        return redirect()->to(base_url('/bajas'));
    }

}