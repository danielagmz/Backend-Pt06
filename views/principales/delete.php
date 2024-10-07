<!DOCTYPE html>
<html lang="ca">

<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public\styles\select.css">
    <script type="module" src="public/javascripts/delete.js"></script>
    <script type="module" src="public/javascripts/filter.js"></script>
    <script type="module" src="public/javascripts/paginacion.js"></script>
    <title>Esborrar Article</title>
</head>

<body>
    <div class="container">
        <?php include('views/global/nav.php') ?>
        <main class="content">
            <div class="content__title">Selecciona l'article per esborrar</div>
            <?php include('views/global/paginacion.php') ?>
        </main>
    </div>
</body>

</html>