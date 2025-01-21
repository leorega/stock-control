<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('listar-productos', 'ProductosController::listarProductos');
$routes->get('cargar-productos', 'ProductosController::cargarProductos');
$routes->get('salida-productos', 'ProductosController::salidaProductos');

$routes->post('guardar-productos', 'ProductosController::guardarProductos');
