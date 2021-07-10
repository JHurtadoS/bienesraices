
<?php
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;
    $errores = [];
    require  '../../inc/app.php';
    $row;
    $fecha=date('Y/m/d');



    analizarSesion();
    $consulta = "SELECT * FROM vendedores";

    try{

        $resultadoConsulta = mysqli_query($db,$consulta);

    }catch (\Throwable $th) {
        echo $th;
    }

        $datosPrevios;
       
        $id=(int)$_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        if($id===0){
            header('location:/admin');
        }

        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        $propiedad = new Propiedad($_POST);

        $propiedad=$propiedad::SelectWhere('propiedades',$id);

        $datosPrevios = $propiedad;

        if(isset($datosPrevios)){
            if($datosPrevios!=null){
                extract((array)$datosPrevios);
            }
        }
        
        $vacio=false;
        $contadorvacios=0;
        $insercionCorrecta=false;

    if($_SERVER['REQUEST_METHOD']==='POST')
    {
        $propiedad->SetArguments($_POST);
        $datos = $_POST;

        extract($datos);

        $imagen=$_FILES['imagen'];
        $nombreImagen = md5(uniqid(rand(),true)).".jpg" ;   

        
        if($imagen['name']){
            unlink(CARPETA_IMAGENES . $propiedad->nombreImagen);
            $image= Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
            $propiedad->SetImagen($nombreImagen);
        }

        foreach ($datos as $key => $value) {
            if(!$value){
                $vacio = true;
                $contadorvacios++;
                $error="hay un campo vacio (TODOS LOS CAMPOS SON OBLIGATORIOS)"; 
                if($contadorvacios===1){
                    $errores[] = $error;
                }
            }else{
                $vacio=false;
            }
            if($key=='descripcion'){
                if(strlen($value)<50 && $vacio!=true){
                    $error ="la descripcion debe tener minimo 50 caracteres";
                    $errores[] =$error;
                }
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
        
        $resultado=$propiedad->actualizar();
        if(empty($errores)){
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
        
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            if($resultado){
                $insercionCorrecta=true;
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
        <?php incluirFormulario('formulario_admin',$insercionCorrecta,$propiedad,'update'); ?>    

        <fieldset>
            <legend>Vendedor</legend>
            <div class="campo">
                <label for="">Elija el vendedor</label>
                <select id="opciones_vendedorId" name="vendedorId"  value="<?php echo isset($vendedorId)? $vendedorId: " " ?> ">
                    <option value="0" disabled selected>>-- Seleccion un vendedor --<</option>
                    
                    <?php while($row = mysqli_fetch_assoc($resultadoConsulta)): ?>
                        <option <?php  if(isset($vendedorId)){echo $vendedorId === $row['id'] ? 'selected' : '';}?> 
                        value="<?php echo  $row['id']?>"> <?php echo $row['nombre']." ".$row['apellido'] ; ?>     
                        </option>
                    <?php  endwhile; ?>
                    
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