<!-- Daniela Gamez -->
<?php
// require_once './model/db/insertarUsuarios.php';



// ⭐  funciones de validación

/**
 * Sanitiza un string de entrada para que sea seguro para su uso en una consulta SQL.
 * El string se somete a las siguientes transformaciones:
 * 1. Se eliminan los espacios en blanco al principio y al final.
 * 2. Se eliminan los caracteres especiales.
 * 3. Se convierten los caracteres especiales en entidades HTML.
 * @param string $data El string a sanitizar.
 * @return string El string sanitizado.
 */
function test_input($data)
{
    //elimina espacios 
    $data = trim($data);
    //elimina caracteres especiales
    $data = stripslashes($data);
    //convierte caracteres especiales
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Comprueba si un valor esta vacio.
 *
 * @param string $value El valor a comprobar.
 * @return bool TRUE si el valor es vacio, FALSE en caso contrario.
 */
function is_empty($value)
{
    if (empty($value)) {
        return true;
    }
    return false;
}

/**
 * Comprueba si un valor es un número entero positivo.
 *
 * @param mixed $value El valor a comprobar.
 * @return bool TRUE si el valor es un número entero positivo, FALSE en caso contrario.
 */
function is_number($value)
{
    return is_numeric($value);
}



/**
 * Valida un nombre de usuario.
 *
 * Comprueba que el nombre de usuario no este vacio y que no exista ya en la base de datos.
 *
 * @param string $username El nombre de usuario a comprobar.
 * @return string Un string vacio si el nombre de usuario es valido, un string de error en caso contrario.
 */
function validate_username($username)
{
    if (is_empty($username)) {
        return '<p>El nom d\'usuari no pot estar buit</p>';
    }
    if (username_exists($username)) {
        return '<p>El nom d\'usuari ja existeix</p>';
    }
    return '';
}


/**
 * Valida un email.
 *
 * Comprueba que el email no este vacio, que sea un email valido y que no exista en la base de datos.
 *
 * @param string $email El email a validar.
 *
 * @return string un string vacio si el email es valido, o un string con el error si no lo es.
 */
function validate_email($email)
{
    if (is_empty($email)) {
        return '<p>L\'email no pot estar buit</p>';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return '<p>L\'email no es valid</p>';
    }
    if (email_exists($email)) {
        return '<p>Aquest email ja existeix</p>';
    }
    return '';
}


/**
 * Valida que la contraseña tenga:
 * - al menos 8 caracteres
 * - una mayúscula
 * - una minúscula
 * - coincida con la verificación
 *
 * @param string $password La contraseña a validar
 * @param string $verifypassword La verificación de la contraseña
 * @return string Un string vacío si la contraseña es válida, un string con errores en caso contrario
 */
function validate_password($password, $verifypassword)
{
    $response = '';

    if (is_empty($password)) {
        $response .= '<p>La contrasenya no pot estar buida</p>';
    }
    if (strlen($password) < 8) {
        $response .= '<p>La contrasenya ha de tenir al menys 8 caracters.</p>';
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $response .= '<p>La contrasenya ha de tenir al menys una majúscula.</p>';
    }
    if (!preg_match('/[a-z]/', $password)) {
        $response .= '<p>La contrasenya ha de tenir al menys una minúscula.</p>';
    }
    if ($password !== $verifypassword) {
        $response .= '<p>Les contrasenyes no coincideixen</p>';
    }

    return $response;
}

?>