<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php incluirFormulario('formulario_vendedores',$vendedor); ?>       
                        
        <input  type="submit" value="Registrar vendedor" class="boton-verde boton-formulario boton-formulario-admin">
        <div class="<?php echo (count($errores)!=0  || $insercionCorrecta!=true ?  'alerta' : 'alerta sucess');  ?>" > 
            <?php
                if(!$errores==null){
                    foreach($errores as $value) {
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