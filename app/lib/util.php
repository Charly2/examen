<?php
/**
 * Created by PhpStorm.
 * User: CHARLY
 * Date: 07/04/2019
 * Time: 11:51 PM
 */



function setViewIndex($view,$args="",$ver = false){
    if ($ver){
        print_r($args);
    }
    extract($args);
    $_VIEW = $view;
    include_once '../vistas/layout_index.php';
}

function setErrorIndex($args="Ocurrio un error"){

    $_ERROR = $args;
    $_VIEW = "error_custom";
    include_once '../vistas/layout_index.php';
}

function setViewApp($view,$args="",$ver = false){
    if ($ver){
        print_r($args);
    }
    extract($args);
    $_VIEW = $view;
    include_once '../vistas/layout_app.php';
}
function setViewAdmin($view,$args="",$ver = false){
    if ($ver){
        print_r($args);
    }
    extract($args);
    $_VIEW = $view;
    include_once '../vistas/layout_admin.php';
}


function _setUrl($url){
    return URL_BASE.$url;
}

function encryptIt( $q ) {

    return base64_encode( $q );
}

function decryptIt( $q ) {
    return base64_decode( $q );
}


function autoUpdate($model, $name, $id , $controller,$value,$min,$max){
    $url = _setUrl($controller);
    return "data-model='$model' data-name='$name' data-id='$id' data-controller='$url' value='$value' data-min='$min' data-max='$max'";
}

function prEx($r){
    print_r($r);
    die("-----AQUI SALI -----");
}


?>