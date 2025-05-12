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

$routes->get('/modificaciones', 'Vistas::vistaModificar');

/**MOSTRAR*/
$routes->get('/mostrar', 'Vinculos::mostrarA');
$routes->get('amosMostrar', 'Amos::obtenerAmos');
$routes->get('mascotasMostrar', 'Mascotas::obtenerMascotas');
$routes->get('veterinariosMostrar', 'Veterinarios::obtenerVeterinarios');

/** BAJAS*/


$routes->get('/bajas', 'Vistas::cargarBajaMascotas');
$routes->post('/bajaMascota', 'Mascotas::bajaMascota');




$routes->get('/mascotas', 'Mascotas::mostrar');
$routes->get('/mascotas', 'Mascotas::alta');


/**FORMULARIOS */
$routes->post('Mascotas/alta', 'Mascotas::alta');
$routes->post('Veterinarios/alta', 'Veterinarios::alta');
$routes->post('Amos/alta', 'Amos::alta');
$routes->post('VinculoAmoMascota/alta', 'VinculoAmoMascota::alta');
$routes->post('VinculoVeterinariaMascota/alta', 'VinculoVeterinariaMascota::alta');


/**busqueda */
$routes->get('veterinariosBusqueda', 'Vinculos::mostrarV');
$routes->get('amosBusqueda', 'Vinculos::mostrarA');
$routes->get('mascotasBusqueda', 'Vinculos::mostrarM');

