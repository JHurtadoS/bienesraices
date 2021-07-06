
<?php
    require  'inc/funciones.php';
    $inicio = false;
    incluirTemplate('header');
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    require 'inc/conf/database.php';
    try{
        $db = conectarDb();
    }catch (\Throwable $th) {
        echo $th;
    }
    if($id){
        $consultaPropiedades = "SELECT*FROM propiedades WHERE id=$id";
        $resConsultaPropiedades = mysqli_query($db,$consultaPropiedades);
        var_dump($resConsultaPropiedades);
    }else{
        header('Location:/');
    }
    
    if(!$resConsultaPropiedades->num_rows){
        header('Location:/');
    }
?>

    <main class="contenedor seccion anuncio">
        <h1>Casa en el lago </h1>
        <div class="contenedor-propiedades anuncio-propiedad">
        <?php 
                $row = mysqli_fetch_assoc($resConsultaPropiedades);  
                inlcuirAnuncio($row['titulo'],$row['nombreImagen'],$row['precio'],
                $row['descripcion'],$row['wc'],$row['estacionamientos'],$row['habitaciones'],$row['id']);
        ?>
            

        </div>
        </div>
    </main>

<?php
    incluirTemplate('footer'); 
    mysqli_close($db);
?>