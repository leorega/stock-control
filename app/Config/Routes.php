<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('listar-productos', 'MainController::listarProductos');
$routes->get('cargar-productos', 'MainController::cargarProductos');
$routes->get('salida-productos', 'MainController::salidaProductos');
