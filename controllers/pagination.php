<?php

require_once 'model/pagination.php';
require_once 'controllers/cookies.php';
// si el usuario ha iniciado sesion se establecen las variables de paginacion y si no se establecen en 1 y 5
if (isset($_SESSION['id'])) {
    define('PAGE', isset($_COOKIE['pagina']) ? obtener_cookie('pagina') : 1);
    define('LIMIT',isset($_COOKIE['limite_usuario']) ? obtener_cookie('limite_usuario') : 5);
    define('ORDER', isset($_COOKIE['order_usuario']) ? obtener_cookie('order_usuario') : "desc");
}else {
    define('PAGE', 1);
    define('LIMIT', 5);
    guardar_cookie('default','desc');
    define('ORDER', isset($_GET['order']) ? $_GET['order'] : "desc");
}
define('MIN_LIMIT', 2);
define('FILTER', '.');



/**
 * Función que se encarga de paginar los artículos de la base de datos
 *
 * @param int $page Número de página actual
 * @param int $limit Número de artículos a mostrar por página
 * @param string $filter Filtro opcional para buscar artículos
 * @param string $order Orden de los artículos (asc o desc)
 *
 * @return string El html con todos los artículos paginados
 */
function paginate($page = PAGE, $limit = LIMIT, $filter = FILTER)
{
    $total = obtener_total();
    $art = '';
    // Validar que el límite esté entre 2 y el total de artículos
    $limit = (is_number($limit) && $limit >= MIN_LIMIT && $limit <= $total) ? $limit : LIMIT;

    // Validar que la página esté dentro del rango permitido
    $page = (is_number($page) && $page > 0) ? $page : PAGE;
    
    $filter = test_texto($filter);
    guardar_busqueda($filter);


    $offset = ($page - 1) * $limit;
    $articulos = obtener_articulos($limit, $offset, $filter);
    if (!$articulos && $total == -1) {
        $art = '<article class="article disabled">  
        <div class="article__header">
            <div class="article__t">
            No hi ha articles a la base de dades 😞
            </div>
        </div>
        </article>';
        return $art;
        
    }else if (!$articulos) {
        $art = '<article class="article disabled">  
        <div class="article__header">
            <div class="article__t">
            No hi ha coincidències 
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
                <div class="article__header %s">
                    <div class="article__icon"></div>
                    <div class="article__title">%s</div>
                </div>
                <p class="article__body">%s...</p>  
                <div class="article__footer">
                    <span class="article__created"><i class="fi fi-rr-add-document icon"></i>%s</span>
                    <span class="article__author"><i class="fi fi-rr-user icon"></i>%s</span>
                </div>
            </article>',
            $article['id'],
            $article['shared'] == 1 ? 'article__header--shared' : '',
            $article['titol'],
            substr($article['cos'], 0, 200),
            $article['data_creacio'],
            username_from_id($article['autor'])

        );
    }
    return $art;
}



/**
 * Crea los enlaces de paginación para la vista de artículos.
 *
 * @param int $limit Número de artículos a mostrar por página.
 * @param int $page Número de página actual.
 * @param string $filter Filtro opcional para buscar artículos.
 *
 * @return string El HTML con los enlaces de las páginas.
 */
function crear_links($limit = LIMIT, $page = PAGE, $filter = FILTER, $action)
{
    $total = obtener_total($filter);
    $links = '';
    if ($total == -1) {
        $links .= '<a role="button" class="desactivado button--page"><i class="fi fi-rr-caret-left"></i></a>';
        $links .= '<a role="button" class="desactivado button--page button--page--right"><i class="fi fi-rr-caret-right"></i></a>';
        return $links;
    }

    // guardar_cookie('pagina', $page, time() + 3600 * 24 * 30);
    
    // Validar que el límite esté entre 2 y el total de artículos
    $limit = is_number($limit) && $limit >= MIN_LIMIT && $limit <= $total ? $limit : LIMIT;
    
    // Validar que la página esté dentro del rango permitido
    $page = is_number($page) && $page > 0 ? $page : PAGE;
    
    $page = is_number($page) ? $page : 1;
    $limit = is_number($limit) ? $limit : 5;

    $totalpages = ceil($total / $limit);
    if ($page < 1 || $page > $totalpages) {
        $page = 1;
        $redirect = sprintf('index.php?action=%s&page=%d&filter=%s', $action, $page,$filter);
        echo '<script>window.location.href = "' . $redirect . '";</script>';
    }

    // Obtener la URL actual y sus componentes
    $url = $_SERVER['REQUEST_URI'];
    $url_parts = parse_url($url);

    // Si hay query params, parsearlos; si no, iniciar como vacío
    parse_str($url_parts['query'] ?? '', $query_params);

    
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
    }else{
        $links .= '<a role="button" class="desactivado button--page"><i class="fi fi-rr-caret-left"></i></a>';
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
    }else{
        $links .= '<a role="button" class="desactivado button--page button--page--right"><i class="fi fi-rr-caret-right"></i></a>';
    }
    // se registran loc cambios en las cookies
    if (isset($_SESSION['id'])) {
        guardar_cookie('pagina', $page, time() + 3600 * 24 * 30);
        guardar_cookie('limite_usuario', $limit, time() + 3600 * 24 * 30);
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
 * Devuelve un input de tipo number que permite al usuario
 * cambiar el numero de articulos que se mostraran en
 * cada pagina.
 *
 * @return string Codigo html del input.
 */
function articles_pagina_user()
{
    if (isset($_SESSION['id'])) {
        return sprintf(
            '<input class="busqueda__input--page" id="page" type="number" min="2" max="%d" name="pages" step="1" value="%d">',
            max_articles(),
            isset($_GET['limit']) ? $_GET['limit'] : LIMIT
        );
    }
    return '';
}
