<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
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
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades,
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');

        // busca la propiedad por id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad,
        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router){
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas  = $_POST['contacto'];

            // crear una instancia de phpmailer
            $mail = new PHPMailer();

            // configurar SMTP(protocolo para envio de emails)
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'a1eb754321d2ab';
            $mail->Password = 'e2496d345e2424';
            $mail->SMTPSecure = 'tls';
            $mail->Port= 2525;

            // configurar contenido de mail
            $mail->setFrom('admin@bienesraices.com', 'BienesRaices.com');
            $mail->addAddress('admin@bienesraices.com');
            $mail->Subject = 'Tienes un nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Defonir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';
            

            // Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p>Eligió ser contactado por teléfono:</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
            }else{
                $contenido .= '<p>Eligió ser contactado por email:</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
            }

            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto:  $' . $respuestas['precio'] . ' </p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'esto es texto alternativo';

            // Enviar el mail
            if($mail->send()){
                $mensaje = 'Mensaje enviado correctamente';
            }else{
                $mensaje = 'Mensaje no enviado ';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje 
        ]);
    }


}