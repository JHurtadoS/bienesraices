<?php
    declare(strict_types=1);

use App\Propiedad;

require  'inc/app.php';
    incluirTemplate('header',$inicio = true);

    //require 'inc/conf/database.php';
    $inicio = false;
    try{

    }catch (\Throwable $th) {
        echo $th;
    }
    $propiedad = new Propiedad();
    $propiedades = $propiedad->all();


?>

    <main class="contenedor seccion">
        <h2>Mas sobre Nosostros</h2>

        <div class="SobreNosotros seccion">
            <div class="items">
                <div class="item">
                    <img src="build/img/icono1.svg" alt="" srcset="">
                    <h2>SEGURIDAD</h2>
                    <div class="contenedor-texto">
                        <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue sed eros sit amet
                        </P>
                    </div>
                </div>
                <div class="item">
                    <img src="build/img/icono2.svg" alt="" srcset="">
                    <h2>PRECIO</h2>
                    <div class="contenedor-texto">
                        <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue sed eros sit amet
                        </P>
                    </div>
                </div>
                <div class="item">
                    <img src="build/img/icono3.svg" alt="" srcset="">
                    <h2>A TIEMPO</h2>
                    <div class="contenedor-texto">
                        <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue sed eros sit amet
                        </P>
                    </div>
                </div>
            </div>
        </div>

        <div class="propiedades-1">
            <h2>Casas y Depas en Venta</h2>
            <div class="contenedor-propiedades">
                <?php $i=0; foreach($propiedades as $value): $i++; if($i<=3): ?>
                    <?php 
                        inlcuirPropiedad($value->titulo,$value->nombreImagen,$value->precio,
                        $value->descripcion,$value->wc,$value->estacionamientos,$value->habitaciones,$value->id);
                    ?>
                 <?php endif; endforeach; ?>   

                <div class="contenedor-verTodasgrid">
                    <div class="boton boton-verTodas">
                        <a href="anuncios.php">Ver todas</a>
                    </div>
                </div>

            </div>

        </div>
                    
        </div>

    </main>

    <div class="seccion-contacto seccion">
        <div class="contenedor-contacto-grid">
            <div class="contenedor-seccion-contacto contenedor">
                <h3>Encuentra las casa de tus sueños</h3>
                <p>LLena el formulario de contacto y un asesor se pondra en contacto contigo lo mas pronto posible</p>
                <div class="contenedor-boton">
                    <div class="boton boton-propiedad">
                        <p>Contacto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="blog seccion contenedor">
        <div class="titulo-blog">
            <h3>Nuestro blog</h3>
        </div>
        <div class="entradas">
            <div class="entrada">
                <div class="contenedor-imagen">
                    <img src="build/img/blog1.jpg" alt="">
                </div>
                <div class="info-entrada">
                    <h4>Terraza en el techo</h4>
                    <p class="fecha">Escrito el<span>20/10/2021</span>por:<span>Admin</span></p>
                    <p class="texto-entrada">is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <div class="entrada">
                <div class="contenedor-imagen">
                    <img src="build/img/blog2.jpg" alt="">
                </div>
                <div class="info-entrada">
                    <h4>Terraza en el techo</h4>
                    <p class="fecha">Escrito el<span>20/10/2021</span>por:<span>Admin</span></p>
                    <p class="texto-entrada">is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
        </div>
        <div class="titulo-blog">
            <h3>Testimoniales</h3>
        </div>
        <div class="testimoniales">
            <div class="testimonial">
                <div class="contenido-testimonial">
                    <div class="texto-testimonial">
                        <blockquote>
                            <p class="texto-testimonial">El personal se comporta de una manera excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas</p>
                        </blockquote>
                        <p class="autor-testimonial">Juan de la torre</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
<?php
    incluirTemplate('footer');
    mysqli_close($db);
?>