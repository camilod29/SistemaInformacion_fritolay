<?php
namespace controllers;

use controllers\BaseController;
use models\Producto;

class ProductoController extends BaseController
{

    public function index(){
        $model = new Producto();
        $rows = $model->all();
        return $rows;
    }
    public function detail($id){
        $model = new Producto();
        $row = $model->find($id);
        return $row;
    }
    public function create($request){
        $modelValidation = new Producto();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']]
        ]);
        if (count($data) > 0) {
            return "El código ya se cuentra registrado";
        }

        $model = new Producto();
        $model-> set('nombre',$request['nombre']);
        $model-> set('cantidad',$request['cantidad']);
        $model-> set('categoria',$request['categoria']);
        $model-> set('descripcion',$request['descripcion']);
        $model-> set('imagen',addslashes(file_get_contents($_FILES['imagen']['tmp_name'])));
        $model-> set('precio',$request['precio']);
        $status = $model->save();
        return $status ? 'Registro guardado':'Error al guardar el registro';
    }
    public function update($id, $request){
        $modelValidation = new Producto();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El código ya se cuentra registrado";
        }

        $model = new Producto();
        $model-> set('id',$id);
        $model-> set('nombre',$request['nombre']);
        $model-> set('cantidad',$request['cantidad']);
        $model-> set('categoria',$request['categoria']);
        $model-> set('descripcion',$request['descripcion']);
        $model-> set('imagen',$request['imagen']);
        $model-> set('precio',$request['precio']);
        $status = $model->update();
        return $status ? 'Registro actualizado':'Error al guardar el actualizado';
    }
    public function delete($id){
        $model = new Producto();
        $model-> set('id',$id);
        $status = $model->delete();
        return $status ? 'Registro eliminado':'Error al eliminar el registro';
    }
}