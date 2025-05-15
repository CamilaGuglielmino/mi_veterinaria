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
                    <a class="nav-link active" href="<?= base_url('amosMostrar') ?>">Amos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('mascotasMostrar') ?>">Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('veterinariosMostrar') ?>">Veterinarios</a>
                </li>
            </ul>
        </nav>

        <h2 class="text-center fw-bold my-4">Lista de Amos</h2>

        <form method="GET" action="<?= base_url('amosBusqueda') ?>" class="bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="amo" class="form-label">Seleccionar Amo:</label>
                <select name="amo" id="amo" class="form-select">
                    <option value="">--Seleccione--</option>
                    <option value="todos">Ver Todos</option>
                    <?php foreach ($listaAmos as $amo): ?>
                        <option value="<?= esc($amo['id']) ?>" <?= isset($amoId) && $amoId == $amo['id'] ? 'selected' : '' ?>>
                            <?= esc($amo['nombre']) ?> <?= esc($amo['apellido']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>

        <?php if (!empty($amos)): ?> 
            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Fecha de Alta</th>
                            <th>Mascotas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($amos as $amo): ?>
                            <tr>
                                <td><?= esc($amo['id']) ?></td>
                                <td><?= esc($amo['nombre']) ?></td>
                                <td><?= esc($amo['direccion']) ?></td>
                                <td><?= esc($amo['telefono']) ?></td>
                               
                                <td><?= date("d/m/Y", strtotime(esc($amo['fecha_alta']))) ?></td>

                                <td><?= !empty($amo['mascotas']) ? esc($amo['mascotas']) : 'Sin mascotas registradas' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?> 
    </main>
</body>
