<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('altas') ?>">Mascotas y Amos</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('altasVeterinario') ?>">Veterinarios</a></li>
            </ul>
        </nav>


<h1>Lista de Amos</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Fecha de Alta</th>
                <th>Mascotas</th> <!-- Nueva columna -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($amos as $amo): ?>
            <tr>
                <td><?= esc($amo['id']) ?></td>
                <td><?= esc($amo['nombre']) ?></td>
                <td><?= esc($amo['direccion']) ?></td>
                <td><?= esc($amo['telefono']) ?></td>
                <td><?= esc($amo['fecha_alta']) ?></td>
                <td>
                    <?php 
                    if (!empty($amo['mascotas'])) {
                        echo implode(', ', array_column($amo['mascotas'], 'nombre'));
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