<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('amosMostrar') ?>">Amos</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('mascotasMostrar') ?>">Mascotas</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('veterinariosMostrar') ?>">Veterinarios</a></li>
            </ul>
        </nav>
        <h1>Listado de Mascotas</h1>

        <form method="GET" action="<?= base_url('mascotasBusqueda') ?>">
            <label for="mascota">Seleccionar Veterinario:</label>
            <select name="mascota" id="mascota">
                <option value="">--Seleccione--</option>
                <option value="todos">Ver Todos</option> <!-- Opción para mostrar todos -->
                <?php foreach ($listaMascotas as $mascota): ?>
                    <option value="<?= esc($mascota['nro_registro']) ?>" <?= isset($mascotaId) && $mascotaId == $mascota['nro_registor'] ? 'selected' : '' ?>>
                        <?= esc($mascota['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>


        <?php if (!empty($mascotas)): ?> <!-- Solo se muestra si hay resultados -->
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Edad</th>
                        <th>Fecha de Alta</th>
                        <th>Fecha de Defunción</th>
                        <th>Amos</th> <!-- Nueva columna -->
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($mascotas as $mascota): ?>
                        <tr>
                            <td><?= esc($mascota['nombre']) ?></td>
                            <td><?= esc($mascota['especie']) ?></td>
                            <td><?= esc($mascota['raza']) ?></td>
                            <td><?= esc($mascota['edad']) ?></td>
                            <td><?= esc($mascota['fecha_alta']) ?></td>
                            <td><?= esc($mascota['fecha_defuncion'] ?: 'N/A') ?></td>
                            <td>
                                <?= isset($mascota['amos']) && !empty($mascota['amos']) ? $mascota['amos'] : 'Sin historial' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php endif; ?> <!-- Cierra la condición y oculta la tabla -->

    </main>
</body>