<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

$errores = [];
$datosPrevios;
$row;
$fecha=date('Y/m/d');

require  '../../inc/app.php';

analizarSesion();
$consulta = "SELECT * FROM vendedores";

try{
    $resultadoConsulta = mysqli_query($db,$consulta);
}catch (\Throwable $th) {
    echo $th;
}
$entradaPost=false;
$vacio=false;
$contadorvacios=0;
$insercionCorrecta=false;

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $entradaPost=true;
    $propiedad = new Propiedad($_POST);
    
    $datos = $_POST;
    $datosPrevios = $datos;
    extract($datos);

    $imagen=$_FILES['imagen'];
    $nombreImagen = md5(uniqid(rand(),true)).".jpg" ;   

    if(!$imagen['name']){
        $errores[] = 'La imagen es obligatoria';

    }else{
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

    if(count($errores)==0){
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }

        $image->save(CARPETA_IMAGENES . $nombreImagen);

        $insercionCorrecta = $propiedad->guardar();
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

    $inicio = false;
    incluirTemplate('header',$inicio);
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
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
                <input type="file" id="imagen" accept="image/jpge , image/png" name="imagen" value="<?php echo isset($imagen)? $imagen: ''?>">
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