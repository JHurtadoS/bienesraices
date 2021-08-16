<h1 data-cy="titulo-propiedad"><?php echo $nombre;?></h1>
<div class="propiedad">
    <div class="comtenedor-imagen-propiedad">
    <img src="/imagenes/<?php echo $imagen ?>" alt="">
     </div>
    <div class="contenedor-info-propiedad">
        <p class="precio">$<?php echo $precio; ?></p>

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
    </div>

    <div class="descripcion-propiedad">
        <p> <?php echo  $descricion; ?> </p>  
    </div>

</div> 