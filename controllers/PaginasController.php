<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){


        $router->render('paginas/nosotros', [

        ]);
    }

    public static function propiedades(Router $router){
        
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){

        $id=validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad'=> $propiedad
        ]);
    }

   

    public static function entrada(Router $router){
        
       

        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router){

        $mensaje = null;

         if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];
          

            //CREAR INSTANCIA DE PHPMAILER
            $mail =new PHPMailer();


            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = True;
            $mail->Username = '2944b706bb8307';
            $mail->Password = '5d9c0782a4cac4';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'Bienes Raices');
            $mail->Subject = ('Tienes un nuevo mensaje');


            //habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';


            //CONTENIDO
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';


            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p>Eligio ser contactado por telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';
            }else{
                $contenido .= '<p>Eligio ser contactado por Email</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Compra o Vende: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';

            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            //Enviar el email
            if($mail->send()){
                $mensaje = 'Mensaje Enviado Correctamente';
            } else {
                $mensaje = 'No se pudo enviar el mensaje';
            }

        }
        
        $router->render('paginas/contacto', [
            'mensaje'=>$mensaje
        ]);
    }
}