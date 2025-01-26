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
                    <div class="form__group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" name="shared" class="check" id="check1-61" <?= isset($shared) && $shared ? 'checked' : '' ?> >
                            <label for="check1-61" class="label">
                                <svg width="45" height="45" viewBox="0 0 95 95">
                                    <rect x="30" y="20" width="50" height="50" stroke="black" fill="none"></rect>
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4" stroke="black" stroke-width="3" fill="none" class="path1"></path>
                                    </g>
                                </svg>
                                <span>Permetre que altres facin duplicats</span>
                            </label>

                        </div>
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