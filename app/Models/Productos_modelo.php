<?php

namespace App\Models;

use CodeIgniter\Model;

class Productos_modelo extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nombre', 'id_categoria', 'precio', 'stock'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function devolverProductosConCategoria()
    {
        return $this->db->table('productos')
            ->select('productos.id, productos.nombre, categorias.nombre as categoria, productos.precio, productos.stock')
            ->join('categorias', 'productos.id_categoria = categorias.id', 'left')
            ->where('productos.deleted_at', null)
            ->get()->getResultArray();
    }
}
