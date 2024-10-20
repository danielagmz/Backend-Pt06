<?php 

/**
 * Destruye la sesión actual y redirige a la pagina de inicio
 */
function logout() {
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
}
?>