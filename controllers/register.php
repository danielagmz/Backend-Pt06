<?php
require_once 'model/register.php';
/**
 * Registra un nuevo usuario en la base de datos y todo es correcto redirecciona a la pagina principal 
 *
 * @param string $username Nombre de usuario 
 * @param string $email Email del nuevo usuario
 * @param string $password Contraseña del nuevo usuario
 * @param string $verifypassword Verificación de la contraseña
 *
 * @return string un string con errores en caso contrario
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
        $usuari = login_from_id($id);
        
        if ($id != -1 && $usuari != -1) {
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $usuari['email'];
            $_SESSION['bio'] = $usuari['bio'];
            $_SESSION['admin'] = $usuari['admin'];
            $_SESSION['avatar'] = $usuari['avatar'];
            $_SESSION['banner'] = $usuari['banner'];
            $_SESSION['SocialProvider'] = $usuari['socialProv'];
            header('Location: index.php?action=read');
            exit();
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



