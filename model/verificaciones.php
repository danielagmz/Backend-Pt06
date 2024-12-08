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

/**
 * Obtiene el id de un usuario por su username.
 *
 * @param string $value El nombre de usuario 
 *
 * @return int El id del usuario si existe, -1 si no existe o si se ha producido un error.
 */
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

/**
 * Obtiene el nombre de usuario de un usuario por su id.
 *
 * @param int $value El id del usuario.
 *
 * @return string El nombre de usuario si existe, "Usuari eliminat" si el usuario ha sido eliminado, cadena vacia si se ha producido un error.
 */
function username_from_id($value){
    global $conn;

    if ($conn == null) {
        return '';
    };

    try {
        $sql = "SELECT usuario FROM usuaris WHERE id = :value";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':value' => $value));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return 'Usuari eliminat';
        }
        return $result['usuario'];
    } catch (PDOException $e) {
        return '';
    }
}

/**
 * Obtiene el nombre de usuario de un usuario por su email.
 *
 * @param string $email El email 
 *
 * @return string El nombre de usuario si existe, cadena vacia si se ha producido un error.
 */
function username_from_email($email){
    global $conn;

    if ($conn == null) {
        return '';
    };

    try {
        $sql = "SELECT usuario FROM usuaris WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return '';
        }
        return $result['usuario'];
    } catch (PDOException $e) {
        return '';
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
 * Comprueba si existe un token con el tipo y valor especificados.
 *
 * @param string $type Tipo de token.
 * @param string $token Valor del token.
 *
 * @return int El id del usuario al que pertenece el token, -1 si no existe o si se ha producido un error.
 */
function has_token($type,$token) {
    global $conn;

    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "SELECT user_id FROM tokens WHERE type = :type AND token = :token";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':type' => $type,':token' => $token));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result == null) {
            return ;
        }
        return $result['user_id'];
    } catch (PDOException $e) {
        return -1;
    }
}

function getOldImagespath($id){
    global $conn;
    if ($conn == null) {
        return '';
    };
    try {
        $sql = "SELECT avatar,banner FROM usuaris WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return '';
        }
        return $result;
    } catch (PDOException $e) {
        return '';
    }
}

/**
 * Guarda un token en la base de datos.
 *
 * @param string $type El tipo de token ('rememberTK' o 'recoverTK')
 * @param string $token El valor del token
 * @param int $id El id del usuario al que se asocia el token
 * @param string $exp La fecha de expiracion del token en formato 'Y-m-d H:i:s'
 *
 * @return bool true si se ha guardado correctamente, false si se ha producido un error
 */
function guardar_token($type, $token, $id,$exp) {
    global $conn;

    if ($conn == null) {
        return false;
    }
    try {
        $sql = "INSERT INTO tokens (user_id, token, type,tokenExp) VALUES (:id, :token, :type, :exp)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $id, ':token' => $token, ':type' => $type, ':exp' => $exp));
        if ($stmt->rowCount() == 0) {
            return false;
        }
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Borra un token de un usuario.
 *
 * @param string $type El tipo de token ('rememberTK' o 'recoverTK')
 * @param int $user_id El id del usuario
 *
 * @return bool true si se ha borrado correctamente, false si se ha producido un error
 */
function borrar_token($type, $user_id) {
    global $conn;

    if ($conn == null) {
        return false;
    }

    try {
        $sql = "DELETE FROM tokens WHERE user_id = :id AND type = :type";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $user_id, ':type' => $type));
        if ($stmt->rowCount() == 0) {
            return false;
        }
        return true;
    } catch (PDOException $e) {
        return false;
    }
}


/**
 * Retorna el token de un usuario.
 *
 * @param string $tokentype El tipo de token (rememberTK o recoverTK)
 * @param int $user_id El id del usuario
 *
 * @return string El token del usuario si existe, cadena vacia si se ha producido un error
 */
function get_token($tokentype, $user_id) {
    global $conn;

    if ($conn == null) {
        return '';
    }
    try {
        $sql = "SELECT token FROM tokens WHERE user_id = :id AND type = :type";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $user_id, ':type' => $tokentype));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // retorna el token si existe
        if ($result == null) {
            return '';
        }
        return $result['token'];
    } catch (PDOException $e) {
        return '';
    }
}

/**
 * Comprueba si un token es valido.
 *
 * @param string $token El token a comprobar
 *
 * @return bool true si el token es valido, false si no existe o si se ha producido un error
 */
function is_token_valid($token){
    global $conn;
    if ($conn == null) {
        return false;
    };
    try {
        $sql = "SELECT tokenExp FROM tokens WHERE token = :token";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':token' => $token));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == null){
            return false;
        }
        $exp = $result['tokenExp'];
        $now = new DateTime();
        $exp = new DateTime($exp);
        if($now > $exp){
            return false;
        }
        return true;
    } catch (PDOException $e) {
        return false;
    }
}


?>