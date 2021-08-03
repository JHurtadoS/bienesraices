<?php
namespace Controlers;
use MVC\Router;
use Model\Admin;

class LoginController{
    public static function Login(Router $router){
        $inicio=false;
        $loginCorrecto=false;
        $errores=array();
        $usuario=new Admin();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuarios=Admin::all();
            $usuario=new Admin($_POST);
            $usuario->sanitizarDatos();
            $password=$usuario->password;
            $email=$usuario->email;
            foreach ($usuarios as $key => $value) {
                if($value->email ==  $_POST['email'] ){
                    $auth=password_verify($password,$value->password);
                    if($auth){
                        session_start();
                        $_SESSION['usuario']=$email;
                        $_SESSION['login']=true;
                        header('Location:/');
                        $loginCorrecto=true;
                    }else{
                        $errores[]='Contraseña equivocada';     
                    }
                }else{
                    $errores[]='Usuario no encontrado';
                }
            }
        }
    
        $router->render("/auth/login",[
            'inicio'=>$inicio,
            'errores'=>$errores,
            'loginCorrecto'=>$loginCorrecto,
            'usuario'=>$usuario
         ]); 
    }

    public static function salir(Router $router){
        
        echo "funciona";
        session_start();

        $_SESSION=[];
        
        header('Location: /');
    }
}