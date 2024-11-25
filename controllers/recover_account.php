<?php 
require_once 'controllers/enviar_correu.php';
function recover_account($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $response='';
    // verificamos que el email este realmente asociado a un usuario
    if(email_exists($email)){
        $user = login_from_username(username_from_email($email));

        if($user){
            $token = bin2hex(random_bytes(16));
            $exp = date('Y-m-d H:i:s', strtotime('+1 day'));
            if(get_token('recoverTK', $user['id'])){
                borrar_token('recoverTK', $user['id']);
            }
            guardar_token('recoverTK', $token, $user['id'], $exp);
                if(enviar_email($user['usuario'], $email, $token, 'Recuperar contrasenya')){
                    $response .= '<p>Correu enviat <i class="fi fi-rr-paper-plane"></i></p>';
                    $response = '<div class="form-info form-info--success">' . $response . '</div>';
                }else{
                    $response = '<p class="form-info form-info--error"> No s\'ha pogut enviar el correu</p>';
                }; 

        }
        
    }else{
        $response='<p>No s\'ha trobat cap usuari amb aquest email</p>';
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
    }
    include_once 'views/secundarias/recover_account.php';
}