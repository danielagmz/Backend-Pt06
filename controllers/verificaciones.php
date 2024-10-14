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
 * Comprueba si un valor es un numero.
 *
 * @param mixed $value El valor a comprobar.
 * @return bool TRUE si el valor es un numero, FALSE en caso contrario.
 */
function is_number($value)
{
    if (is_numeric($value)) {
        return true;
    }
    return false;
}

?>