<!DOCTYPE html>
<html lang="ca">

<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public\styles\anonimo.css">
    <script type="module" src="public/javascripts/showme.js"></script>
    <script defer src="public/javascripts/login.js"></script>
    <title>Recover</title>
</head>

<body>
    <div class="container">
        <?php include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title">Canviar contrasenya</div>
            <div class="content__body">
                <form action="index.php?action=recover_password&token=<?= $_GET['token'] ?>" method="post" class="form article">
                    <div class="form__group">
                        <label for="newPassword" class="form__label">Contrasenya nova</label>
                        <div class="input__group--pass">
                            <input type="password" id="newPassword" name="newPassword" class="form__input" value="<?= isset($newPassword) ? $newPassword : '' ?>">
                            <i class="fi fi-rr-eye showme"></i>
                        </div>
                    </div>
                    <div class="form__group">
                        <label for="verifyPassword" class="form__label">Confirmar contrasenya</label>
                        <div class="input__group--pass">
                            <input type="password" id="verifyPassword" name="verifyPassword" class="form__input" value="<?= isset($verifyPassword) ? $verifyPassword : '' ?>">
                            <i class="fi fi-rr-eye showme"></i>
                        </div>
                    </div>
                    <?= isset($response) ? $response : '' ?>
                    <input type="submit" value="Canviar contrasenya" class="form__button form__button--mark">
                </form>
            </div>
        </main>
    </div>
</body>

</html>