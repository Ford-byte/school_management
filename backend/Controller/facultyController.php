<?php
require_once('../Model/facultyModel.php');

class facultyController {
    private $facultyModel;

    public function __construct() {
        $this->facultyModel = new facultyModel();
    }

    private function setCorsHeaders() {
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Max-Age: 3600");
    }

    public function getCreate_API() {
        $this->setCorsHeaders();

        $data = json_decode(file_get_contents('php://input'), true);

        $procedure = "add_faculty";
        try {
            
            $data = $this->uploads();

            $result = $this->facultyModel->create($procedure, $data);
            echo json_encode("Success: Data inserted successfully.");
        } catch (Exception $e) {
            echo json_encode("Error: ".$e->getMessage());
        }
    }

    public function getCreatePrivilage_API(){
        $this->setCorsHeaders();
    
        $data = json_decode(file_get_contents('php://input'), true);
    
        $procedure = "add_privilageAdmin";
        try {
            $result = $this->facultyModel->create($procedure, $data);
            echo json_encode(["message" => "Success: Data inserted successfully."]);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error: ".$e->getMessage()]);
        }
    }
    

    public function getUpdate_API() {
        $this->setCorsHeaders();
    
        $data = json_decode(file_get_contents('php://input'), true);
    
        $procedure = "edit_faculty";
        try {
           $data = $this->UpdateFaculty();
    
            $result = $this->facultyModel->update($procedure, $data);
            echo json_encode("Success: Data updated successfully.");
        } catch (Exception $e) {
            echo json_encode("Error: ".$e->getMessage());
        }
    }
    

    public function getDelete_API() {
        $this->setCorsHeaders();

        $id = json_decode(file_get_contents('php://input'), true);

        $procedure = "del_faculty";
        try {
            $result = $this->facultyModel->destroy($procedure, $id);
            echo json_encode("Success: Data Deleted successfully.");
        } catch (Exception $e) {
            echo json_encode("Error: ".$e->getMessage());
        }
    }

    public function revokePrivilage_API(){
        $this->setCorsHeaders();

        $id = json_decode(file_get_contents('php://input'), true);

        $procedure = "revoke_privilage";
        try {
            $result = $this->facultyModel->destroy($procedure, $id);
            echo json_encode("Success: Data Deleted successfully.");
        } catch (Exception $e) {
            echo json_encode("Error: ".$e->getMessage());
        }
    }

    public function getAllData_API() {
        $this->setCorsHeaders();

        $procedure = "get_faculty";
        try {
            $result = $this->facultyModel->All($procedure);
            $data = is_array($result) ? $result : [];
            echo json_encode($data);
        } catch (Exception $e) {
            echo json_encode("Error: ".$e->getMessage());
        }
    }

    
    public function uploads(){
        $uploadDirectory = 'D:/xammp/htdocs/management/frontend/src/assets/uploads/';
        $filename = null;
        $data = [];
    
        if (isset($_FILES['profile']) && !empty($_FILES['profile']['name'])) {
            $originalFilename = $_FILES['profile']['name'];
            $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
    
            $filename = bin2hex(random_bytes(8)) . '.' . $extension;
    
            $uploadedFile = $uploadDirectory . $filename;
    
            if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadedFile)) {
                $data['profile'] = $filename;
                $data['fname'] = $_POST['fname'];
                $data['lname'] = $_POST['lname'];
                $data['email'] = $_POST['email'];
                $data['password'] = $_POST['password'];
                $data['dob'] = $_POST['dob'];
                $data['departmentId'] = $_POST['departmentId'];
                $data['position'] = $_POST['position'];
                $data['address'] = $_POST['address'];
                $data['phoneNumber'] = $_POST['phoneNumber'];
            } else {
                throw new Exception("Error: File upload failed.");
            }
        }
    
        return $data;
    }
    

    public function UpdateFaculty() {
        $uploadDirectory = 'D:/xammp/htdocs/management/frontend/src/assets/uploads/';
        $filename = null;
        $data = [];

        if (isset($_FILES['profile']) && !empty($_FILES['profile']['name'])) {
            $originalFilename = $_FILES['profile']['name'];
            $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $filename = bin2hex(random_bytes(8)) . '.' . $extension;

            $uploadedFile = $uploadDirectory . $filename;

            if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadedFile)) {
                $data['id'] = $_POST['id'];
                $data['profile'] = $filename;
                $data['fname'] = $_POST['fnameEdit']; 
                $data['lname'] = $_POST['lnameEdit'];
                $data['email'] = $_POST['emailEdit'];
                $data['password'] = $_POST['passwordEdit'];
                $data['dob'] = $_POST['dobEdit'];
                $data['departmentId'] = $_POST['departIdEdit'];
                $data['position'] = $_POST['posEdit'];
                $data['address'] = $_POST['addressEdit'];
                $data['phoneNumber'] = $_POST['cpNumberEdit'];
            } else {
                throw new Exception("Error: File upload failed.");
            }
        }

        return $data;
    }
}
?>