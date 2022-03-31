<?php

namespace controllers;

use controllers\BaseController;
use models\LibroSubTema;
use models\SubTema;

class SubTemaController extends BaseController
{
    public function index()
    {
        $model = new SubTema();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $sub = explode(',',$id);
        if($sub[1]=="buscar"){
            $model = new SubTema();
            $subtema = $model->where([
            ['nombre', 'LIKE', '%'.$sub[0].'%']
            ]);
            $idsubTema = $subtema[0]->get('id');
            $row =  $model->find($idsubTema);
            return $row;
        }else{
            $model = new SubTema();
            $row =  $model->find($sub[0]);
        return $row;
        }
    }

    public function create($request)
    {

        $model = new SubTema();
        $model->set('nombre', $request['nombre']);
        $model->set('tema_id',  $request['tema_id']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $model = new SubTema();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $model->set('tema_id',  $request['tema_id']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $modelLibroSubTema = new LibroSubTema();
        $temas = $modelLibroSubTema->all();
        for($i=0;$i<count($temas);$i++){
            $librosbtemId=$temas[$i]->get('libro_id');
            $subtema_id=$temas[$i]->get('sub_tema_id');
            if($subtema_id==$id){
                $modelLibroSubTema->set('libro_id',$librosbtemId);
                $modelLibroSubTema->set('sub_tema_id',$subtema_id);
                $modelLibroSubTema->delete();
            }
        }

        $model = new SubTema();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
