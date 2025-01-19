<?php 

namespace api\controllers;

use api\Controllers\Core\BaseController;

class ErrorController extends BaseController {
    public static function notFound() {
        return self::jsonResponse(['error' => 'ruta no encontrada'], 404);
    }

    public static function internalServerError() {
        return self::jsonResponse(['error' => 'error interno del servidor'], 500);
    }

    public static function badRequest() {
        return self::jsonResponse(['error' => 'bad request'], 400);
    }

    public static function forbidden() {
        return self::jsonResponse(['error' => 'forbidden'], 403);
    }
}