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