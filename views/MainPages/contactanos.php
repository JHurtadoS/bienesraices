<main class="contenedor seccion">
    <h1 data-cy="contacto">Contactanos</h1>
    <picture>
        <source src="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpge">
        <img loading="lazy" src="build/img/destacada3.webp">
        <h2>LLena el formulario</h2>
        <form class="formulario" action="/contactanos" method="POST" data-cy="formulario-contacto-submit">

            <?php 
                if($sucess==true){
                    echo 
                    '<script type="text/javascript">
                        document.addEventListener("DOMContentLoaded", (event) => {
                            let alerta = document.querySelector(".alerta");
                            if(alerta!=null){
                                alerta.scrollIntoView({behavior:"smooth"});
                            }
                        });
                    </script>'
                ;
                }
            ?>

            <fieldset>
                <legend>Informacion Personal</legend>
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" placeholder="Nombre" name="contacto[nombre]" required data-cy="nombre">
                </div>




                <div class="campo">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="contacto[mensaje]" required data-cy="mensaje"></textarea>
                </div>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre propiedad</legend>
                <div class="campo">
                    <label for="">VENDE O COMPRA</label>
                    <select id="opciones" name="contacto[tipo]" required data-cy="input-contacto-tipo">
                        <option value="" disabled selected>>-- Selecciona --<< </option>
                        <option value="compra">Compra</option>
                        <option value="vende">Vende</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="precio">precio:</label>
                    <input type="number" placeholder="precio" name="contacto[precio]" required data-cy="precio">
                </div>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <div class="campo forma-contacto">
                    <p>Forma de ser contactado</p>
                    <div class="campo">
                        <label for="contactar-telefono">telefono</label>
                        <input type="radio" value="telefono" id="telefono" name="contacto[TipoContacto]" required
                            data-cy="TipoContacto">
                    </div>
                    <div class="campo">
                        <label for="contactar-email">E-mail</label>
                        <input type="radio" value="email" id="email" name="contacto[TipoContacto]" required
                            data-cy="TipoContacto">
                    </div>
                </div>
                <div class="contacto"></div>
                <div class="campo">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" value="fecha" name="contacto[fecha]" required data-cy="fecha">
                </div>
                <div class="campo">
                    <label for="hora">Hora:</label>
                    <input type="time" id="hora" min="09:00" max="18:00" value="hora" name="contacto[Hora]" required
                        data-cy="hora">
                </div>
                <?php
                    if($sucess==true){
                        echo
                        "<div class='alerta sucess'>
                            <p data-cy='alerta'>Correo Enviado Nos comunicaremos prontamente con usted</p>
                        </div>";
                    }
                ?>
                <input type="submit" value="Enviar" class="boton-verde">

            </fieldset>
        </form>

    </picture>

</main>