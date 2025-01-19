<?php

namespace api\core;

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
    public static function checkOption($option, $validOptions){
        if(!in_array($option, $validOptions)){
            return false;
        }
        return true;
    }
}
