<?php
require_once('../Model/facultyModel.php');

class authController {
    private $authModel;

    public function __construct() {
        $this->authModel = new facultyModel();
    }

    private function setCorsHeaders() {
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Max-Age: 3600");
    }

    public function getAllData_API() {
        $this->setCorsHeaders();

        $data = json_decode(file_get_contents('php://input'), true);

        $procedure = "auth_login";
        try {
            $result = $this->authModel->Auth($procedure, $data);
            $datas = is_array($result) ? $result : [];
            echo json_encode($datas);
        } catch (Exception $e) {
            echo json_encode("Error: ".$e->getMessage());
        }
    }
}

?>