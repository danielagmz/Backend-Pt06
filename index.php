<?php
// Daniela Gamez 
require_once 'controllers/controlador.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'read';
    }

    switch ($action) {

        case 'create':
            include 'views/insert.php';
            break;
        case 'delete':
            include 'views/delete.php';
            break;
        case 'update':
            include 'views/update.php';
            break;
        case 'updating':
            read_one($_GET['id'], 'update');
            break;
        case 'deleting':
            read_one($_GET['id'], 'delete');
            break;
        case 'reading':
            read_one($_GET['id'], 'read');
            break;
        default:
            include 'views/read.php';
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    switch ($action) {
        case 'create':
            create($_POST['title'], $_POST['content']);
            break;
        case 'updating':
            update($_GET['id'], $_POST['title'], $_POST['content']);
            break;
        case 'deleting':
            delete($_GET['id']);
            break;
    }
}
