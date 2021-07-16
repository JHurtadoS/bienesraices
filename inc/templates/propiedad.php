<div class="propiedad">
    <div class="comtenedor-imagen-propiedad">
        <img src="/imagenes/<?php echo $imagen ?>" alt="">
    </div>
    <div class="contenedor-info-propiedad">
        <h3><?php echo $nombre ?></h3>

        <div class="descripcion">
            <p> <?php echo  $descricion; ?> </p>
        </div>
        <p class="precio">$<?php echo $precio; ?></p>
    </div>

    <div class="contenedor-iconos-propiedad">
        <div class="contenedor-icono">
            <img src="build/img/icono_wc.svg" alt="" srcset="">
            <p class="cantidad-icono"><?php echo $baños; ?></p>
        </div>

        <div class="contenedor-icono">
            <img src="build/img/icono_estacionamiento.svg" alt="" srcset="">
            <p class="cantidad-icono"><?php echo $estacionamientos; ?></p>
        </div>

        <div class="contenedor-icono">
            <img src="build/img/icono_dormitorio.svg" alt="" srcset="">
            <p class="cantidad-icono"> <?php echo $habitaciones ;?></p>
        </div>
    </div>
    <div class="contenedor-boton">
        <div class="boton boton-propiedad">
            <a href="/anuncio?id=<?php echo $id;?>">Ver Propiedad</a>
        </div>
    </div>
</div>