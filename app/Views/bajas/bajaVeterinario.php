<?php if (isset($mensaje)): ?>
    <p class="success-message"><?= esc($mensaje) ?></p>
<?php endif; ?>

<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?= base_url('bajasMascotas') ?>">Mascotas</a></li>
                <li class="lista-interna"><a href="<?= base_url('bajasVeterinarios') ?>">Veterinarios</a></li>
            </ul>
        </nav>

        <form method="POST" action="<?= base_url('bajaVeterinario') ?>">
            <label for="veterinario_id">Seleccionar Veterinario:</label>
            <select name="veterinario_id" id="veterinario_id">
                <?php foreach ($listaVeterinarios as $veterinario): ?>
                    <option value="<?= esc($veterinario['id']) ?>">
                        <?= esc($veterinario['nombre']) ?> - <?= esc($veterinario['especialidad']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fecha_fin">Fecha de Baja:</label>
            <input type="date" name="fecha_fin" id="fecha_fin" required>

            <button type="submit">Registrar Baja</button>
        </form>
    </main>
</body>