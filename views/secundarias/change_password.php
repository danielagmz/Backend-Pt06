<!DOCTYPE html>
<html lang="ca">
<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php')?>
    <?php include('views/global/scripts_logged.php') ?>
    <title>Recover</title>
</head>
<body>
    <div class="container">
    <?php include('views/global/nav.php') ?>
        <main class="content">
            <div class="content__title">Recuperar contrasenya</div>
            <div class="content__body">
                 <form action="index.php?action=change_password" method="post" class="form article">
                    <div class="form__group">
                        <label for="oldPassword" class="form__label">Contrasenya actual</label>
                        <input type="password" id="oldPassword" name="oldPassword" class="form__input" value="<?= isset($oldPassword) ? $oldPassword: '' ?>">
                    </div>
                    <div class="form__group">
                        <label for="newPassword" class="form__label">Contrasenya nova</label>
                        <input type="password" id="newPassword" name="newPassword" class="form__input" value="<?= isset($oldPassword) ? $oldPassword: '' ?>">
                    </div>
                    <div class="form__group">
                        <label for="verifyPassword" class="form__label">Confirmar contrasenya</label>
                        <input type="password" id="verifyPassword" name="verifyPassword" class="form__input" value="<?= isset($oldPassword) ? $oldPassword: '' ?>">
                    </div>
                    <?= isset($response) ? $response : ''?>
                    <?= isset($button) ? $button : ''?>
                    <input type="submit" value="Cambiar contrasenya" class="form__button form__button--mark">
                </form>
            </div>
        </main>
    </div>
</body>
</html>