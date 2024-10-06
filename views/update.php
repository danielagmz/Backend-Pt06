<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('global/estilos.php')?>
    <link rel="stylesheet" href="public\styles\select.css">
    <link rel="stylesheet" href="public\styles\update.css">
    <script type="module" src="public/javascripts/update.js"></script>
    <script type="module" src="public/javascripts/filter.js"></script>
    <script type="module" src="public/javascripts/paginacion.js"></script>
    <title>Modificar article</title>
</head>
<body>
    <div class="container">
        <?php include('global/nav.php')?>
        
        <main class="content">
            <div class="content__title"> Selecciona l'article per modificar</div>
            <?php include('global/paginacion.php') ?>
        </main>
    </div>
</body>
</html>