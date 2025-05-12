<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('amosMostrar') ?>">Amos</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('mascotasMostrar') ?>">Mascotas</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('veterinariosMostrar') ?>">Veterinarios</a></li>
            </ul>
        </nav>
        <h1>Médicos Veterinarios</h1>
        <form method="GET" action="<?= base_url('veterinariosBusqueda') ?>">
            <label for="veterinario">Seleccionar Veterinario:</label>
            <select name="veterinario" id="veterinario">
                <option value="">--Seleccione--</option>
                <option value="todos">Ver Todos</option> <!-- Opción para mostrar todos -->
                <?php foreach ($listaVeterinarios as $veterinario): ?>
                    <option value="<?= esc($veterinario['id']) ?>" <?= isset($veterinarioId) && $veterinarioId == $veterinario['id'] ? 'selected' : '' ?>>
                        <?= esc($veterinario['nombre']) ?>     <?= esc($veterinario['apellido']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>
        <?php if (!empty($veterinarios)): ?> <!-- Solo se muestra si hay resultados -->
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Especialidad</th>
                        <th>Teléfono</th>
                        <th>Fecha de Ingreso</th>
                        <th>Fecha de Egreso</th>
                        <th>Mascotas Atendidas</th>
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
                            <td><?= esc($veterinario['fecha_creacion']) ?></td>
                            <td><?= esc($veterinario['fecha_egreso'] ?: 'Activo') ?></td>
                            <td>
                                <?= !empty($veterinario['mascotas_atendidas']) ? esc($veterinario['mascotas_atendidas']) : 'Sin mascotas registradas' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?> <!-- Cierra la condición y oculta la tabla -->
    </main>
</body>