<body>
    <?php if (session()->has('mensaje')): ?>
    <?php $mensaje = session()->getFlashdata('mensaje'); ?>
    <div class="alert <?= strpos($mensaje, 'Error') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show"
        role="alert">
        <?= $mensaje; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
    <main class="container mt-4">
        <nav class="nav nav-tabs">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('modificarAmo') ?>">Modificar Amo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('modificarMascota') ?>">Modificar Mascota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('modificarVeterinario') ?>">Modificar Veterinario</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content mt-3">
            <div id="modificarMascota" class="tab-pane active">
                <form method="POST" action="<?= base_url('procesarModificacionM') ?>" class="bg-light p-4 rounded shadow">
                    <h2 class="text-center fw-bold mb-4">Modificar Mascota</h2>

                    <!-- Selección de Mascota -->
                    <div class="mb-3">
                        <label for="mascota_id" class="form-label">Seleccionar Mascota:</label>
                        <select name="mascota_id" id="mascota_id" class="form-select" onchange="cargarDatosMascota()" required>
                            <option value="">Seleccione una mascota</option>
                            <?php foreach ($listaMascostas as $mascota): ?>
                                <option value="<?= esc($mascota['nro_registro']) ?>" 
                                    data-nombre="<?= esc($mascota['nombre']) ?>" 
                                    data-especie="<?= esc($mascota['especie']) ?>" 
                                    data-raza="<?= esc($mascota['raza']) ?>" 
                                    data-edad="<?= esc($mascota['edad']) ?>">
                                    <?= esc($mascota['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Información de Mascota -->
                    <div id="tablaMascota" class="d-none">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="especie" class="form-label">Especie:</label>
                            <input type="text" name="especie" id="especie" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="raza" class="form-label">Raza:</label>
                            <input type="text" name="raza" id="raza" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad:</label>
                            <input type="number" name="edad" id="edad" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Actualizar</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function cargarDatosMascota() {
            let select = document.getElementById('mascota_id');
            let selectedOption = select.options[select.selectedIndex];
            let nombre = selectedOption.getAttribute('data-nombre');
            let especie = selectedOption.getAttribute('data-especie');
            let raza = selectedOption.getAttribute('data-raza');
            let edad = selectedOption.getAttribute('data-edad');

            if (nombre) {
                document.getElementById('nombre').value = nombre;
                document.getElementById('especie').value = especie;
                document.getElementById('raza').value = raza;
                document.getElementById('edad').value = edad;
                document.getElementById('tablaMascota').classList.remove('d-none');
            } else {
                document.getElementById('tablaMascota').classList.add('d-none');
            }
        }
    </script>
</body>
