<?php require_once('controllers/user_pagination.php');?>
<div class="cabeceras">

    <div class="busqueda__barra cabeceras--filtrado content__body--row">
        <input type="text" value="<?= isset($_GET['filter']) ? $_GET['filter'] : '' ?>" name="busqueda__input" placeholder="Filtar por..." class="busqueda__input" autofocus>
        <button class="form__button--search">
            <i class="fi fi-rr-search"></i>
        </button>
    </div>
    <div class="busqueda__barra cabeceras--paginacion">
        <input class="busqueda__input--page" id="page" type="number" min="2" max="<?= max_articles_user() ?>" name="pages" step="1" value="<?= isset($_GET['limit']) ? $_GET['limit'] : LIMIT ?>">
        <div class="paginacion">
            <div class="paginacion__links">
                <?= crear_links_user(
                    isset($_GET['limit']) ? $_GET['limit'] : LIMIT, // Si no hay límite usa 4
                    isset($_GET['page']) ? $_GET['page'] : PAGE,// Si no hay página, usa 1
                    isset($_GET['filter']) ? $_GET['filter'] : '' // Si hay filtro usa el filtro vacio
                ) ?>
                
            </div>
        </div>
        
    </div>
</div>


<div class="busqueda__resultados">
    <?= paginate_user(
        isset($_GET['page']) ? $_GET['page'] : PAGE,
        isset($_GET['limit']) ? $_GET['limit'] : LIMIT,
        isset($_GET['filter']) ? $_GET['filter'] : ''  // Pasar el límite desde la URL
    ); ?>
</div>
