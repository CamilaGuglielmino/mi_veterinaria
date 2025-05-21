<?php

namespace App\Controllers;

use App\Models\AmosModel;
use App\Models\MascotasModel;
use App\Models\VeterinariosModel;
use App\Models\VinculosModel;
use CodeIgniter\I18n\Time;
use DateTime;


class Vinculos extends BaseController
{
    public function mostrarM()
    {
        $mascotaModel = new MascotasModel();
        $mascotaId = $this->request->getGet('mascota');
        $listaMascotas = $mascotaModel->obtenerListaMascotasTodo();

        $query = $mascotaModel->obtenerMascotasConAmo();

        if (!empty($mascotaId) && $mascotaId !== "todos") {
            $query->where('mascotas.nro_registro', $mascotaId);
        }

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

        $query = $amoModel->obtenerAmo();

        if (!empty($amoId) && $amoId !== "todos") {
            $query->where('amos.id', $amoId);
        }

        $amos = $query->get()->getResultArray();

        return view('header')
            . view('mostrar/listadoAmos', ['amos' => $amos, 'listaAmos' => $listaAmos])
            . view('footer');
    }


    public function mostrarV()
    {
        $veterinarioModel = new VeterinariosModel();
        $veterinarioId = $this->request->getGet('veterinario');
        $listaVeterinarios = $veterinarioModel->obtenerListaTodo();

        $query = $veterinarioModel->obtenerV();

        if (!empty($veterinarioId)) {
            $query->where('id', $veterinarioId);
        }

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

        $mascota = $Mascotas->find($mascotaId);

        if (!$Amo->find($amoId) || !$mascota) {
            session()->setFlashdata('error_message', 'Error: Amo o mascota inválidos.');
            return redirect()->to(base_url('/altas'));
        }


        $existeVinculo = $vinculoModel->where('mascota_id', $mascotaId)
            ->where('amo_id', $amoId)
            ->first();

        if ($existeVinculo) {
            session()->setFlashdata('mensaje', 'Error: Este vínculo ya existe.');
        } else {

            $dato=[
                'mascota_actual'=>$mascotaId,
            ];
            $data = [
                'id_vinculo' => mt_rand(100, 1000),
                'amo_id' => $amoId,
                'mascota_id' => $mascotaId,
                'fecha_inicio' => $fechaRegistro,
                'motivo' => 'Sin motivo',
                'estado' => 1,
            ];


            if ($mascota) {
                $datoActualizar = [
                    'amo' => 2, // Valor 2- tiene amo
                    'id_amo' => $amoId
                ];

                if ($vinculoModel->insertar($data) && $Mascotas->update($mascotaId, $datoActualizar)) {
                    if($Amo->update($amoId, $dato)){
                    session()->setFlashdata('mensaje', 'Vínculo registrado y mascota actualizada correctamente.');

                    }
                } else {
                    session()->setFlashdata('mensaje', 'Error: No se pudo registrar el vínculo o actualizar la mascota.');
                }
            } else {
                session()->setFlashdata('mensaje', 'Error: No se pudo encontrar la mascota para actualizar.');
            }
        }

        session()->set([
            'datoMascota' => $datoMascota,
            'datoAmo' => $datoAmo
        ]);

        return redirect()->to(base_url('/altas'));
    }

    public function bajaMascota()
    {
        $mascotaModel = new MascotasModel();
        $vinculoModel = new VinculosModel();

        $mascotaId = $this->request->getPost('mascota_id');
        $fechaBaja = $this->request->getPost('fecha_baja');

        $reglas = [
            'fecha_baja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'La fecha de baja es obligatoria.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            session()->setFlashdata('mensaje', 'Error: La fecha de baja es obligatoria.');
            return redirect()->to(base_url('/bajas'))
                ->withInput()
                ->with('validation', $this->validator);
        }

        if (!$this->validarFechaBaja($fechaBaja, $mascotaId, $mascotaModel)) {
            session()->setFlashdata('mensaje', 'Error: La fecha de baja debe ser posterior a la fecha de alta.');
            return redirect()->to(base_url('/bajas'))
                ->withInput();
        }

        $motivo = $this->request->getPost('motivo');
        $vinculoId = $this->request->getPost('vinculo_id');

        $data = [
            'fecha_defuncion' => $fechaBaja,
            'fecha_fin' => $fechaBaja,
            'motivo' => $motivo,
            'estado' => ($motivo === 'fallecimiento') ? 2 : 1
        ];

        $mascotaData = [
            'estado' => ($motivo === 'fallecimiento') ? 2 : 1,
            'fecha_defuncion' => $fechaBaja,
            'fecha_fin' => $fechaBaja,
            'amo' => 1,
            'id_amo' => 0
        ];

        if ($vinculoModel->update($vinculoId, $data) && $mascotaModel->update($mascotaId, $mascotaData)) {
            session()->setFlashdata('mensaje', "Baja de la mascota registrada exitosamente.");
            return redirect()->to(base_url('/bajas'));
        } else {
            session()->setFlashdata('mensaje', "Error: No se realizó ninguna actualización.");
            return redirect()->to(base_url('/bajas'));
        }
    }


    public function validarFechaBaja($fechaBaja, $mascotaId, $mascotaModel)
    {
        $mascota = $mascotaModel->where('nro_registro', $mascotaId)->first();

        if (!$mascota) {
            return false;
        }

        $fechaAlta = new DateTime($mascota['fecha_alta']);
        $fechaBajaObj = new DateTime($fechaBaja);

        return $fechaBajaObj > $fechaAlta;
    }
}