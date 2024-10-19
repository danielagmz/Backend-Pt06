<?php 

/**
 * Actualiza la contrase a de un usuario en la base de datos.
 *
 * @param int $id El id del usuario a actualizar.
 * @param string $password La nueva contraseña del usuario.
 *
 * @return bool true si se ha actualizado correctamente, false si se ha producido un error.
 */
function update_password($id, $password){
    global $conn;

    if ($conn == null) {
        return false;
    }
    
    try {
        $sql = "UPDATE usuaris SET pass = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':password' => $password, ':id' => $id));
        return true;
    } catch (PDOException $e) {
        return false;
    }
}