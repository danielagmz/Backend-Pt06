<?php

namespace api\controllers\core;

trait BaseTrait
{
    public static function borrar_cookie($nombre)
    {
        setcookie($nombre, "", time() - 3600);
    }

    public static function test_input($data)
    {
        //elimina espacios 
        $data = trim($data);
        //convierte caracteres especiales
        $data = htmlspecialchars($data);
        return $data;
    }
    
}
