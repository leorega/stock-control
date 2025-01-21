<?php

namespace App\Controllers;

class ProductosController extends BaseController
{
    public function listarProductos(): string
    {

        $ProductosModelo = new \App\Models\Productos_modelo();

        $productos = $ProductosModelo->devolverProductosConCategoria();

        $data = [
            'productos' => $productos
        ];

        return view('lista_productos', $data);
    }

    public function cargarProductos(): string
    {
        $ProductosModelo = new \App\Models\Productos_modelo();
        $CategoriasModelo = new \App\Models\Categorias_modelo();

        $productos = $ProductosModelo->findAll();
        $categorias = $CategoriasModelo->findAll();

        $data = [
            'productos' => $productos,
            'categorias' => $categorias
        ];

        return view('carga_productos', $data);
    }

    public function guardarProductos()
    {
        $ProductosModelo = new \App\Models\Productos_modelo();
        $MovimientosModelo = new \App\Models\Movimientos_modelo();
        $db = \Config\Database::connect();

        $request = \Config\Services::request();

        $idProducto = $request->getPost('nombre');
        $idCategoria = $request->getPost('categoria');
        $cantidad = $request->getPost('cantidad');

        $reglas = [
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_natural_no_zero' => 'Debe seleccionar un producto.'
                ]
            ],
            'categoria' => [
                'label' => 'Categoria',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_natural_no_zero' => 'Debe seleccionar una categoría.'
                ]
            ],
            'cantidad' => [
                'label' => 'Cantidad',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_natural_no_zero' => 'Debe ingresar una cantidad.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {

            return redirect()->to('cargar-productos')->withInput();
        };

        $producto = $ProductosModelo->find($idProducto);

        $nuevaCantidad = $producto['stock'] + $cantidad;

        $db->transBegin();

        try {

            $ProductosModelo->update($idProducto, [
                'id_categoria' => $idCategoria,
                'stock' => $nuevaCantidad
            ]);

            $MovimientosModelo->insert([
                'id_producto' => $idProducto,
                'tipo' => 'entrada',
                'cantidad' => $cantidad,
                'fecha' => date('Y-m-d H:i:s')
            ]);

            $db->transCommit();

            return redirect()->to('cargar-productos')->with('success', 'Producto cargado correctamente.');
        } catch (\Exception $e) {

            $db->transRollback();

            log_message('error', $e->getMessage());

            return redirect()->to('cargar-productos')->with('error', 'Ocurrió un error al cargar el producto.');
        }
    }

    public function salidaProductos(): string
    {
        return view('salida_productos');
    }
}
