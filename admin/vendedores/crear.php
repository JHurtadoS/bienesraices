<?php
    use App\Vendedor;
    require  '../../inc/app.php';
    analizarSesion();


    $insercionCorrecta=false; 
    $errores=[];
    $entradaPost=false;
    $vendedor = new Vendedor($_POST);


    $vendedor;
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $entradaPost=true;

        $datos = $_POST;
        $datosPrevios = $datos;
        $vendedor = new Vendedor($_POST);

        foreach ($datosPrevios as $key => $value) {
            $value=s($value);
        }

        extract($datosPrevios);

        $errores=$vendedor->validar(true);


        if($errores==null ||count((array)$errores)>1){

            $insercionCorrecta = $vendedor->guardar();
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

    if(isset($datosPrevios)){
        if($datosPrevios!=null){
            extract($datosPrevios);
        }
    }

    incluirTemplate('header',$inicio=false);
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">
        
        <?php incluirFormulario('formulario_vendedores',$vendedor); ?>       
                        
        <input  type="submit" value="Registrar vendedor" class="boton-verde boton-formulario boton-formulario-admin">
        <?php var_dump(count($errores)!=0 || $insercionCorrecta!=true) ?>
        <div class="<?php echo (count($errores)!=0  || $insercionCorrecta!=true ?  'alerta' : 'alerta sucess');  ?>" > 
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