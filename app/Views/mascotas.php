<body>
    <main>
        <div class="container" id="container">
            <div class="button">
                <button class="btn" data-number="1">Mascotas</button>
                <button class="btn" data-number="2">Alta Mascotas</button>
                <button class="btn" data-number="3">Modificar Mascotas</button>
                <button class="btn" data-number="4">Baja Mascotas</button>
                <button class="btn" data-number="5">Vinculos</button>
            </div>
            <div class="content">
                <div class="content_text" data-seccion="1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Especie</th>
                                <th>Edad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($datoMascota['dato'])): ?>
                                <?php foreach ($datoMascota['dato'] as $mascota): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($mascota['id']) ?></td>
                                        <td><?= htmlspecialchars($mascota['nombre']) ?></td>
                                        <td><?= htmlspecialchars($mascota['especie']) ?></td>
                                        <td><?= htmlspecialchars($mascota['edad']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No hay mascotas registradas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="content_text" data-seccion="2">
                    <h2 class="title">MASCOTAS</h2>
                    <form action="<?php echo base_url('Mascotas/alta') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Mascota</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="especie" class="form-label">Especie</label>
                            <select class="form-control" id="especie" name="especie" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Perro">Perro</option>
                                <option value="Gato">Gato</option>
                                <option value="Ave">Roedores</option>
                                <option value="Ave">Peces</option>
                                <option value="Ave">Ave</option>
                                <option value="Ave">Reptiles</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="raza" class="form-label">Raza</label>
                            <input type="text" class="form-control" id="raza" name="raza">
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" min="0" required>
                        </div>
                        <button type="submit" class="btn">Registrar Mascota</button>
                    </form>

                </div>
                <div class="content_text" data-seccion="3">
                </div>
                <div class="content_text" data-seccion="4">
                </div>
                <div class="content_text" data-seccion="5">
                </div>
            </div>
        </div>
    </main>
</body>