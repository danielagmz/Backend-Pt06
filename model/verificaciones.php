<!-- Daniela Gamez -->

<?php

//⭐ Funciones de comprobación
/**
 * Comprueba si existe un articulo con el titulo proporcionado.
 *
 * @param string $value Titulo del articulo a comprobar
 *
 * @return int ID del articulo si existe, -1 si no existe o si se ha producido un error
 */
function article_exists($value){
    global $conn;

    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "SELECT * FROM articles WHERE titol = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $value));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // retorna el id si existe 
        if($result == null){
            return -1;
        }
        return $result['id'];
    } catch (PDOException $e) {
        return -1;
    }
}


/**
 * Comprueba si existe un usuario con el nombre proporcionado.
 *
 * @param string $value Nombre del usuario a comprobar
 *
 * @return bool true si existe, false si no existe o si se ha producido un error
 */
function username_exists($value){
    global $conn;

    if ($conn == null) {
        return false;
    };

    try {
        $sql = "SELECT * FROM usuaris WHERE usuario = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $value));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return false;
        }
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function id_from_username($value){
    global $conn;

    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "SELECT id FROM usuaris WHERE usuario = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $value));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return -1;
        }
        return $result['id'];
    } catch (PDOException $e) {
        return -1;
    }
}

function username_from_id($value){
    global $conn;

    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "SELECT usuario FROM usuaris WHERE id = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $value));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return -1;
        }
        return $result['usuario'];
    } catch (PDOException $e) {
        return -1;
    }
}

/**
 * Comprueba si existe un usuario con el email proporcionado.
 *
 * @param string $email Email del usuario a comprobar
 *
 * @return bool true si existe, false si no existe o si se ha producido un error
 */
function email_exists($email){
    global $conn;

    if ($conn == null) {
        return false;
    };

    try {
        $sql = "SELECT * FROM usuaris WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return false;
        }
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Comprueba si existe un articulo con el ID proporcionado.
 *
 * @param int $id ID del articulo a comprobar
 *
 * @return int 1 si existe, 0 si no existe, -1 si se ha producido un error
 */
function id_exists($id){
    global $conn;

    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // retorna el id si existe 
        if($result == null){
            return 0;
        }
        return $result['id'];
    } catch (PDOException $e) {
        return -1;
    }
}

/**
 * Comprueba si el usuario con el id especificado es el autor del articulo con el id especificado.
 *
 * @param int $id_user Identificador del usuario a comprobar
 * @param int $id_article Identificador del articulo a comprobar
 *
 * @return int el id si el usuario es el autor del articulo, 0 si no lo es, -1 si se ha producido un error
 */
function is_user_author($id_user,$id_article){
    global $conn;

    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "SELECT * FROM articles WHERE id = :id AND autor = :id_user";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $id_article,':id_user' => $id_user));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // retorna el id si existe 
        if($result == null){
            return 0;
        }
        return $result['id'];
    } catch (PDOException $e) {
        return -1;
    }
}

/**
 * Comprueba si existe un usuario con el token de recordatorio especificado.
 *
 * @param string $rememberTK Token de recordatorio a comprobar
 *
 * @return array Un array que contiene el id y el nombre de usuario si existe, un array vacio en caso de error
 */
function has_rememberTK($rememberTK){
    global $conn;

    if ($conn == null) {
        return [];
    };

    try {
        $sql = "SELECT * FROM usuaris WHERE rememberTK = :rememberTK";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':rememberTK' => $rememberTK));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return [];
        }
        return $result;
    } catch (PDOException $e) {
        return [];
    }
}



/**
 * Verifica si hay un token de recordatorio en una cookie y
 *   si existe, inicia la sesion automaticamente con el usuario
 *   relacionado con ese token.
 *
 *   Si no existe el token o no se ha iniciado la sesion,
 *   no hace nada.
 *
 */
function remember() {
    $token = isset($_COOKIE['remember']) ? $_COOKIE['remember'] : null;
    if ($token !== null) {
        $result = has_rememberTK($token);
        if (!empty($result)) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['usuario'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['bio'] = $result['bio'];
        }
    }
}


?>