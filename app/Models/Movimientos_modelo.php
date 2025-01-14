<?php

namespace App\Models;

use CodeIgniter\Model;

class Movimientos_modelo extends Model
{
    protected $table = 'movimientos_stock';
    protected $primaryKey = 'id_movimiento';

    protected $allowedFields = ['id_producto', 'tipo', 'cantidad', 'fecha'];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
