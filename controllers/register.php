<?php
require_once 'model/register.php';
/**
 * Registra un nuevo usuario en la base de datos.
 *
 * @param string $username Nombre de usuario del nuevo usuario
 * @param string $email Email del nuevo usuario
 * @param string $password Contraseña del nuevo usuario
 * @param string $verifypassword Verificación de la contraseña
 *
 * @return string Un string vacío si el registro ha sido exitoso, un string con errores en caso contrario
 */
function register($username, $email, $password, $verifypassword)
{
    $response = '';
    $username = test_input($username);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = test_input($password);
    $verifypassword = test_input($verifypassword);


    // Validaciones de usuario y email
    $response .= validate_username($username);
    $response .= validate_email($email);

    // Si no hay errores hasta el momento, se continúa con la validación de contraseña
    if (is_empty($response)) {
        $response .= validate_password($password, $verifypassword);
    }

    // Si no hay errores, registra el usuario
    if (is_empty($response)) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $id = register_user($username, $email, $hashed_pass);
        
        if ($id != -1) {
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            header('Location: index.php?action=read');
        } else {
            $response = '<p class="form-info form-info--error">No hem pogut registrar l\'usuari</p>';
        }
    }

    // Si hay errores, muestra los mensajes de error
    if (!is_empty($response)) {
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
        include_once 'views/principales/register.php';
    }
}



