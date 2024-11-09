<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public\styles\anonimo.css">
    <title>Vista de lectura</title>
</head>

<body>
    <div class="container">
        <?php include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title"><?= isset($title) ? $title : '' ?></div>
            <div class="content__body reading__body">
                <p class="article__content"><?= isset($content) ? $content : '' ?></p>
            </div>
            <a class="form__button form__button--mark" href="index.php?action=read-anonimo">Tornar</a>
        </main>
        
</body>

</html>