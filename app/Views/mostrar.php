<h1>Listado de Mascotas</h1>
<table>
    <tr>
        <th>Nombre</th>
        <th>Especie</th>
        <th>Raza</th>
        <th>Registro</th>
        <th>Edad</th>
        <th>Fecha de Alta</th>
        <th>Fecha de Defunción</th>
    </tr>
    <?php foreach ($mascotas as $mascota): ?>
    <tr>
        <td><?= $mascota['nombre'] ?></td>
        <td><?= $mascota['especie'] ?></td>
        <td><?= $mascota['raza'] ?></td>
        <td><?= $mascota['registro'] ?></td>
        <td><?= $mascota['edad'] ?></td>
        <td><?= $mascota['fecha_alta'] ?></td>
        <td><?= $mascota['fecha_defuncion'] ?: 'N/A' ?></td>
    </tr>
    <?php endforeach; ?>
</table>