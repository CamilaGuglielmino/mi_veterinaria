<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/**VISTAS */
$routes->get('/', 'Vistas::index');
$routes->get('/inicio', 'Vistas::index');
$routes->get('/altas', 'Vistas::vistaAlta');
$routes->get('/bajas', 'Vistas::vistaBaja');
$routes->get('/modificaciones', 'Vistas::vistaModificar');
$routes->get('/mpostrar', 'Vistas::vistaMostrar');
/**FORMULARIOS */
$routes->post('Mascotas/alta', 'Mascotas::alta');
$routes->post('Veterinarios/alta', 'Veterinarios::alta');
$routes->post('Amos/alta', 'Amos::alta');

