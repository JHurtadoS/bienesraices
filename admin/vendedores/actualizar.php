<?php
    use App\Vendedor;
    require  '../../inc/app.php';
    analizarSesion();

    $id=(int)$_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if($id===0){
        
    
        header('location:/admin');
    }


    $vendedor = Vendedor::SelectWhere($id);
    var_dump($vendedor);

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
    incluirTemplate('header',$inicio=false);
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST">
        <?php incluirFormulario('formulario_vendedores',$vendedor); ?>       
                        
        <input  type="submit" value="Guardar Cambios" class="boton-verde boton-formulario boton-formulario-admin">
        
        <div class="<?php echo (count($errores)!=0 || $insercionCorrecta==false ?  'alerta' : 'alerta sucess');  ?>" > 
            <?php
                if(!$errores==null){
                    foreach($errores as $value) {
                        echo "<p>$value</p>";
                    }
                }else if($insercionCorrecta==true){
                    echo "<p>Insercion de datos correcto</p>";
                }else if($insercionCorrecta==false && $entradaPost==true){
                    echo "<p>Error en insercion de datos contecte con su proveedor</p>";
                }
            ?>
        </div>
    </form>

    <div class="boton boton-verTodas admin">
        <a href="../index.php">Volver</a>
    </div>

</main>


<?php
    incluirTemplate('footer'); 
?>