
<?php
    use App\Propiedad;
    require  'inc/app.php';
    $inicio = false;
    incluirTemplate('header');
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if($id){
        $propiedad=Propiedad::SelectWhere($id);

    }else{
        header('Location:/');
    }

?>

    <main class="contenedor seccion anuncio">
        <h1>Casa en el lago </h1>
        <div class="contenedor-propiedades anuncio-propiedad">
        <?php 
             
                inlcuirAnuncio($propiedad->titulo,$propiedad->nombreImagen,$propiedad->precio,
                $propiedad->descripcion,$propiedad->wc,$propiedad->estacionamientos,$propiedad->habitaciones,$propiedad->id);
        ?>
            

        </div>
        </div>
    </main>

<?php
    incluirTemplate('footer'); 
    mysqli_close($db);
?>