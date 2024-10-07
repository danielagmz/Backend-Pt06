<!-- Daniela Gamez -->
<?php
require_once 'model/db.php';

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
        $id = create_article($title, $content);
        if ($id == -1) {
            $response =  '<p class="form-info form-info--error">No hem pogut inserir l\'article</p>';
        } else {
            // si se ha insertado se limpian los campos y se muestra un mensaje
            $title = $content = '';
            $response = '<p class="form-info form-info--success"> Article inserit correctament 🥳</p>';
            $button = '<a href="index.php?action=read" class="form__button form__button--mark">Veure articles</a>';
        }
    } else {
        // si hay errores se muestran los errores en el formulario
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
    }
    include_once 'views/principales/insert.php';
}



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
// variables para paginacion
define('PAGE', 1);
define('LIMIT', 5);
define('MIN_LIMIT', 2);
define('FILTER', '.');



/**
 * Funcion que se encarga de paginar los articulos de la base de datos
 *
 * @param int $page Número de página actual
 * @param int $limit Número de artículos a mostrar por página
 * @param string $filter Filtro opcional para buscar articulos
 *
 * @return string El html con todos los articulos paginados
 */
function paginate($page = PAGE, $limit = LIMIT, $filter = FILTER)
{
    $total = obtener_total();
    $art = '';

    // Validar que el límite esté entre 2 y el total de artículos
    $limit = is_number($limit) && $limit >= MIN_LIMIT && $limit <= $total ? $limit : LIMIT;

    // Validar que la página esté dentro del rango permitido
    $page = is_number($page) && $page > 0 ? $page : PAGE;

    $offset = ($page - 1) * $limit;
    $articulos = obtener_articulos($limit, $offset, $filter);
    if ($articulos == -1) {
        $art = '<article class="article cta span2C">  
        <div class="article__header">
            <div class="article__t">
            No hi ha articles a la base de dades 😞
            </div>
        </div>
        </article>';
        return $art;
    }

    // por cada articulo se crea el html correspondiente y se agrega a "art"
    // para el cos solos se muestra los primeros 200 caracteres
    foreach ($articulos as $article) {
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
    return $art;
}


/**
 * Crea los enlaces de paginación para la vista de artículos
 *
 * @param int $limit Número de artículos a mostrar por página
 * @param int $page Número de página actual
 * @param string $filter Filtro opcional para buscar artículos
 *
 * @return string El html con los enlaces de las páginas
 */
function crear_links($limit = LIMIT, $page = PAGE, $filter = FILTER)
{
    $total = obtener_total($filter);
    // Validar que el límite esté entre 2 y el total de artículos
    $limit = is_number($limit) && $limit >= MIN_LIMIT && $limit <= $total ? $limit : LIMIT;

    // Validar que la página esté dentro del rango permitido
    $page = is_number($page) && $page > 0 ? $page : PAGE;

    $totalpages = ceil($total / $limit);
    $links = '';

    // Obtener la URL actual y sus componentes
    $url = $_SERVER['REQUEST_URI'];
    $url_parts = parse_url($url);

    // Si hay query params, parsearlos; si no, iniciar como vacío
    parse_str($url_parts['query'] ?? '', $query_params);

    if ($page < 1 || $page > $totalpages) {
        // Redirigir a la primera página
        $query_params['limit'] = $limit;
        $query_params['page'] = 1;
        $query_params['filter'] = $filter;
        header("Location: " . $url_parts['path'] . '?' . http_build_query($query_params));
        exit();
    }
    
    // enlace de la página anterior
    if ($page > 1) {
        $query_params['limit'] = $limit;
        $query_params['page'] = $page - 1;
        $query_params['filter'] = $filter;
        $links .= sprintf(
            '<a role="button" href="%s?%s" class="button--page"><i class="fi fi-rr-caret-left"></i></a>',
            $url_parts['path'],
            http_build_query($query_params)
        );
    }

    // bucle para los enlaces de las páginas
    for ($i = 1; $i <= $totalpages; $i++) {
        if ($i == $page) {
            $links .= sprintf('<a class="num--pages page--active">%d</a>', $i); // Página actual
        } else {
            $query_params['limit'] = $limit;
            $query_params['page'] = $i;
            $query_params['filter'] = $filter;
            $links .= sprintf(
                '<a class="num--pages" href="%s?%s">%d</a>',
                $url_parts['path'],
                http_build_query($query_params),
                $i
            );
        }
    }

    // enlace de la página siguiente
    if ($page < $totalpages) {
        $query_params['limit'] = $limit;
        $query_params['page'] = $page + 1;
        $query_params['filter'] = $filter;
        $links .= sprintf(
            '<a role="button" href="%s?%s" class="button--page button--page--right"><i class="fi fi-rr-caret-right"></i></a>',
            $url_parts['path'],
            http_build_query($query_params)
        );
    }

    return $links;
}



/**
 * Devuelve el número total de artículos en la base de datos.
 *
 * @return int Número de artículos.
 */
function max_articles()
{
    $total = obtener_total();
    return $total;
}

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
            $button = '<a href="index.php?action=delete" class="form__button form__button--mark">Tornar</a>';
        } else {
            $response = '<p class="form-info form-info--error"> No s\'ha pogut esborrar l\'article</p>';
        }
        include_once 'views/secundarias/deleting.php';
    }
}


/**
 * Funcion que se encarga de modificar un articulo de la base de datos
 * y mostrar el resultado de la operacion
 * @param int $id Identificador del articulo a modificar
 * @param string $title Titulo del articulo
 * @param string $content Contenido del articulo
 */
function update($id, $title, $content)
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
        $updated = update_article($id, $title, $content);
        // si se ha insertado se limpian los campos y se muestra un mensaje en funcion de la situacion
        if ($updated == 1) {
            $response = '<p class="form-info form-info--success"> Article actualitzat correctament 🥳</p>';
            $button = '<a href="index.php?action=update" class="form__button form__button--mark">Tornar</a>';
        } else if ($updated == 0) {
            $response = '<p class="form-info form-info--warning"> Es el mateix article d\'abans</p>';
            $button = '<a href="index.php?action=update" class="form__button form__button--mark">Tornar</a>';
        } else {
            $response = '<p class="form-info form-info--error"> No s\'ha pogut actualitzar l\'article</p>';
        }
    } else {
        $response = '<div class="form-info form-info--error">' . $response . '</div>';
    }
    include_once 'views/secundarias/updating.php';
}

// ⭐  funciones de validación

/**
 * Sanitiza un string de entrada para que sea seguro para su uso en una consulta SQL.
 * El string se somete a las siguientes transformaciones:
 * 1. Se eliminan los espacios en blanco al principio y al final.
 * 2. Se eliminan los caracteres especiales.
 * 3. Se convierten los caracteres especiales en entidades HTML.
 * @param string $data El string a sanitizar.
 * @return string El string sanitizado.
 */
function test_input($data)
{
    //elimina espacios 
    $data = trim($data);
    //elimina caracteres especiales
    $data = stripslashes($data);
    //convierte caracteres especiales
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Comprueba si un valor esta vacio.
 *
 * @param string $value El valor a comprobar.
 * @return bool TRUE si el valor es vacio, FALSE en caso contrario.
 */
function is_empty($value)
{
    if (empty($value)) {
        return true;
    }
    return false;
}

/**
 * Comprueba si un valor es un numero.
 *
 * @param mixed $value El valor a comprobar.
 * @return bool TRUE si el valor es un numero, FALSE en caso contrario.
 */
function is_number($value)
{
    if (is_numeric($value)) {
        return true;
    }
    return false;
}

?>