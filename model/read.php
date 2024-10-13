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
?>