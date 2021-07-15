<?php

namespace Controlers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public function eliminar(){

    }

    public function actualizar(){

    }

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
            var_dump(count($errores));
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
}