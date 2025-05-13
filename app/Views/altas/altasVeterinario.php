<body>
    <?php $validation = isset($validation) ? $validation : \Config\Services::validation(); ?>

    <?php if ($validation->getErrors()): ?>
        <div class="error-message">
            <?php foreach ($validation->getErrors() as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?= base_url('altas') ?>">Mascotas y Amos</a></li>
                <li class="lista-interna"><a href="<?= base_url('altasVeterinario') ?>">Veterinarios</a></li>
            </ul>
        </nav>

        <!-- Mostrar mensaje de éxito -->
        <?php if (session()->getFlashdata('mensaje')): ?>
            <p class="success-message"><?= esc(session()->getFlashdata('mensaje')) ?></p>
        <?php endif; ?>

        <div class="tab-content">
            <div id="veterinarios" class="tab-pane active">
                <form action="<?= base_url('formularioAlta') ?>" method="POST">
                    <p class="titulos">Médicos Veterinarios</p>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="<?= set_value('nombre') ?>" required>
                        <?php if ($validation->hasError('nombre')): ?>
                            <span class="help-block"><?= esc($validation->getError('nombre')) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido"
                            value="<?= set_value('apellido') ?>" required>
                        <?php if ($validation->hasError('apellido')): ?>
                            <span class="help-block"><?= esc($validation->getError('apellido')) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="especialidad" class="form-label">Especialidad:</label>
                        <select class="form-control" id="especialidad" name="especialidad" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Animales domésticos">Animales domésticos</option>
                            <option value="Animales de producción">Animales de producción</option>
                            <option value="Animales exóticos">Animales exóticos</option>
                            <option value="Especialidades clínicas">Especialidades clínicas</option>
                            <option value="Especialidades de laboratorio">Especialidades de laboratorio</option>
                            <option value="Salud pública veterinaria">Salud pública veterinaria</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                        <?php if ($validation->hasError('telefono')): ?>
                            <span class="help-block"><?= esc($validation->getError('telefono')) ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" id="tabla">Registrar Veterinario</button>
                </form>
            </div>
        </div>
    </main>
</body>