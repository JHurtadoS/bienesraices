<?php

require_once __DIR__.'/../inc/app.php';

use Controlers\LoginController;
//use Controlers\LoginController;
use MVC\Router;
use Controlers\PropiedadController;
use Controlers\VendedorController;
use Controlers\PaginasController;
 //Controlers\LoginCotroller;

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
//$router->post('/contactanos',[PaginasController::class,'contacto']);
$router->get('/login',[LoginController::class,'Login']);
$router->post('/login',[LoginController::class,'Login']);
$router->get('/logout',[LoginController::class,'salir']);
//$router->post('/logout',[LoginCotroller::class,'Logout']);

$router->comprobarRutas();