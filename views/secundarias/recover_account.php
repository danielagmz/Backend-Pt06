<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php')?>
    <link rel="stylesheet" href="public\styles\anonimo.css">
    <title>Recuperar contrasenya</title>
</head>
<body>
    <div class="container">
    <?php include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title">Recuperar contrasenya</div>
            <div class="content__body">
                <form action="index.php?action=recover_account" method="post" class="form article">
                    <div class="form__group">
                        <label class="form__label" for="email">Introdueix el teu email:</label>
                        <input class="form__input" value="<?= isset($email) ? $email : '' ?>" placeholder="patato123@correo.com" type="email" name="email" id="email" required />
                    </div>
                    <?= isset($response) ? $response : ''?>
                    <input type="submit" value="Enviar enllaç" class="form__button form__button--mark">
                    <hr>
                    <div class="content__subtitle limit-p"><i class="fi fi-rr-comment-info "></i> El correu ha de ser el que s'ha utilitzat per crear el compte</div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
