


<?php
    require  'inc/funciones.php';
    $inicio = false;
    incluirTemplate('header',$inicio);

    require 'inc/conf/database.php';
    $inicio = false;
    try{
        $db = conectarDb();
    }catch (\Throwable $th) {
        echo $th;
    }
    $consultaPropiedades = "SELECT*FROM propiedades";
    $resConsultaPropiedades = mysqli_query($db,$consultaPropiedades);
?>
    <main class="contenedor seccion">
        <h1>Anuncios</h1>

        <div class="propiedades-1 anuncios">
            <h2>Casas y Depas en Venta</h2>
            <div class="contenedor-propiedades">

            <?php $i=0; while($row = mysqli_fetch_assoc($resConsultaPropiedades)):?>
                <?php inlcuirPropiedad($row['titulo'],$row['nombreImagen'],$row['precio'],$row['descripcion'],$row['wc'],$row['estacionamientos'],$row['habitaciones'],$row['id']); ?>
            <?php endwhile; ?>   


            </div>

        </div>

        </div>
    </main>

<?php
    incluirTemplate('footer'); 
    mysqli_close($db);
?>