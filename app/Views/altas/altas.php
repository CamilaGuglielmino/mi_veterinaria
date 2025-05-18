<?php $session = session(); ?>
<?php $validation = session('validation'); ?>

<body>
    <?php if (session()->getFlashdata('abrir_modal') || session()->getFlashdata('abrir_modal_amo')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Abrir el modal de mascota si hay errores en la validación de mascota
                if (<?= session()->getFlashdata('abrir_modal') ? 'true' : 'false' ?>) {
                    var mascotaModal = new bootstrap.Modal(document.getElementById('mascotaModal'));
                    mascotaModal.show();
                }

                // Abrir el modal de amo si hay errores en la validación de amo
                if (<?= session()->getFlashdata('abrir_modal_amo') ? 'true' : 'false' ?>) {
                    var amoModal = new bootstrap.Modal(document.getElementById('amoModal'));
                    amoModal.show();
                }
            });
        </script>
    <?php endif; ?>


    <?php
    session()->remove('abrir_modal'); // Limpia la sesión después de mostrar el modal de mascota
    session()->remove('abrir_modal_amo'); // Limpia la sesión después de mostrar el modal de amo
    ?>

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
                    <a class="nav-link active" href="<?php echo base_url('altas') ?>">Mascotas y Amos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('altasVeterinario') ?>">Veterinarios</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content mt-3">
            <div id="vinculos" class="tab-pane active">
                <form action="<?php echo base_url('altaVinculo') ?>" method="POST" class="bg-light p-4 rounded shadow">
                    <h2 class="text-center fw-bold mb-4">Mascotas y Amos</h2>

                    <!-- Selección de Mascota -->
                    <div class="mb-3">
                        <label for="id_mascota" class="form-label">Nombre de la Mascota</label>
                        <select class="form-select" id="id_mascota" name="id_mascota" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($datoMascota as $mascota): ?>
                                <option value="<?= htmlspecialchars($mascota['nro_registro']) ?>">
                                    <?= htmlspecialchars($mascota['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <small class="text-muted">
                            Si la mascota no está registrada,

                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                data-bs-target="#mascotaModal">
                                Registrar Mascota
                            </button>

                        </small>
                    </div>

                    <!-- Selección de Amo -->
                    <div class="mb-3">
                        <label for="id_amo" class="form-label">Nombre del Amo</label>
                        <select class="form-select" id="id_amo" name="id_amo" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($datoAmo as $amo): ?>
                                <option value="<?= htmlspecialchars($amo['id']) ?>">
                                    <?= htmlspecialchars($amo['nombre'] . ' ' . $amo['apellido']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <small class="text-muted">
                            Si el propietario no está registrado,
                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                data-bs-target="#amoModal">
                                Registrar Propietario
                            </button>

                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Registrar Vínculo</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Modal de Mascota -->
    <div id="mascotaModal" class="modal fade" tabindex="-1" aria-labelledby="mascotaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Ajuste de tamaño más amplio -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="mascotaModalLabel">Registrar Mascota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('alta') ?>" method="POST">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" value="<?= old('nombre') ?>" required>
                            <?php if (!empty($validation) && $validation->hasError('nombre')): ?>
                                <span class="text-danger"><?= esc($validation->getError('nombre')) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Especie -->
                        <div class="mb-3">
                            <label for="especie" class="form-label">Especie:</label>
                            <select name="especie" class="form-select">
                                <option value="Perro" <?= old('especie') == 'Perro' ? 'selected' : '' ?>>Perro</option>
                                <option value="Gato" <?= old('especie') == 'Gato' ? 'selected' : '' ?>>Gato</option>
                                <option value="Ave" <?= old('especie') == 'Ave' ? 'selected' : '' ?>>Ave</option>
                                <option value="Reptil" <?= old('especie') == 'Reptil' ? 'selected' : '' ?>>Reptil</option>
                            </select>
                            <?php if (!empty($validation) && $validation->hasError('especie')): ?>
                                <span class="text-danger"><?= esc($validation->getError('especie')) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Raza -->
                        <div class="mb-3">
                            <label for="raza" class="form-label">Raza:</label>
                            <input type="text" name="raza" class="form-control" value="<?= old('raza') ?>">
                            <?php if (!empty($validation) && $validation->hasError('raza')): ?>
                                <span class="text-danger"><?= esc($validation->getError('raza')) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Edad -->
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad:</label>
                            <input type="number" name="edad" class="form-control" value="<?= old('edad') ?>">
                            <?php if (!empty($validation) && $validation->hasError('edad')): ?>
                                <span class="text-danger"><?= esc($validation->getError('edad')) ?></span>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Registrar Mascota</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Amo -->
    <div id="amoModal" class="modal fade" tabindex="-1" aria-labelledby="amoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Modal más amplio -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="amoModalLabel">Registrar Propietario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Amos/alta') ?>" method="POST">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required
                                value="<?= old('nombre') ?>">
                            <?php if (!empty($validation) && $validation->hasError('nombre')): ?>
                                <span class="text-danger"><?= esc($validation->getError('nombre')) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Apellido -->
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Apellido" required
                                value="<?= old('apellido') ?>">
                            <?php if (!empty($validation) && $validation->hasError('apellido')): ?>
                                <span class="text-danger"><?= esc($validation->getError('apellido')) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección" required
                                value="<?= old('direccion') ?>">
                            <?php if (!empty($validation) && $validation->hasError('direccion')): ?>
                                <span class="text-danger"><?= esc($validation->getError('direccion')) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required
                                value="<?= old('telefono') ?>">
                            <?php if (!empty($validation) && $validation->hasError('telefono')): ?>
                                <span class="text-danger"><?= esc($validation->getError('telefono')) ?></span>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Registrar Propietario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>