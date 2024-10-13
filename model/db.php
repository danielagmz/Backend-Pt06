<!-- Daniela Gamez -->

<?php
require_once 'connect.php';
require_once 'create.php';
require_once 'read.php';
require_once 'pagination.php';
require_once 'update.php';
require_once 'delete.php';

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
 * Comprueba si existe un articulo con el ID proporcionado.
 *
 * @param int $id ID del articulo a comprobar
 *
 * @return int 1 si existe, 0 si no existe, -1 si se ha producido un error
 */
function id_exists($id){
    global $conn;

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


?>