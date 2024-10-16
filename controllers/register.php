<?php
require_once 'model/register.php';
function register($username, $email, $password, $verifypassword)
{
    $response = '';

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
        include_once 'views/secundarias/register.php';
    }
}



