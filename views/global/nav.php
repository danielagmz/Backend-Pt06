<div class="nav-grid">
    <aside class="menu">
        <a id="home" class="menu__item" href="index.php">
            <div class="menu__item-link">
                <i class="fi fi-rr-home"></i>
            </div>
        </a>
        <a id="all" class="menu__item" href="index.php?action=all">
            <div class="menu__item-link">
                <i class="fi fi-rr-book-alt"></i>
            </div>
        </a>
        <a id="create" class="menu__item" href="index.php?action=create">
            <div class="menu__item-link">
                <i class="fi fi-rr-add-document"></i>
            </div>
        </a>
        <a id="delete" class="menu__item" href="index.php?action=delete">
            <div class="menu__item-link">
                <i class="fi fi-rr-delete-document"></i>
            </div>
        </a>
        <a id="update" class="menu__item" href="index.php?action=update">
            <div class="menu__item-link">
                <i class="fi fi-rr-edit"></i>
            </div>
        </a>
        <a id="change_password" class="menu__item" href="index.php?action=update_info">
            <div class="menu__item-link">
                <i class="fi fi-rr-settings"></i>
            </div>
        </a>
        <form action="index.php?action=logout" class="cursor--pointer" method="post">
            <button type="submit" class="button--logout menu__item">
                <div  class="menu__item ">
                    <i class="fi fi-rr-sign-out-alt"></i>
                </div>
            </button>
        </form>
    </aside>
</div>