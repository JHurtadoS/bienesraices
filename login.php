<?php 
    $errores=[];
    require 'inc/app.php';
    incluirTemplate('header');


    $loginCorrecto=false;
    if($_SERVER['REQUEST_METHOD']==='POST'){

        $queryUsuarios ="SELECT * FROM usuarios";
        $resultado = mysqli_query($db,$queryUsuarios);

        $variablesFormulario=$_POST;
        extract($variablesFormulario);
        $email=mysqli_real_escape_string($db,filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db,$_POST['password']);

        if(!$email){
            $errores[]="El email no es valido";
            echo "entro"."<br>";
        }
        if(!$password){
            $errores[]="la contraseña no es valida";
        }
        if($password && $email){
            while($row = mysqli_fetch_assoc($resultado)){
                if($email==$row['email']){
                    $auth=password_verify($password,$row['password']);
                    if($auth){
                        session_start();
                        $_SESSION['usuario']=$email;
                        $_SESSION['login']=true;
                        header('Location:/admin');
                        $loginCorrecto=true;
                    }else{
                        $errores[]='Contraseña equivocada';     
                    }
                }else{
                    $errores[]='Usuario no encontrado';
                }
            }
        }
    }
    
?>

    <main class="contenedor seccion">
        <h1>Iniciar sesion</h1>
        <form method="POST" class="formulario InicioSesion" action="">
            <fieldset>
                <legend>Email y Pasword </legend>
                <div class="campo">
                    <label class="InicioSesion" for="email">E-MAIL:</label>
                    <input class="InicioSesion" name="email" type="email" placeholder="Email" required>
                </div>
                <div class="campo InicioSesion">
                    <label class="InicioSesion" for="nombre">password:</label>
                    <input  class="InicioSesion" name="password" type="password" placeholder="Password" required>
                </div>
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

            <div class="<?php echo (count($errores)!=0 ?  'alerta' : 'alerta sucess');  ?>" > 
                <?php
                    if(count($errores)!=0){
                        foreach ($errores as $value) {
                            echo "<p>$value</p>";
                        }
                    }else if($loginCorrecto){
                        echo "<p>Insercion de datos correcto</p>";
                    }
                ?>
            </div>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>