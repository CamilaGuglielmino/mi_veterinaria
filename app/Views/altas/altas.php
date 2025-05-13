
<?php $session = session(); ?>
<?php $validation = session('validation'); ?>
<?php if (isset($mensaje)): ?>
    <p class="success-message"><?= esc($mensaje) ?></p>
<?php endif; ?>
<body>
    <main>
        <nav class="nav">
            <ul class="nav-n">
                <li class="lista-interna"><a href="<?php echo base_url('altas') ?>">Mascotas y Amos</a></li>
                <li class="lista-interna"><a href="<?php echo base_url('altasVeterinario') ?>">Veterinarios</a></li>
            </ul>
        </nav>

        <div class="tab-content">
            <div id="vinculos" class="tab-pane active">
                <form action="<?php echo base_url('altaVinculo') ?>" method="POST">
                    <p class="titulos">Mascotas y Amos</p>

                    <!-- Selección de mascota -->
                    <div class="mb-3">
                        <label for="id_mascota" class="form-label">Nombre de la Mascota</label>
                        <select class="form-control" id="id_mascota" name="id_mascota" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($datoMascota as $mascota): ?>
                                <option value="<?= htmlspecialchars($mascota['nro_registro']) ?>">
                                    <?= htmlspecialchars($mascota['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <h6>Si la mascota no está registrada, <button type="button"
                                onclick="mostrarModal('mascotaModal')">
                                Registrar Mascota
                            </button></h6>
                    </div>

                    <!-- Selección de amo -->
                    <div class="mb-3">
                        <label for="id_amo" class="form-label">Nombre del Amo</label>
                        <select class="form-control" id="id_amo" name="id_amo" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($datoAmo as $amo): ?>
                                <option value="<?= htmlspecialchars($amo['id']) ?>">
                                    <?= htmlspecialchars($amo['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <h6>Si la Propietario no está registrado, <button type="button"
                                onclick="mostrarModal('amoModal')">
                                Registrar Propietarios
                            </button></h6>
                    </div>

                    <button type="submit" id="tabla">Registrar Vínculo</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Modal de Mascota -->
    <div id="mascotaModal" class="modal">
        <div class="modal-contenido">
            <span onclick="cerrarModal('mascotaModal')" class="cerrar">&times;</span>
            <h2>Registrar Mascota</h2>
            <form action="<?php echo base_url('alta') ?>" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>

                <label for="especie">Especie:</label>
                <select name="especie">
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Ave">Ave</option>
                    <option value="Reptil">Reptil</option>
                </select>

                <label for="raza">Raza:</label>
                <input type="text" name="raza">

                <label for="edad">Edad:</label>
                <input type="number" name="edad">

                <button type="submit">Registrar Mascota</button>
            </form>
        </div>
    </div>
    <!-- Modal de Amo -->
    <div id="amoModal" class="modal">
        <div class="modal-contenido">
            <span onclick="cerrarModal('amoModal')" class="cerrar">&times;</span>
            <h2>Registrar Propietario</h2>
            <form action="<?php echo base_url('Amos/alta') ?>" method="POST">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <?php if (!empty($validation) && $validation->hasError('nombre')): ?>
                    <span class="help-block"><?= esc($validation->getError('nombre')) ?></span>
                <?php endif; ?>
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <?php if (!empty($validation) && $validation->hasError('apellido')): ?>
                    <span class="help-block"><?= esc($validation->getError('apellido')) ?></span>
                <?php endif; ?>
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" name="direccion" placeholder="Teléfono">
                <?php if (!empty($validation) && $validation->hasError('direccion')): ?>
                    <span class="help-block"><?= esc($validation->getError('direccion')) ?></span>
                <?php endif; ?>
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="text" name="telefono" placeholder="Teléfono">
                <?php if (!empty($validation) && $validation->hasError('telefono')): ?>
                    <span class="help-block"><?= esc($validation->getError('telefono')) ?></span>
                <?php endif; ?>
                <button type="submit" id="tabla">Registrar Propietario</button>
            </form>

        </div>
    </div>
    <!-- Estilos -->
    <style>
       
    </style>

    <!-- Scripts -->
    <script>
        function mostrarModal(id) {
            document.getElementById(id).style.display = "flex";
        }

        function cerrarModal(id) {
            document.getElementById(id).style.display = "none";
        }

        // Cerrar modal con la tecla ESC
        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                cerrarModal("mascotaModal");
                cerrarModal("amoModal");
            }
        });
    </script>
</body>