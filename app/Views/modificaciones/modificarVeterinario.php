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

        <form method="POST" action="<?= base_url('procesarModificacionV') ?>">
            <label for="tablaVeterinario">Seleccionar Veterinario:</label>
            <select name="veterinario_id" id="veterinario_id" onchange="cargarDatosMascota()">
                <option value="">Seleccione un veterinario</option>
                <?php foreach ($listaVeterinarios as $veterinario): ?>
                    <option value="<?= esc($veterinario['id']) ?>" 
                        data-nombre="<?= esc($veterinario['nombre']) ?>"
                        data-apellido="<?= esc($veterinario['apellido']) ?>" data-especialidad="<?= esc($veterinario['especialidad']) ?>"
                        data-telefono="<?= esc($veterinario['telefono']) ?>">
                        <?= esc($veterinario['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <table id="tablaVeterinario" style="display: none;">
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" name="nombre" id="nombre"></td>
                </tr>
                <tr>
                    <td><label for="apellido">Apellido:</label></td>
                    <td><input type="text" name="apellido" id="apellido"></td>
                </tr>
                <tr>
                    <td><label for="especialidad">Especialidad:</label></td>
                    <td><input type="text" name="especialidad" id="especialidad"></td>
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
        function cargarDatosMascota() {
            let select = document.getElementById('veterinario_id');
            let selectedOption = select.options[select.selectedIndex];
            let nombre = selectedOption.getAttribute('data-nombre');
            let especialidad = selectedOption.getAttribute('data-especialidad');
            let apellido = selectedOption.getAttribute('data-apellido');
            let telefono = selectedOption.getAttribute('data-telefono');


            if (nombre) {
                document.getElementById('nombre').value = nombre;
                document.getElementById('especialidad').value = especialidad;
                document.getElementById('apellido').value = apellido;
                document.getElementById('telefono').value = telefono;

                document.getElementById('tablaVeterinario').style.display = 'table';
            } else {
                document.getElementById('tablaVeterinario').style.display = 'none';
            }
        }
    </script>
</body>