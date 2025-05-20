<body>
    <?php if (session()->has('mensaje')): ?>
        <?php $mensaje = session()->getFlashdata('mensaje'); ?>
        <div class="alert <?= strpos($mensaje, 'Error') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show"
            role="alert">
            <?= esc($mensaje); ?>
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
                                <option value="<?= esc($mascota['nro_registro']) ?>" <?= old('mascota_id') == $mascota['nro_registro'] ? 'selected' : '' ?>
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
                    <div id="tablaMascota" class="<?= old('nombre') || old('especie') || old('raza') || old('edad') ? '' : 'd-none' ?>">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('nombre')): ?>
                                <span class="text-danger"><?= esc($validation->getError('nombre')) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="especie" class="form-label">Especie:</label>
                            <input type="text" name="especie" id="especie" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('especie') ? 'is-invalid' : '' ?>" value="<?= old('especie') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('especie')): ?>
                                <span class="text-danger"><?= esc($validation->getError('especie')) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="raza" class="form-label">Raza:</label>
                            <input type="text" name="raza" id="raza" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('raza') ? 'is-invalid' : '' ?>" value="<?= old('raza') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('raza')): ?>
                                <span class="text-danger"><?= esc($validation->getError('raza')) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad:</label>
                            <input type="number" name="edad" id="edad" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('edad') ? 'is-invalid' : '' ?>" value="<?= old('edad') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('edad')): ?>
                                <span class="text-danger"><?= esc($validation->getError('edad')) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Actualizar</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Script para manejar la carga de datos de la mascota -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let select = document.getElementById('mascota_id');
            if (select.value || document.querySelector('.text-danger')) {
                cargarDatosMascota();
                document.getElementById('tablaMascota').classList.remove('d-none');
            }
        });

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