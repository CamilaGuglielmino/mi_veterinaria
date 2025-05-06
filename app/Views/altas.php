<!--En la vista Alta, deberá permitir registrar un par Amo- Mascota. Si ambos ya
están cargados, solo se deberá cargar la relación Amo-Mascota, en caso
contrario, previamente se deberá dar de alta el amo y/o la mascota. En el caso
de los veterinarios, deberá registrar los datos personales y especialidad de un
nuevo médico veterinario. 
-->
<script src="js/scripts.js"></script>


<body>
    <main>
        <div class="container" id="container">
            <div class="button">
                <button class="btn" data-number="1">Amos-Mascotas</button>
                <button class="btn" data-number="2">Mascotas-Veterinarios</button>
                <button class="btn" data-number="3">AMOS</button>
                <button class="btn" data-number="4">MASCOTAS</button>
                <button class="btn" data-number="5">VETERINARIOS</button>

            </div>

            <div class="content">

                <div class="content_text block" data-seccion="1">
                    <h2 class="title">Amos-Mascotas</h2>
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
                            <label for="nro_registro" class="form-label">Número de Registro</label>
                            <input type="text" class="form-control" id="nro_registro" name="nro_registro" required>
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" min="0" required>
                        </div>
                        <button type="submit" class="btn">Registrar Mascota</button>
                    </form>

                </div>
                <div class="content_text" data-seccion="2">
                    <h2 class="title">MASCOTAS Y VETERINARIOS</h2>
                    <button class="btn" id="opcion1"></button>
                    <button class="btn" id="opcion2"></button>

                    <form action="<?php echo base_url('Mascotas/alta') ?>" method="POST">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Mascota:</label>
                            <select class="form-control" id="nombre" name="nombre" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Perro">Animales de domesticos</option>
                                <option value="Gato">Animales de producción</option>
                                <option value="Ave">Animales exóticos</option>
                                <option value="Ave">Especialidades clínicas</option>
                                <option value="Ave">Especialidades de laboratorio</option>
                                <option value="Ave">Salud pública veterinaria</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <button type="submit" class="btn">Registrar Mascota</button>
                    </form>

                    </b>
                </div>
                <div class="content_text" data-seccion="3">
                    <h2 class="title">AMOS</h2>
                    <form action="<?php echo base_url('Amos/alta') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre: /label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido: /label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección: /label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono: /label>
                                <input type="int" class="form-control" id="telefono" name="telefono" required>
                        </div>

                        <button type="submit" class="btn">Registrar Amo</button>
                    </form>

                </div>
            </div>
            <div class="content_text" data-seccion="4">
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
        </div>
        <div class="content_text" data-seccion="5">
            <h2 class=" title">VETERINARIOS</h2>
            <form action="<?php echo base_url('Veterinarios/alta') ?>" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre: /label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido: /label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad:</label>
                    <select class="form-control" id="especialidad" name="especialidad" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Perro">Animales de domesticos</option>
                        <option value="Gato">Animales de producción</option>
                        <option value="Ave">Animales exóticos</option>
                        <option value="Ave">Especialidades clínicas</option>
                        <option value="Ave">Especialidades de laboratorio</option>
                        <option value="Ave">Salud pública veterinaria</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="int" class="form-control" id="telefono" name="telefono">
                </div>
                <button type="submit" class="btn">Registrar Veterinario</button>
            </form>

        </div>
        </div>
        </div>
        </div>

        <script src="js/scripts.js"></script>

    </main>
</body>