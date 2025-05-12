<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('altas') ?>">Mascotas y Amos</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('altasVeterinario') ?>">Veterinarios</a></li>
            </ul>
        </nav>


<h1>Listado de Mascotas</h1>
<table class="styled-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Raza</th>
            <th>Registro</th>
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
            <td><?= esc($mascota['registro']) ?></td>
            <td><?= esc($mascota['edad']) ?></td>
            <td><?= esc($mascota['fecha_alta']) ?></td>
            <td><?= esc($mascota['fecha_defuncion'] ?: 'N/A') ?></td>
            <td><?= implode(', ', $mascota['amos']) ?></td> <!-- Mostrar relación -->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</main>
</body>