<?php
require_once 'model/read.php';

define('PAGE', (isset($_COOKIE['pagina_usuario']) && is_number(obtener_cookie('pagina_usuario'))) ? intval(obtener_cookie('pagina_usuario')) : 1);
define('LIMIT', (isset($_COOKIE['limite_usuario']) && is_number(obtener_cookie('limite_usuario'))) ? intval(obtener_cookie('limite_usuario')) : 5);
define('FILTER', '');
define('MIN_LIMIT', 2);
define('ORDER', isset($_COOKIE['order_usuario']) ? obtener_cookie('order_usuario') : "desc");
define('USER_ID', $_SESSION['id']);

/**
 * Genera la paginacion para el administrador, recibe como parametros
 * la pagina actual, el limite de registros por pagina, el filtro de
 * busqueda y el orden de los registros.
 *
 * @param int $page pagina actual
 * @param int $limit limite de registros por pagina
 * @param string $filter filtro de busqueda
 * @param string $order orden de los registros
 *
 * @return array con los usuarios formateados, los enlaces de paginacion
 * y el total de usuarios
 */
function admin_pagination($page = PAGE, $limit = LIMIT, $filter = FILTER, $order = ORDER)
{
    $filter = test_texto($filter);
    $usuarios = obtener_usuarios($filter, $order, USER_ID);
    if (!$usuarios['total']) {
        return ['Allusers' => '', 'links' => '', 'total' => 0];
    }
    $total = $usuarios['total'];
    $users = $usuarios['users'];

    $limit = (is_number($limit) && $limit >= MIN_LIMIT && $limit <= $total) ? $limit : LIMIT;

    if ($limit > $total) {
        $limit = $total;
    }
    $totalpages = ceil($total / $limit);
    $users = array_slice($users, ($page - 1) * $limit, $limit);
    $totalUsers = count($users);

    $links = crear_links_admin($limit, $page, $total, $totalpages);
    $formated = format_users($users);

    return ['Allusers' => $formated, 'links' => $links, 'total' => $totalUsers];
}

/**
 * Genera los enlaces de paginación para el administrador.
 *
 * @param int $limit Número de registros a mostrar por página.
 * @param int $page Número de página actual.
 * @param int $total Número total de registros.
 * @param int $totalpages Número total de páginas.
 *
 * @return string El HTML con los enlaces de las páginas.
 */
function crear_links_admin($limit = LIMIT, $page = PAGE, $total, $totalpages)
{
    $links = '';
    if ($total == 0) {
        $links .= '<a role="button" class="desactivado button--page"><i class="fi fi-rr-caret-left"></i></a>';
        $links .= '<a role="button" class="desactivado button--page button--page--right"><i class="fi fi-rr-caret-right"></i></a>';
        return $links;
    }
    // Validar que el límite esté entre 2 y el total de artículos
    $limit = (is_number($limit) && $limit >= MIN_LIMIT && $limit <= $total) ? $limit : LIMIT;

    // Validar que la página esté dentro del rango permitido
    $page = (is_number($page) && $page > 0) ? $page : PAGE;

    $totalpages = ceil($total / $limit);

    if ($page > $totalpages) {
        $page = $totalpages;
    } else if ($page < 1) {
        $page = PAGE;
    }

    $page = is_number($page) ? $page : 1;
    $limit = is_number($limit) ? $limit : 5;

    guardar_cookie('pagina_usuario', $page, time() + 3600 * 24 * 30);
    guardar_cookie('limite_usuario', $limit, time() + 3600 * 24 * 30);

    $links = '';

    // Obtener la URL actual y sus componentes
    $url = $_SERVER['REQUEST_URI'];
    $url_parts = parse_url($url);

    // Si hay query params, parsearlos; si no, iniciar como vacío
    parse_str($url_parts['query'] ?? '', $query_params);

    // enlace de la página anterior
    if ($page > 1) {
        $query_params['limit'] = $limit;
        $query_params['page'] = $page - 1;
        $links .= sprintf(
            '<a role="button" href="%s?%s" class="button--page"><i class="fi fi-rr-caret-left"></i></a>',
            $url_parts['path'],
            http_build_query($query_params)
        );
    } else {
        $links .= '<a role="button" class="desactivado button--page"><i class="fi fi-rr-caret-left"></i></a>';
    }

    // bucle para los enlaces de las páginas
    for ($i = 1; $i <= $totalpages; $i++) {
        if ($i == $page) {
            $links .= sprintf('<a class="num--pages page--active">%d</a>', $i); // Página actual
        } else {
            $query_params['limit'] = $limit;
            $query_params['page'] = $i;
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
        $links .= sprintf(
            '<a role="button" href="%s?%s" class="button--page button--page--right"><i class="fi fi-rr-caret-right"></i></a>',
            $url_parts['path'],
            http_build_query($query_params)
        );
    } else {
        $links .= '<a role="button" class="desactivado button--page button--page--right"><i class="fi fi-rr-caret-right"></i></a>';
    }

    return $links;
}

/**
 * Función que formatea los usuarios para mostrarlos en la tabla de usuarios
 *
 * @param array $users Los usuarios a mostrar
 *
 * @return string El HTML con los usuarios formateados
 */
function format_users($users)
{
    $formated = '';
    foreach ($users as $user) {
        if ($user['id'] === $_SESSION['id']) {
            continue;
        }
        $formated .= sprintf(
            '<tr class="user_row" data-id="%d">
                <td class="col user_name"><div class="user_image"><img src="%s"></div>%s</td>
                <td class="col user_created">%s</td>
                <td class="col user_updated">%s</td>
                <td class="col user_actions">
                    <div class="actions-container">
                        <button id="user-%d" class="delete-user__button"><i class="fi fi-rr-trash"></i></button>
                    </div>
                </td>
            </tr>',
            $user['id'],
            $user['avatar'] ? $user['avatar'] : 'public/assets/cats-nose.webp',
            $user['usuario'],
            $user['created_at'],
            $user['updated_at'],
            $user['id']
        );
    }

    return $formated;
}
