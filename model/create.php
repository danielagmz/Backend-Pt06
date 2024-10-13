<?php 
//⭐ create


/**
 * Crea un nou article en la base de dades.
 *
 * @param string $title Titol de l'article
 * @param string $content Contingut de l'article
 *
 * @return int ID de l'article creat, -1 si error
 */
function create_article($title, $content)
{
    global $conn;
    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "INSERT INTO articles (titol, cos) VALUES (:titol, :cos)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':titol' => $title, ':cos' => $content));

        return $conn->lastInsertId(); 

    } catch (PDOException $e) {
        return -1;
    }
}
?>