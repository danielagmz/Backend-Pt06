<?php
include_once 'model/read.php';
/**
 * Funcion que se encarga de leer los articulos de la base de datos
 * y mostrarlos 
 * @param string $filter Filtro opcional para buscar articulos
 * @return string El html con todos los articulos
 */
function read($filter = FILTER)
{
    $filter = test_input($filter);
    $articles = read_articles($filter); // [id (%d), titol(%s), cos(%s)]
    $art = '';
    // por cada articulo se crea el html correspondiente y se agrega a "art"
    // para el cos solos se muestra los primeros 200 caracteres
    foreach ($articles as $article) {
        $art .= sprintf(
            '
            <article class="article" data-id="%d"> 
                <div class="article__header">
                    <div class="article__icon"></div>
                    <div class="article__title">%s</div>
                </div>
                <p class="article__body">%s...</p>  
            </article>',
            $article['id'],
            $article['titol'],
            substr($article['cos'], 0, 200)

        );
    }
    if ($art == '' && $filter == '') {
        $art = '<article class="article cta span2C">  
        <div class="article__header">
            <div class="article__t">
            No hi ha articles a la base de dades 😞
            </div>
        </div>
        </article>';
    } else if ($art == '' && $filter != '') {
        // si no hay articulos que coincidan con el filtro se muestra un mensaje
        $art = '<article class="article span2c">  
                    <div class="article__header">
                        <div class="article__title">
                            No hi ha articles amb aquest nom
                        </div>
                    </div></article>';
    }
    return $art;
}

/**
 * Funcion que se encarga de leer un articulo de la base de datos
 * y mostrarlo
 * @param int $id Identificador del articulo a buscar
 * @param string $action Accion a realizar con el articulo: 
 * 
 *                  update -> formulario para actualizar el articulo
 *                  delete -> formulario de confirmacion para borrar el articulo
 *                  read -> vista de lectura del articulo
 */
function read_one($id, $action)
{
    $id = test_input($id);
    $id = id_exists($id);
    // se puede leer pero no actualizar o borrar un articulo si no se es el autor
    if ($action != "read") {
        if (isset($_SESSION['id'])) {
            $id = is_user_author($_SESSION['id'], $id);
        }
    }

    if ($id == 0) {
        include_once 'views/error/404.php';
        return;
    } else {
        $article = read_article($id);
        $title = $article['titol'];
        $content = $article['cos'];

        switch ($action) {
            case 'update':
                include_once 'views/secundarias/updating.php';
                break;
            case 'delete':
                include_once 'views/secundarias/deleting.php';
                break;
            case 'read':
                include_once 'views/secundarias/reading.php';
                break;
            case 'read-anonimo':
                include_once 'views/secundarias/reading-anonimo.php';
                break;
            default:
                include_once 'views/error/404.php';
                break;
        }
    }
}
