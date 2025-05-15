<?php if (session()->has('mensaje')): ?>
    <?php $mensaje = session()->getFlashdata('mensaje'); ?>
    <div class="alert <?= strpos($mensaje, 'Error') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show"
        role="alert">
        <?= $mensaje; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<body>
    <main class="container mt-4">
        <nav class="nav nav-tabs">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('bajasMascotas') ?>">Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('bajasVeterinarios') ?>">Veterinarios</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content mt-3">
            <div id="bajasMascotas" class="tab-pane active">
                <form method="POST" action="<?= base_url('bajaMascota') ?>" class="bg-light p-4 rounded shadow">
                    <h2 class="text-center fw-bold mb-4">Bajas de Mascotas</h2>

                    <!-- Selección de Mascota -->
                    <div class="mb-3">
                        <label for="mascota_id" class="form-label">Seleccionar Mascota:</label>
                        <select name="mascota_id" id="mascota_id" class="form-select" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($listaMascotas as $mascota): ?>
                                <option value="<?= esc($mascota['nro_registro']) ?>"
                                    data-vinculo="<?= esc($mascota['id_vinculo']) ?>">
                                    <?= esc($mascota['nombre']) ?> - <?= esc($mascota['amos']) ?> (Vínculo desde:
                                    <?= date("d/m/Y", strtotime(esc($mascota['fecha_inicio']))) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>



                    </div>

                    <!-- Motivo de Baja -->
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo de Baja:</label>
                        <select name="motivo" id="motivo" class="form-select" required>
                            <option value="venta">Venta</option>
                            <option value="fallecimiento">Fallecimiento</option>
                        </select>
                    </div>



                    <!-- Fecha de Baja -->
                    <div class="mb-3">
                        <label for="fecha_baja" class="form-label">Fecha de Baja:</label>
                        <input type="date" name="fecha_baja" id="fecha_baja" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100">Registrar Baja</button>
                </form>

            </div>
        </div>
    </main>
</body>
<script>
    document.querySelector("form").addEventListener("submit", function (event) {
        let selectMascota = document.getElementById("mascota_id");
        let mascotaId = selectMascota.value;
        let vinculoId = selectMascota.options[selectMascota.selectedIndex].getAttribute("data-vinculo");
        let motivo = document.getElementById("motivo").value;
        let fechaBaja = document.getElementById("fecha_baja").value; // Capturar la fecha

        if (!mascotaId || !motivo || !fechaBaja) {
            alert("Debes seleccionar una mascota, un motivo de baja y una fecha.");
            event.preventDefault();
            return;
        }

        // Agregar campos ocultos para enviar ID de vínculo y motivo
        let inputVinculo = document.createElement("input");
        inputVinculo.type = "hidden";
        inputVinculo.name = "vinculo_id";
        inputVinculo.value = vinculoId;

        let inputMotivo = document.createElement("input");
        inputMotivo.type = "hidden";
        inputMotivo.name = "motivo";
        inputMotivo.value = motivo;

        let inputFecha = document.createElement("input");
        inputFecha.type = "hidden";
        inputFecha.name = "fecha_baja";
        inputFecha.value = fechaBaja;

        this.appendChild(inputVinculo);
        this.appendChild(inputMotivo);
        this.appendChild(inputFecha);
    });
</script>