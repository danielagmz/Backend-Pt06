<?php

require_once 'models/Articles.php';
require_once 'models/Usuaris.php';
require_once 'models/Tokens.php';
require_once 'models/entities/Article.php';
require_once 'models/entities/Usuari.php';
require_once 'models/core/Database.php';
require_once 'core/BaseController.php';
require_once 'core/BaseTrait.php';
require_once 'controllers/ArticlesController.php';
require_once 'controllers/JWTcontroller.php';
require_once 'controllers/ErrorController.php';
require_once 'Router.php';


use api\controllers\ArticlesController;
use api\controllers\JWTController;

$router = new Router();

$router->validarProtocolo();

$router->addRoute('POST','/api/refresh', function() {
    $body = Router::getRequestBody();
    $refreshToken = $body['refreshToken'] ?? '';
    echo JWTController::handleRefreshToken($refreshToken);
});

$router->addRoute('POST','/api/login', function() {
    $body = Router::getRequestBody();
    $user = $body['user'] ?? '';

    echo JWTController::generarJWT($user);
});

$router->addRoute('GET','/api/articles', function() {
    JWTController::validarAutenticacion();
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    echo ArticlesController::getAllArticles($filter, $order);
});

$router->addRoute('GET','/api/articles/user/{identifier}', function($identifier) {
    JWTController::validarAutenticacion();
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    echo ArticlesController::getUserArticles($identifier, $filter, $order);
});

$router->addRoute('GET','/api/article/{id}', function($id) {
    JWTController::validarAutenticacion();
    echo ArticlesController::getArticle($id);
});


$router->matchRoute($requestMethod,$relativeUri);

