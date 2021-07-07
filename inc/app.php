<?php
require'funciones.php';
require 'conf/database.php';
require __DIR__.'/../vendor/autoload.php';

use App\Propiedad;
$db = conectarDb();
Propiedad::SetDB($db);

