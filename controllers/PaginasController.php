<?php
namespace Controlers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $inicio=true;
        $router->render("/MainPages/index",[
            'propiedades'=>$propiedades,
            'inicio'=>$inicio
         ]); 
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $inicio=false;
        $router->render("/MainPages/anuncios",[
            'propiedades'=>$propiedades,
            'inicio'=>$inicio
         ]); 
    }

    public static function anuncio(Router $router){
        $id=(int)$_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        if($id===0){
            header('location:/');
        }
        $propiedad = Propiedad::SelectWhere($id);
        $inicio=false;
        $router->render("/MainPages/anuncio",[
            'propiedad'=>$propiedad,
            'inicio'=>$inicio
         ]); 
    }

    public static function contacto(Router $router){
        $inicio=false;
        $mailValidate=true;
        $sucess=false;

        if($_SERVER['REQUEST_METHOD']==='POST'){

            foreach ($_POST['contacto'] as $key => $value) {
                if($value=='' || $value==' '){
                    $mailValidate=false;
                }
            }

            if($mailValidate){
                echo "entro";
                $respuestas = $_POST['contacto'];
                $mail = new PHPMailer();

                $mail->isSMTP();
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = '72950a33e4b850';
                $mail->Password = '7f30f505efdd18';
                $mail->SMTPSecure='tls';

                //contenido

                $mail->setFrom('admin@bienesraices.com');
                $mail->addAddress('admin@bienesraices.com','BienesRaices.com');
                $mail->Subject='Tienes un nuevo mensaje';

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                
                $contenido = '<html>';

                $contenido.='<p>Tienes un nuevo mensaje</p>';
                $contenido.="<p>Nombre: $respuestas[nombre]</p>";
                if($respuestas['TipoContacto']=='telefono'){
                    $contenido.="<p>Telefono: $respuestas[telefono]</p>";
                }else{
                    $contenido.="<p>email: $respuestas[email]</p>";
                }
                $contenido.="<p>mensaje: $respuestas[mensaje]</p>";
                $contenido.="<p>Tipo de servicio: $respuestas[tipo]</p>";
                $contenido.="<p>precio: $respuestas[precio]</p>";
                //$contenido.="<p>Tipo de Contacto: $respuestas[TipoContacto]</p>";
                $contenido.="<p>fecha: $respuestas[fecha]</p>";
                $contenido.="<p>Hora: $respuestas[Hora]</p>";
                $contenido.='</html>';

                $mail->Body = $contenido;
                $mail->AltBody = 'esto texto alternativo';

                if($mail->send()){
                    echo "se envio enviar";
                    $sucess=true;
                    header('location:/contactanos');
                }else{
                    echo "error al enviar";
                }
            }
        }
        
        $router->render("/MainPages/contactanos",[
            'inicio'=>$inicio,
            'sucess'=>$sucess
         ]); 
    }

    public static function blog(Router $router){
        $inicio=false;
        $router->render("/MainPages/blog",[
            'inicio'=>$inicio
         ]); 
    }

    public static function nosotros(Router $router){
        $inicio=false;
        $router->render("/MainPages/nosotros",[
            'inicio'=>$inicio
         ]); 
    }
}