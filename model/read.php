<?php 
// ⭐ readAll

/**
 * Llista tots els articles de la base de dades amb el filtre opcional.
 *
 * @param string $filter Filtre opcional
 *
 * @return array Un array que conte tots els articles amb el format associatiu.
 */
function read_articles($filter)
{
    global $conn;
    if ($conn == null) {
        return [];
    };

    try {
        $sql = "SELECT * FROM articles WHERE titol RLIKE :filter ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['filter' => $filter]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result == null) {
            return [];
        }
        return  $result;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


/**
 * Llegeix un article de la base de dades.
 *
 * @param int $id Identificador de l'article a llegir
 *
 * @return array Un array que conte l'article amb el format associatiu. Si no existeix l'article, es retorna un array buit.
 */
function read_article($id){
    global $conn;

    if ($conn == null) {
        return [];
    };

    try {
        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function obtener_usuarios($filter = '',$desc = ORDER,$id_user){
    global $conn;

    if ($conn == null) {
        return [];
    };
    $order = $desc == "desc" ? "DESC" : "ASC";
    try {
        $sql = "SELECT * FROM usuaris WHERE usuario RLIKE :filter AND id != :id_user ORDER BY usuario $order";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(':filter', $filter, PDO::PARAM_STR);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        
        $stmt->execute();
        $total = $stmt->rowCount();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['users' => $result, 'total' => $total];
    } catch (PDOException $e) {
        return [];
    }

}
?>