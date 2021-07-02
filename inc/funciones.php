<?php

require'app.php';

function incluirTemplate(string $nombre, bool $estado=false){
    $inicio=$estado;
    include TEMPLATES_URL."/${nombre}.php"; 
}