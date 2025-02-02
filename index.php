<?php
require_once 'controllers/env.php';
$requestMethod = $_SERVER['REQUEST_METHOD'];
$relativeUri = str_replace(ROOT, '', $_SERVER['REQUEST_URI']);
$relativeUri = strtok($relativeUri, '?');

if (preg_match('/^\/api\/.+$/', $relativeUri)) {
    require_once 'api/api.routing.php';
} else {
    require_once 'app.routing.php';
}
