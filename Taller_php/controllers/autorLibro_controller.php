<?php

namespace controllers;

use controllers\BaseController;
use models\AutorLibro;

class AutorLibroController extends BaseController
{
    public function index()
    {
        $model = new AutorLibro();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new AutorLibro();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $model = new AutorLibro();
        $model->set('libro_id', $request['libro_id']);
        $model->set('autor_id',  $request['autor_id']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $model = new AutorLibro();
        $model->set('libro_id', $id);
        $model->set('autor_id',  $request['autor_id']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $model = new AutorLibro();
        $autores =  $model->all();
        for($i=0;$i<count($autores);$i++){
            $libroId=$autores[$i]->get('libro_id');
            $autor_id=$autores[$i]->get('autor_id');
            if($libroId==$id){
                $model->set('libro_id',$libroId);
                $model->set('autor_id',$autor_id);
                $status = $model->delete();
            }
        }
       // return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}