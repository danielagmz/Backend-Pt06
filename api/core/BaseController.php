<?php 

namespace api\Controllers\Core;

class BaseController{
    public static function jsonResponse($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function convertToArray(array $objects): array {
        return array_map(function ($object) {
            if (method_exists($object, 'toArray')) {
                return $object->toArray();
            }
            throw new \Exception('El objeto no tiene el método toArray.');
        }, $objects);
    }
}