<?php 
//⭐ update

/**
 * Modifica un articulo de la base de datos.
 *
 * @param int $id ID del articulo a modificar
 * @param string $title Titulo del articulo
 * @param string $content Contenido del articulo
 *
 * @return int 1 si se ha modificado correctamente, 0 si no se ha podido modificar porque el articulo tiene el mismo contenido y -1 si se ha producido un error
 */
function update_article($id, $title, $content)
{
    global $conn;
    try {
        $sql = "update articles set titol = :titol, cos = :cos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':titol' => $title, ':cos' => $content, ':id' => $id));

        if ($stmt->rowCount() > 0) {
            // si se ha modificado
            return 1;
        }else{
            // no se ha podido modificar porque el articulo tiene el mismo contenido
            return 0;
        }
    } catch (PDOException $e) {
        // si se ha producido un error
        return -1;
    }
}
?>