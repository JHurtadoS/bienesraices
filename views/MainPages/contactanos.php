<main class="contenedor seccion">
    <h1>Contactanos</h1>
    <picture>
        <source src="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpge">
        <img loading="lazy" src="build/img/destacada3.webp">
        <h2>LLena el formulario</h2>
        <form class="formulario" action="/contactanos" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" placeholder="Nombre" name="contacto[nombre] required">
                </div>
                <div class="campo">
                    <label for="email">E-mail:</label>
                    <input type="email" placeholder="E-mail" name="contacto[email] required">
                </div>

                <div class="campo">
                    <label for="telefono">Telefono:</label>
                    <input type="tel" placeholder="Telefono" name="contacto[telefono] required">
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="contacto[mensaje] required"></textarea>
                </div>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre propiedad</legend>
                <div class="campo">
                    <label for="">VENDE O COMPRA</label>
                    <select id="opciones" name="contacto[tipo] required">
                        <option value="" disabled selected >>-- Selecciona --<< </option>
                        <option value="compra">Compra</option>
                        <option value="vende">Vende</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="precio" name="contacto[precio]">precio:</label>
                    <input type="number" placeholder="precio required">
                </div>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <div class="campo forma-contacto">
                    <p>Forma de ser contactado</p>
                    <div class="campo">
                        <label for="contactar-telefono">telefono</label>
                        <input type="radio" value="telefono" id="telefono" name="contacto[TipoContacto] required">
                    </div>
                    <div class="campo">
                        <label for="contactar-email">E-mail</label>
                        <input type="radio" value="email" id="email" name="contacto[TipoContacto] required">
                    </div>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="" id="" name="contacto[fecha] required">
                </div>
                <div class="campo">
                    <label for="hora">Hora:</label>
                    <input type="time" id="hora" min="09:00" max="18:00" value="hora" name="contacto[Hora] required">
                </div>

                <input type="submit" value="Enviar" class="boton-verde">

            </fieldset>
        </form>

    </picture>

</main>