<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="<?php  echo $inicio ? 'inicio' : '' ?>" >
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img class="logo" src="/build/img/logo.svg" alt="logotipo de bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="">
                </div>

                <div class="derecha">
                    <div class="contenedor-darkmode">
                        <img src="/build/img/dark-mode.svg" alt="">
                    </div>
                    <nav class="navegacion hover-nav">


                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contactanos.php">Contacto</a>
                    </nav>
                </div>
            </div>

            <?php echo $inicio ? 
            '<div class="contenedor-titulo-header"><h1>Venta de Casas Y departamentos <span> Exclusivos de lujo</span> </div>' 
            : ' '?>


        </div>



    </header>
    
