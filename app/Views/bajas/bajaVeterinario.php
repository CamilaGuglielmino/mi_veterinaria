<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('amosMostrar') ?>">Amos y Mascotas</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('veterinariosMostrar') ?>">Veterinarios</a></li>
            </ul>
        </nav>
<form method="POST" action="<?= base_url('bajaMascota') ?>">
    <label for="mascota_id">Seleccionar Mascota:</label>
    <select name="mascota_id" id="mascota_id">
        <?php foreach ($listaMascotas as $mascota): ?>
            <option value="<?= esc($mascota['nro_registro']) ?>">
                <?= esc($mascota['nombre']) ?> - <?= esc($mascota['especie']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="motivo">Motivo de Baja:</label>
    <select name="motivo" id="motivo">
        <option value="venta">Venta</option>
        <option value="fallecimiento">Fallecimiento</option>
    </select>

    <button type="submit">Registrar Baja</button>
</form>
</main>
</body>
