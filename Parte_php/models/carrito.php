<?php
namespace models;

use models\Model;

class Carrito extends Model
{
    protected $id;
    protected $producto_id;
    protected $cantidad;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'carrito';
    }
}