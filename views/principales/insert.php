<!DOCTYPE html>
<html lang="ca">

<head>
    <!-- Daniela Gamez -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public/styles/qr.css">
    <?php include('views/global/scripts_logged.php') ?>
    <script type="module" src="public/javascripts/qrUploadForm.js"></script>
    <title>Insertar article</title>
</head>

<body>
    <div class="container">
        <?php include('views/global/nav.php') ?>
        <main class="content">
            <div class="qr__container">
                <div class="content__title">El teu nou article</div>
                <button class="content__button qr__button form__button form__button--mark" title="importar QR" id="swapForm">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" width="30" height="30" viewBox="0 0 24 24">
                        <g>
                            <path d="M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8
                                h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8
                                H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M3.4,3v7.6h7.6V3H3.4z M10.1,9.7H4.4V4h5.7V9.7z M9.1,4.9
                                H5.3v3.8h3.8V4.9z M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z
                                M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9
                                V7.8z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9
                                v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9
                                H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z
                                M17.7,7.8h-1.9V5.9h1.9V7.8z M12.9,3v7.6h7.6V3H12.9z M19.6,9.7h-5.7V4h5.7V9.7z M18.7,4.9h-3.8v3.8h3.8V4.9z M17.7,7.8h-1.9V5.9
                                h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z
                                M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M14.9,4.9v3.8
                                h3.8V4.9H14.9z M17.7,7.8h-1.9V5.9h1.9V7.8z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3
                                z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3
                                H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9
                                h1.9V17.3z M11.1,16.4v-3.9H3.4v7.6h7.4v-0.4c0,0-0.5,0.1-1.1,0c-0.6-0.1-0.6-0.5-0.6-0.5c0,0,0,0,0-0.1H4.4v-5.7h5.7v4L11.1,16.4z
                                M9.1,18.2v-3.8H5.3v3.8H9.1z M6.3,15.4h1.9v1.9H6.3V15.4z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4
                                v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8
                                v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3z M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,14.4v3.8h3.8v-3.8H5.3z
                                M8.2,17.3H6.3v-1.9h1.9V17.3z M5.3,4.9v3.8h3.8V4.9H5.3z M8.2,7.8H6.3V5.9h1.9V7.8z M14.9,4.9v3.8h3.8V4.9H14.9z M17.7,7.8h-1.9
                                V5.9h1.9V7.8z M17.7,12.5v1.9h-1.9v-1.9h-2.9v2.9h1.9v1.9h-0.3l1.2,1.5v-0.5h2.9v-2.9h1.9v-2.9H17.7z M14.9,14.4h-0.9v-1h0.9V14.4z
                                M17.7,17.3h-1.9v-1.9h1.9V17.3z M19.6,14.4h-0.9v-1h0.9V14.4z M3,0.1c-1.3,0-2.4,1.1-2.4,2.4v4.3h0.9V2.5c0-0.8,0.6-1.4,1.4-1.4
                                h4.3v-1H3z M3,22c-0.8,0-1.4-0.6-1.4-1.4v-4.3H0.6v4.3C0.6,21.9,1.6,23,3,23h4.3V22H3z M22.5,16.3v4.3c0,0.8-0.6,1.4-1.4,1.4h-4.3
                                V23H21c1.3,0,2.4-1.1,2.4-2.4v-4.3H22.5z M21,0.1h-4.3v1H21c0.8,0,1.4,0.6,1.4,1.4v4.3h0.9V2.5C23.4,1.2,22.4,0.1,21,0.1z" />
                            <g id="XMLID_1_">
                                <g>
                                </g>
                                <g>
                                    <path class="st0" d="M16,19c0,0.1,0,0.3-0.1,0.4c-0.2,0.4-0.5,0.6-0.9,0.6h-0.8v2.7c0,0.7-0.5,1.2-1.2,1.2h-1.1c-0.7,0-1.3-0.5-1.3-1.2v-2.7H9.8c-0.4,0-0.7-0.2-0.9-0.6c-0.2-0.4-0.1-0.8,0.2-1l2.3-2.6c0.5-0.5,1.4-0.5,1.9,0l2.3,2.6C15.9,18.5,16,18.7,16,19z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="content__body">
                <div id="qrForm__container" hidden>
                    <form id="qrForm" action="index.php?action=upload__qr" method="POST" enctype="multipart/form-data" class="form article">
                        <div class="form__group">
                            <label for="qrImage" class="form__label">Puja el QR de l'article:</label>
                            <input class="form__input" type="file" name="qrImage" id="qrImage" accept="image/png" required>
                        </div>
                        <input type="submit" value="Pujar" class="form__button form__button--mark qrForm__button">
                        <hr>
                        <div class="content__subtitle"><i class="fi fi-rr-comment-info"></i> Pots generar el QR desde la vista de tots els articles</div>
                    </form>
                </div>

                <div id="manualForm__container">
                    <form id="manual" action="index.php?action=create" method="post" class="form article">
                        <div class="form__group">
                            <label for="title" class="form__label">Titol</label>
                            <input type="text" name="title" class="form__input" placeholder="Hi havia una vegada..." value="<?= isset($title) ? $title : '' ?>">
                        </div>
                        <div class="form__group">
                            <label for="content" class="form__label">Contingut</label>
                            <textarea name="content" class="form__textarea" maxlength="2504" placeholder="<?= isset($content) && $content ? '' : 'Un article gloriós...'; ?>"><?= isset($content) ? $content : '' ?></textarea>
                        </div>
                        <div class="form__group">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" name="shared" class="check" id="check1-61">
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
                        <?php if (isset($fromQR) && $fromQR) : ?>
                            <input type="hidden" name="fromQR" value="true">
                        <?php endif ?>
                        <?= isset($response) ? $response : ''   ?>
                        <?= isset($button) ? $button : '' ?>
                        <input type="submit" value="Insertar" class="form__button form__button--mark insert__button">
                    </form>


                </div>
            </div>
        </main>
    </div>
</body>

</html>