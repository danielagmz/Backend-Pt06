<?php 
//⭐ create



/**
 * Crea un nuevo articulo en la base de datos.
 *
 * @param string $title Titulo del articulo.
 * @param string $content Contenido del articulo.
 * @param int $user_id Identificador del usuario que crea el articulo.
 *
 * @return int Identificador del articulo creado. Devuelve -1 si ha habido un error.
 */
function create_article($title, $content,$user_id)
{
    global $conn;
    if ($conn == null) {
        return -1;
    };

    try {
        $sql = "INSERT INTO articles (titol, cos,autor) VALUES (:titol, :cos, :autor)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':titol' => $title, ':cos' => $content, ':autor' => $user_id));
        $result = $conn->lastInsertId();
        if ($result == null) {
            return -1;
        }
        return $result; 

    } catch (PDOException $e) {
        return -1;
    }
}
?>