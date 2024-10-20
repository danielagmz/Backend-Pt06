<?php 

/**
 * Guarda un valor en una cookie.
 *
 * @param string $nombre Nombre de la cookie que se va a guardar.
 * @param string $valor Valor que se va a guardar en la cookie.
 * @param int $expiracion (Opcional) Hora de expiracion de la cookie. Si no se especifica, no expira.
 */
function guardar_cookie($nombre, $valor, $expiracion = 0) {
    setcookie($nombre, $valor, $expiracion);
}

/**
 * Borra una cookie. La hora de expiracion se establece en la hora actual menos una hora, 
 * para asegurarse de que se borre la cookie.
 *
 * @param string $nombre nombre de la cookie a borrar.
 */
function borrar_cookie($nombre){
    setcookie($nombre, "", time() - 3600);
}

/**
 * Obtiene el valor de una cookie.
 *
 * @param string $nombre Nombre de la cookie a obtener.
 * @return string Valor de la cookie. Si no existe, devuelve un string vacio.
 */
function obtener_cookie($nombre){
    return $_COOKIE[$nombre];
}

