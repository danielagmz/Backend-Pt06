<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public\styles\anonimo.css">
    <link rel="stylesheet" href="public\styles\select.css">
    <link rel="stylesheet" href="public\styles\read.css">
    <script type="module" src="public/javascripts/filter.js"></script>
    <script type="module" src="public/javascripts/read-anonimo.js"></script>
    <title>Home</title>
</head>

<body>
    <div class="container">
    <?php include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title">Articles</div>
            <?php include('views/global/paginacion.php') ?>
        </main>
    </div>
</body>
</html>