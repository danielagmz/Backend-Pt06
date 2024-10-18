<?php
require_once 'model/login.php';
/**
 * Comprueba si el usuario y la contrasenya son correctos, 
 * si es asi, loguea al usuario y redirige a la pagina principal
 * 
 * @param string $username El nombre de usuario
 * @param string $password La contrasenya
 * @return void
 */
function login($username, $password) {
    $response = '';
    $usuari = login_from_username($username);

    if ($usuari == -1) {
        $response .= '<p> No s\'ha trobat cap usuari amb aquest username</p>';
    }else if (password_verify($password, $usuari['pass']) == false) {
        $response .= '<p>La contrasenya no es correcta</p>';
    }

    if (is_empty($response)){
        // si no hay errores se loguea al usuario
        $_SESSION['id'] = $usuari['id'];
        $_SESSION['username'] = $username;

        header('Location: index.php?action=read');
    }else{
        // si hay errores se muestran los errores en el formulario
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
        include_once 'views/principales/login.php';
    }


}


