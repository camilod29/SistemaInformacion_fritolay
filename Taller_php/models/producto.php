<?php
namespace models;

use models\Model;

class Producto extends Model
{
    protected $id;
    protected $nombre;
    protected $cantidad;
    protected $categoria;
    protected $descripcion;
    protected $imagen;
    protected $precio;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'productos';
    }
}