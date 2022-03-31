<?php

namespace controllers;

use controllers\BaseController;
use models\AutorLibro;
use models\Libro;
use models\Tema;
use models\SubTema;
use models\LibroSubTema;

class LibroController extends BaseController
{
    public function index()
    {
        $model = new Libro();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $libr = explode(',',$id);
        if($libr[1]!="buscar"){
            $model = new Libro();
            $row =  $model->find($libr[0]);
            return $row;
        }else{
                $lib = explode(',',$id);
            if($lib[1]=="buscar"){
                $model = new Libro();
                $libro = $model->where([
                ['nombre', 'LIKE', '%'.$lib[0].'%']
                ]);
                if($libro==false){
                    $libro = $model->where([
                        ['descripcion', 'LIKE', '%'.$lib[0].'%']
                        ]);
                        if($libro==false){
                            $libro = $model->where([
                                ['fecha_publicacion', 'LIKE', '%'.$lib[0].'%']
                                ]);
                                if($libro==false){
                                    $libro = $model->where([
                                        ['edicion', 'LIKE', '%'.$lib[0].'%']
                                        ]);
                                }
                        }
                }
                $idlibro = $libro[0]->get('id');
                $row =  $model->find($idlibro);
                return $row;
        }
        
    }
}


    public function create($request)
    {        
        $autores_id = explode(',',$request['autores_id']);
        $model = new Libro();
        $model->set('nombre', $request['nombre']);
        $model->set('descripcion',  $request['descripcion']);
        $model->set('fecha_publicacion',  $request['fecha_publicacion']);
        $model->set('edicion',  $request['edicion']);
        $model->set('editorial_id',  $request['editorial_id']);
        $status = $model->save();

        $modelValidation = new Libro();
        $libro = $modelValidation->where([
            ['nombre', '=', $request['nombre']],
            ['descripcion', '=', $request['descripcion']],
            ['fecha_publicacion', '=', $request['fecha_publicacion']],
            ['edicion', '=', $request['edicion']],
            ['editorial_id', '=', $request['editorial_id']]
        ]);
        $idLibro = $libro[0]->get('id');

        for($i=0;$i<count($autores_id);$i++){
        $idAutor = $autores_id[$i];
        $modelAutor = new AutorLibro();
        $modelAutor->set('autor_id',$idAutor);
        $modelAutor->set('libro_id',$idLibro);
        $modelAutor->save();
        }

        $idsubtema = $request['subtema_id'];
        $modelLibroSubTema = new LibroSubTema();
        $modelLibroSubTema->set('sub_tema_id', $idsubtema);
        $modelLibroSubTema->set('libro_id', $idLibro);
        $modelLibroSubTema->save();
        

        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {
        $autores_id = explode(',',$request['autores_id']);
        $model = new Libro();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $model->set('descripcion',  $request['descripcion']);
        $model->set('fecha_publicacion',  $request['fecha_publicacion']);
        $model->set('edicion',  $request['edicion']);
        $model->set('editorial_id',  $request['editorial_id']);
        $status = $model->update();

        for($i=0;$i<count($autores_id);$i++){
            $idAutor = $autores_id[$i];
            $modelAutor = new AutorLibro();
            $modelAutor->set('autor_id',$idAutor);
            $modelAutor->set('libro_id',$id);
            $modelAutor->save();
        }
        $idsubtema = $request['subtema_id'];
        $modelLibroSubTema = new LibroSubTema();
        $modelLibroSubTema->set('sub_tema_id', $idsubtema);
        $modelLibroSubTema->set('libro_id', $id);
        $modelLibroSubTema->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $modelAutor = new AutorLibro();
        $autores =  $modelAutor->all();
        for($i=0;$i<count($autores);$i++){
            $libroId=$autores[$i]->get('libro_id');
            $autor_id=$autores[$i]->get('autor_id');
            if($libroId==$id){
                $modelAutor->set('libro_id',$libroId);
                $modelAutor->set('autor_id',$autor_id);
                $modelAutor->delete();
            }
        }
        $modelLibroSubTema = new LibroSubTema();
        $temas = $modelLibroSubTema->all();
        for($i=0;$i<count($temas);$i++){
            $librosbtemId=$temas[$i]->get('libro_id');
            $subtema_id=$temas[$i]->get('sub_tema_id');
            if($librosbtemId==$id){
                $modelLibroSubTema->set('libro_id',$librosbtemId);
                $modelLibroSubTema->set('sub_tema_id',$subtema_id);
                $modelLibroSubTema->delete();
            }
        }
        $model = new Libro();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
