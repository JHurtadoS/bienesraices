
<?php
$errores = [];

$row;
$fecha=date('Y/m/d');
require '../../inc/conf/database.php';

$consulta = "SELECT * FROM vendedores";
try{
    $db = conectarDb();
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

    $consultaDatosPrevios = "SELECT * FROM propiedades WHERE id=$id";
    $resultadoConsultaDatosPrevios = mysqli_query($db,$consultaDatosPrevios);
    $datosPrevios = mysqli_fetch_assoc($resultadoConsultaDatosPrevios);

    if(isset($datosPrevios)){
        if($datosPrevios!=null){
            extract($datosPrevios);
        }
    }

    $vacio=false;
    $contadorvacios=0;
    $insercionCorrecta=false;

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $datos = $_POST;
    extract($datos);

    foreach ($datos as $value) {
       $value=mysqli_real_escape_string($db,$value);
    }
    
    $imagen=$_FILES['imagen'];

    $carpetaImagenes = '../../imagenes/';
    if(!is_dir($carpetaImagenes))
        mkdir($carpetaImagenes);



    if($imagen['name']){
        unlink($carpetaImagenes.$datosPrevios['nombreImagen']);
        $nombreImagen = md5(uniqid(rand(),true)).".jpg" ;
        $ImagenGuardada = $carpetaImagenes . "$nombreImagen";
        move_uploaded_file($imagen['tmp_name'],$ImagenGuardada);
    }else{
        $nombreImagen=$datosPrevios['nombreImagen'];
    }
    

    
    $medida=50000*1000;

    if($imagen['size']>$medida){
        $errores[] = 'La imagen es muy pesada';
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
    $query="UPDATE propiedades SET titulo='${titulo}' , precio=${precio} , nombreImagen='${nombreImagen}' , descripcion='${descripcion}' , habitaciones=${habitaciones} , wc=${wc} , estacionamientos=${estacionamientos} , creado='${fecha}' , vendedorId=${vendedorId} WHERE id=$id";

    
    if($db!=null & empty($errores)){
        try{
            $resultado = mysqli_query($db,$query);
                if($resultado){
                    $insercionCorrecta=true;
                }
                else{
                    $errorbaseDeDatos=true;
                    $errores[]="actualizacion incorrecta error interno";
                }        

        }catch (\Throwable $th) {
             echo $th;
        }
    }
    

    }


    require  '../../inc/funciones.php';
    $inicio = false;
    incluirTemplate('header',$inicio);
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion general</legend>


            <div class="campo">
                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" placeholder="Titulo" name="titulo" value="<?php echo isset($titulo)? $titulo: ''?>">
            </div>

            <div class="campo">
                <label for="precio">Precio</label>
                <input type="number" id="precio" placeholder="Precio Propiedad" name="precio" value="<?php echo isset($precio)? $precio: ''?>">
            </div>

            <div class="campo">
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpge , image/png" name="imagen" value="<?php echo isset($nombreImagen)? $nombreImagen: ''?>">
                <img src="<?php echo "/imagenes/".$nombreImagen ?>" class="imagen-small" alt="">
            </div>

            <div class="campo">
                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo isset($descripcion)? $descripcion: ''?></textarea>
            </div>
        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>
  

            <div class="campo">
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Numero de propiedades" min="1" max="9" value="<?php echo isset($habitaciones)? $habitaciones: ''?>">
            </div>

            <div class="campo">
                <label for="wc">wc</label>
                <input type="number" id="wc" name="wc" placeholder="Numero de wc" min="1" max="9" value="<?php echo isset($wc)? $wc: ''?>">
            </div>

            <div class="campo">
                <label for="estacionamientos">estacionamientos:</label>
                <input type="number" id="estacionamientos" name="estacionamientos" placeholder="Numero de estacionamientos" min="1" max="9"value="<?php echo isset($estacionamientos)? $estacionamientos: ''?>">
            </div>
        </fieldset>

        
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
?>