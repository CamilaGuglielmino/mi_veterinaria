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

        <form method="POST" action="<?= base_url('procesarModificacionA') ?>">
            <label for="amo_id">Seleccionar Amo:</label>
            <select name="amo_id" id="amo_id" onchange="cargarDatosAmo()">
                <option value="">Seleccione un amo</option>
                <?php foreach ($listaAmos as $amo): ?>
                    <option value="<?= esc($amo['id']) ?>" data-nombre="<?= esc($amo['nombre']) ?>"
                        data-apellido="<?= esc($amo['apellido']) ?>" data-telefono="<?= esc($amo['telefono']) ?>"
                        data-direccion="<?= esc($amo['direccion']) ?>">
                        <?= esc($amo['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <table id="tablaAmo" style="display: none;">
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" name="nombre" id="nombre"></td>
                </tr>
                <tr>
                    <td><label for="apellido">Apellido:</label></td>
                    <td><input type="text" name="apellido" id="apellido"></td>
                </tr>
                <tr>
                    <td><label for="direccion">Dirección:</label></td>
                    <td><input type="text" name="direccion" id="direccion"></td>
                </tr>
                <tr>
                    <td><label for="telefono">Teléfono:</label></td>
                    <td><input type="text" name="telefono" id="telefono"></td>
                </tr>

            </table>

            <button type="submit">Actualizar</button>
        </form>
    </main>

    <script>
        function cargarDatosAmo() {
            let select = document.getElementById('amo_id');
            let selectedOption = select.options[select.selectedIndex];
            let nombre = selectedOption.getAttribute('data-nombre');
            let apellido = selectedOption.getAttribute('data-apellido');
            let direccion = selectedOption.getAttribute('data-direccion');
            let telefono = selectedOption.getAttribute('data-telefono');


            if (nombre) {
                document.getElementById('nombre').value = nombre;
                document.getElementById('apellido').value = apellido;
                document.getElementById('direccion').value = direccion;
                document.getElementById('telefono').value = telefono;

                document.getElementById('tablaAmo').style.display = 'table';
            } else {
                document.getElementById('tablaAmo').style.display = 'none';
            }
        }
    </script>
</body>