<?php

namespace App\Models;

use CodeIgniter\Model;

class Movimientos_modelo extends Model
{
    protected $table = 'movimientos_stock';
    protected $primaryKey = 'id_movimiento';

    protected $allowedFields = ['id_producto', 'tipo', 'cantidad', 'fecha'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function devolverMovimientosConProducto()
    {
        $this->select('movimientos_stock.*, productos.nombre as producto');
        $this->join('productos', 'productos.id = movimientos_stock.id_producto', 'left');
        $this->orderBy('movimientos_stock.fecha', 'DESC');
        return $this->findAll();
    }
}
