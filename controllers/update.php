<?php 
require_once 'model/update.php';

/**
 * Funcion que se encarga de modificar un articulo de la base de datos
 * y mostrar el resultado de la operacion
 * @param int $id Identificador del articulo a modificar
 * @param string $title Titulo del articulo
 * @param string $content Contenido del articulo
 */
function update($id, $title, $content,$shared)
{
    $id = id_exists($id);
    // si el id no existe se redirige a la vista de 404
    if ($id == 0) {
        include_once 'views/error/404.php';
        return;
    }
    $title = test_input($title);
    $content = test_input($content);
    $response = '';


    // los campos tienen que estar llenos y el título no debe existir
    if (is_empty($title)) {
        $response .= '<p>El <span class="campo">Titol</span> no pot estar buit<p>';
    }
    if (article_exists($title) != -1 && $id != article_exists($title)) {
        $response .= '<p>El Ja tenim un article amb aquest <span class="campo">Titol</span><p>';
    }
    if (is_empty($content)) {
        $response .= '<p>El <span class="campo">Contingut</span> no pot estar buit<p>';
    }
    // si no hay errores se intenta updatear el articulo
    if (is_empty($response)) {
        $updated = update_article($id, $title, $content,$shared);
        // si se ha insertado se limpian los campos y se muestra un mensaje en funcion de la situacion
        if ($updated == 1) {
            $response = '<p class="form-info form-info--success"> Article actualitzat correctament 🥳</p>';
            $button = '<a href="index.php?action=update&page=1" class="form__button form__button--mark">Tornar</a>';
        } else if ($updated == 0) {
            $response = '<p class="form-info form-info--warning"> Es el mateix article d\'abans</p>';
            $button = '<a href="index.php?action=update&page=1" class="form__button form__button--mark">Tornar</a>';
        } else {
            $response = '<p class="form-info form-info--error"> No s\'ha pogut actualitzar l\'article</p>';
        }
    } else {
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
    }
    include_once 'views/secundarias/updating.php';
}

?>