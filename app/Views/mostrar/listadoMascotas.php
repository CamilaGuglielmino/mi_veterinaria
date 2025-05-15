<body>
    <?php if (session()->has('mensaje')): ?>
        <div class="alert <?= strpos(session()->getFlashdata('mensaje'), 'Error') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show"
            role="alert">
            <?= esc(session()->getFlashdata('mensaje')) ?>
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
                    <a class="nav-link active" href="<?= base_url('mascotasMostrar') ?>">Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('veterinariosMostrar') ?>">Veterinarios</a>
                </li>
            </ul>
        </nav>

        <h2 class="text-center fw-bold my-4">Listado de Mascotas</h2>

        <form method="GET" action="<?= base_url('mascotasBusqueda') ?>" class="bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="mascota" class="form-label">Seleccionar Mascota:</label>
                <select name="mascota" id="mascota" class="form-select">
                    <option value="">--Seleccione--</option>
                    <option value="todos">Ver Todos</option>
                    <?php foreach ($listaMascotas as $mascota): ?>
                        <option value="<?= esc($mascota['nro_registro']) ?>" <?= isset($mascotaId) && $mascotaId == $mascota['nro_registro'] ? 'selected' : '' ?>>
                            <?= esc($mascota['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>

        <?php if (!empty($mascotas)): ?>
            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Edad</th>
                            <th>Fecha de Alta</th>
                            <th>Estado</th>
                            <th>Motivo</th>
                            <th>Fecha de Defunción</th>
                            <th>Amos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mascotas as $mascota): ?>
                            <?php $estado = ($mascota['estado'] === '1') ? 'Activo' : 'Baja'; ?>
                            <tr>
                                <td><?= esc($mascota['nombre']) ?></td>
                                <td><?= esc($mascota['especie']) ?></td>
                                <td><?= esc($mascota['raza']) ?></td>
                                <td><?= esc($mascota['edad']) ?></td>
                                <td><?= date("d/m/Y", strtotime(esc($mascota['fecha_alta']))) ?></td>
                                <td><?= $estado ?></td>
                                <td><?= !empty($mascota['motivo']) ? esc($mascota['motivo']) : 'Sin registro' ?></td>
                                <td><?= !empty($mascota['fecha_defuncion']) && $mascota['estado'] !== '1' ? date("d/m/Y", strtotime(esc($mascota['fecha_defuncion']))) : '-' ?></td>
                                <td><?= !empty($mascota['amos']) ? esc($mascota['amos']) : 'Sin historial' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
