<?php
http_response_code(404); // Establece el código de respuesta a 404
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('views/global/estilos.php') ?>
</head>
<body>
<main class="content">
    <div class="content__body">
        <img class="article img" style="height: 76vh;" src="public/assets/404.jpg" alt="not found">
        <a href="index.php" class="form__button form__button--mark">Tornar</a>
    </div>
</main>
</body>
</html>