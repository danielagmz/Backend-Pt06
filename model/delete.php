<?php 
//⭐ delete
/**
 * Borra un articulo de la base de datos.
 *
 * @param int $id ID del articulo a borrar
 *
 * @return bool true si se ha podido borrar, false si se ha producido un error
 */
function delete_article($id)
{
    global $conn;
    try {
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        if ($stmt->rowCount() > 0) {
            return true;
        }else{
            throw new PDOException('No se ha podido borrar el artículo');
        }
    } catch (PDOException $e) {
        return false;
    }
}
?>