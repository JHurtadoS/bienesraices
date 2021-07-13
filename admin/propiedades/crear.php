<?php

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    $errores = [];
    $row;
    $fecha=date('Y/m/d');
    require  '../../inc/app.php';

    analizarSesion();
    $vendedor  = new Vendedor() ;
    $vendedores=$vendedor->all();

    $entradaPost=false;
    $insercionCorrecta=false;
    $propiedad = new Propiedad();

    if($_SERVER['REQUEST_METHOD']==='POST'){
                    
        $imagen=$_FILES['imagen'];
        $nombreImagen = md5(uniqid(rand(),true)).".jpg" ;  
        $entradaPost=true;
        
        $datosPrevios = $_POST;

        foreach ($datosPrevios as $key => $value) {
            $value=s($value);
        }

        $propiedad = new Propiedad($datosPrevios);
        

        $image= Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
        $propiedad->SetImagen($nombreImagen);

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


    $inicio = false;
    incluirTemplate('header',$inicio);
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php incluirFormulario('formulario_admin',$propiedad); ?>       

        <fieldset>
            <legend>Vendedor</legend>
            <div class="campo">
                <label for="">Elija el vendedor</label>
                <select id="opciones_vendedorId" name="vendedorId"  value="<?php echo isset($vendedorId)? $vendedorId: " " ?> ">
                    <option value="0" disabled selected>>-- Seleccion un vendedor --<</option>
                    
                    <?php foreach ($vendedores as $key => $value): ?>
                        <option <?php  if(isset($vendedorId)){echo $vendedorId === $value->id ? 'selected' : '';}?> 
                        value="<?php echo  $value->id?>"> <?php echo $value->nombre." ".$value->apellido ; ?>     
                        </option>
                    <?php  endforeach; ?>
                    
                </select>
            </div>
        </fieldset>
                        
        <input  type="submit" value="CrearPropiedad" class="boton-verde boton-formulario boton-formulario-admin">
        
        <div class="<?php echo (count($errores)!=0 || $insercionCorrecta==false ?  'alerta' : 'alerta sucess');  ?>" > 
            <?php
                if(count($errores)!=0){
                    foreach ($errores as $value) {
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
    mysqli_close($db);
?>