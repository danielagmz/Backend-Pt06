<?php require_once ('controllers/admin_pagination.php'); ?>
<?php $pagination = admin_pagination(isset($_GET['page']) ? $_GET['page'] : PAGE, 
isset($_GET['limit']) ? $_GET['limit'] : LIMIT, 
isset($_GET['filter']) ? $_GET['filter'] : '', 
isset($_GET['order']) ? $_GET['order'] : ORDER); ?>
<dialog class="dialog dialog__delete-user">
    <div class="dialog__content">
        <button class="dialog__close"><i class="fi fi-rr-cross"></i></button>
        <div class="content__body">
        <form id="DeletUserForm" method="post" class="form article" enctype="multipart/form-data">
            <div class="content__title">Estas segur?</div>
            <div class="form__group">
                <input type="hidden" id="id" name="id" class="form__input" value="">
            </div>
            <div id="deletUserResponse" class="response-container"></div>
            <input type="submit" value="Eliminar" class="form__button form__button--mark">
        </form>
        </div>
    </div>
</dialog>
<div class="cabeceras">
    <div class="busqueda__barra cabeceras--filtrado content__body--row">
        <?php include('views/global/barra_busqueda.php');?>
        <button class="form__button--search">
            <i class="fi fi-rr-search"></i>
        </button>
    </div>
    <div class="busqueda__barra cabeceras--paginacion">
        <input class="busqueda__input--page" id="page" type="number" min="1" max="4" name="pages" step="1" value="<?= isset($_GET['limit']) ? $_GET['limit'] : LIMIT ?>">
        <div class="paginacion">
            <div class="paginacion__links">
                <?= $pagination['links'] ?>
            </div>
        </div>
        <div class="cabeceras--ordenacion">
            <div class=" content_subtitle content__body--row">
                <input type="radio" class="ordenacion__input" id="asc" value="asc" name="orden">
                <label for="asc" class="ordenacion__label"><i class="fi fi-rr-sort-alpha-up"></i></label>

                <input type="radio" checked class="ordenacion__input" value="desc" id="desc" name="orden">
                <label for="desc" class="ordenacion__label"><i class="fi fi-rr-sort-alpha-down-alt"></i></i></label>
            </div>
        </div>
    </div>
</div>

<div class="content__body--table article">
<table class="user_table">
    <thead>
        <tr class="header_row">
            <th><i class="fi fi-rr-user"></i> Usuari</th>
            <th><i class="fi fi-rr-user-add"></i> Creació</th>
            <th><i class="fi fi-rr-user-pen"></i> Actualització</th>
        </tr>
    </thead>
    <tbody>
    <?= $pagination['Allusers'] ?>  
    </tbody>
</table>  
</div>
