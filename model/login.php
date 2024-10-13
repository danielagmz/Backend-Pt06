<?php 


/**
 * Comprueba si existe un usuario con el nombre proporcionado.
 *
 * @param string $username Nombre del usuario a comprobar
 *
 * @return array Un array que contiene el id y la contrasena del usuario si existe, -1 en caso de error
 */
function login_from_username($username) {
    global $conn;
    
    if ($conn == null) {
        return -1;
    }
    try {
        $sql = "SELECT id,pass FROM usuaris WHERE usuario = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $username));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // retorna el id si existe
        if($result == null){
            return -1;
        }
        return $result;
    } catch (PDOException $e) {
        return -1;
    }
}


?>