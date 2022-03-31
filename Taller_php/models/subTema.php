<?php

namespace models;

use models\Model;

class SubTema extends Model
{
    protected $id;
    protected $nombre;
    protected $tema_id;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'sub_temas';
    }
}
