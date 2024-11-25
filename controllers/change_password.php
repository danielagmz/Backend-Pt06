<?php
require_once 'model/update_info.php';
require_once 'controllers/login.php';
define('USER_ID', isset($_SESSION['id']) ? $_SESSION['id'] : '');

function change_password($currentPassword, $newPassword, $verifyPassword)
{
    $currentPassword = test_input($currentPassword);
    $newPassword = test_input($newPassword);
    $verifyPassword = test_input($verifyPassword);

    $usuari = login_from_username($_SESSION['username']);
    if (is_empty($currentPassword)) {
        http_response_code(400);
        echo '<div class="form-info form-info--error">Introdueix la teva contrasenya actual</div>';
        return;
    }
    if ($usuari == -1) {
        http_response_code(500);
        echo '<div class="form-info form-info--error">No se ha podido encontrar el usuario</div>';
        return;
    }
    if (!password_verify($currentPassword, $usuari['pass'])) {
        http_response_code(400);
        echo '<div class="form-info form-info--error">La contrasenya actual no es correcta</div>';
        return;
    }

    $validationError = validate_password($newPassword, $verifyPassword);
    if (!is_empty($validationError)) {
        http_response_code(400);
        echo '<div class="form-info form-info--error">' . $validationError . '</div>';
        return;
    }

    $hashed_pass = password_hash($newPassword, PASSWORD_DEFAULT);
    if (update_password($usuari['id'], $hashed_pass)) {
        http_response_code(200);
        echo '<div class="form-info form-info--success profile-info">Contrasenya modificada</div>';
    } else {
        http_response_code(500);
        echo '<div class="form-info form-info--error">No se ha podido modificar la contrasenya</div>';
    }
}



function recover_password($token, $newPassword, $verifyPassword)
{
    $response = '';
    $newPassword = test_input($newPassword);
    $verifyPassword = test_input($verifyPassword);

    if (is_empty($newPassword)) {
        $response .= '<p>Introdueix una nova contrasenya</p>';
    }else if (is_empty($verifyPassword)) {
        $response .= '<p>Confirma la nova contrasenya!</p>';
    }
    // comprobar que la contraseña cumpla la fortaleza y coincida con $verifyPassword
    if (is_empty($response)) {
        $response .= validate_password($newPassword, $verifyPassword);
    }

    if (is_empty($response)) {
        $id=has_token('recoverTK', $token);
        if ($id != -1) {
            $hashed_pass = password_hash($newPassword, PASSWORD_DEFAULT);
            if (update_password($id, $hashed_pass)) {
                borrar_token('recoverTK', $id);
                $response = '<p class="form-info form-info--success">Contrasenya modificada, ja pots logar-te</p>';

            } else {
                $response = '<p class="form-info form-info--error">No se ha podido modificar la contrasenya </p>';
            }
        }else{
            $response = '<p class="form-info form-info--error">Token invalid o expirat</p>';
        }
    } else {
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
    }

    include_once 'views/secundarias/change_password.php';
}
