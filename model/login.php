<?php 



/**
 * Comprueba si existe un usuario con el nombre de usuario especificado.
 *
 * @param string $username El nombre de usuario a comprobar
 *
 * @return array Un array que contiene todos los campos del usuario si existe, 
 * -1 si no existe o si se ha producido un error
 */
function login_from_username($username) {
    global $conn;
    
    if ($conn == null) {
        return -1;
    }
    try {
        $sql = "SELECT * FROM usuaris WHERE usuario = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $username));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return -1;
        }
        return $result;
    } catch (PDOException $e) {
        return -1;
    }
}

/**
 * Comprueba si existe un usuario con el id especificado.
 *
 * @param int $id El id del usuario a comprobar
 *
 * @return array Un array que contiene todos los campos del usuario si existe, 
 * -1 si no existe o si se ha producido un error
 */
function login_from_id($id) {
    global $conn;
    
    if ($conn == null) {
        return -1;
    }
    try {
        $sql = "SELECT * FROM usuaris WHERE id = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return -1;
        }
        return $result;
    } catch (PDOException $e) {
        return -1;
    }
}

?>