
<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST" action="crear" enctype="multipart/form-data">
        <?php incluirFormulario('formulario_admin',$propiedad); ?>       

        <fieldset>
            <legend>Vendedor</legend>
            <div class="campo">
                <label for="">Elija el vendedor</label>
                <select id="opciones_vendedorId" name="vendedorId"  value="<?php echo isset($vendedorId)? $vendedorId: " " ?> ">
                    <option value="0" disabled selected>>-- Seleccion un vendedor --<</option>
                    
                    <?php foreach ($vendedores as $key => $value): ?>
                        <option <?php  if(isset($vendedorId)){echo $vendedorId === $value->id ? 'selected' : '';}?> 
                        value="<?php echo  $value->id?>"> <?php echo $value->nombre." ".$value->apellido ; ?>     
                        </option>
                    <?php  endforeach; ?>
                    
                </select>
            </div>
        </fieldset>
                        
        <input  type="submit" value="CrearPropiedad" class="boton-verde boton-formulario boton-formulario-admin">
        
        <div class="<?php echo (count($errores)!=0 || $insercionCorrecta==false ?  'alerta' : 'alerta sucess');  ?>" > 
            <?php
                if(count($errores)!=0){
                    foreach ($errores as $value) {
                        echo "<p>$value</p>";
                    }
                }else if($insercionCorrecta==true){
                    echo "<p>Insercion de datos correcto</p>";
                }else if($insercionCorrecta==false && $entradaPost==true){
                    echo "<p>Error en insercion de datos contecte con su proveedor</p>";
                }
            ?>
        </div>
    </form>

    <div class="boton boton-verTodas admin">
        <a href="/admin">Volver</a>
    </div>

</main>