<?php

require_once __DIR__.'/../inc/app.php';

use MVC\Router;
use Controlers\PropiedadController;
use Controlers\VendedorController;
use Controlers\PaginasController;

$router = new Router();

//privada
$router->get('/admin',[PropiedadController::class,'index']);
$router->get('/propiedades/crear',[PropiedadController::class,'crear']);
$router->post('/propiedades/crear',[PropiedadController::class,'crear']);
$router->get('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/eliminar',[PropiedadController::class,'eliminar']);

$router->get('/vendedores/crear',[VendedorController::class,'crear']);
$router->post('/vendedores/crear',[VendedorController::class,'crear']);
$router->get('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->post('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->post('/vendedores/eliminar',[VendedorController::class,'eliminar']);

//publica
$router->post('/',[PaginasController::class,'index']);
$router->get('/',[PaginasController::class,'index']);
$router->get('/propiedades',[PaginasController::class,'propiedades']);
$router->get('/nosotros',[PaginasController::class,'nosotros']);
$router->get('/anuncio',[PaginasController::class,'anuncio']);
$router->get('/blog',[PaginasController::class,'blog']);
$router->post('/contactanos',[PaginasController::class,'contacto']);
$router->get('/contactanos',[PaginasController::class,'contacto']);


$router->comprobarRutas();