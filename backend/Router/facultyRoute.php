<?php
require_once('../Controller/facultyController.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';



$controller = new facultyController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'create':
            $controller->getCreate_API();
            break;
        case 'getAll':
            $controller->getAllData_API();
            break;
        case 'update':
            $controller->getUpdate_API();
            break;
        case 'delete':
            $controller->getDelete_API();
            break;
        case 'savePrivilage':
            $controller->getCreatePrivilage_API();
            break;
        case 'revokePrivilage':
            $controller->revokePrivilage_API();
            break;
        default:
            echo json_encode("Invalid action.");
            break;
    }
}
?>