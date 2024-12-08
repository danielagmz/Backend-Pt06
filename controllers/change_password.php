<?php
require_once 'model/update_info.php';
require_once 'controllers/login.php';
define('USER_ID', isset($_SESSION['id']) ? $_SESSION['id'] : '');

/**
 * Cambia la contrasenya del usuario logueado.
 *
 * Valida que la contrasenya actual sea correcta y que la nueva cumpla las
 * condiciones de fortaleza. Si todo es correcto actualiza la contrasenya del
 * usuario.
 *
 * @param string $currentPassword Contraseña actual del usuario.
 * @param string $newPassword Nueva contraseña del usuario.
 * @param string $verifyPassword Verificación de la contraseña.
 *
 * @return string Un string con el resultado de la operación que recibe el cliente.
 */
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



/**
 * Recupera la contraseña del usuario. Valida que el token sea correcto, 
 * que la contraseña nueva cumpla las condiciones de fortaleza y que 
 * coincida con la verificación. Si todo es correcto actualiza la contraseña 
 * del usuario y borra el token.
 *
 * @param string $token Token de recuperación de contraseña.
 * @param string $newPassword Nueva contraseña del usuario.
 * @param string $verifyPassword Verificación de la contraseña.
 *
 * @return string Un string con el resultado de la operación que se retorna en vista.
 */
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
