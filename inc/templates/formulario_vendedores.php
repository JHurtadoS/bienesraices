<fieldset>
    <legend>Informacion general</legend>

    <div class="campo">
        <label for="Nombre">Nombre</label>
        <input type="text" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo isset($variable)? $variable->nombre: ''?>">
    </div>
    <div class="campo">
        <label for="titulo">Apellido</label>
        <input type="text" id="apellido" placeholder="Apellido" name="apellido" value="<?php echo isset($variable)? $variable->apellido:''?>">
    </div>


    <div class="campo">
        <label for="Telefono">Telefono</label>
        <input type="number" id="telefono" placeholder="Telefono Vendedor" name="telefono" value="<?php echo isset($variable)? $variable->telefono: ''?>">
    </div>

</fieldset>