<?php
require_once 'model/login.php';
/**
 * Comprueba si el usuario y la contrasenya son correctos, 
 * si es asi, loguea al usuario y redirige a la pagina principal
 * 
 * @param string $username El nombre de usuario
 * @param string $password La contrasenya
 * @return void
 */
function login($username, $password,$remember ,$recaptcha)
{
    $response = '';
    $username = test_input($username);
    $password = test_input($password);
    $usuari = login_from_username($username);

    if ($usuari == -1) {
        $response .= '<p> No s\'ha trobat cap usuari amb aquest username</p>';
    }

    if ($_SESSION['intentos'] <= 0) {
            $catcha = '<div class="form__group">
                <div class="g-recaptcha" data-sitekey="' . CATCHAKEYSITEWEB . '"></div>
                </div>';
                if (empty($recaptcha)) {
                    $response .= '<p>Verifiqui el CAPTCHA per continuar.</p>';
                } else {
                    // Verificar el CAPTCHA 
                    $response .= login_captcha($recaptcha);
                }
    
    }
    
    if (empty($response) && password_verify($password, $usuari['pass']) === false) {
        $response .= '<p>La contraseña no es correcta.</p>';
        $_SESSION['intentos']--;
    }

    // Verificar que no haya errores en $response ni códigos de error en el CAPTCHA
    if (empty($response)) {
        ini_set('session.gc_maxlifetime', 40 * 60);

        // si no hay errores, se loguea al usuario
        $_SESSION['id'] = $usuari['id'];
        $_SESSION['username'] = $username;
        $_SESSION['intentos'] = 3;
        $catcha = '';

        if ($remember) {
            $token = bin2hex(random_bytes(32));
            guardar_cookie('remember', $token, time() + 3600 * 24 * 30);
            guardar_rememberTK($token, $usuari['id']);
        }
        header('Location: index.php?action=read');
        exit();
    } else {
        // Si hay errores, se muestran en el formulario
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
        include_once 'views/principales/login.php';
    }
}

function login_captcha($recaptcha)
{
    $response = '';
    $erroresTraducidos = [
        'missing-input-secret' => 'Falta la clau secreta',
        'invalid-input-secret' => 'La clau secreta es invalida.',
        'missing-input-response' => 'Falta la resposta del captcha.',
        'invalid-input-response' => 'La resposta del captcha no es válida.',
        'bad-request' => 'La solicitud es inválida.',
        'timeout-or-duplicate' => 'La respuesta ha caducado o ya fue utilizada.'
    ];

    $recaptcharesponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . CATCHAKEYSECRET . '&response=' . $recaptcha);
    $atributos = json_decode($recaptcharesponse, true);

    if (isset($atributos['error-codes'])) {
        foreach ($atributos['error-codes'] as $codigoError) {
            if (isset($erroresTraducidos[$codigoError])) {
                var_dump($codigoError);
                $response .= '<p>' . $erroresTraducidos[$codigoError] . '</p>';
            } else {
                $response .= '<p>Error desconocido: ' . $codigoError . '</p>';
            }
        }
    }
    return $response;
}
