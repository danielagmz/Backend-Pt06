<?php 
require_once 'model/update_info.php';
require_once 'controllers/login.php';
define('USER_ID', $_SESSION['id']);

function change_password($currentPassword, $newPassword, $verifyPassword) {
    $response = '';
    $currentPassword = test_input($currentPassword);
    $newPassword = test_input($newPassword);
    $verifyPassword = test_input($verifyPassword);

    // comprobar que el password coincida con la contraseña del sesion username

    $usuari = login_from_username($_SESSION['username']);
    if(is_empty($currentPassword)){
        $response = 'Introdueix la teva contrasenya actual';
    }else{
        if ($usuari == -1) {
        $response = 'No se ha podido encontrar el usuario';
    } else if (!password_verify($currentPassword, $usuari['pass'])) {
        $response = 'La contrasenya actual no es correcta';
    }
    }
    

    // comprobar que la contraseña cumpla la fortaleza y coincida con $verifyPassword
    if (is_empty($response)) {
        $response .= validate_password($newPassword, $verifyPassword);
    }
    
    if (is_empty($response)) {
        $hashed_pass = password_hash($newPassword, PASSWORD_DEFAULT);
        if (update_password(USER_ID, $hashed_pass)) {
            $response = '<p class="form-info form-info--success">Contrasenya modificada</p>';
        } else {
            $response = '<div class="form-info form-info--error">No se ha podido modificar la contrasenya </div>';
        }
    } else {
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
    }
    include_once 'views/secundarias/change_password.php';
}

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