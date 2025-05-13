<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('amosMostrar') ?>">Amos</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('mascotasMostrar') ?>">Mascotas</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('veterinariosMostrar') ?>">Veterinarios</a></li>
            </ul>
        </nav>


        <h1>Lista de Amos</h1>
        <form method="GET" action="<?= base_url('amosBusqueda') ?>">
            <label for="amo">Seleccionar amo:</label>
            <select name="amo" id="amo">
                <option value="">--Seleccione--</option>
                <option value="todos">Ver Todos</option>
                <?php foreach ($listaAmos as $amo): ?>
                    <option value="<?= esc($amo['id']) ?>" <?= isset($amoId) && $amoId == $amo['id'] ? 'selected' : '' ?>>
                        <?= esc($amo['nombre']) ?>     <?= esc($amo['apellido']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>

        
        <?php if (!empty($amos)): ?> <!-- Solo se muestra si hay resultados -->
            <table class="styled-table">
                <thead>
                    <tr>
                        <<tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Fecha de Alta</th>
                            <th>Mascotas</th> <!-- Nueva columna -->
                    </tr>
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
                            <td><?= !empty($amo['mascotas']) ? esc($amo['mascotas']) : 'Sin mascotas registradas' ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?> <!-- Cierra la condición y oculta la tabla -->
    </main>


</body>