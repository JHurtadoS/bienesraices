            <fieldset>
            <legend>Informacion general</legend>

            <div class="campo">
                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" placeholder="Titulo" name="titulo" value="<?php echo isset($variable)? $variable->titulo: ''?>">
            </div>

            <div class="campo">
                <label for="precio">Precio</label>
                <input type="number" id="precio" placeholder="Precio Propiedad" name="precio" value="<?php echo isset($variable)? $variable->precio: ''?>">
            </div>

            <div class="campo">
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpge , image/png" name="imagen" value="<?php echo isset($imagen)? $imagen: ''?>">
                <?php echo $Tipo=='update'?"<img class='imagen-small' src='/imagenes/$variable->nombreImagen' alt=''>":"";?>  
            </div>
            
            <div class="campo">
                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo isset($variable)? $variable->descripcion: ''?></textarea>
            </div>
        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>
  

            <div class="campo">
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Numero de propiedades" min="1" max="9" value="<?php echo isset($variable)? $variable->habitaciones: ''?>">
            </div>

            <div class="campo">
                <label for="wc">wc</label>
                <input type="number" id="wc" name="wc" placeholder="Numero de wc" min="1" max="9" value="<?php echo isset($variable)? $variable->wc: ''?>">
            </div>

            <div class="campo">
                <label for="estacionamientos">estacionamientos:</label>
                <input type="number" id="estacionamientos" name="estacionamientos" placeholder="Numero de estacionamientos" min="1" max="9"value="<?php echo isset($variable)? $variable->estacionamientos: ''?>">
            </div>
        </fieldset>