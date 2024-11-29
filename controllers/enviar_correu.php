<?php
// importar phpmailer
require_once 'lib/phpmailer/src/PHPMailer.php';
require_once 'lib/phpmailer/src/SMTP.php';
require_once 'lib/phpmailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Envia un correu electrònic a una adreça amb un contingut determinat.
 *
 * @param string $nom      Nom del destinatari.
 * @param string $correu   Adreça de correu electrònic del destinatari.
 * @param string $missatge Contingut del correu electrònic.
 * @param string $assumpte Assumpte del correu electrònic.
 *
 * @return bool true si s'ha pogut enviar el correu electrònic, false en cas contrari.
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

