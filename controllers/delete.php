<?php 
require_once 'model/delete.php';
/**
 * Funcion que se encarga de eliminar un articulo de la base de datos
 * y mostrar el resultado de la operacion
 * @param int $id Identificador del articulo a eliminar
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
?>