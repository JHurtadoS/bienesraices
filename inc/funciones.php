<?php

define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT']."/imagenes/");

function incluirTemplate(string $nombre, bool $estado=false){
    $inicio=$estado;
    include TEMPLATES_URL."/${nombre}.php"; 
}

function validarTipoContenido($tipo){
    $tipos =['vendedor','propiedad'];
    return in_array($tipo,$tipos);
}

function inlcuirPropiedad( $nombre,$imagen,$precio,$descricion,$baños,$estacionamientos,$habitaciones,$id){
    include TEMPLATES_URL."/propiedad.php"; 
}

function incluirFormulario($nombre,$variable=null,string $tipo=''){
    $Tipo=$tipo;
    $variable=$variable;
    include TEMPLATES_URL."/${nombre}.php"; 
}

function inlcuirAnuncio( $nombre,$imagen,$precio,$descricion,$baños,$estacionamientos,$habitaciones,$id){
    include TEMPLATES_URL."/AnuncioUnitario.php"; 
}

function analizarSesion(){
    
    session_start();
    $auth = $_SESSION['login'];

    if(!$auth){
        header('Location: /');
    }

}

function s($html):string{
    $s = htmlspecialchars($html);
    return $s;
}

function borrarImagen($propiedad){
    $imagen=$propiedad->nombreImagen;
    $carpetaImagenes = '../imagenes/';
    unlink($carpetaImagenes.$imagen);
}