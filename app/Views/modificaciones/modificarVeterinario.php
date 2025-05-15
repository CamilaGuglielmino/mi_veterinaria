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
                    <a class="nav-link" href="<?= base_url('modificarMascota') ?>">Modificar Mascota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('modificarVeterinario') ?>">Modificar Veterinario</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content mt-3">
            <div id="modificarVeterinario" class="tab-pane active">
                <form method="POST" action="<?= base_url('procesarModificacionV') ?>" class="bg-light p-4 rounded shadow">
                    <h2 class="text-center fw-bold mb-4">Modificar Veterinario</h2>

                    <!-- Selección de Veterinario -->
                    <div class="mb-3">
                        <label for="veterinario_id" class="form-label">Seleccionar Veterinario:</label>
                        <select name="veterinario_id" id="veterinario_id" class="form-select" onchange="cargarDatosVeterinario()" required>
                            <option value="">Seleccione un veterinario</option>
                            <?php foreach ($listaVeterinarios as $veterinario): ?>
                                <option value="<?= esc($veterinario['id']) ?>" 
                                    data-nombre="<?= esc($veterinario['nombre']) ?>" 
                                    data-apellido="<?= esc($veterinario['apellido']) ?>" 
                                    data-especialidad="<?= esc($veterinario['especialidad']) ?>" 
                                    data-telefono="<?= esc($veterinario['telefono']) ?>">
                                    <?= esc($veterinario['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Información de Veterinario -->
                    <div id="tablaVeterinario" class="d-none">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="especialidad" class="form-label">Especialidad:</label>
                            <input type="text" name="especialidad" id="especialidad" class="form-control">
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
        function cargarDatosVeterinario() {
            let select = document.getElementById('veterinario_id');
            let selectedOption = select.options[select.selectedIndex];
            let nombre = selectedOption.getAttribute('data-nombre');
            let especialidad = selectedOption.getAttribute('data-especialidad');
            let apellido = selectedOption.getAttribute('data-apellido');
            let telefono = selectedOption.getAttribute('data-telefono');

            if (nombre) {
                document.getElementById('nombre').value = nombre;
                document.getElementById('especialidad').value = especialidad;
                document.getElementById('apellido').value = apellido;
                document.getElementById('telefono').value = telefono;
                document.getElementById('tablaVeterinario').classList.remove('d-none');
            } else {
                document.getElementById('tablaVeterinario').classList.add('d-none');
            }
        }
    </script>
</body>
