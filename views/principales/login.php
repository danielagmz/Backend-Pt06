<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public\styles\anonimo.css">
    <script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>
    <title>Logar-se</title>
</head>

<body>
    <div class="container">
    <?php $accion = 'Enregistrar-se'; $url = 'register'; include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title">Logar-se</div>
            <div class="content__body content__body--40W">
                <form class="form article" action="index.php?action=login" method="POST">
                    <div class="form__group">
                        <label class="form__label" for="username">Username</label>
                        <input class="form__input" value="<?= isset($username) ? $username : '' ?>" placeholder="patato123" type="text" name="username" id="username" required />
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="password">Password</label>
                        <input class="form__input" value="<?= isset($password) ? $password : '' ?>" placeholder="••••••••" type="password" name="password" id="password" required />
                    </div>
                    <?= isset($catcha) && $catcha!='default' ? $catcha : '' ?>
                    <?= isset($response) ? $response : ''   ?>
                    <div class="form__group">
                        <input class="form__button form__button--mark" type="submit" value="Logar-se" />
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>