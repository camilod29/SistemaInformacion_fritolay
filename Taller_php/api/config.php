<?php
require_once dirname(__DIR__) . '/utils/model_util.php';
require_once dirname(__DIR__) . '/db/conexion_db.php';
require_once dirname(__DIR__) . '/models/model.php';
require_once dirname(__DIR__) . '/controllers/base_controller.php';
require_once dirname(__DIR__) . '/api/parse_array_reponse.php';
require_once dirname(__DIR__) . '/api/response.php';
require_once dirname(__DIR__) . '/models/autorLibro.php';
require_once dirname(__DIR__) . '/models/tema.php';
require_once dirname(__DIR__) . '/models/subTema.php';
require_once dirname(__DIR__) . '/models/libroSubTema.php';
require_once dirname(__DIR__) . '/models/libro.php';
require_once dirname(__DIR__) . '/controllers/libro_controller.php';
require_once dirname(__DIR__) . '/controllers/subTema_controller.php';

$uriRelativeApp =  '/clase/SistemaInformacion_fritolay/taller_php/';

$uriClass = [
    "productos" => [
        'model' => 'models/producto.php',
        'controller' => 'controllers/producto_controller.php'
    ],
    "autores" => [
        'model' => 'models/autor.php',
        'controller' => 'controllers/autor_controller.php'
    ],
    "libros" => [
        'model' => 'models/libro.php',
        'controller' => 'controllers/libro_controller.php'
    ],
    "editoriales" => [
        'model' => 'models/editorial.php',
        'controller' => 'controllers/editorial_controller.php'
    ],
    "temas" => [
        'model' => 'models/tema.php',
        'controller' => 'controllers/tema_controller.php'
    ],
    "sub_temas" => [
        'model' => 'models/subTema.php',
        'controller' => 'controllers/subTema_controller.php'
    ],
    "libros_sub_temas" => [
        'model' => 'models/libroSubTema.php',
        'controller' => 'controllers/libroSubTema_controller.php'
    ],
    "autores_libros" => [
        'model' => 'models/autorLibro.php',
        'controller' => 'controllers/autorLibro_controller.php'
    ]
];

$controllers = [
    "productos" => 'controllers\ProductoController',
    "autores" => 'controllers\AutorController',
    "libros" => 'controllers\LibroController',
    "editoriales" => 'controllers\EditorialController',
    "temas" => 'controllers\TemaController',
    "sub_temas" => 'controllers\SubTemaController',
    "libros_sub_temas" => 'controllers\LibroSubTemaController',
    "autores_libros" => 'controllers\AutorLibroController'
];


$getArrayUrlCurrent = function () {
    $urlData = str_replace($GLOBALS['uriRelativeApp'], '', $_SERVER['REQUEST_URI']);
    $urlArray  =  explode('/', $urlData);
    return  $urlArray;
};

