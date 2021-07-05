
<?php
    require  '../../inc/funciones.php';
    $inicio = false;
    incluirTemplate('header',$inicio);
?>

<main class="contenedor seccion">
<h1>Borrar</h1>
</main>
 

<?php
    incluirTemplate('footer'); 
    mysqli_close($db);
?>