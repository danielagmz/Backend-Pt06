<?php 
/**
 * Inserta un nuevo usuario en la base de datos.
 *
 * @param string $username Nombre de usuario 
 * @param string $email Email del nuevo usuario
 * @param string $password Contraseña del nuevo usuario
 *
 * @return int El id del nuevo usuario, o -1 si se ha producido un error
 */
function register_user($username,$email, $password) {
    global $conn;

    if ($conn == null) {
        return -1;
    }

    try {
        $sql = "INSERT INTO usuaris (usuario, email, pass) VALUES (:username, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':username' => $username, ':email' => $email, ':password' => $password));
        $result = $conn->lastInsertId();
        if($result == null) {
            return -1;
        }
        return $result;

    } catch (PDOException $e) {
        return -1;
    }
}
/**
 * Inserta un nuevo usuario en la base de datos proveniente de una cuenta de autenticacion social.
 *
 * @param string $username Nombre de usuario 
 * @param string $email Email del nuevo usuario
 * @param string $password Contraseña del nuevo usuario para usuarios sociales un string vacío
 * @param string $provider Proveedor de la cuenta de autenticacion social
 *
 * @return int El id del nuevo usuario, o -1 si se ha producido un error
 */
function register_social_user($username,$email, $password, $provider) {
    global $conn;

    if ($conn == null) {
        return -1;
    }

    try {
        $sql = "INSERT INTO usuaris (usuario, email, pass, socialProv) VALUES (:username, :email, :password, :provider)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':provider' => $provider));
        $result = $conn->lastInsertId();
        if($result == null) {
            return -1;
        }
        return $result;

    } catch (PDOException $e) {
        return -1;
    }
}
?>