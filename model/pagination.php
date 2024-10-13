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
        return 1;
    }

    try {
        $sql = "SELECT count(*) as total FROM articles WHERE titol RLIKE :filter";
        $stmt = $conn->prepare($sql);
        $stmt->execute((['filter' => $filter]));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] == null) {
            return 1;
        }
        return (int)$result['total']; 
    } catch (PDOException $e) {
        return 1;
    }
}


/**
 * Obtiene los artículos de la base de datos con paginación.
 *
 * @param int $limit Número de artículos a obtener.
 * @param int $offset Número de artículos a saltar.
 *
 * @return array Un array que contiene los artículos con el formato asociativo.
 */
function obtener_articulos($limit, $offset,$filter = FILTER){
    global $conn;

    if ($conn == null) {
        return [];
    };

    try {
        $sql = "SELECT * FROM articles WHERE titol RLIKE :filter ORDER BY id DESC LIMIT :limit OFFSET :offset";
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
?>