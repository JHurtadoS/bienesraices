
<?php
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
    $errores = [];
    require  '../../inc/app.php';
    $row;
    $fecha=date('Y/m/d');

    analizarSesion();

    $vendedor  = new Vendedor() ;
    $vendedores=$vendedor->all();


    $id=(int)$_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    if($id===0){
        header('location:/admin');
    }

    $propiedad=$propiedad::SelectWhere($id);


    $vacio=false;
    $contadorvacios=0;
    $insercionCorrecta=false;

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
    $inicio = false;
    incluirTemplate('header',$inicio);
?>

<main class="contenedor seccion">
    <h1>Actualizar</h1>

    <form class="formulario" method="POST" enctype="multipart/form-data">
    <?php incluirFormulario('formulario_admin',$propiedad,'update'); ?>   

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
 
        <input  type="submit" value="Actualizar propiedad" class="boton-verde boton-formulario boton-formulario-admin">
        
        <div class="<?php echo (count($errores)!=0 ?  'alerta' : 'alerta sucess');  ?>" > 
        
            <?php
                if(count($errores)!=0){
                    foreach ($errores as $value) {
                        echo "<p>$value</p>";
                    }
                }else if($insercionCorrecta==true){
                    echo "<p>Actualizacion correcta de datos correcto</p>";
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