
<?php

use App\Propiedad;

$idBorrar;
    require  '../inc/app.php';
    analizarSesion();
    
    $inicio = false;
    try{
    }catch (\Throwable $th) {
        echo $th;
    }
   
    incluirTemplate('header',$inicio);
    
    $propiedades = Propiedad::all("propiedades");
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id=$_POST['id'];
        $id=filter_var($id,FILTER_VALIDATE_INT);
        $consultaEliminar = "DELETE FROM propiedades WHERE id=$id"; 
        $consultaSeleccionar = "SELECT *FROM propiedades WHERE id=$id";
        $resultadoconsultaSeleccionar = mysqli_query($db,$consultaSeleccionar);
        $datosPropiedades = mysqli_fetch_assoc($resultadoconsultaSeleccionar);
        $carpetaImagenes = '../imagenes/';
        unlink($carpetaImagenes.$datosPropiedades['nombreImagen']);
        if($db!=null && $id){
            try{
                $resultado_eliminacion=mysqli_query($db,$consultaEliminar);
                if(!$resultado_eliminacion){
                    echo mysqli_errno($db);
                }
            }catch(\Throwable $th){
                echo $th;
            }    

        }
        if($resultado_eliminacion){
            header('location:/admin');
        }
    }
?>

<main class="contenedor seccion">
<h1>Administrador bienes raices</h1>

<div class="boton boton-verde admin">
    <a href="/admin/propiedades/crear.php">Crear propiedad</a>
</div>

<div class="tabla_de_propiedades admin">
    <div class="rows">
        <p>ID</p>
        <p>Titulo</p>
        <p>Imagen</p>
        <p>Precio</p>
        <p>Acciones</p>
    </div>
    <div class="propiedades">
    <?php foreach ($propiedades as $value):?>
         <p><?php echo $value->id; ?></p> 
         <p><?php echo $value->titulo; ?></p> 
         <img src="<?php echo "/imagenes/".$value->nombreImagen; ?>"> 
         <p><?php echo $value->precio; ?></p> 
         <div class="acciones">


            <form class="eliminar" method="POST">
                <input type="hidden" name="id" value=" <?php echo $value->id ?> ">
                <input type="submit" class="boton boton-rojo eliminar" value="Eliminar">
            </form>


            <div class="actualizar boton boton-amarillo">
                <a href="propiedades/actualizar.php?id=<?php  echo $value->id; ?>">actualizar</a>
            </div>
            
        </div>
    <?php  endforeach; ?>
    </div>
</div>
 

</main>
 

<?php
    incluirTemplate('footer'); 
    mysqli_close($db);
?>