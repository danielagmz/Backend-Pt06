<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public/styles/qr.css">
    <script type="module" src="public/javascripts/qrDialog.js"></script>
    <title>Vista de lectura</title>
</head>

<body>
    <?php if (isset($shared) && $shared == 1) { ?>
        <?php include('views/global/qrDialog.php');?>
    <?php } ?>
    <div class="container">
        <?php include('views/global/nav.php') ?>
        <main class="content">
            <div class="qr__container">
                <div class="content__title" id="articleTitle"><?= isset($title) ? $title : '' ?></div>
                <?php if (isset($shared) && $shared == 1) { ?>
                    <button class="content__button qr__button form__button form__button--mark" id="qrDialogButton">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" width="24" height="24" viewBox="0 0 24 24">
                            <path d="m3,11h8V3H3v8Zm1-7h6v6h-6v-6Zm17-1h-8v8h8V3Zm-1,7h-6v-6h6v6ZM3,21h8v-8H3v8Zm1-7h6v6h-6v-6Zm1,5h4v-4h-4v4Zm1-3h2v2h-2v-2Zm-1-7h4v-4h-4v4Zm1-3h2v2h-2v-2Zm13-1h-4v4h4v-4Zm-1,3h-2v-2h2v2Zm1,11v-3h2v-3h-3v2h-2v-2h-3v3h2v2h-2v3h3v-2h3Zm0-5h1v1h-1v-1Zm-5,1v-1h1v1h-1Zm2,1h2v2h-2v-2Zm-1,4h-1v-1h1v1ZM1,7H0V2.5C0,1.122,1.122,0,2.5,0h4.5v1H2.5c-.827,0-1.5.673-1.5,1.5v4.5Zm1.5,16h4.5v1H2.5c-1.378,0-2.5-1.122-2.5-2.5v-4.5h1v4.5c0,.827.673,1.5,1.5,1.5Zm20.5-6h1v4.5c0,1.378-1.122,2.5-2.5,2.5h-4.5v-1h4.5c.827,0,1.5-.673,1.5-1.5v-4.5Zm1-14.5v4.5h-1V2.5c0-.827-.673-1.5-1.5-1.5h-4.5V0h4.5c1.378,0,2.5,1.122,2.5,2.5Z" />
                        </svg>
                    </button>
                <?php } ?>
            </div>
            <div class="content__body reading__body">
                <p class="article__content" id="articleContent"><?= isset($content) ? $content : '' ?></p>
            </div>
        </main>
</body>

</html>