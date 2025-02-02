<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <?php include('views/global/estilos.php') ?>
    <?php include('public/styles/uploads.php') ?>
    <?php require_once('public/javascripts/ApiAccess.php') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css">
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>
    <script type="module" src="public/javascripts/dialog.js"></script>
    <script type="module" src="public/javascripts/activePage.js"></script>
    <script type="module" src="public/javascripts/uploadDialogs.js"></script>
    <script type="module" src="public/javascripts/showme.js"></script>

</head>

<body>
    <div class="container">
        <?php include('views/global/nav.php') ?>
        <?php include('views/global/settings-dialogs.php') ?>
        <main class="content content--settings">
            <div class="banner">
            </div>
            <div class="content__body--bento">
                <form class="articles settings__element profile" action="index.php?action=update_info" method="post">
                    <div class="profile__info">
                        <div class="profile__info-group">
                            <label class="profile__label content__title" for="username"><i class="fi fi-rr-circle-user"></i> Usuari</label>
                            <input class="profile__input" type="text" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" name="username" id="username">
                        </div>
                        <div class="profile__info-group">
                            <label class="profile__label content__title" for="email"><i class="fi fi-rr-at"></i> Email</label>
                            <?php if (!isset($_SESSION['SocialProvider'])) : ?>
                                <input class="profile__input" type="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" name="email" id="email">
                            <?php endif; ?>
                            <?php if (isset($_SESSION['SocialProvider'])) : ?>
                                <input class="profile__input disabled--opacity" type="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" name="email" id="email" readonly>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bio">
                        <label class="profile__label content__title" for="bio"><i class="fi fi-rr-info"></i> Descripció</label>
                        <textarea
                            class="profile__textarea bio__textarea"
                            name="bio"
                            id="bio"
                            placeholder="<?= isset($_SESSION['bio']) && !empty($_SESSION['bio']) ? '' : 'Escriu una cosa interessant sobre tu...' ?>"><?= isset($_SESSION['bio']) ? $_SESSION['bio'] : '' ?></textarea>

                    </div>
                    <div class="actions">
                        <?= isset($response) ? $response : '' ?>
                        <input type="submit" value="Guardar" class="form__button banner__button banner__button--save">
                    </div>
                </form>

                <div class="settings__element dev">
                    <p class="settings__element-title dev__title content__title"><i class="fi fi-rr-square-code"></i> Developers</p>
                    <button class="form__button banner__button dev__button">Acceder a la api</button>
                </div>
                <div class="settings__element customize">
                    <p class="settings__element-title customize__title content__title"><i class="fi fi-rr-palette"></i> Personalitzar</p>
                    <div class="customize__buttons">
                        <button class="form__button banner__button edit-avatar__button"><i class="fi fi-rr-pen-square"></i> Editar imatge</button>
                        <button class="form__button banner__button edit-banner__button"><i class="fi fi-rr-pen-square"></i> Editar portada</button>
                    </div>
                </div>
                <div class="settings__element change-password text__align--center <?= isset($_SESSION['SocialProvider']) ? 'disabled disabled--opacity' : '' ?>">
                    <?php if (!isset($_SESSION['SocialProvider'])) : ?>
                        <div class="settings__element-title change-password__title content__title"><i class="fi fi-rr-password-lock"></i> Canviar contrasenya</div>
                        <button class="form__button banner__button change-password__button">Canviar contrasenya</button>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['SocialProvider'])) : ?>
                        <div class="settings__element-title change-password__title content__title"><i class="fi fi-rr-password-lock"></i> t'has logat amb una compte social</div>
                        <button class="form__button banner__button change-password__button">No pots canviar la contrasenya</button>
                    <?php endif; ?>
                </div>
                <div class="settings__element delete-account text__align--center">
                    <div class="settings__element-title delete-account__title content__title"><i class="fi fi-rr-user-xmark"></i> Eliminar compte</div>
                    <?php if (!isset($_SESSION['SocialProvider'])) : ?>
                        <button id="delete-account" class="form__button banner__button banner__button--red delete-account__button">Eliminar compte</button>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['SocialProvider'])) : ?>
                        <button class="form__button banner__button banner__button--red delete-SocialUser__button"
                            onclick="location.href='mailto:admin@dgamez.cat?subject=Consulta sobre la eliminació del compte&body=Hola, necessito ajuda amb la meva compte...'">
                            Contacta amb l'admin
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>