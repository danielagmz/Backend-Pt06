<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <title>Vista de lectura</title>
</head>

<body>
    <div class="container">
        <?php include('views/global/nav.php') ?>
        <main class="content">
            <div class="content__title"><?= isset($title) ? $title: '' ?></div>
            <div class="content__body reading__body">
                    <p class="article__content"><?= isset($content) ? $content: '' ?></p>
            </div>
        </main>
</body>

</html>