<?php 
/**
 * Inserta un nuevo usuario en la base de datos.
 *
 * @param string $username Nombre de usuario del nuevo usuario
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
?>