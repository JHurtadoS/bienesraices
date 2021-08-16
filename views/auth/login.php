<main class="contenedor seccion">
    <h1 data-cy="header-login">Iniciar sesion</h1>
    <form method="POST" data-cy="formulario-login" class="formulario InicioSesion" action="">
        <fieldset>
            <legend>Email y Pasword </legend>
            <div class="campo">
                <label class="" for="email">E-MAIL:</label>
                <input class="InicioSesion-email" name="email" type="email" placeholder="Email" required>
            </div>
            <div class="campo InicioSesion">
                <label class="InicioSesion" for="nombre">password:</label>
                <input class="InicioSesion-pasword" name="password" type="password" placeholder="Password" required>
            </div>
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

        <div data-cy='alerta' class="<?php echo (count($errores)!=0 ?  'alerta' : 'alerta sucess');  ?>">
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