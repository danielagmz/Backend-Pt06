<?php 

namespace api\Controllers\Core;

class BaseController{
    public static function jsonResponse(array $data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        $data = array_merge(['status' => $status], self::decodeHtmlEntities($data));
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
    private static function decodeHtmlEntities(array $data): array {
        return array_map(function ($value) {
            if (is_array($value)) {
                return self::decodeHtmlEntities($value); // Decodifica valores anidados
            }
            return is_string($value) ? html_entity_decode($value, ENT_QUOTES | ENT_HTML5) : $value;
        }, $data);
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