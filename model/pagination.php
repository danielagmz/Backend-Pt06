<?php 
// ⭐ funciones para paginacion


/**
 * Retorna el numero total de articulos en la base de datos.
 *
 * @param string $filter Filtro opcional para buscar articulos
 *
 * @return int Numero total de articulos.
 */
function obtener_total($filter = FILTER){
    global $conn;

    if ($conn == null) {
        return -1;
    }

    try {
        $sql = "SELECT count(*) as total FROM articles WHERE titol RLIKE :filter";
        $stmt = $conn->prepare($sql);
        $stmt->execute((['filter' => $filter]));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] == null) {
            return -1;
        }
        return (int)$result['total']; 
    } catch (PDOException $e) {
        return -1;
    }
}

/**
 * Returns the total number of articles for a specific user with an optional filter.
 *
 * @param string $filter Optional filter to search articles by title.
 * @param int $id_user The ID of the user whose articles are to be counted.
 *
 * @return int Total number of articles found. Returns -1 if an error occurs or if no articles match.
 */
function obtener_total_user($id_user){
    global $conn;

    if ($conn == null) {
        return -1;
    }

    try {
        $sql = "SELECT count(*) as total FROM articles WHERE autor = :id_user";
        $stmt = $conn->prepare($sql);
        $stmt->execute((['id_user' => $id_user]));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] == null) {
            return -1;
        }
        return (int)$result['total']; 
    } catch (PDOException $e) {
        return -1;
    }
}



/**
 * Obtiene los artículos de la base de datos con paginación.
 *
 * @param int $limit Número de artículos a obtener.
 * @param int $offset Número de artículos a saltar.
 * @param string $filter Filtro opcional para buscar artículos por título.
 * @param string $desc Orden de los artículos, ascendente ("asc") o descendente ("desc").
 *
 * @return array Un array que contiene los artículos con el formato asociativo.
 */
function obtener_articulos($limit, $offset,$filter = FILTER,$desc = ORDER){
    global $conn;

    if ($conn == null) {
        return [];
    };
    $order = $desc == "desc" ? "DESC" : "ASC";

    try {
        $sql = "SELECT * FROM articles WHERE titol RLIKE :filter ORDER BY titol $order LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        
        // Usamos bindValue para asegurarnos de que estos parámetros sean tratados como enteros
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':filter', $filter, PDO::PARAM_STR);
        
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        return [];
    }

}
/**
 * Obtiene los artículos de la base de datos para un usuario en particular, con paginación.
 *
 * @param int $limit Número de artículos a obtener.
 * @param int $offset Número de artículos a saltar.
 * @param string $filter Filtro opcional para buscar artículos.
 * @param int $id_user Identificador del usuario.
 * @param string $desc Orden de los artículos, ascendente ("asc") o descendente ("desc").
 *
 * @return array Un array que contiene los artículos
 */
function obtener_articulos_usuario($limit, $offset,$filter = FILTER,$id_user,$desc = ORDER){
    global $conn;

    if ($conn == null) {
        return [];
    };
    $order = $desc == "desc" ? "DESC" : "ASC";
    try {
        $sql = "SELECT * FROM articles WHERE titol RLIKE :filter AND autor = :user  ORDER BY titol $order LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        
        // Usamos bindValue para asegurarnos de que estos parámetros sean tratados como enteros
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':filter', $filter, PDO::PARAM_STR);
        $stmt->bindValue(':user', $id_user, PDO::PARAM_INT);
        
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            return [];
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        return [];
    }

}
?>