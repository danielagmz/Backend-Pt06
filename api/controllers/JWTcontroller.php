<?php 

namespace api\controllers;
require_once 'lib/vendor/autoload.php';
require_once 'controllers/enviar_correu.php';

use api\Controllers\core\BaseController;
use Models\Tokens;
use Models\Usuaris;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTcontroller extends BaseController {

    public static function generarJWT($user_id) {
        if (!$user_id) {
            return self::jsonResponse([], 204);
        }
        $token = JWTController::generarToken($user_id);
        $refreshToken = JWTController::generarRefreshToken($user_id);
        return self::jsonResponse(['token' => $token, 'refreshToken' => $refreshToken]);
    }

    public static function validarAutenticacion() {
        $headers = getallheaders();
        if (!isset($headers['authorization'])) {
            self::jsonResponse(['error' => 'Authorization header missing'], 401);
            exit;
        }
    
        $token = str_replace('Bearer ', '', $headers['authorization']);
        $isValid = self::validarJWT($token);
        
        if (!$isValid) {
            self::jsonResponse(['error' => 'Invalid or expired token, for refresh use «POST /api/refresh» and send "refreshToken"'], 401);
            exit;
        }
    }

    public static function handleRefreshToken($refreshToken) {
        if (!$refreshToken) {
            return self::jsonResponse(['error' => 'Refresh token is required'], 400);
        }
        $isvalid = self::validarRefreshJWT($refreshToken);

        if (!$isvalid) {
            return self::jsonResponse(['error' => 'Invalid or expired refresh token'], 401);
            
        }
    
        $decoded = JWTController::decodeRefreshToken($refreshToken);
        return  self::jsonResponse(['token' => JWTController::generarToken($decoded->data->user_id), 'refreshToken' => JWTController::generarRefreshToken($decoded->data->user_id)], 200);
    }

    public static function generarToken($user_id) {
        $expires = date('Y-m-d H:i:s', time() + (60 * 60)); // Expira en 1 hora
        $payload = [
            "iss" => "dgamez.cat", 
            "iat" => time(), 
            "exp" => $expires, 
            "data" => [
                "user_id" => $user_id
            ]
        ];
        try {
            return JWT::encode($payload, KEY , 'HS256');
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function generarRefreshToken($user_id) {
        $expires = date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60)); // Expira en 7 día
        $payload = [
            "iss" => "dgamez.cat", 
            "iat" => time(), 
            "exp" => $expires,
            "data" => [
                "user_id" => $user_id
            ]
        ];

        $token = JWT::encode($payload, REFRESH_KEY , 'HS256');
        $savedToken = Tokens::getRefreshToken($user_id);
        if ($savedToken != null) {
            Tokens::deleteRefreshToken($user_id);
        }

        if (Tokens::saveRefreshToken($user_id, $token, 'refreshTK', $expires)) {
            $user = Usuaris::getUser($user_id);
            if ($user != null) notificacion_newRefreshToken($user->getUsername(),$user->getEmail(), 'Nuevas credenciales de api');
            return $token; 
        }
        
        return null;
    }

    public static function validarJWT($token) {
        try {
            $decoded = JWT::decode($token, new Key(KEY, 'HS256'));
            // verifico que la data del payload no haya expirado 
            if (strtotime($decoded->exp) < time()) {
                return false;
            }
            // verifico que el id del usuario exista
            $user_id = $decoded->data->user_id;

            if ($user_id == null) {
                return false;
            }

            $user = Usuaris::getUser($user_id);
            if ($user == null) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function validarRefreshJWT($token) {
        try {
            $decoded = JWT::decode($token, new Key(REFRESH_KEY, 'HS256'));
            // verifico que la data del payload no haya expirado 
            if (strtotime($decoded->exp) < time()) {
                return false;
            }
            // verifico que el id del usuario exista
            $user_id = $decoded->data->user_id;

            if ($user_id == null) {
                return false;
            }else {
                $savedToken = Tokens::getRefreshToken($user_id);
                if ($token == null) {
                    return false;
                }else {
                    if ($token != $savedToken) {
                        return false;
                    }
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function decodeToken($token) {
        try {
            return JWT::decode($token, new Key(KEY, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function decodeRefreshToken($token) {
        try {
            return JWT::decode($token, new Key(REFRESH_KEY, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }


}