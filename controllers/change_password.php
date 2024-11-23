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
        echo '<div class="form-info form-info--error">Introdueix la teva contrasenya actual</div>';
        return;
    }
    if ($usuari == -1) {
        echo '<div class="form-info form-info--error">No se ha podido encontrar el usuario</div>';
        return;
    }
    if (!password_verify($currentPassword, $usuari['pass'])) {
        echo '<div class="form-info form-info--error">La contrasenya actual no es correcta</div>';
        return;
    }

    $validationError = validate_password($newPassword, $verifyPassword);
    if (!is_empty($validationError)) {
        echo '<div class="form-info form-info--error">' . $validationError . '</div>';
        return;
    }

    $hashed_pass = password_hash($newPassword, PASSWORD_DEFAULT);
    if (update_password($usuari['id'], $hashed_pass)) {
        echo '<div class="form-info form-info--success profile-info">Contrasenya modificada</div>';
    } else {
        echo '<div class="form-info form-info--error">No se ha podido modificar la contrasenya</div>';
    }
}

