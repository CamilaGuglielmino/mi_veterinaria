<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/**VISTAS */
$routes->get('/', 'Vistas::index');
$routes->get('/inicio', 'Vistas::index');
$routes->get('/altas', 'Vistas::vistaAlta');
$routes->get('/altasVeterinario', 'Veterinarios::vista');
$routes->get('altasVeterinario', 'Veterinarios::vista');


/**MOSTRAR*/
$routes->get('/mostrar', 'Vinculos::mostrarA');
$routes->get('amosMostrar', 'Amos::obtenerAmos');
$routes->get('mascotasMostrar', 'Mascotas::obtenerMascotas');
$routes->get('veterinariosMostrar', 'Veterinarios::obtenerVeterinarios');

/** BAJAS*/

$routes->get('/bajas', 'Mascotas::cargarBajaMascotas');
$routes->get('/bajasMascotas', 'Mascotas::cargarBajaMascotas');
$routes->get('/bajasVeterinarios', 'Veterinarios::cargarBajaVeterinarios');
$routes->post('bajaVeterinario', 'Veterinarios::bajaVeterinarios');
$routes->post('bajaMascota', 'Vinculos::bajaMascota');




$routes->get('/mascotas', 'Mascotas::mostrar');
$routes->get('/mascotas', 'Mascotas::alta');


/**FORMULARIOS */
$routes->post('alta', 'Mascotas::alta');
$routes->post('formularioAlta', 'Veterinarios::alta');
$routes->post('Amos/alta', 'Amos::alta');
$routes->post('altaVinculo', 'Vinculos::alta');


/**busqueda */
$routes->get('veterinariosBusqueda', 'Vinculos::mostrarV');
$routes->get('amosBusqueda', 'Vinculos::mostrarA');
$routes->get('mascotasBusqueda', 'Vinculos::mostrarM');

/**MOFICACIONES*/
$routes->get('/modificaciones', 'Vistas::vistaModificar');
$routes->get('/modificarAmo', 'Vistas::vistaModificar');
$routes->get('/modificarMascota', 'Mascotas::vistaModificar');
$routes->get('/modificarVeterinario', 'Veterinarios::vistaModificar');
$routes->post('procesarModificacionA', 'Amos::modificar');
$routes->post('procesarModificacionM', 'Mascotas::modificar');
$routes->post('procesarModificacionV', 'Veterinarios::modificar');






