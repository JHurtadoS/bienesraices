<?php

define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
define('CARPETA_IMAGENES',__DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $estado=false){
    $inicio=$estado;
    include TEMPLATES_URL."/${nombre}.php"; 
}

function inlcuirPropiedad( $nombre,$imagen,$precio,$descricion,$baños,$estacionamientos,$habitaciones,$id){
    include TEMPLATES_URL."/propiedad.php"; 
}

function incluirFormulario($nombre,$EstadoInsercion,$Propiedad=null,string $tipo=''){
    $Tipo=$tipo;
    $insercionCorrecta =$EstadoInsercion;
    $propiedad=$Propiedad;
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