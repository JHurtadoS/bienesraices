<?php
namespace Controlers;
use MVC\Router;
use Model\Propiedad;

class PaginasController{
    
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $inicio=true;
        $router->render("/MainPages/index",[
            'propiedades'=>$propiedades,
            'inicio'=>$inicio
         ]); 
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $inicio=false;
        $router->render("/MainPages/anuncios",[
            'propiedades'=>$propiedades,
            'inicio'=>$inicio
         ]); 
    }

    public static function anuncio(Router $router){
        $id=(int)$_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        if($id===0){
            header('location:/');
        }
        $propiedad = Propiedad::SelectWhere($id);
        $inicio=false;
        $router->render("/MainPages/anuncio",[
            'propiedad'=>$propiedad,
            'inicio'=>$inicio
         ]); 
    }

    public static function contacto(Router $router){
        $inicio=false;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
            exit;
        }
        
        $router->render("/MainPages/contactanos",[
            'inicio'=>$inicio
         ]); 
    }

    public static function blog(Router $router){
        $inicio=false;
        $router->render("/MainPages/blog",[
            'inicio'=>$inicio
         ]); 
    }

    public static function nosotros(Router $router){
        $inicio=false;
        $router->render("/MainPages/nosotros",[
            'inicio'=>$inicio
         ]); 
    }
}