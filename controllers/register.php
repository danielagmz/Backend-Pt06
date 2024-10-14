<?php 
function register($username,$email, $password, $verifypassword) {
    $response = '';

    if (is_empty($username)) {
        $response .= '<p>El nombre de usuario no puede estar vacio</p>';
    }
    if (username_exists($username) != -1) {
        $response .= '<p>El nom d\'usuari ja existeix</p>';
    }
    if (is_empty($email)) {
        $response .= '<p>El email no puede estar vacio</p>';
    }
    if (email_exists($email) != -1) {
        $response .= '<p>Aquest email ja existeix</p>';
    }

    if (is_empty($password)) {
        $response .= '<p>La contrasenya no puede estar vacia</p>';
    }elseif ($password != $verifypassword) {
        $response .= '<p>Las contrasenya no coincideixen</p>';
    }

    if (is_empty($response)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $id = register_user($username,$email, $password);
    }else{
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
        include_once 'views/secundarias/register.php';
    }

    
    
}