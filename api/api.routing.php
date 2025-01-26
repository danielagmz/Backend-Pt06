<?php

require_once 'models/Articles.php';
require_once 'models/Usuaris.php';
require_once 'models/entities/Article.php';
require_once 'models/entities/Usuari.php';
require_once 'models/core/Database.php';
require_once 'core/BaseController.php';
require_once 'core/BaseTrait.php';
require_once 'controllers/ArticlesController.php';
require_once 'controllers/ErrorController.php';
require_once 'Router.php';


use api\controllers\ArticlesController;

$router = new Router();

$router->addRoute('GET','/api/articles', function() {
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    echo ArticlesController::getAllArticles($filter, $order);
});
// id de usuario o username
$router->addRoute('GET','/api/articles/user/{identifier}', function($identifier) {
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    echo ArticlesController::getUserArticles($identifier, $filter, $order);
});

$router->addRoute('GET','/api/article/{id}', function($id) {
    echo ArticlesController::getArticle($id);
});

$router->matchRoute($relativeUri, $requestMethod);

