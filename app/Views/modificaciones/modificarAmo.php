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
                                <option value="<?= esc($amo['id']) ?>" <?= old('amo_id') == $amo['id'] ? 'selected' : '' ?>
                                    data-nombre="<?= esc($amo['nombre']) ?>"
                                    data-apellido="<?= esc($amo['apellido']) ?>"
                                    data-telefono="<?= esc($amo['telefono']) ?>"
                                    data-direccion="<?= esc($amo['direccion']) ?>">
                                    <?= esc($amo['nombre']) . ' ' . esc($amo['apellido']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Información de Amo -->
                    <div id="tablaAmo" class="<?= old('nombre') || old('apellido') || old('direccion') || old('telefono') ? '' : 'd-none' ?>">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('nombre')): ?>
                                <span class="text-danger"><?= esc($validation->getError('nombre')) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('apellido') ? 'is-invalid' : '' ?>" value="<?= old('apellido') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('apellido')): ?>
                                <span class="text-danger"><?= esc($validation->getError('apellido')) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('direccion') ? 'is-invalid' : '' ?>" value="<?= old('direccion') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('direccion')): ?>
                                <span class="text-danger"><?= esc($validation->getError('direccion')) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" class="form-control <?= session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('telefono') ? 'is-invalid' : '' ?>" value="<?= old('telefono') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('telefono')): ?>
                                <span class="text-danger"><?= esc($validation->getError('telefono')) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Actualizar</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Script para manejar la carga de datos del amo -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let select = document.getElementById('amo_id');
            if (select.value || document.querySelector('.text-danger')) {
                cargarDatosAmo();
                document.getElementById('tablaAmo').classList.remove('d-none');
            }
        });

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