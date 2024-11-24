<?php

/**
 * Actualiza la contrase a de un usuario en la base de datos.
 *
 * @param int $id El id del usuario a actualizar.
 * @param string $password La nueva contraseña del usuario.
 *
 * @return bool true si se ha actualizado correctamente, false si se ha producido un error.
 */
function update_password($id, $password)
{
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

/**
 * Actualiza la información de un usuario en la base de datos.
 *
 * @param int $id El id del usuario a actualizar.
 * @param string $username El nuevo nombre de usuario.
 * @param string $email El nuevo email del usuario.
 * @param string $bio La nueva biografía del usuario.
 *
 * @return int 1 si se ha actualizado correctamente, 0 si no se han realizado cambios, -1 si se ha producido un error.
 */
function update_info($id, $username, $email, $bio)
{
    global $conn;

    if ($conn == null) {
        return -1;
    }

    try {
        $sql = "UPDATE usuaris SET usuario = :username, email = :email,bio = :bio WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':username' => $username, ':email' => $email, ':bio' => $bio, ':id' => $id));
        if ($stmt->rowCount() == 0) {
            return 0;
        }
        return 1;
    } catch (PDOException $e) {
        
        return -1;
    }
}

function update_avatar($id, $avatar) {
    global $conn;
    if ($conn == null) {
        return false;
    }
    try {
        $sql = "UPDATE usuaris SET avatar = :avatar WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':avatar' => $avatar, ':id' => $id));
        return true;
        
    } catch (PDOException $e) {
        return false;
    }
}

function update_banner($id, $banner) {
    global $conn;
    if ($conn == null) {
        return false;
    }
    try {
        $sql = "UPDATE usuaris SET banner = :banner WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':banner' => $banner, ':id' => $id));
        return true;
        
    } catch (PDOException $e) {
        return false;
    }
}
