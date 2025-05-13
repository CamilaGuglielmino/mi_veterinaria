<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?= base_url('modificarAmo') ?>">Modificar Amo</a></li>
                <li class="lista-interna"><a href="<?= base_url('modificarMascota') ?>">Modificar Mascota</a></li>
                <li class="lista-interna"><a href="<?= base_url('modificarVeterinario') ?>">Modificar Veterinario</a>
                </li>
            </ul>
        </nav>

        <form method="POST" action="<?= base_url('procesarModificacionM') ?>">
            <label for="tablaMascota">Seleccionar Mascota:</label>
            <select name="mascota_id" id="mascota_id" onchange="cargarDatosMascota()">
                <option value="">Seleccione una mascota</option>
                <?php foreach ($listaMascostas as $mascota): ?>
                    <option value="<?= esc($mascota['nro_registro']) ?>" 
                        data-nombre="<?= esc($mascota['nombre']) ?>"
                        data-especie="<?= esc($mascota['especie']) ?>" data-raza="<?= esc($mascota['raza']) ?>"
                        data-edad="<?= esc($mascota['edad']) ?>">
                        <?= esc($mascota['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <table id="tablaMascota" style="display: none;">
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" name="nombre" id="nombre"></td>
                </tr>
                <tr>
                    <td><label for="especie">Especie:</label></td>
                    <td><input type="text" name="especie" id="especie"></td>
                </tr>
                <tr>
                    <td><label for="raza">Raza:</label></td>
                    <td><input type="text" name="raza" id="raza"></td>
                </tr>
                <tr>
                    <td><label for="edad">Edad:</label></td>
                    <td><input type="text" name="edad" id="edad"></td>
                </tr>

            </table>

            <button type="submit">Actualizar</button>
        </form>
    </main>

    <script>
        function cargarDatosMascota() {
            let select = document.getElementById('mascota_id');
            let selectedOption = select.options[select.selectedIndex];
            let nombre = selectedOption.getAttribute('data-nombre');
            let especie = selectedOption.getAttribute('data-especie');
            let raza = selectedOption.getAttribute('data-raza');
            let edad = selectedOption.getAttribute('data-edad');


            if (nombre) {
                document.getElementById('nombre').value = nombre;
                document.getElementById('especie').value = especie;
                document.getElementById('raza').value = raza;
                document.getElementById('edad').value = edad;

                document.getElementById('tablaMascota').style.display = 'table';
            } else {
                document.getElementById('tablaMascota').style.display = 'none';
            }
        }
    </script>
</body>