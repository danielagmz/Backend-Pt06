<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <script type="module" src="public/javascripts/activePage.js"></script>
    <script type="module" src="public/javascripts/filter.js"></script>
    <script type="module" src="public/javascripts/paginacion.js"></script>
    <script type="module" src="public/javascripts/dialog.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php include('views/global/nav.php') ?>
        <dialog class="dialog dialog__delete-user">
            <div class="dialog__content">
                <button class="dialog__close"><i class="fi fi-rr-cross"></i></button>
                <div class="content__body">
                    <form id="deleteUserForm" method="post" class="form article" enctype="multipart/form-data">
                        <div class="content__title">Estas segur?</div>
                        <input type="hidden" id="user-id" name="user-id" class="form__input">
                        <div id="deleteUserResponse" class="response-container"></div>
                        <input type="submit" value="Eliminar compte" id="delete-account" class="form__button banner__button banner__button--red delete-account__button"></input>
                    </form>
                </div>
        </dialog>
        <main class="content">
            <div class="content__title">Gestió d'usuaris</div>
            <?php include('views/global/admin_pagination.php') ?>
        </main>
    </div>
</body>

</html>