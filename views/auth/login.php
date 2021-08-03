<main class="contenedor seccion">
    <h1>Iniciar sesion</h1>
    <form method="POST" class="formulario InicioSesion" action="">
        <fieldset>
            <legend>Email y Pasword </legend>
            <div class="campo">
                <label class="InicioSesion" for="email">E-MAIL:</label>
                <input class="InicioSesion" name="email" type="email" placeholder="Email" required>
            </div>
            <div class="campo InicioSesion">
                <label class="InicioSesion" for="nombre">password:</label>
                <input class="InicioSesion" name="password" type="password" placeholder="Password" required>
            </div>
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

        <div class="<?php echo (count($errores)!=0 ?  'alerta' : 'alerta sucess');  ?>">
            <?php
                    if(count($errores)!=0){
                        foreach ($errores as $value) {
                            echo "<p>$value</p>";
                        }
                    }else if($loginCorrecto){
                        echo "<p>Insercion de datos correcto</p>";
                    }
                ?>
        </div>
    </form>
</main>