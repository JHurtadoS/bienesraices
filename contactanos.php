

<?php
    require  'inc/funciones.php';
    $inicio = false;
    incluirTemplate('header',$inicio);
?>
    <main class="contenedor seccion">
        <h1>Contactanos</h1>
        <picture>
            <source src="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpge">
            <img loading="lazy" src="build/img/destacada3.webp">
            <h2>LLena el formulario</h2>
            <form class="formulario" action="">
                <fieldset>
                    <legend>Informacion Personal</legend>
                    <div class="campo">
                        <label for="nombre">Nombre:</label>
                        <input type="text" placeholder="Nombre">
                    </div>
                    <div class="campo">
                        <label for="email">E-mail:</label>
                        <input type="email" placeholder="E-mail">
                    </div>

                    <div class="campo">
                        <label for="telefono">Telefono:</label>
                        <input type="tel" placeholder="Telefono">
                    </div>

                    <div class="campo">
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje"></textarea>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Informacion sobre propiedad</legend>
                    <div class="campo">
                        <label for="">VENDE O COMPRA</label>
                        <select id="opciones">
                            <option value="" disabled selected>>-- Selecciona --<</option>
                            <option value="compra">Compra</option>
                            <option value="vende">Vende</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" placeholder="Cantidad">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Contacto</legend>
                    <div class="campo forma-contacto">
                        <p>Forma de ser contactado</p>
                        <div class="campo">
                            <label for="contactar-telefono">telefono</label>
                            <input type="radio" name="FormaContacto" id="telefono">
                        </div>
                        <div class="campo">
                            <label for="contactar-email">E-mail</label>
                            <input type="radio" name="FormaContacto" id="email">
                        </div>
                    </div>

                    <div class="campo">
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="" id="">
                    </div>
                    <div class="campo">
                        <label for="hora">Hora:</label>
                        <input type="time" name="hora" id="hora" min="09:00" max="18:00">
                    </div>

                    <input type="submit" value="Enviar" class="boton-verde">

                </fieldset>
            </form>

        </picture>

    </main>

<?php
incluirTemplate('footer'); 
?>