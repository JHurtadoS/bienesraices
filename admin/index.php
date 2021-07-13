
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
    
    $propiedades = Propiedad::all();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id=$_POST['id'];
        $id=filter_var($id,FILTER_VALIDATE_INT);
        $propiedad = new Propiedad($_POST);
        $resultado=$propiedad->borrar($id);

        if($DB!=null && $id){
            try{
                if(!$resultado){
                    echo mysqli_errno($DB);
                }
            }catch(\Throwable $th){
                echo $th;
            }    

        }
        if($resultado){
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