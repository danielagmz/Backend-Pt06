<!-- Daniela Gamez -->

<?php
require_once'connect.php';


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