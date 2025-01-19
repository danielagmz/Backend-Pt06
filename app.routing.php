<?php
// Daniela Gamez 
require_once 'controllers/verificaciones.php';
require_once 'model/verificaciones.php';
require_once 'model/connect.php';
require_once 'controllers/cookies.php';
require_once 'controllers/login.php';
require_once 'controllers/sesion.php';
require_once 'controllers/socialAuth.php';

ini_set('session.gc_maxlifetime', 40 * 60);
session_start();
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 3; // valor inicial
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'read';
    }

// laweb.com/index.php?action=create
// laweb.com/articles/1

    remember();

    if (isset($_SESSION['id'])) {
        switch ($action) {
            case 'create':
                require_once 'controllers/insert.php';
                include 'views/principales/insert.php';
                break;
            case 'delete':
                require_once 'controllers/delete.php';

                include 'views/principales/delete.php';
                break;
            case 'update':
                require_once 'controllers/update.php';
                include 'views/principales/update.php';
                break;
            case 'updating':
                require_once 'controllers/read.php';
                read_one($_GET['id'], 'update');
                break;
            case 'deleting':
                require_once 'controllers/read.php';
                read_one($_GET['id'], 'delete');
                break;
            case 'reading':
                require_once 'controllers/read.php';
                read_one($_GET['id'], 'read');
                break;
            case 'read':
                include 'views/principales/read.php';
                break;
            case 'all':
                include 'views/principales/readAll.php';
                break;
            case 'update_info':
                include 'views/secundarias/settings.php';
                break;
            case 'admin':
                if ($_SESSION['admin']) {
                    include 'views/secundarias/admin.php';
                    break;
                }
            default:
                require_once 'controllers/read.php';
                include 'views/principales/read.php';
                break;
        }
    } else {
        switch ($action) {

            case 'login':
                require_once 'controllers/login.php';
                $socialLogged = false;
                include 'views/principales/login.php';
                break;
            case 'register':
                require_once 'controllers/register.php';
                include 'views/principales/register.php';
                break;
            case 'reading-anonimo':
                require_once 'controllers/read.php';
                read_one($_GET['id'], 'read-anonimo');
                break;
            case 'recover_account':
                include 'views/secundarias/recover_account.php';
                break;

            case 'reset':
                if (isset($_GET['token']) && is_token_valid($_GET['token'])) {
                    include_once 'views/secundarias/change_password.php';
                } else {
                    include_once 'views/error/498.php';
                }
                break;
            case 'GoogleAuth':
                if (isset($_GET['code'])) {
                    require_once 'controllers/socialAuth.php';
                    google_redirect(isset($_GET['code']) ? $_GET['code'] : '');
                    break;
                } else {
                    header('Location: index.php?action=login');
                    break;
                }
            case 'GitHubAuth':
                    require_once 'controllers/socialAuth.php';
                    github_redirect();
                    break;
            default:
                require_once 'controllers/read.php';
                include 'views/principales/read-anonimo.php';
                break;
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    switch ($action) {
        case 'create':
            require_once 'controllers/insert.php';
            create($_POST['title'], $_POST['content']);
            break;
        case 'updating':
            require_once 'controllers/update.php';
            update($_GET['id'], $_POST['title'], $_POST['content']);
            break;
        case 'deleting':
            require_once 'controllers/delete.php';
            delete($_GET['id']);
            break;
        case 'login':
            require_once 'controllers/login.php';
            login(
                $_POST['username'],
                $_POST['password'],
                isset($_POST['remember']) ? $_POST['remember'] : '',
                isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : ''
            );
            break;
        case 'register':
            require_once 'controllers/register.php';
            register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['verifypassword']);
            break;
        case 'logout':
            require_once 'controllers/logout.php';
            logout();
            break;
        case 'update_info':
            require_once 'controllers/change_info.php';
            change_info($_POST['username'], $_POST['email'], $_POST['bio']);
            break;
        case 'change_password':
            require_once 'controllers/change_password.php';
            change_password($_POST['oldPassword'], $_POST['newPassword'], $_POST['verifyPassword']);
            break;
        case 'recover_password':
            require_once 'controllers/change_password.php';
            recover_password($_GET['token'], $_POST['newPassword'], $_POST['verifyPassword']);
            break;
        case 'recover_account':
            require_once 'controllers/recover_account.php';
            recover_account($_POST['email']);
            break;
        case 'delete__account':
            require_once 'controllers/delete.php';
            delete_account($_POST['password']);
            break;
        case 'delete__user':
            require_once 'controllers/delete.php';
            delete_user($_POST['user-id']);
            break;
        case 'upload__avatar':
            require_once 'controllers/uploads.php';
            upload_avatar($_FILES['imagen']);
            break;
        case 'upload__banner':
            require_once 'controllers/uploads.php';
            upload_banner($_FILES['imagen']);
            break;
    }
}
