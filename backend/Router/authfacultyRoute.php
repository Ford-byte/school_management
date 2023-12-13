<?php
require_once('../Controller/authController.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';



$controller = new authController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'auth':
            $controller->getAllData_API();
            break;
        default:
            echo json_encode("Invalid action.");
            break;
    }
}
?>