<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('listar-productos', 'ProductosController::listarProductos');
$routes->get('cargar-productos', 'ProductosController::cargarProductos');
$routes->get('salida-productos', 'ProductosController::salidaProductos');
$routes->get('editar-producto/(:num)', 'ProductosController::editarProducto/$1');
$routes->get('informes-productos', 'ProductosController::informesProductos');

$routes->post('guardar-productos', 'ProductosController::guardarProductos');
$routes->post('nuevo-producto', 'ProductosController::nuevoProducto');
$routes->post('nueva-categoria', 'CategoriasController::nuevaCategoria');
$routes->post('eliminar-producto', 'ProductosController::eliminarProducto');
$routes->post('guardar-producto-editado', 'ProductosController::guardarProductoEditado');
$routes->post('confirmar-salida-producto', 'ProductosController::confirmarSalidaProducto');
