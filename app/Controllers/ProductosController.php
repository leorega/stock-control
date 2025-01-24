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

            return redirect()->back()->withInput();
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

            return redirect()->back()->with('success', 'Producto cargado correctamente.');
        } catch (\Exception $e) {

            $db->transRollback();

            log_message('error', $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al cargar el producto.');
        }
    }

    public function salidaProductos(): string
    {
        $ProductosModelo = new \App\Models\Productos_modelo();

        $productos = $ProductosModelo->findAll();

        $data = [
            'productos' => $productos
        ];

        return view('salida_productos', $data);
    }

    public function confirmarSalidaProducto()
    {
        $ProductosModelo = new \App\Models\Productos_modelo();
        $MovimientosModelo = new \App\Models\Movimientos_modelo();

        $request = \Config\Services::request();

        $idProducto = $request->getPost('nombreProductoSalida');
        $cantidad = $request->getPost('cantidadProductoSalida');

        $reglas = [
            'nombreProductoSalida' => [
                'label' => 'Nombre',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_natural_no_zero' => 'Debe seleccionar un producto.'
                ]
            ],
            'cantidadProductoSalida' => [
                'label' => 'Cantidad',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_natural_no_zero' => 'Debe ingresar una cantidad.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput();
        };

        $producto = $ProductosModelo->find($idProducto);

        if ($producto['stock'] < $cantidad) {
            return redirect()->back()->with('error', 'No hay stock suficiente.');
        }

        $nuevaCantidad = $producto['stock'] - $cantidad;

        $db = \Config\Database::connect();

        $db->transBegin();

        try {

            $ProductosModelo->update($idProducto, [
                'stock' => $nuevaCantidad
            ]);

            $MovimientosModelo->insert([
                'id_producto' => $idProducto,
                'tipo' => 'salida',
                'cantidad' => $cantidad,
                'fecha' => date('Y-m-d H:i:s')
            ]);

            $db->transCommit();

            return redirect()->back()->with('success', 'Stock actualizado correctamente.');
        } catch (\Exception $e) {

            $db->transRollback();

            log_message('error', $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al intentar registrar la salida del producto.');
        }
    }

    public function eliminarProducto()
    {
        $ProductosModelo = new \App\Models\Productos_modelo();

        $request = \Config\Services::request();

        $idProducto = $request->getPost('idProductoEliminar');

        try {
            $ProductosModelo->delete($idProducto);

            return redirect()->back()->with('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el producto.');
        }
    }

    public function nuevoProducto()
    {
        $ProductosModelo = new \App\Models\Productos_modelo();

        $request = \Config\Services::request();

        $nombre = $request->getPost('nombreProductoNuevo');

        $reglas = [
            'nombreProductoNuevo' => [
                'label' => 'Nombre',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'min_length' => 'El campo {field} debe tener al menos 3 caracteres.',
                    'max_length' => 'El campo {field} debe tener menos de 100 caracteres.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {

            return redirect()->back()->withInput();
        };

        try {
            $ProductosModelo->insert([
                'nombre' => $nombre,
                'precio' => 0,
                'stock' => 0
            ]);

            return redirect()->back()->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrio un error al crear el producto.');
        }
    }

    public function editarProducto($idProducto)
    {
        $ProductosModelo = new \App\Models\Productos_modelo();
        $CategoriasModelo = new \App\Models\Categorias_modelo();

        $idProducto = $idProducto;

        $producto = $ProductosModelo->find($idProducto);
        $categorias = $CategoriasModelo->findAll();

        $data = [
            'producto' => $producto,
            'categorias' => $categorias
        ];

        return view('editar_producto', $data);
    }

    public function guardarProductoEditado()
    {
        $ProductosModelo = new \App\Models\Productos_modelo();

        $request = \Config\Services::request();

        $idProducto = $request->getPost('idProductoEditar');
        $nombreProducto = $request->getPost('nombreProductoEditar');
        $idCategoria = $request->getPost('categoriaProductoEditar');
        $stock = $request->getPost('stockProductoEditar');
        $precio = $request->getPost('precioProductoEditar');

        $reglas = [
            'nombreProductoEditar' => [
                'label' => 'Nombre',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'min_length' => 'El campo {field} debe tener al menos 3 caracteres.',
                    'max_length' => 'El campo {field} debe tener menos de 100 caracteres.'
                ]
            ],
            'stockProductoEditar' => [
                'label' => 'Stock',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'numeric' => 'El campo {field} debe ser un número.'
                ]
            ],
            'precioProductoEditar' => [
                'label' => 'Precio',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'numeric' => 'El campo {field} debe ser un número.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput();
        };

        try {
            $ProductosModelo->update($idProducto, [
                'nombre' => $nombreProducto,
                'id_categoria' => $idCategoria,
                'stock' => $stock,
                'precio' => $precio
            ]);

            return redirect()->to('listar-productos')->with('success', 'Producto editado correctamente.');
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al editar el producto.');
        }
    }

    public function informesProductos()
    {
        $MovimientosModelo = new \App\Models\Movimientos_modelo();

        $movimientos = $MovimientosModelo->devolverMovimientosConProducto();

        $data = [
            'movimientos' => $movimientos
        ];

        return view('informes_productos', $data);
    }
}
