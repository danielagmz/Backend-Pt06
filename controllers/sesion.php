<?php

/**
 * Establece las variables de sesión del usuario.
 *
 * Asigna valores de la información del usuario proporcionada a las variables de sesión
 * correspondientes, incluyendo id, nombre de usuario, email, biografía, permisos de administrador,
 * avatar y banner.
 *
 * @param array $usuari Arreglo asociativo que contiene la información del usuario.
 */
function set_user_session($usuari)
{
    $_SESSION['id'] = $usuari['id'];
    $_SESSION['username'] = $usuari['usuario'];
    $_SESSION['email'] = $usuari['email'];
    $_SESSION['bio'] = $usuari['bio'];
    $_SESSION['admin'] = $usuari['admin'];
    $_SESSION['avatar'] = $usuari['avatar'];
    $_SESSION['banner'] = $usuari['banner'];
    $_SESSION['SocialProvider'] = $usuari['socialProv'];
}
