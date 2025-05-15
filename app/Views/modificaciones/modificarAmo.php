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
                    <a class="nav-link active" href="<?= base_url('modificarAmo') ?>">Modificar Amo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('modificarMascota') ?>">Modificar Mascota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('modificarVeterinario') ?>">Modificar Veterinario</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content mt-3">
            <div id="modificarAmo" class="tab-pane active">
                <form method="POST" action="<?= base_url('procesarModificacionA') ?>" class="bg-light p-4 rounded shadow">
                    <h2 class="text-center fw-bold mb-4">Modificar Amo</h2>

                    <!-- Selección de Amo -->
                    <div class="mb-3">
                        <label for="amo_id" class="form-label">Seleccionar Amo:</label>
                        <select name="amo_id" id="amo_id" class="form-select" onchange="cargarDatosAmo()" required>
                            <option value="">Seleccione un amo</option>
                            <?php foreach ($listaAmos as $amo): ?>
                                <option value="<?= esc($amo['id']) ?>" 
                                    data-nombre="<?= esc($amo['nombre']) ?>" 
                                    data-apellido="<?= esc($amo['apellido']) ?>" 
                                    data-telefono="<?= esc($amo['telefono']) ?>" 
                                    data-direccion="<?= esc($amo['direccion']) ?>">
                                    <?= esc($amo['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Información de Amo -->
                    <div id="tablaAmo" class="d-none">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Actualizar</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function cargarDatosAmo() {
            let select = document.getElementById('amo_id');
            let selectedOption = select.options[select.selectedIndex];
            let nombre = selectedOption.getAttribute('data-nombre');
            let apellido = selectedOption.getAttribute('data-apellido');
            let direccion = selectedOption.getAttribute('data-direccion');
            let telefono = selectedOption.getAttribute('data-telefono');

            if (nombre) {
                document.getElementById('nombre').value = nombre;
                document.getElementById('apellido').value = apellido;
                document.getElementById('direccion').value = direccion;
                document.getElementById('telefono').value = telefono;
                document.getElementById('tablaAmo').classList.remove('d-none');
            } else {
                document.getElementById('tablaAmo').classList.add('d-none');
            }
        }
    </script>
</body>
