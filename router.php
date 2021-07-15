<?php

namespace MVC;

class Router {
    public function __construct()
    {

    }

    public $rutasGet=[];
    public $rutasPost=[];

    public function get($url,$fn){
        $this->rutasGet[$url]= $fn;
    }

    public function post($url,$fn){
        $this->rutasPost[$url]= $fn;

    }


    public function comprobarRutas(){
        $urlActual= $_SERVER['PATH_INFO'] ?? "/";
        $metodo = $_SERVER['REQUEST_METHOD'];
        if($metodo=='GET'){
            $fn=$this->rutasGet[$urlActual];
        }else{
            $fn=$this->rutasPost[$urlActual];
        }

        if($fn){
            call_user_func($fn,$this);
        }else{
            echo "pagina no encontrada";
        }
    }

    public function render($view,$datos=[]){
        extract($datos); 

        ob_start();
        include_once __DIR__."/views"."$view".".php";
        $contenido=ob_get_clean();
        include_once __DIR__."/views/layout.php";
    }
}