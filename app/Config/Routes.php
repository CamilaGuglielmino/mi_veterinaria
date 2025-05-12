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



$routes->get('/bajas', 'Vistas::vistaBaja');
$routes->get('/modificaciones', 'Vistas::vistaModificar');
$routes->get('/mostrar', 'Vistas::vistaMostrar');

$routes->get('/mascotas', 'Mascotas::mostrar');
$routes->get('/mascotas', 'Mascotas::alta');


/**FORMULARIOS */
$routes->post('Mascotas/alta', 'Mascotas::alta');
$routes->post('Veterinarios/alta', 'Veterinarios::alta');
$routes->post('Amos/alta', 'Amos::alta');
$routes->post('VinculoAmoMascota/alta', 'VinculoAmoMascota::alta');
$routes->post('VinculoVeterinariaMascota/alta', 'VinculoVeterinariaMascota::alta');

