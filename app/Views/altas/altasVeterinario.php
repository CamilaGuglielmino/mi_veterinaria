<?php $session = session(); ?>
<?php $validation = session('validation'); ?>

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
                    <a class="nav-link active" href="<?= base_url('altas') ?>">Mascotas y Amos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('altasVeterinario') ?>">Veterinarios</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content mt-3">
            <div id="veterinarios" class="tab-pane active">
                <form action="<?= base_url('formularioAlta') ?>" method="POST" class="bg-light p-4 rounded shadow">
                    <h2 class="text-center fw-bold mb-4">Médicos Veterinarios</h2>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required value="<?= old('nombre') ?>">
                        <?php if (!empty($validation) && $validation->hasError('nombre')): ?>
                            <span class="text-danger"><?= esc($validation->getError('nombre')) ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" name="apellido" class="form-control" placeholder="Apellido" required value="<?= old('apellido') ?>">
                        <?php if (!empty($validation) && $validation->hasError('apellido')): ?>
                            <span class="text-danger"><?= esc($validation->getError('apellido')) ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Especialidad -->
                    <div class="mb-3">
                        <label for="especialidad" class="form-label">Especialidad:</label>
                        <select class="form-select" id="especialidad" name="especialidad" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Animales domésticos">Animales domésticos</option>
                            <option value="Animales de producción">Animales de producción</option>
                            <option value="Animales exóticos">Animales exóticos</option>
                            <option value="Especialidades clínicas">Especialidades clínicas</option>
                            <option value="Especialidades de laboratorio">Especialidades de laboratorio</option>
                            <option value="Salud pública veterinaria">Salud pública veterinaria</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <?php if (!empty($validation) && $validation->hasError('especialidad')): ?>
                            <span class="text-danger"><?= esc($validation->getError('especialidad')) ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required value="<?= old('telefono') ?>">
                        <?php if (!empty($validation) && $validation->hasError('telefono')): ?>
                            <span class="text-danger"><?= esc($validation->getError('telefono')) ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Registrar Veterinario</button>
                </form>
            </div>
        </div>
    </main>
</body>
