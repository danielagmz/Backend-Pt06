<?php
require_once 'model/delete.php';
require_once 'model/login.php';
require_once 'controllers/logout.php';

/**
 * Funcion que se encarga de eliminar un articulo
 *
 * Primero comprueba si el id existe en la base de datos, si no existe
 * se muestra la pagina de error 404
 *
 * Si existe el id, se llama al modelo para borrar el articulo, si se
 * borra correctamente se muestra un mensaje de exito y un boton para
 * regresar a la pagina principal, si no se puede borrar se muestra un
 * mensaje de error
 *
 * @param int $id id del articulo a eliminar
 */
function delete($id)
{
    $id = id_exists($id);
    if ($id == 0) {
        include_once 'views/error/404.php';
        return;
    } else {
        // llamamos al modelo para borrar el articulo
        $response = delete_article($id);
        if ($response) {
            $response = '<p class="form-info form-info--success"> Article esborrat correctament 🥳</p>';
            $button = '<a href="index.php?action=delete&page=1" class="form__button form__button--mark">Tornar</a>';
        } else {
            $response = '<p class="form-info form-info--error"> No s\'ha pogut esborrar l\'article</p>';
        }
        include_once 'views/secundarias/deleting.php';
    }
}

/**
 * Funcion que se encarga de eliminar la cuenta del usuario logueado
 *
 * Primero verifica que la contraseña introducida coincida con la de la sesion
 * si no es correcta se muestra un mensaje de error, si es correcta se llama
 * al modelo para borrar el usuario, si se borra correctamente se muestra un
 * mensaje de exito y se cierra la sesion, si no se puede borrar se muestra un
 * mensaje de error
 *
 * @param string $password Contraseña actual del usuario
 */
function delete_account($password)
{
    $password = test_input($password);
    $usuari = login_from_username($_SESSION['username']);
    //verificar que la contraseña coincida con la de la sesion
    if (is_empty($password)) {
        echo '<div class="form-info form-info--error">Introdueix la teva contrasenya actual</div>';
        return;
    }
    if (!password_verify($password, $usuari['pass'])) {
        echo '<div class="form-info form-info--error"> La contrasenya no es correcta</div>';
        return;
    }

    $id = $_SESSION['id'];
    $response = delete_user_by_id($id);
    if ($response) {
        guardar_cookie('remember', '', time() - 3600);
        borrar_token('rememberTK', $_SESSION['id']);
        borrar_token('refreshTK', $_SESSION['id']);

        session_unset();
        session_destroy();
        http_response_code(200);
        echo '<div class="form-info form-info--success"> Usuari esborrat correctament 🥳</div>';
        return;
    } else {
        http_response_code(500);
        echo '<div class="form-info form-info--error"> No s\'ha pogut esborrar l\'usuari</div>';
        return;
    }
}

/**
 * Elimina un usuario por su ID.
 *
 * Verifica si el usuario se ha podido eliminar correctamente,
 * si es así muestra un mensaje de éxito y devuelve un estado 200,
 * si no se puede eliminar muestra un mensaje de error y devuelve un estado 500.
 *
 * @param int $id ID del usuario que se va a eliminar.
 */
function delete_user($id){
    if(delete_user_by_id($id)){
        http_response_code(200);
        echo '<div class="form-info form-info--success"> Usuari esborrat correctament 🥳</div>';
    }else{
        http_response_code(500);
        echo '<div class="form-info form-info--error"> No s\'ha pogut esborrar l\'usuari</div>';
    }
}
