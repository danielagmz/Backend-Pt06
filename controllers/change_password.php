<?php 
require_once 'model/update_password.php';
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