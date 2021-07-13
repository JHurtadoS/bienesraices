<?php
use App\Vendedor;
require  '../../inc/app.php';
analizarSesion();

$vendedor = new Vendedor();
$insercionCorrecta=false; 
$errores=[];
$entradaPost=false;

if($_SERVER['REQUEST_METHOD']==='POST'){
    $insercionCorrecta=true;
    $entradaPost=true;
}
incluirTemplate('header',$inicio=false);
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <form class="formulario" method="POST" action="/admin/vendedores/actualizar.php" enctype="multipart/form-data">
        <?php incluirFormulario('formulario_vendedores',$insercionCorrecta); ?>       
                        
        <input  type="submit" value="Guardar Cambios" class="boton-verde boton-formulario boton-formulario-admin">
        
        <div class="<?php echo (count($errores)!=0 || $insercionCorrecta==false ?  'alerta' : 'alerta sucess');  ?>" > 
            <?php
                if(count($errores)!=0){
                    foreach ($errores as $value) {
                        echo "<p>$value</p>";
                    }
                }else if($insercionCorrecta==true){
                    echo "<p>Insercion de datos correcto</p>";
                }else if($insercionCorrecta==false && $entradaPost==true){
                    echo "<p>Error en insercion de datos contecte con su proveedor</p>";
                }
            ?>
        </div>
    </form>

    <div class="boton boton-verTodas admin">
        <a href="../index.php">Volver</a>
    </div>

</main>


<?php
    incluirTemplate('footer'); 
?>