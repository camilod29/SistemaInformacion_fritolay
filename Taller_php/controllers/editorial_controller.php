<?php

namespace controllers;

use controllers\BaseController;
use controllers\LibroController;
use models\Editorial;
use models\Libro;

class EditorialController extends BaseController
{
    public function index()
    {
        $model = new Editorial();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Editorial();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {

        $model = new Editorial();
        $model->set('nombre', $request['nombre']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $model = new Editorial();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $modelLibroDel = new LibroController();
        $modelLibro = new Libro();
        $libros =  $modelLibro->all();
        for($i=0;$i<count($libros);$i++){
            $libroId=$libros[$i]->get('id');
            $editorialId=$libros[$i]->get('editorial_id');
            if($editorialId==$id){
                $modelLibroDel->delete($libroId);
                
            }
        }
        $model = new Editorial();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
