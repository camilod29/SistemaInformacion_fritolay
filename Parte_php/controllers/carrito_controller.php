<?php
namespace controllers;

use controllers\BaseController;
use models\Carrito;
use models\Productos;

class CarritoController extends BaseController
{

    public function index(){
        $model = new Carrito();
        $rows = $model->all();
        return $rows;
    }
    public function detail($id){
        $model = new Carrito();
        $row = $model->find($id);
        return $row;
    }
    public function create($request){
        $modelValidation = new Carrito();

        $model = new Carrito();
        $model-> set('producto_id',$request['producto_id']);
        $model-> set('cantidad',$request['cantidad']);
        $status = $model->save();
        return $status ? 'Registro guardado':'Error al guardar el registro';
    }
    public function update($id, $request){
        $modelValidation = new Carrito();

        $model = new Carrito();
        $model-> set('id',$id);
        $model-> set('producto_id',$request['producto_id']);
        $model-> set('cantidad',$request['cantidad']);
        $status = $model->update();
        return $status ? 'Registro actualizado':'Error al guardar el actualizado';
    }
    public function delete($id){
        $model = new Carrito();
        $model-> set('id',$id);
        $status = $model->delete();
        return $status ? 'Registro eliminado':'Error al eliminar el registro';
    }
}