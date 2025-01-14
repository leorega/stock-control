<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index(): string
    {
        return view('navegacion');
    }

    public function listarProductos(): string
    {

        $ProductosModelo = new \App\Models\Productos_modelo();

        $productos = $ProductosModelo->findAll();

        $data = [
            'productos' => $productos
        ];

        return view('lista_productos', $data);
    }

    public function cargarProductos(): string
    {
        return view('carga_productos');
    }

    public function salidaProductos(): string
    {
        return view('salida_productos');
    }
}
