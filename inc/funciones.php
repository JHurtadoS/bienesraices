<?php

require'app.php';

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