<?php 

    require 'inc/funciones.php';
    incluirTemplate('header');
    
?>

    <main class="contenedor seccion">
        <h1>Iniciar sesion</h1>
        <form class="formulario InicioSesion" action="">
            <fieldset>
                <legend>Email y Pasword </legend>
                <div class="campo">
                    <label for="email">E-MAIL:</label>
                    <input type="email" placeholder="email">
                </div>
                <div class="campo">
                    <label for="nombre">password:</label>
                    <input type="password" placeholder="password">
                </div>
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>