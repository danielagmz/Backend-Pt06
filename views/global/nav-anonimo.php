<div class="nav-grid">
    <aside class="menu">
        <a class="menu__item" href="index.php">
            <div class="menu__item-link">
                <i class="fi fi-rr-home"></i>
                <div class="menu__item-text">Inici</div>
            </div>
        </a>
        <a class="menu__item" href="index.php?action=<?= isset($url) ? $url : 'login' ?>">
            <div class="menu__item-link">
                <i class="fi fi-rr-user"></i>
                <div class="menu__item-text"><?= isset($accion) ? $accion : 'Logar-se / Enregistrar-se' ?></div>
            </div>
        </a>
    </aside>
</div>