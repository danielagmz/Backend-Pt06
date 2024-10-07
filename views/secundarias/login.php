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
        <?php include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title">Logar-se</div>
            <div class="content__body">
                <form class="form article" action="login" method="POST">
                    <div class="form__group">
                        <label class="form__label" for="username">Username</label>
                        <input class="form__input" placeholder="patato123" type="text" name="username" id="username" required />
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="password">Password</label>
                        <input class="form__input" placeholder="••••••••" type="password" name="password" id="password" required />
                    </div>
                    <div class="form__group">
                        <input class="form__button form__button--mark" type="submit" value="Login" />
                        <a class="form__button form__button--mark" href="index.php?action=register">Engistrar-se</a>
                    </div>
                    
                </form>
            </div>
        </main>
    </div>
</body>

</html>