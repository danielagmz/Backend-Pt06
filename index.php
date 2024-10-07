<?php
// Daniela Gamez 
require_once 'controllers/controlador.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'read-anonimo';
    }

    switch ($action) {

        case 'create':
            include 'views/principales/insert.php';
            break;
        case 'delete':
            include 'views/principales/delete.php';
            break;
        case 'update':
            include 'views/principales/update.php';
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
        case 'reading-anonimo':
            read_one($_GET['id'], 'read-anonimo');
        break;
        case 'login': 
            include 'views/secundarias/login.php';
        break;
        case 'register': 
            include 'views/secundarias/register.php';
        break;
        case 'read':
            include 'views/principales/read.php';
        break;
        default:
            include 'views/principales/read-anonimo.php';
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
