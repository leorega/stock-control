<?php

namespace App\Models;

use CodeIgniter\Model;

class Productos_modelo extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $allowedFields = ['nombre', 'categoria', 'precio', 'stock'];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
