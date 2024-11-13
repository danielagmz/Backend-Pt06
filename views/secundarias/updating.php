<!DOCTYPE html>
<html lang="ca">

<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <script type="module" src="public/javascripts/update.js"></script>
    <title>Modificar article</title>
</head>

<body>
    <div class="container">
        <?php include('views/global/nav.php') ?>

        <main class="content">
            <div class="content__title"> Modificant "<?= isset($title) ? $title : 'l\'article' ?>"</div>
            <div class="content__body">
                <form action="index.php?action=updating&id=<?= $_GET['id'] ?>" method="post" class="form article">
                    <div class="form__group">
                        <label for="title" class="form__label">Titol</label>
                        <input type="text" id="title" name="title" class="form__input" value="<?= isset($title) ? $title : '' ?>">
                    </div>
                    <div class="form__group">
                        <label for="content" class="form__label">Contingut</label>
                        <textarea name="content" id="content" class="form__textarea" maxlength="200"><?= isset($content) ? $content : '' ?></textarea>
                    </div>
                    <?= isset($response) ? $response : '' ?>
                    <?= isset($button) ? $button : '' ?>
                    <input type="submit" value="Modificar" class="form__button form__button--mark">
                </form>
            </div>
        </main>
    </div>
</body>

</html>