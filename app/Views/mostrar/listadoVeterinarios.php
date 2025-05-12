<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('altas') ?>">Mascotas y Amos</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('altasVeterinario') ?>">Veterinarios</a></li>
            </ul>
        </nav>
<h1>Listado de Veterinarios</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Teléfono</th>
                <th>Fecha de Ingreso</th>
                <th>Fecha de Egreso</th>
                <th>Mascotas Atendidas</th> <!-- Nueva columna -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veterinarios as $veterinario): ?>
            <tr>
                <td><?= esc($veterinario['id']) ?></td>
                <td><?= esc($veterinario['nombre']) ?></td>
                <td><?= esc($veterinario['especialidad']) ?></td>
                <td><?= esc($veterinario['telefono']) ?></td>
                <td><?= esc($veterinario['fecha_ingreso']) ?></td>
                <td><?= esc($veterinario['fecha_egreso'] ?: 'Activo') ?></td>
                <td>
                    <?php 
                    if (!empty($veterinario['mascotas'])) {
                        echo implode(', ', array_column($veterinario['mascotas'], 'nombre'));
                    } else {
                        echo "Sin mascotas registradas";
                    }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>