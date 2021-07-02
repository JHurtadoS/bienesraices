
<?php
    require  '../inc/funciones.php';
    require '..//inc/conf/database.php';
    $inicio = false;
    try{
        $db = conectarDb();
        //printf("Select returned %d rows.\n", mysqli_num_rows($resultadoConsulta));
    }catch (\Throwable $th) {
        echo $th;
    }
   
    incluirTemplate('header',$inicio);
    $consulta = "SELECT * FROM propiedades";
    $resultadoConsulta = mysqli_query($db,$consulta);
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
    <?php while($row = mysqli_fetch_assoc($resultadoConsulta)): ?>
         <p><?php echo $row['id']; ?></p> 
         <p><?php echo $row['titulo']; ?></p> 
         <img src="<?php echo "/imagenes/".$row['nombreImagen']; ?>"> 
         <p><?php echo $row['precio']; ?></p> 
         <div class="acciones">
            <div class="eliminar boton boton-rojo">
                <a href="#">Eliminar</a>
            </div>

            <div class="actualizar boton boton-amarillo">
                <a href="propiedades/actualizar.php?id=<?php  echo $row['id']; ?>">actualizar</a>
            </div>
            
        </div>
    <?php  endwhile; ?>
    </div>
</div>
 

</main>
 

<?php
incluirTemplate('footer'); 
?>