<?php 

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

?>