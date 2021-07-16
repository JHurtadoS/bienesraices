<?php

namespace Controlers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{


    public static function crear(Router $router){
        $insercionCorrecta=false; 
        $errores=[];
        $entradaPost=false;
        $vendedor = new Vendedor();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $entradaPost=true;
    
            $datosPrevios = $_POST;
            foreach ($datosPrevios as $key => $value) {
                $value=s($value);
            }
    
            $vendedor = new Vendedor($datosPrevios);
    
            $errores=$vendedor->validar(true);
            if(count($errores)==0){
                echo "entro";
                $insercionCorrecta = $vendedor->guardar();
            }else{
                echo "entro2";
                $insercionCorrecta=false;
            }
    
            echo 
            '<script type="text/javascript">
                document.addEventListener("DOMContentLoaded", (event) => {
                    let Boton_Crear_Propiedad = document.querySelector(".boton-formulario-admin");
                    if(Boton_Crear_Propiedad!=null){
                        Boton_Crear_Propiedad.scrollIntoView({behavior:"smooth"});
                    }
                });
            </script>'
            ;
        }
    
        $router->render("/vendedores/crear",[
            "vendedor"=>$vendedor,
            "errores"=>$errores,
            "insercionCorrecta"=>$insercionCorrecta,
            "entradaPost"=>$entradaPost
        ]);  
    }

    public static function actualizar(Router $router){
        $id=(int)$_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
    
        if($id===0){
            header('location:/admin');
        }
    
        $vendedor = Vendedor::SelectWhere($id);
    
        $insercionCorrecta=false; 
        $errores=[];
        $entradaPost=false; 

        
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $insercionCorrecta=true;
            $entradaPost=true;
            $datosPrevios = $_POST;

            foreach ($datosPrevios as $key => $value) {
                $value=s($value);
            }

            $vendedor = new Vendedor($datosPrevios);
            $vendedor->setId($id);
            $errores=$vendedor->validar(true);


            if(count((array)$errores)==0){     
                echo "entro";
                $insercionCorrecta = $vendedor->actualizar();
            }else{
                $insercionCorrecta=false;
            }

            echo 
            '<script type="text/javascript">
                document.addEventListener("DOMContentLoaded", (event) => {
                    let Boton_Crear_Propiedad = document.querySelector(".boton-formulario-admin");
                    if(Boton_Crear_Propiedad!=null){
                        Boton_Crear_Propiedad.scrollIntoView({behavior:"smooth"});
                    }
                });
            </script>'
            ;

        }

        $router->render("/vendedores/actualizar",[
            'vendedor'=>$vendedor,
            "errores"=>$errores,
            "insercionCorrecta"=>$insercionCorrecta,
            "entradaPost"=>$entradaPost
         ]); 
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id=$_POST['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
            if($id){
                $vendedor = Vendedor::SelectWhere($id);
                $resultado=$vendedor->borrar($id);
                if($resultado){
                    header('location:/admin');
                }
            }
        }
    }
}