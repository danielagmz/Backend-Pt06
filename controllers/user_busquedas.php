<?php

function guardar_busqueda($valor)
{   
    if (isset($_SESSION['id'])) {
        // Si no existe, la inicializamos como array vacío
        if (!isset($_SESSION["busquedas"])) {
            $_SESSION["busquedas"] = [];
        }

        if (count($_SESSION["busquedas"]) >= 5) {
            array_shift($_SESSION["busquedas"]); // eliminamos el elemento mas antiguo
        }

        // Añadimos el nuevo valor al final

        $busqueda = test_texto($valor);
        $_SESSION["busquedas"][] = $busqueda;

    }
}


function crear_datalist_user()
{

    $html = '';

    if (isset($_SESSION['id']) && isset($_SESSION["busquedas"])) {
        // $busquedasGuardadas = obtener_busquedas_user($_SESSION['id']);

        $busquedasGuardadas = $_SESSION["busquedas"];
        if ($busquedasGuardadas != null) {
            foreach ($busquedasGuardadas as $busqueda) {
                $html .= "<option value='$busqueda'>$busqueda</option>";
            }
        }
    }

    return $html;
}
