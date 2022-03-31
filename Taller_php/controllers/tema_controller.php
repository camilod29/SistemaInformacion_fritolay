<?php

namespace controllers;

use controllers\BaseController;
use controllers\SubTemaController;
use models\Tema;
use models\SubTema;

class TemaController extends BaseController
{
    public function index()
    {
        $model = new Tema();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $tem = explode(',',$id);
        if($tem[1]=="buscar"){
            $model = new Tema();
            $tema = $model->where([
            ['nombre', 'LIKE', '%'.$tem[0].'%']
            ]);
            $idTema = $tema[0]->get('id');
            $row =  $model->find($idTema);
            return $row;
        }else{
            $model = new Tema();
            $row =  $model->find($tem[0]);
        return $row;
        }
    }

    public function create($request)
    {

        $model = new Tema();
        $model->set('nombre', $request['nombre']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $model = new Tema();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $modelSubTC = new SubTemaController();
        $modelSubT = new SubTema();
        $subtemas =  $modelSubT->all();
        for($i=0;$i<count($subtemas);$i++){
            $SubId=$subtemas[$i]->get('id');
            $TemaId=$subtemas[$i]->get('tema_id');
            if($TemaId==$id){
                $modelSubTC->delete($SubId);
                
            }
        }

        $model = new Tema();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
