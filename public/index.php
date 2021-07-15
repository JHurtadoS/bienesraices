<?php

require_once __DIR__.'/../inc/app.php';

use MVC\Router;
use Controlers\PropiedadController;
use Controlers\VendedorController;

$router = new Router();

$router->get('/admin',[PropiedadController::class,'index']);
$router->post('/admin',[PropiedadController::class,'index']);


$router->get('/propiedades/crear',[PropiedadController::class,'crear']);
$router->post('/propiedades/crear',[PropiedadController::class,'crear']);

$router->get('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'actualizar']);

$router->post('/propiedades/eliminar',[PropiedadController::class,'eliminar']);


$router->get('/vendedores/crear',[VendedorController::class,'crear']);
$router->post('/vendedores/crear',[VendedorController::class,'crear']);

$router->comprobarRutas();