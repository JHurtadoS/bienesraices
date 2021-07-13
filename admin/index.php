
<?php

    use App\Propiedad;
    use App\Vendedor;

    $idBorrar;
    require  '../inc/app.php';
    analizarSesion();
    
    $inicio = false;
    try{
    }catch (\Throwable $th) {
        echo $th;
    }
   
    incluirTemplate('header',$inicio);
    
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id=$_POST['id'];
        $tipo=$_POST['tipo'];
        $id=filter_var($id,FILTER_VALIDATE_INT);

        if($tipo=="vendedor" && $id && validarTipoContenido($tipo)){
            $vendedor = new Vendedor($_POST);
            $resultado=$vendedor->borrar($id);
        }else if($tipo=="propiedad" &&$id && validarTipoContenido($tipo)){
            $propiedad = new Propiedad($_POST);
            $resultado=$propiedad->borrar($id);
            borrarImagen($propiedad);
        }

        if($resultado){
            header('location:/admin');
        }
    }
?>

<main class="contenedor seccion">
    <h1>Administrador bienes raices</h1>



    <div class="tabla_de_propiedades admin">
        <h2>Propiedades</h2>
        <div class="rows">
            <p>ID</p>
            <p>Titulo</p>
            <p>Imagen</p>
            <p>Precio</p>
            <p>Acciones</p>
        </div>
        <div class="propiedades">
        <?php foreach ($propiedades as $value):?>
            <p><?php echo $value->id; ?></p> 
            <p><?php echo $value->titulo; ?></p> 
            <img src="<?php echo "/imagenes/".$value->nombreImagen; ?>"> 
            <p><?php echo $value->precio; ?></p> 
            <div class="acciones">

                <form class="eliminar" method="POST">
                    <input type="hidden" name="id" value=" <?php echo $value->id ?> ">
                    <input type="hidden" name="tipo" value="propiedad">
                    <input type="submit" class="boton boton-rojo eliminar" value="Eliminar">
                </form>

                <div class="actualizar boton boton-amarillo">
                    <a href="propiedades/actualizar.php?id=<?php  echo $value->id; ?>">actualizar</a>
                </div>
                
            </div>
        <?php  endforeach; ?>
        </div>
    </div>

    <div class="boton boton-verde admin">
        <a href="/admin/propiedades/crear.php">Crear propiedad</a>
    </div>

    <div class="tabla_de_propiedades admin">
        <h2>Vendedores</h2>
        <div class="rows">
            <p>ID</p>
            <p>Nombre</p>
            <p>Apellido</p>
            <p>Telefono</p>
            <p>Acciones</p>
        </div>
        <div class="propiedades">
        <?php foreach ($vendedores as $value):?>
            <p><?php echo $value->id; ?></p> 
            <p><?php echo $value->nombre; ?></p> 
            <p><?php echo $value->apellido; ?></p> 
            <p><?php echo $value->telefono; ?></p> 
            <div class="acciones">

                <form class="eliminar" method="POST">
                    <input type="hidden" name="id" value=" <?php echo $value->id ?> ">
                    <input type="hidden" name="tipo" value="vendedor">
                    <input type="submit" class="boton boton-rojo eliminar" value="Eliminar">
                </form>

                <div class="actualizar boton boton-amarillo">
                    <a href="vendedores/actualizar.php?id=<?php  echo $value->id; ?>">actualizar</a>
                </div>
                
            </div>
        <?php  endforeach; ?>
        </div>
    </div>
    <div class="boton boton-verde admin">
            <a href="/admin/vendedores/crear.php">Crear Vendedor</a>
    </div>

</main>
 

<?php
    incluirTemplate('footer'); 
    mysqli_close($db);
?>