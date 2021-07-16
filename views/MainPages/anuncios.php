<main class="contenedor seccion">
        <h1>Anuncios</h1>

        <div class="propiedades-1 anuncios">
            <h2>Casas y Depas en Venta</h2>
            <div class="contenedor-propiedades">

            <?php foreach($propiedades as $value):?>
                <?php
                    inlcuirPropiedad($value->titulo,$value->nombreImagen,$value->precio,
                    $value->descripcion,$value->wc,$value->estacionamientos,$value->habitaciones,$value->id);
                ?>
            <?php endforeach; ?>   


            </div>

        </div>

        </div>
    </main>