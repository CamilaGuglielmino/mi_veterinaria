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
                    <a class="nav-link" href="<?= base_url('amosMostrar') ?>">Amos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('mascotasMostrar') ?>">Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('veterinariosMostrar') ?>">Veterinarios</a>
                </li>
            </ul>
        </nav>

        <h2 class="text-center fw-bold my-4">Médicos Veterinarios</h2>

        <form method="GET" action="<?= base_url('veterinariosBusqueda') ?>" class="bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="veterinario" class="form-label">Seleccionar Veterinario:</label>
                <select name="veterinario" id="veterinario" class="form-select">
                    <option value="none">--Seleccione--</option>
                    <option value="">Ver Todos</option>
                    <?php foreach ($listaVeterinarios as $veterinario): ?>
                        <option value="<?= esc($veterinario['id']) ?>" <?= isset($veterinarioId) && $veterinarioId == $veterinario['id'] ? 'selected' : '' ?>>
                            <?= esc($veterinario['nombre']) ?>     <?= esc($veterinario['apellido']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>

        <?php if (!empty($veterinarios)): ?>
            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Especialidad</th>
                            <th>Teléfono</th>
                            <th>Fecha de Ingreso</th>
                            <th>Fecha de Egreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($veterinarios as $veterinario): ?>
                            <tr>
                                <td><?= esc($veterinario['id']) ?></td>
                                <td><?= esc($veterinario['nombre']) ?></td>
                                <td><?= esc($veterinario['apellido']) ?></td>
                                <td><?= esc($veterinario['especialidad']) ?></td>
                                <td><?= esc($veterinario['telefono']) ?></td>
                                <td><?= date("d/m/Y", strtotime(esc($veterinario['fecha_creacion']))) ?></td>
                               <td><?= !empty($veterinario['fecha_egreso']) ? date("d/m/Y", strtotime(esc($veterinario['fecha_egreso']))) : 'Activo' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>