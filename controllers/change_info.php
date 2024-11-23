<?php 
require_once 'model/update_info.php';
require_once 'controllers/login.php';
define('USER_ID', $_SESSION['id']);

function change_info($username, $email, $bio) {
    $response = '';
    $username = test_input($username);
    $bio = test_texto($bio);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $usuari = login_from_username($_SESSION['username']);

    if (is_empty($username)) {
        $response .= '<p>El nom d\'usuari no pot estar buit</p>';
        $username = $usuari['usuario'];
    }
    if (is_empty($email)) {
        $response .= '<p>L\'email no pot estar buit</p>';
        $email = $usuari['email'];
    }
    if (is_empty($bio)) {
        $bio = $usuari['bio'];
    }

    if (is_empty($response)) {
        if (!($username == $usuari['usuario'] || $email == $usuari['email'])) {
            // Validaciones de usuario y email
            $response .= validate_username($username);
            $response .= validate_email($email);
        }
    }


    // Si hay errores, muestra los mensajes de error
    if (!is_empty($response)) {
        $response = '<div class="form-info form-info--error profile-info">' . $response . '</div>';
        include_once 'views/secundarias/settings.php';
    }

    // Si no hay errores, actualiza los datos del usuario
    if (is_empty($response)) {
        $updated = update_info(USER_ID, $username, $email, $bio);
        switch ($updated) {
            case -1:
                $response = '<div class="form-info form-info--error profile-info">No se ha podido modificar la información</div>';
                break;
            case 0:
                $response = '<div class="form-info form-info--warning profile-info">La informació no ha cambiat</div>';
                break;
            case 1:
                $response = '<p class="form-info form-info--success profile-info">Información modificada</p>';
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['bio'] = $bio;
                break;
        }
            
        include_once 'views/secundarias/settings.php';
    }
}