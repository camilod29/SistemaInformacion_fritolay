<?php
require_once dirname(__DIR__) . '/utils/model_util.php';
require_once dirname(__DIR__) . '/db/conexion_db.php';
require_once dirname(__DIR__) . '/models/model.php';
require_once dirname(__DIR__) . '/controllers/base_controller.php';
require_once dirname(__DIR__) . '/api/parse_array_reponse.php';
require_once dirname(__DIR__) . '/api/response.php';

$uriRelativeApp =  '/clase/SistemaInformacion_fritolay/parte_php/';

$uriClass = [
    "productos" => [
        'model' => 'models/producto.php',
        'controller' => 'controllers/producto_controller.php'
    ]
];

$controllers = [
    "productos" => 'controllers\ProductoController'
];


$getArrayUrlCurrent = function () {
    $urlData = str_replace($GLOBALS['uriRelativeApp'], '', $_SERVER['REQUEST_URI']);
    $urlArray  =  explode('/', $urlData);
    return  $urlArray;
};

