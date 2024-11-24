<?php
require_once 'model/update_info.php';
require_once 'controllers/login.php';
define('USER_ID', $_SESSION['id']);

function change_password($currentPassword, $newPassword, $verifyPassword) {
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

