<dialog class="dialog dialog--change-pass">
    <div class="dialog__content">
        <button class="dialog__close"><i class="fi fi-rr-cross"></i></button>
        <div class="content__body">
            <form id="changePasswordForm" method="post" class="form article">
                <div class="content__title">Canviar contrasenya</div>
                <div class="form__group">
                    <label for="oldPassword" class="form__label">Contrasenya actual</label>
                    <input type="password" id="oldPassword" name="oldPassword" class="form__input" value="<?= isset($oldPassword) ? $oldPassword : '' ?>">
                </div>
                <div class="form__group">
                    <label for="newPassword" class="form__label">Contrasenya nova</label>
                    <input type="password" id="newPassword" name="newPassword" class="form__input" value="<?= isset($oldPassword) ? $oldPassword : '' ?>">
                </div>
                <div class="form__group">
                    <label for="verifyPassword" class="form__label">Confirmar contrasenya</label>
                    <input type="password" id="verifyPassword" name="verifyPassword" class="form__input" value="<?= isset($oldPassword) ? $oldPassword : '' ?>">
                </div>
                <div id="responseContainer" class="response-container"></div>
                <input type="submit" value="Cambiar contrasenya" class="form__button form__button--mark">
            </form>
        </div>
    </div>
</dialog>

<dialog class="dialog dialog--delete-account">
    <div class="dialog__content">
        <button class="dialog__close"><i class="fi fi-rr-cross"></i></button>
        <div class="content__body">
            <form id="deleteAccountForm" method="post" class="form article">
                <div class="content__title center">Estas segur?</div>
                <div class="form__group">
                    <label for="password" class="form__label">Confirma la teva contrasenya</label>
                    <input type="password" id="password" name="password" class="form__input">
                </div>
                <div id="responseDelete" class="responseDelete-container"></div>
                <input type="submit" value="Eliminar compte" class="form__button banner__button--red">
                <hr>
                <div class="content__subtitle"><i class="fi fi-rr-comment-info banner__button--red"></i> Es mantindràn els teus articles pero no podras iniciar sessió</div>
            </form>
        </div>
    </div>
</dialog>
