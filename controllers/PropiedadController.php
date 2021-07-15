<?php

namespace Controlers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){

        $propiedades = Propiedad::all();

        $router->render("/propiedades/admin",[
           'propiedades'=>$propiedades
        ]);  
    }
    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $errores=[];
        $insercionCorrecta=false;
        $entradaPost=false;
        $vendedores= Vendedor::all();

        if($_SERVER['REQUEST_METHOD']==='POST'){
                        
            $imagen=$_FILES['imagen'];

            $nombreImagen = md5(uniqid(rand(),true)).".jpg" ;  
            $entradaPost=true;
            
            $datosPrevios = $_POST;

            foreach ($datosPrevios as $key => $value) {
                $value=s($value);
            }

            $propiedad = new Propiedad($datosPrevios);
            

            if($imagen['name']!=""){
                $image= Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);    
                $propiedad->SetImagen($nombreImagen);
            }else{
                //$propiedad->SetImagen(" ");
            }
            $errores=$propiedad->validar(true);    

            if(count($errores)==0){
    
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                $insercionCorrecta = $propiedad->guardar();
                if($insercionCorrecta){
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
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

        $router->render("/propiedades/crear",[
            "propiedad"=>$propiedad,
            "errores"=>$errores,
            "insercionCorrecta"=>$insercionCorrecta,
            "entradaPost"=>$entradaPost,
            "vendedores"=>$vendedores
        ]);  
    }

    public static function actualizar(Router $router){
        $errores=[];
        $insercionCorrecta=false;
        $entradaPost=false;
        $id=(int)$_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        if($id===0){
            header('location:/admin');
        }
        $vendedores=Vendedor::all();
        $propiedad=Propiedad::SelectWhere($id);

        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $datosPrevios = $_POST;

            foreach ($datosPrevios as $key => $value) {
                $value=s($value);
            }

            $propiedad->SetArguments($datosPrevios);
            $propiedad->setId($id);

            $imagen=$_FILES['imagen'];
            $nombreImagen = md5(uniqid(rand(),true)).".jpg" ;  

            if($imagen['name']){
                unlink(CARPETA_IMAGENES . $propiedad->nombreImagen);
                $image= Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
            }

            $errores=$propiedad->validar(true);

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
            
            if(empty($errores)){
                $resultado=$propiedad->actualizar();
                if($resultado){
                    $insercionCorrecta=true;
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    $propiedad->SetImagen($nombreImagen);
                    if($imagen['name']){
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
                }
                else{
                    $errorbaseDeDatos=true;
                    $errores[]="actualizacion incorrecta error interno";
                }        
            }
        }
        
        $router->render("/propiedades/actualizar",[
            'propiedad'=>$propiedad,
            "errores"=>$errores,
            "insercionCorrecta"=>$insercionCorrecta,
            "entradaPost"=>$entradaPost,
            'vendedores'=>$vendedores
         ]); 
    }
}