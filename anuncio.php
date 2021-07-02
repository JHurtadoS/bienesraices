
<?php
    require  'inc/funciones.php';
    $inicio = false;
    incluirTemplate('header');
?>

    <main class="contenedor seccion anuncio">
        <h1>Casa en el lago </h1>
        <div class="contenedor-propiedades anuncio-propiedad">
            <div class="propiedad">
                <div class="comtenedor-imagen-propiedad">
                    <img src="build/img/anuncio1.webp" alt="">
                </div>
                <div class="contenedor-info-propiedad">
                    <p>$3.000.000</p>

                    <div class="contenedor-iconos-propiedad">
                        <div class="contenedor-icono">
                            <img src="build/img/icono_wc.svg" alt="" srcset="">
                            <p class="cantidad-icono">1</p>
                        </div>

                        <div class="contenedor-icono">
                            <img src="build/img/icono_estacionamiento.svg" alt="" srcset="">
                            <p class="cantidad-icono">1</p>
                        </div>

                        <div class="contenedor-icono">
                            <img src="build/img/icono_dormitorio.svg" alt="" srcset="">
                            <p class="cantidad-icono">1</p>
                        </div>
                    </div>
                </div>



                <div class="descripcion-propiedad">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris commodo mauris turpis, nec vulputate risus auctor eu. Vestibulum elementum magna ac hendrerit sollicitudin. Nulla lacinia hendrerit lectus, non cursus tellus tristique
                        vel. Integer vitae tortor tortor. Nunc mattis pulvinar augue, eget aliquam risus rutrum sit amet. Nullam porta nisi rhoncus congue facilisis. Pellentesque porttitor varius tortor, et ultricies nisl mollis bibendum. Cras bibendum
                        tristique turpis nec sagittis. Suspendisse ullamcorper finibus massa, tristique posuere metus bibendum vitae. Ut risus purus, auctor egestas convallis in, consectetur ac ex. </p>

                    <p>Curabitur porta erat sed urna commodo rutrum. Donec eu magna vel sapien eleifend vehicula sed eu diam. Etiam laoreet tristique magna, quis ultricies ante iaculis nec. Integer dictum erat a egestas dapibus. Sed nec mauris feugiat, tincidunt
                        leo nec, gravida metus. Maecenas odio mi, faucibus vitae dictum non, volutpat in magna. Nunc vel nunc interdum, vestibulum urna vitae, aliquet magna. Quisque maximus interdum eros et tincidunt. Nam a tempor leo. Donec porttitor
                        nisl auctor dapibus tristique. Phasellus sagittis ex et lacinia facilisis. Fusce a bibendum mi. Quisque nec purus id neque pharetra imperdiet. Etiam posuere pulvinar augue, eu semper nibh euismod ut. Quisque sollicitudin nec erat
                        nec convallis. Nullam non mi felis. </p>
                </div>

            </div>
        </div>
        </div>
    </main>

<?php
incluirTemplate('footer'); 
?>