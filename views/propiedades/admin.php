<main class="contenedor seccion">
    <h1>Administrador bienes raices</h1>

    <div class="tabla_de_propiedades admin">
        <h2>Propiedades</h2>
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
                    <input type="hidden" name="tipo" value="propiedad">
                    <input type="submit" class="boton boton-rojo eliminar" value="Eliminar">
                </form>

                <div class="actualizar boton boton-amarillo">
                    <a href="propiedades/actualizar?id=<?php  echo $value->id; ?>">actualizar</a>
                </div>
                
            </div>
        <?php  endforeach; ?>
        </div>
    </div>

    <div class="boton boton-verde admin">
        <a href="propiedades/crear">Crear propiedad</a>
    </div>
</main>