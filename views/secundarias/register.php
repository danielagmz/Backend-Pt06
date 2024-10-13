<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public\styles\anonimo.css">
    <title>Logar-se</title>
</head>

<body>
    <div class="container">
    <?php $accion = 'Logar-se'; $url = 'login'; include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title">Enregistrar-se</div>
            <div class="content__body">
                <form class="form article" action="register" method="POST">
                    <div class="form__group">
                        <label class="form__label" for="username">Nom d'usuari</label>
                        <input class="form__input" placeholder="patato123" type="text" name="username" id="username" required />
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="password">Contrasenya</label>
                        <input class="form__input" placeholder="••••••••" type="password" name="password" id="password" required />
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="Verifypassword">Confirma la contrasenya</label>
                        <input class="form__input" placeholder="••••••••" type="password" name="verifypassword" id="verifypassword" required />
                    </div>
                    <div class="form__group">
                        <input class="form__button form__button--mark" type="submit" value="Engistrar-se" />
                    </div>
                    
                </form>
            </div>
        </main>
    </div>
</body>

</html>