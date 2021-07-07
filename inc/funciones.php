<?php

define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');

function incluirTemplate(string $nombre, bool $estado=false){
    $inicio=$estado;
    include TEMPLATES_URL."/${nombre}.php"; 
}

function inlcuirPropiedad( $nombre,$imagen,$precio,$descricion,$baños,$estacionamientos,$habitaciones,$id){
    include TEMPLATES_URL."/propiedad.php"; 
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