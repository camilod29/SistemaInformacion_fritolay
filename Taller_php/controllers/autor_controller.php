<?php

namespace controllers;

use controllers\BaseController;
use models\Autor;
use models\AutorLibro;

class AutorController extends BaseController
{
    public function index()
    {
        $model = new Autor();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $autores = explode(',',$id);
        if($autores[1]=="buscar"){
            $model = new Autor();
            $autor = $model->where([
            ['nombre', 'LIKE', '%'.$autores[0].'%']
            ]);
                $idAutor = $autor[0]->get('id');
                $row =  $model->find($idAutor);
                return $row;
            
            
        }else{
            $model = new Autor();
            $row =  $model->find($autores[0]);
        return $row;
        }
    }


    public function create($request)
    {

        $model = new Autor();
        $model->set('nombre', $request['nombre']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $model = new Autor();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $modelAutor = new AutorLibro();
        $autores =  $modelAutor->all();
        for($i=0;$i<count($autores);$i++){
            $libroId=$autores[$i]->get('libro_id');
            $autor_id=$autores[$i]->get('autor_id');
            if($autor_id==$id){
                $modelAutor->set('libro_id',$libroId);
                $modelAutor->set('autor_id',$autor_id);
                $modelAutor->delete();
            }
        }

        $model = new Autor();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
