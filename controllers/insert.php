<?php

require_once 'model/create.php';
define('USER_ID', $_SESSION['id']);
/**
 * Funcion que se encarga de crear un nuevo articulo
 * @param string $title Titulo del articulo
 * @param string $content Contenido del articulo
 */
function create($title, $content)
{
    $response = '';
    // sanitizar los datos
    $title = test_input($title);
    $content = test_input($content);

    // los campos tienen que estar llenos y el título no debe existir
    if (is_empty($title)) {
        $response .= '<p>El <span class="campo">Titol</span> no pot estar buit<p>';
    }
    if (article_exists($title) != -1) {
        $response .= '<p>El Ja tenim un article amb aquest <span class="campo">Titol</span><p>';
    }
    if (is_empty($content)) {
        $response .= '<p>El <span class="campo">Contingut</span> no pot estar buit<p>';
    }
    // si no hay errores se intenta insertar el articulo
    if (is_empty($response)) {
        $id = create_article($title, $content, USER_ID);
        if ($id == -1) {
            $response =  '<p class="form-info form-info--error">No hem pogut inserir l\'article</p>';
        } else {
            // si se ha insertado se limpian los campos y se muestra un mensaje
            $title = $content = '';
            $response = '<p class="form-info form-info--success"> Article inserit correctament 🥳</p>';
            $button = '<a href="index.php?action=read&page=1" class="form__button form__button--mark">Veure articles</a>';
        }
    } else {
        // si hay errores se muestran los errores en el formulario
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
    }
    include_once 'views/principales/insert.php';
}
?>