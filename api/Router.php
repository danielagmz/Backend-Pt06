<?php

use api\controllers\ErrorController;
class Router extends ErrorController {
    private $routes = [];


    // Método para agregar rutas
    public function addRoute($method,$pattern, $callback) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'callback' => $callback
        ];
    }

    // Método para hacer el match y ejecutar la ruta correspondiente
    public function matchRoute($requestMethod, $request) {
        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($requestMethod)) {
                continue;
            }
    
            $params = $this->matchPattern($request, $route['pattern']);
            if ($params !== false) {
                if (is_callable($route['callback'])) {
                    call_user_func_array($route['callback'], $params);
                } else {
                    echo "Error: El callback no es válido.";
                }
                return;
            }
        }
    
        // Si no se encuentra la ruta
        $this->notFound();
    }
    

    // Método para hacer el match de un patrón con la ruta solicitada
    private function matchPattern($request, $pattern) {
        $pattern = preg_quote($pattern, '/');
        $pattern = str_replace('\{', '(', $pattern);  
        $pattern = str_replace('\}', ')', $pattern);  
    
        $pattern = preg_replace('/\(([^)]+)\)/', '([\w-]+)', $pattern);
    
        if (preg_match('/^' . $pattern . '$/', $request, $matches)) {
            array_shift($matches); // Eliminar la ruta completa
            return $matches;
        }
    
        return false;
    }

    
    public static function getRequestBody()
    {
        $rawBody = file_get_contents('php://input');

        // Intentar decodificarlo como JSON
        $body = json_decode($rawBody, true);

        // Devolver el contenido decodificado o vacío si no es JSON válido
        return $body ?? [];
    }

    public function validarProtocolo() {
        $protocolo_actual = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    
        if ($protocolo_actual !== PROTOCOL) {
            self::jsonResponse(['error' => 'Invalid protocol'], 400);
        }
    }
    

}
