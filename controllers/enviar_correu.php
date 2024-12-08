<?php
// importar phpmailer
require_once 'lib/PHPMailer/src/PHPMailer.php';
require_once 'lib/PHPMailer/src/SMTP.php';
require_once 'lib/PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;


/**
 * Funcion para enviar un email de recuperacion de cuenta
 *
 * La funcion instanciara un objeto PHPMailer, configurara los datos de envio
 * y el contenido del email y lo enviara. Si se produce un error al enviar el
 * email, se lanzara una excepcion.
 *
 * @param string $nom nombre del usuario
 * @param string $correu email del usuario
 * @param string $token token de recuperacion
 * @param string $assumpte asunto del email
 *
 * @return bool true si se ha podido enviar el email, false en caso contrario
 */
function enviar_email($nom, $correu, $token, $assumpte)
{
    // instanciar phpmailer
    $email = new PHPMailer(true);

    try {
        // configurar phpmailer
        $email->isSMTP();
        $email->Host = HOST;
        $email->SMTPAuth = true;
        $email->SMTPSecure = 'tls';
        $email->Port = PORT;
        $email->Username   = USER;
        $email->Password   = PASS;
        $email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        // establecer los datos de envio y el contenido del email
        $email->isHTML(true);
        $email->CharSet = 'UTF-8';
        $email->setFrom(FROM, 'no-reply');
        $email->addAddress($correu, $nom);

        $email->Subject = $assumpte;
        $mensaje = file_get_contents('views/templates/recover.html');
        $mensaje = str_replace('{nombre_usuario}', $nom, $mensaje);
        $mensaje = str_replace('{enlace_recuperacion}', BASE_RESET_URL . $token, $mensaje);
        $email->Body = $mensaje;

        // enviar el email
        if ($email->send()) {
            // si se ha podido enviar el email se avisa
            return true;
        } else {
            // si no se ha podido enviar el email se lanza un error
            throw new Exception();
        }
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
        
    }
}

