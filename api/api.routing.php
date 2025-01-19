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
    echo ArticlesController::getAllArticles($filter);
});

$router->addRoute('GET','/api/articles/user/{id}', function($userId) {
    echo ArticlesController::getUserArticles($userId);
});

$router->addRoute('GET','/api/article/{id}', function($id) {
    echo ArticlesController::getArticle($id);
});

$router->addRoute('GET','/api/articles/user/{username}', function($username) {
    
});

$router->matchRoute($relativeUri);

