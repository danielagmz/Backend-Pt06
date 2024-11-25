<!DOCTYPE html>
<html lang="ca">
<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <?= isset($_SESSION['id']) ? '': '<link rel="stylesheet" href="public\styles\anonimo.css">'  ?>
    <title>Not found</title>
</head>
<body>
<div class="container">
<?php isset($_SESSION['id']) ? include('views/global/nav.php') : include('views/global/nav-anonimo.php')?>

<main class="content">
    <div class="content__title">Not found</div>
    <div class="content__body">
        <img class="article img" style="height: 76vh;" src="public/assets/404.jpg" alt="not found">
        <a href="index.php" class="form__button form__button--mark">Tornar</a>
    </div>
</main>
</body>
</html>