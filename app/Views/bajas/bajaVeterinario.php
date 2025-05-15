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
                    <a class="nav-link active" href="<?= base_url('bajasMascotas') ?>">Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('bajasVeterinarios') ?>">Veterinarios</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content mt-3">
            <div id="bajasVeterinarios" class="tab-pane active">
                <form method="POST" action="<?= base_url('bajaVeterinario') ?>" class="bg-light p-4 rounded shadow">
                    <h2 class="text-center fw-bold mb-4">Bajas de Veterinarios</h2>

                    <!-- Selección de Veterinario -->
                    <div class="mb-3">
                        <label for="veterinario_id" class="form-label">Seleccionar Veterinario:</label>
                        <select name="veterinario_id" id="veterinario_id" class="form-select" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($listaVeterinarios as $veterinario): ?>
                                <option value="<?= esc($veterinario['id']) ?>">
                                    <?= esc($veterinario['nombre']) ?>     <?= esc($veterinario['apellido']) ?> -
                                    <?= esc($veterinario['especialidad']) ?>
                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Fecha de Baja -->
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Baja:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100">Registrar Baja</button>
                </form>
            </div>
        </div>
    </main>
</body>